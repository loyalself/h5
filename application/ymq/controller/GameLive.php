<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2018/9/17
 * Time: 17:23
 */

namespace app\ymq\controller;


use app\common\BaseController;
use think\Db;
class GameLive extends BaseController
{
    private $tableName = 'game_live';

    /**
     * 查看赛程列表,这里具体到某一场比赛
     * @param int bigGame_id 大赛id     是从阶段列表查看赛程传过来的
     * @param int phase_id   阶段赛id   是从阶段列表查看赛程传过来的
     */
    public function liveList()
    {
        $where = [];
        $phase_id = input('param.phase_id');
        $bigGame_id = input('param.bigGame_id');
        $where['phase_id'] =  $phase_id;
        $where['bigGame_id'] = $bigGame_id;
        $list = Db::table($this->tableName)->where($where)->select();
        foreach($list as $k=>$v)
        {
            //查看当前比赛有无竞猜,比赛表里的主键id关联竞猜表里的game_id
            $game_id = $v['id'];
            $is_guess = Db::table('guess_list')->where('game_id',$game_id)->find();
            if($is_guess)
            {
                $list[$k]['is_guess'] = 1;
            }else{
                $list[$k]['is_guess'] = 0;
            }
            if(empty($v['winner']))
            {
                $list[$k]['winner'] = '胜负未分';
            }else{
                $list[$k]['winner'] = Db::table('star_list')->where('id',$v['winner'])->value('c_name');
            }
            $list[$k]['who_beat_who'] = $v['play_a_name'].'&nbsp;<strong>VS</strong>&nbsp;'.$v['play_b_name'];
        }
        return view('',[
            'list'=>$list,
            'bigGame_id'=>$bigGame_id,
            'phase_id'=>$phase_id
        ]);
    }

    /**
     * 添加比赛(直播)或修改
     */
    public function live()
    {
        $bigGame_id = input('param.bigGame_id');
        $phase_id = input('param.phase_id');
        if(request()->isPost())
        {
            $post = input('post.');
            $post['start_time'] = strtotime($post['start_time']);
            if($post['play_a_name'] == $post['play_b_name'] && (empty($post['play_a_name']) || empty($post['play_b_name'])))
            {
                return $this->error('两边的对战名称不能相同或者对战名称不能为空',0);
            }
            $play_a_name = $post['play_a_name'];
            $play_b_name = $post['play_b_name'];
            $play_a_id = Db::table('star_list')->where('c_name',$play_a_name)->value('id');
            $play_b_id = Db::table('star_list')->where('c_name',$play_b_name)->value('id');
            $post['play_a_id'] = $play_a_id;
            $post['play_b_id'] = $play_b_id;

            //将对战人员的主键id存进去,没有存中文
            if(!empty($play_a_id) && !empty($play_b_id))
            {
                $post['who_beat_who'] = $play_a_id.','.$play_b_id;
            }
            if(empty($post['a_win_num']))
            {
                $post['a_win_num'] = 0;
            }
            if(empty($post['b_win_num']))
            {
                $post['b_win_num'] = 0;
            }
            //如果 a_win_num 或 b_win_num有一个有值,就代表比赛已经结束
            if(!empty($post['a_win_num']) || !empty($post['b_win_num']))
            {
                $post['is_end'] = 3;        // 3代表比赛结束
                if($post['a_win_num'] > $post['b_win_num'])
                {
                    $post['winner'] = $post['play_a_id'];
                    //TODO:根据比分更新投注为输的球员(或国家)投注状态为失败
                }elseif($post['a_win_num'] < $post['b_win_num'])
                {
                    $post['winner'] = $post['play_b_id'];
                    //TODO:根据比分更新投注为输的球员(或国家)投注状态为失败
                }
            }

            try{
                $id = model('GameLive')->addLive($post);  //成功后的主键id
            }catch (\Exception $e){
                return $this->error($e->getMessage(),0);
            }
            if($id && empty($post['id']))  //表示新增
            {
                //比赛场次编号:大赛id + 阶段id  第一场:为大赛id + 阶段id + 1,然后依次递增
                $game_number = Db::table($this->tableName)->where(['bigGame_id'=>$bigGame_id,'phase_id'=>$phase_id])->value('game_number');
                $game_number = intval($game_number);
                if(empty($game_number))
                {
                    $game_number = 1;
                    $game_number = $bigGame_id.$phase_id.$game_number;
                }else{
                    $game_number = $game_number+1;
                }
                try{
                    $res = model('GameLive')->isUpdate(true)->save(['id'=>$id,'game_number'=>$game_number]);
                }catch (\Exception $e){
                    return $this->error($e->getMessage(),0);
                }
                return $this->result(['jump_url'=>url('gameLive/liveList',['bigGame_id'=>$bigGame_id,'phase_id'=>$phase_id])],1,'ok');
            }else{
                $bigGame_id = input('post.bigGame_id');
                $phase_id = input('post.phase_id');
                return $this->result(['jump_url'=>url('gameLive/liveList',['bigGame_id'=>$bigGame_id,'phase_id'=>$phase_id])],1,'ok');
            }
        }
        //修改,这个id是通过url传进来的,是比赛的主键id
        $id = input('id');
        $one = Db::table($this->tableName)->where('id',$id)->find();
        return view('',[
            'bigGame_id'=>$bigGame_id,
            'phase_id'=>$phase_id,
            'one'=>$one
        ]);
    }

    /**
     * 对战对手实时搜索
     * @param name string 名字
     * @param who  int  哪一边 1代表左边 | 2代表右边
     * @return array | string
     */
    public function search()
    {
        $name = input('get.name');
        $who = input('get.who');
        $result = Db::table('star_list')->where('c_name','like',"{$name}%")->select();
        $res = '';
        if($result)
        {
            foreach($result as $v)
            {
                $res .= '<li onclick="choice(this, ' .$who.')">' . $v['c_name'] . '</li>';
            }
        }else{
            $res = '暂时没有结果,请添加';
        }
        echo $res;
        exit;
    }
    /**
     * 删除
     */
    public function del()
    {
        if(request()->isPost())
        {
            $id = input('post.id');
            try{
                $res = Db::table($this->tableName)->where('id',$id)->delete();
            }catch (\Exception $e){
                return json_show($e->getMessage(),0);
            }
            if($res)
            {
                return json_show('删除成功',1);
            }else{
                return json_show('删除失败',0);
            }
        }else{
            return json_show('操作异常,请稍后再试',0);
        }
    }
}
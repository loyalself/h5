<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2018/8/24
 * Time: 14:50
 */

namespace app\ymq\controller;

use app\common\BaseController;
use think\Db;

class Match extends BaseController
{
    private $tableName = 'big_game_list';
    /*
     * 羽毛球赛程列表(即大赛表)
     */
    public function matchList()
    {
        $list = Db::table('big_game_list')->select();
        return view('matchlist',['list'=>$list]);
    }
    /*
     * 羽毛球大赛添加和修改
     */
    public function addMatch()
    {
        if(request()->isPost())
        {
            $post = input('post.');
            $post['sport_id'] = 1;
            try{
                $res = model('BigGame')->add($post);
            }catch (\Exception $e){
                return $this->error($e->getMessage(),0);
            }
            if($res)
            {
                return $this->result(['jump_url'=>url('match/matchList')],1,'ok');
            }else{
                return $this->error('操作失败',0);
            }
        }
        $id = intval(input('id'));
        $one = Db::table($this->tableName)->where('id',$id)->find();
        return view('addmatch',['one'=>$one]);
    }
    /*
     * 羽毛球直播列表
     */
    public function matchLive()
    {
        return 'matchLive';
    }
    /*
     * 其它赛事列表
     */
    public function matchOther()
    {
        return 'matchOthersss';
    }

    /**
     * 删除
     * @return bool|int
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function del()
    {
        $id = intval(input('post.id'));
        $res = $this->comDel($this->tableName,$id);
        return $res;
    }
}
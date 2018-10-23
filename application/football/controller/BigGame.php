<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2018/8/24
 * Time: 14:50
 */

namespace app\football\controller;

use app\common\BaseController;
use think\Db;

class BigGame extends Common
{
    private $tableName = 'big_game_list';
    /*
     * 羽毛球赛程列表(即大赛表)
     */
    public function bigGameList()
    {
        $list = $this->db->table('big_game_list')->select();
        return view('',['list'=>$list]);
    }
    /*
     * 羽毛球大赛添加和修改
     */
    public function bigGame()
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
                return $this->result(['jump_url'=>url('bigGame/bigGameList')],1,'ok');
            }else{
                return $this->error('操作失败',0);
            }
        }
        $id = intval(input('id'));
        //$one = Db::table($this->tableName)->where('id',$id)->find();
        $one = $this->db->table($this->tableName)->where('id',$id)->find();
	return view('',['one'=>$one]);
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
        try{
            $res = $this->db->table('big_game_list')->where('id',$id)->delete();
        }catch (\Exception $e){
            return json_show($e->getMessage(),0);
        }
        if($res)
        {
            return json_show('删除成功',1);
        }else{
            return json_show('删除失败',0);
        }
    }
}

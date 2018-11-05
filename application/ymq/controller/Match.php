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
use think\response\Json;

class Match extends BaseController
{
    private $tableName = 'big_game_list';
    /*
     * 羽毛球赛程列表(即大赛表)
     * status 为1代表当前大赛被删除(即屏蔽,不展示)
     */
    public function matchList()
    {
        $list = Db::table('big_game_list')->where('status','neq',1)->select();
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
    /**
     * 删除,更改大赛的状态,并不是硬删除
     * @param  id int primary key
     * @param  status 为1代表删除(即屏蔽)
     * @return Json
     */
    public function del()
    {
        if(request()->isPost())
        {
            $id = input('post.id');
            try{
                $sql1 = "update big_game_list b INNER JOIN game_phase g 
                         on b.id=g.bigGame_id
                         set b.status=1,g.status=1 where b.id = $id";

                $sql2 = "update game_live set status = 1 where bigGame_id = $id";

                $res1 = Db::execute($sql1);
                $res2 = Db::execute($sql2);
            }catch (\Exception $e){
                return json_show($e->getMessage(),0);
            }
            if($res1 && $res2)
            {
                return json_show('删除成功',1);
            }else{
                return json_show('删除失败',0);
            }
        }
    }
}

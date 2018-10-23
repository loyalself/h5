<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2018/9/29
 * Time: 11:55
 */

namespace app\ymq\controller;


use app\common\BaseController;
use think\Db;

class BatchDel extends BaseController
{
    public function userList()
    {
        $list = Db::table('batchdel')->select();
        return view('',['list'=>$list]);
    }
    public function del()
    {
        $post = input('post.');
        foreach($post as $k=>$v)
        {
            $ids = implode(',',$v);
        }
       $res = Db::execute("delete from batchdel where id in($ids)");
        if($res)
        {
            return json_show('删除成功',1);
        }else{
            return json_show('fail',0);
        }
    }
}
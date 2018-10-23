<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2018/9/27
 * Time: 10:36
 */

namespace app\ymq\controller;


use app\common\BaseController;

class PostCard extends BaseController
{
    public function postList()
    {
        $list = $this->db->table('postcard')->order('id desc')->paginate(10);
        return view('',['list'=>$list]);
    }

    public function postCard()
    {
        return view();
    }
}
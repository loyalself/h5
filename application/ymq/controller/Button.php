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

class Button extends BaseController
{
    public function buttonList()
    {
        $list = Db::table('control_button')->select();
        return view('',['list'=>$list]);
    }
    /*
     * 按钮添加和修改
     */
    public function button()
    {
        if(request()->isPost())
        {
            $post = input('post.');
            try{
                $res = model('button')->add($post);
            }catch (\Exception $e){
                return $this->error($e->getMessage(),0);
            }
            if($res)
            {
                return $this->result(['jump_url'=>url('button/buttonList')],1,'ok');
            }else{
                return $this->error('操作失败',0);
            }
        }
        $id = intval(input('id'));
        $one = $this->db->table('control_button')->where('id',$id)->find();
        return view('',['one'=>$one]);
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
            $res = Db::table('control_button')->where('id',$id)->delete();
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

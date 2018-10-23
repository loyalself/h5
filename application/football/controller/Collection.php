<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2018/9/26
 * Time: 20:35
 */

namespace app\ymq\controller;


use app\common\BaseController;
use think\Db;

class Collection extends BaseController
{
    public $db;

    public function _initialize()
    {
        $this->db = Db::connect('mysql://ymqtv:ymqtv123@39.108.214.73:3306/ymqtv#utf8');
    }

    public function collecList()
    {
        //$list = Db::table('collection')->order('id desc')->select();
        $list = $this->db->table('collection')->order('id desc')->select();
        return view('',['list'=>$list]);
    }

    public function collection()
    {
        if(request()->isPost())
        {
            $data = input('post.');
            try{
                $id = model('Collection')->add($data);
            }catch (\Exception $e){
                return $this->error($e->getMessage());
                //return $this->result('',0,'新增失败');
            }
            if($id)
            {
                return $this->result(['jump_url'=>url('collection/collecList')],1,'ok');
            }else{
                return $this->result('',0,'操作失败');
            }
        }
        //如有修改,获取到要修改的id
        $id = intval(input('param.id'));
        $one = Db::table('collection')->where('id',$id)->find();
        return view('',['one'=>$one]);
    }
    /**
     * 删除
     * @param int id
     */
    public function del()
    {
        if(request()->isPost())
        {
            $id = input('post.id');
            try{
                //$res = Db::table('collection')->where('id',$id)->delete();
                $res = $this->db->table('collection')->where('id',$id)->delete();
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
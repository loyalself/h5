<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2018/9/17
 * Time: 10:33
 */

namespace app\billiards\controller;


use app\common\BaseController;
use think\Db;

class Sport extends BaseController
{
    /**
     * 运动种类列表
     */
    public function sportList()
    {
        $list = $this->db->table('sport_name')->select();
        return view('',['list'=>$list]);
    }

    /**
     * 添加和修改
     */
    public function sport()
    {
        if(request()->isPost())
        {
            $post = input('post.');
            try{
                $res = model('Sport')->add($post);
            }catch(\Exception $e){
                return json_show($e->getMessage(),0);
            }
            if($res)
            {
                return json_show('操作成功',1);
            }else{
                return json_show('操作失败',0);
            }
        }
        //若有修改
        $id = intval(input('id'));
        $one = $this->db->table('sport_name')->where('id',$id)->find();
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
                $res = $this->db->table('sport_name')->where('id',$id)->delete();
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

    /**
     * 修改状态
     * @param int id
     */
    public function changeStatus()
    {
        if(request()->isPost())
        {
            $data = input('post.');
            try{
                $res = $this->db->table('sport_name')->where('id',$data['id'])->update(['is_show'=>$data['value']]);
            }catch (\Exception $e){
                return json_show($e->getMessage(),0);
            }
            if($res)
            {
                return json_show('操作成功',1);
            }else{
                return json_show('操作失败',0);
            }
        }else{
            return json_show('操作异常,请稍后再试',0);
        }
    }
}
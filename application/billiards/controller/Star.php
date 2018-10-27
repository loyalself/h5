<?php

namespace app\billiards\controller;

use app\common\BaseController;
use think\Db;
use think\Request;

class Star extends Common
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function starList()
    {
        $list = $this->db->table('star_list')->paginate(10);;
        return view('',['list'=>$list]);
    }

    /***
     * 新增和修改
     * @return \think\response\View|void
     */
    public function star()
    {
        if(request()->isPost())
        {
            $post = input('post.');
            try{
                $res = model('Star')->add($post);
            }catch (\Exception $e){
                return json_show($e->getMessage(),0);
            }
            if($res)
            {
                return json_show('操作成功',1);
            }else{
                return json_show('操作失败',0);
            }
        }
        //如有修改,获取到要修改的id
        $id = intval(input('param.id'));
        $one = $this->db->table('star_list')->where('id',$id)->find();
        return view('',['one'=>$one]);
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
                $res = $this->db->table('star_list')->where('id',$data['id'])->update(['status'=>$data['value']]);
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
                $res = $this->db->table('star_list')->where('id',$id)->delete();
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

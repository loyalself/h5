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
use app\ymq\model\Information as News;
use think\paginator;
class Information extends BaseController
{

    public $db;

    public function _initialize()
    {
        $this->db = Db::connect('mysql://ymqtv:ymqtv123@39.108.214.73:3306/ymqtv#utf8');
    }

    /**
     * 首页热点新闻列表
     */
    public function informationList()
    {
      //$list = Db::table('information')->paginate(10);
      $list = $this->db->table('information')->paginate(10);
      $this->assign('list', $list);
      return $this->fetch('list');
    }

    /**
     * 热点新闻添加
     */
    public function add()
    {
        if(request()->isPost())
        {
            $data = input('post.');
            try{
                $id = model('information')->add($data);
            }catch (\Exception $e){
                return $this->error($e->getMessage());
                //return $this->result('',0,'新增失败');
            }
            if($id)
            {
                return $this->result(['jump_url'=>url('information/informationList')],1,'ok');
            }else{
                return $this->result('',0,'fail');
            }
        }
        //获取热点新闻id
        $id = input('param.id');
        //$one = Db::table('information')->where('id',$id)->find();
        $one = $this->db->table('information')->where('id',$id)->find();
        return view('add',['one'=>$one]);
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
                //$res = Db::table('information')->where('id',$id)->delete();
                $res = $this->db->table('information')->where('id',$id)->delete();
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
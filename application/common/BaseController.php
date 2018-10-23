<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2018/8/24
 * Time: 15:02
 */

namespace app\common;
use think\Controller;
use think\Cookie;
use think\Db;

class BaseController extends Controller
{
    //public $db;

    public function _initialize()
    {
        $username = Cookie::get('username');
        if(is_null($username))
        {
            $this->error('您还没有登录','ymq/login/index');
        }
        //$this->db = Db::connect('mysql://ymqtv:ymqtv123@39.108.214.73:3306/ymqtv#utf8');
    }

    /**
     * 查询多条数据
     * @param $tableName
     * @param array $where
     * @return false|\PDOStatement|string|\think\Collection|void
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function comList($tableName,$where = [])
    {
        if(!empty($tableName))
        {
            $list = Db::table($tableName)->where($where)->select();
            return $list;
        }else{
            return json_show('表名不能为空',0);
        }
    }

    /**
     * 公共删除方法
     * @param $tableName  表名
     * @param $id         主键id
     * @return bool|int
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function comDel($tableName,$id)
    {
       if(request()->isPost())
       {
           if(empty($tableName) || empty($id))
           {
               return json_show('表名或id为空',0);
           }
           try{
               $res = Db::table($tableName)->where('id',$id)->delete();
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
       return json_show('操作异常,请稍后再试',0);
    }
}
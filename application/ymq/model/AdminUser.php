<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2018/9/12
 * Time: 14:31
 */

namespace app\ymq\model;

use think\Db;
class AdminUser extends Base
{
    /**
     * 管理员的添加
     * @return array|bool
     */
    public function add_admin()
    {
        $data = [];
        $uid = input('post.uid');
        if(!empty($uid))
        {
            $this->changeAdmin();
        }
        //获取到表单提交上来的数据
        $data['username'] = input('post.username');
        $data['password'] = password_hash(input('post.password'),true);  //密码加密
        $data['create_time'] = time();
        $data['status'] = input('post.status');
        $group_id = input('post.adminRole');
        try{
            Db::startTrans();       //开启事务
            $res1 = $this->add($data);
            $res2 = Db::table('admin_group_access')->insert(['uid'=>$res1,'group_id'=>$group_id]);
            if($res1 && $res2)
            {
                Db::commit();
                return true;
            }
        }catch (\Exception $e){
            Db::rollback();
            return ['msg'=>$e->getMessage()];
        }
    }

    /**
     * 修改管理员
     * @return bool|void
     */
    public function changeAdmin()
    {
        $post = request()->post();
        try{
           $res1 =  Db::table('admin_group_access')
                    ->where('uid', $post['uid'])
                    ->update(['group_id' => $post['adminRole']]);
           $res2 = Db::table('admin_user')
                    ->where('id',$post['uid'])
                    ->update(['username'=>$post['username']]);
           if($res1 && $res2)
           {
               return true;
           }
        }catch (\Exception $e){
            return json_show($e->getMessage(),0);
            return false;
        }
        return true;
    }
    /**
     * 密码修改
     * @return bool|void
     */
    public function pwdEdit()
    {
        $post = input('post.');
        $password = password_hash($post['password'],true);
        try{
           $res = $this->allowField(['password'])->save(['password'=>$password],['id'=>$post['id']]);
        }catch (\Exception $e){
            return json_show($e->getMessage(),0);
            return false;
        }
        return true;
    }
}
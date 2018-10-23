<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2018/9/12
 * Time: 17:39
 */

namespace app\ymq\controller;

use app\common\BaseController;
use app\ymq\model\AdminUser;
use think\Db;
class Admin extends BaseController
{
    /**
     * 管理员列表
     */
    public function adminList()
    {
        $admin_list = Db::table('admin_user')
                        ->alias('a')
                        ->join('admin_group_access b','a.id = b.uid')
                        ->join('admin_role_group c','b.group_id = c.id')
                        ->field('a.id,a.username,c.groupname,a.create_time,a.status')
                        ->paginate(10);

        return view('',['admin_list'=>$admin_list]);
    }

    /**
     * 管理员的添加和修改
     */
    public function admin()
    {
        if(request()->isPost())
        {
            $res = model('AdminUser')->add_admin();
            if($res)
            {
                return json_show('操作成功',1);
            }else{
                return json_show('操作失败',0);
            }
        }
        //查询出有多少种角色组
        $result = Db::table('admin_role_group')->select();
        //获取到修改的管理员id
        $id = intval(input('id'));
        //dump($id);
        $one = Db::table('admin_user')
                ->alias('a')
                ->join('admin_group_access b','a.id=b.uid')
                ->join('admin_role_group c','b.group_id=c.id')
                ->field('a.id,a.username,b.group_id,c.groupname')
                ->where(['a.id'=>$id])
                ->find();
        return view('',[
            'one'=>$one,
            'result'=>$result
        ]);
    }

    /**
     * 密码修改
     * @return \think\response\View
     */
    public function pwdEdit()
    {
        if(request()->isPost())
        {
            $res = model('AdminUser')->pwdEdit();
            if($res)
            {
                return json_show('修改成功',1);
            }else{
                return json_show('修改失败,请稍后重试',0);
            }
        }
        $id = intval(input('param.id'));
        $one = Db::table('admin_user')->where('id',$id)->find();
        return view('',['one'=>$one]);
    }

}
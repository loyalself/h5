<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2018/9/12
 * Time: 17:22
 */

namespace app\ymq\controller;

use app\common\BaseController;
use think\Db;
class AdminRoleGroup extends BaseController
{
    /**
     * 角色组列表 如:超级管理员拥有的权限  1,2,3....很多
     *              普通管理员
     * @return \think\response\View
     */
    public function roleList()
    {
        $role_list = Db::table('admin_role_group')->select();
        return view('',['role_list'=>$role_list]);
    }

    /**
     * 角色组的修改和添加
     * @return \think\response\View|void
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function role()
    {
        if(request()->post())
        {
            $role_data = input('post.');
            $role_data['rules'] = implode(',',$role_data['ids']);
            unset($role_data['ids']);
            $res = model('AdminRoleGroup')->add($role_data);
            if($res)
            {
                return json_show('操作成功',1);
            }else{
                return json_show('操作失败',0);
            }
        }
        //若有修改,获取到要修改的角色组主键id
        $id = intval(input('param.id'));
        $one = Db::table('admin_role_group')->where('id',$id)->find();
        //先查出顶级分类,P_id为0的
        $list = Db::table('admin_rule')->where('p_id',0)->select();
        $result = [];
        foreach($list as $k=>$v)
        {
            $result[$v['title']] = Db::table('admin_rule')->where('p_id',$v['id'])->select();
        }
        return view('',[
            'list'=>$result,
            'one'=> $one
        ]);
    }
}
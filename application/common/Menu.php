<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2018/9/15
 * Time: 9:32
 */

namespace app\common;


use think\Cookie;
use think\Db;

class Menu
{
    const GROUP_ID = 1;             //超级管理员

    public static function getMenu()
    {
       $is_admin  = self::getAid();
       $aid = $is_admin ? : 0;
       //获取当前登录用户拥有的权限组
       $rules =  Db::table('admin_user')
                    ->alias('a')
                    ->join('admin_group_access b','a.id=b.uid')
                    ->join('admin_role_group c','b.group_id=c.id')
                    ->field('a.*,b.group_id,c.rules')
                    ->where(['a.id'=>$aid])
                    ->find();
        $rules = empty($rules) ? 0 : $rules;
        if(empty($rules))
        {
            exit('你不具备任何管理权限无法登录');
        }
        //如果是超级管理员则获取所有的权限(TODO:这里有点问题,关于用户身份)
        if($rules['group_id'] == MENU::GROUP_ID)
        {
            $parent_menu_where = "p_id = 0";
            $son_menu_where = "p_id != 0 and is_show = 1";
        }else{
            $parent_menu_where = "id in ({$rules['rules']}) and p_id = 0";
            $son_menu_where  = "id in ({$rules['rules']}) and p_id != 0 and is_show = 1";
        }
        //先查询出父级菜单
        $parent_menu = Db::table('admin_rule')
                      ->where($parent_menu_where)
                      ->order('id asc')
                      ->select();
        //查出子级菜单
        $son_menu = Db::table('admin_rule')
                    ->where($son_menu_where)
                    ->order('id asc')
                    ->select();
        $menu = [];
        foreach($parent_menu as $k=>$v)
        {
            foreach($son_menu as $k1=>$v1)
            {
                if($v1['p_id'] == $v['id'])
                {
                    $menu[$k]['parentMenu'] = $v;
                    $menu[$k]['sonMenu'][]  = $v1;
                }
            }
        }
        return $menu;
    }

    /**
     * 获取登录用户的id
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    private static function getAid()
    {
        $username = Cookie::get('username');
        $aid = Db::table('admin_user')->field('id')->where('username',$username)->find();
        if(!$aid['id'])
        {
            return false;
        }
        return $aid['id'];
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2018/8/24
 * Time: 14:50
 */

namespace app\billiards\controller;

use app\common\BaseController;
use app\common\Menu;
use think\Db;
class Index extends BaseController
{
    public function welcome()
    {
        return "<h1>H5后台管理系统</h1>";
    }
    /**
     * 后台首页展示
     */
    public function index()
    {
        $result = [
            'label' => '首页',
            'menu'  => Menu::getMenu(),
        ];
        //halt($result);
        return view('',['result'=>$result]);
    }
    /*
     * 赛程列表
     */
    public function schedule_list()
    {
        return 'schedule_list';
    }


}
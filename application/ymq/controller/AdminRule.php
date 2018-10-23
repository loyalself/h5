<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2018/9/13
 * Time: 16:07
 */

namespace app\ymq\controller;


use app\common\BaseController;
use think\Db;

class AdminRule extends BaseController
{

    /**
     * 权限列表
     * @return \think\response\View
     */
    public function ruleList()
    {
        $rule_list = Db::table('admin_rule')->select();
        $rule_list = infinite($rule_list,0,0);
        return view('',['rule_list'=>$rule_list]);
    }

    /**
     * 权限的修改和更新
     * @return \think\response\View|void
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function rule()
    {
        if(request()->isPost())
        {
            $rule_data = input('post.');
            $res = model('AdminRule')->add($rule_data);
            if($res)
            {
                return json_show('操作成功',1);
            }else{
                return json_show('操作失败',0);
            }
        }
        //若有修改,获取到修改权限主键id,查出这条权限数据
        $id = intval(input('param.id'));
        $one = Db::table('admin_rule')->where('id',$id)->find();
        //dump($one);
        $parent_rule = Db::table('admin_rule')
                        ->where('p_id',0)
                        ->field('id,title,status')
                        ->select();
        $result = [
            'one'=>$one,
            'parent_rule'=>$parent_rule
        ];
        return view('',['result'=>$result]);
    }
}
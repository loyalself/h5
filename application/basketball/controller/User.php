<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2018/9/12
 * Time: 17:39
 */

namespace app\basketball\controller;

use think\Db;
class User extends Common
{
    /**
     * 注册用户列表
     */
    public function userList()
    {
        //获取到用户输入的搜索数据
        $data = input('param.');
        $whereData = [];
        if(!empty($data['start_time']) && !empty($data['end_time']) && $data['start_time']<$data['end_time'])
        {
            $whereData['reg_time'] = [
                ['gt',strtotime($data['start_time'])],    //大于
                ['lt',strtotime($data['end_time'])]       //小于
            ];

        }
        if(!empty($data['username']))
        {
            $whereData['username|phone'] = ['like','%'.$data['username'].'%'];
        }
        if(!empty($whereData))
        {
            $user_list = $this->db->table('userinfo')
                ->where($whereData)
                ->order('id asc')
                ->field('id,phone,username,reg_time,recharge_amount,operation_amount,total_amount')
                ->paginate(10);
        }else{
            $user_list = $this->db->table('userinfo')
                ->order('id asc')
                ->field('id,phone,username,reg_time,recharge_amount,operation_amount,total_amount')
                ->paginate(10);
        }
        //查询用户充值总金额
        $userAllRecharge = $this->db->table('userinfo')->sum('recharge_amount');
        //dump($userAllRecharge); 格式float()
        //查询今日充值总金额
        //select * from 表名 where to_days(时间字段名) = to_days(now());
        $night = strtotime(date('Y-m-d', time()));
        $day = strtotime(date('Y-m-d', time()))+86400;    //86400为一天的秒数
        $where['reg_time'] = ['between',$night.",".$day];       //用between判断
        //$todayUserRecharge = $this->db->table('userinfo')->where($where)->sum('recharge_amount');
        $sql = "select sum('recharge_amount') as recharge_amount,sum('operation_amount') as operation_amount from userinfo";
        $money = $this->db->query($sql);
        foreach ($money as $k=>$v)
        {
            $todayUserRecharge = $v['recharge_amount'];
            $todayUserWithDraw = $v['operation_amount'];
        }
        return view('',[
            'user_list'=>$user_list,
            'start_time'=>empty($data['start_time']) ?'': $data['start_time'],
            'end_time'=>empty($data['end_time']) ?'': $data['end_time'],
            'username'=>empty($data['username']) ?'': $data['username'],
            'userAllRecharge'=>$userAllRecharge,
            'todayUserRecharge'=>$todayUserRecharge,
            'todayUserWithDraw'=>$todayUserWithDraw,
        ]);
    }
}

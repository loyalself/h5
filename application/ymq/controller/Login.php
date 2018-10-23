<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2018/8/24
 * Time: 15:08
 */

namespace app\ymq\controller;

use think\Controller;
use think\Cookie;
use think\Db;
use think\Request;

class Login extends Controller
{
    /**
     * 后台登录首页展示
     */
    public function index()
    {
        if(Cookie::get('username'))
        {
            $this->error('您已经登录过了','ymq/index/index');
        }
        return $this->fetch();
    }

    /**
     * 登录逻辑
     */
    public function login()
    {
        if(request()->isPost())
        {
            $username = input('post.username');
            $password = input('post.password');
            $admin_user = model('AdminUser')->where('username',$username)->find();
            if(!empty($admin_user))
            {
                //验证密码是否正确
                $check_password = password_verify($password,$admin_user['password']);
                if($check_password)
                {
                    $time = time();
                    $ip = request()->ip();
                    Cookie::set('username',$username,3600);
                    try{
                        model('AdminUser')->where('username',$username)->update(['ip'=>$ip,'login_time'=>$time]);
                    }catch (\Exception $e){
                        //$this->error($e->getMessage());
                        return json_show('内部错误',0);
                    }
                    return json_show('登录成功',1);
                }else{
                    return json_show('用户名或密码错误',0);
                }
            }
            return json_show('该用户不存在',0);
        }

    }

    /**
     * 登出逻辑
     */
    public function logout()
    {
        Cookie::delete('username');
        return redirect('ymq/login/index');
    }

}
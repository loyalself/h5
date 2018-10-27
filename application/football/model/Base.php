<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2018/8/25
 * Time: 15:22
 */

namespace app\football\model;

use think\Db;
use think\Model;

class Base extends Model
{
    protected $connection = 'mysql://root:Yd12345678.@154.223.65.38:3306/football#utf8';

    protected $autoWriteTimestamp = true;

    /**
     * 封装一个通用的添加数据的方法.
     * allowField()方法如果$data里面传进来的数据里面包含的字段数据库里面没有的,就会报错
     * @param $data     要插入的数据
     * @return mixed    返回插入成功后的主键id
     * @throws \Exception
     */
    public function add($data)
    {
        if(!is_array($data))
        {
            exception('传递数据不合法');       //tp5自带的抛出异常
        }
        if(!empty($data['id']))
        {
            $this->gengxin();
        }
        $this->allowField(true)->save($data);
        return $this->id;
    }

    /**
     * 更新数据
     * @param $id  要修改权限的主键id
     * @return bool|void
     */
    public function gengxin()
    {
        $data = request()->post();
        if(!empty($data['id']))
        {
            try{
                $res = $this->allowField(true)->save($data,$data['id']);
            }catch (\Exception $e){
                return json_show($e->getMessage(),0);
            }
            return true;
        }
        return json_show('要修改的id为空',0);
    }

    public  function addGamePhase($data)
    {
        if(!is_array($data))
        {
            exception('传递数据不合法');
        }
        if(!empty($data['id']))
        {
            $this->updateGamePhase();
        }
        $this->allowField(true)->save($data);
        return $this->id;
    }

    public function updateGamePhase()
    {
        $data = request()->post();
        if(!empty($data['id']))
        {
            try{
                $res = $this->allowField(true)->save($data,$data['id']);
            }catch (\Exception $e){
                return json_show($e->getMessage(),0);
            }
            return true;
        }
        return json_show('要修改的id为空',0);
    }
}
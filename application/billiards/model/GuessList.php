<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2018/9/25
 * Time: 16:37
 */

namespace app\billiards\model;


use think\Db;

class GuessList extends Base
{
    public function insGL($data)
    {
        if(!is_array($data))
        {
            exception('传递数据不合法');       //tp5自带的抛出异常
        }
        if(!empty($data['id']))
        {
            $this->updateGL();
        }
        $this->allowField(true)->save($data);
        return $this->id;
    }

    public function updateGL()
    {
        $data = request()->post();
        $data['start_time'] = strtotime($data['start_time']);
        $data['end_time'] = strtotime($data['end_time']);
        $data['id'] = $data['guess_list_id'];
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

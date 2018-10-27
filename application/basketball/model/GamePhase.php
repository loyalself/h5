<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2018/9/17
 * Time: 15:48
 */

namespace app\basketball\model;


use think\Model;

class GamePhase extends Base
{
   // protected $connection = 'football';

    
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

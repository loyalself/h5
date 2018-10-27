<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2018/9/17
 * Time: 17:39
 */

namespace app\billiards\model;


class GameLive extends Base
{
    /**
     * 添加比赛
     * @param $data
     * @return mixed
     * @throws \Exception
     */
    public function addLive($data)
    {
        if(!is_array($data))
        {
            exception('传递数据不合法');
        }
        if(!empty($data['id']))
        {
            $this->updateLive();
        }
        $this->allowField(true)->save($data);
        return $this->id;
    }

    /**
     * 更新比赛
     */
    public function updateLive()
    {
        $data = request()->post();
        $data['start_time'] = strtotime($data['start_time']);
        if(!empty($data['id']))
        {
            try{
                $res = $this->allowField(true)->save($data,$data['id']);
            }catch (\Exception $e){
                return json_show($e->getMessage(),0);
            }
            return true;
        }
        return false;
    }
}

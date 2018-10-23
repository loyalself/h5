<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2018/9/26
 * Time: 15:34
 */

namespace app\ymq\model;


class GuessWinnerRangfen extends Base
{
    public function insGWR($data)
    {
        if(!is_array($data))
        {
            exception('传递数据不合法');       //tp5自带的抛出异常
        }
        if(!empty($data['id']))
        {
            $this->updateGWR();
        }
        $this->allowField(true)->save($data);
        return $this->id;
    }

    public function updateGWR()
    {
        $data = request()->post();
        $data['id'] = $data['guess_winner_rangfen_id'];
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
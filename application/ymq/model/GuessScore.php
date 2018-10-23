<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2018/9/26
 * Time: 17:17
 */

namespace app\ymq\model;


class GuessScore extends Base
{
    public function insGS($data)
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
}
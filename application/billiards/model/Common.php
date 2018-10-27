<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2018/9/27
 * Time: 14:02
 */

namespace app\billiards\controller;


use app\common\BaseController;
use think\Db;
class Common extends BaseController
{
    public $db;

    public function _initialize()
    {
       $this->db = Db::connect('mysql://root:Yd12345678.@154.223.65.38:3306/billiards#utf8');
    }
}

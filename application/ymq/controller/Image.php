<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2018/8/25
 * Time: 15:04
 */

namespace app\ymq\controller;

use app\common\BaseController;
use think\Request;
use think\Image as Img;
class Image extends BaseController
{
    /**
     * uploadify插件图片上传逻辑
     */
    public function upload()
    {
        $file = Request::instance()->file('file');
        $time_file = date("Ymd",time());
        $info = $file->validate(['size'=>6097152,'ext'=>'jpeg,jpg,png,gif'])->move('uploads/'.$time_file,time());
        $imgHost = Request::instance()->domain();
        if($info && $info->getPathname())
        {
            $saveName = str_replace('\\',"/",$info->getSaveName());
            $data =  [
                'status' => 1,
                'msg'    => 'ok',
                'data'   => $imgHost.'/uploads/'.$time_file.'/'.$saveName
            ];
            echo json_encode($data);
            exit;
        }
        echo  json_encode(['status'=>0,'msg'=>'上传失败']);
    }
}
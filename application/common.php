<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function json_show($msg = '', $status = 0, $dataarr = array())
{
    $arr = array (
        'msg'    => $msg,
        'status' => $status.''
    );
    if(!empty($dataarr))
    {
        $arr['data'] = $dataarr;
    }
    echo json_encode($arr);
    exit;
}

function json_html($msg = '', $status = 0, $url = '')
{
    if(!$url)
    {
        $url='';
    }

    $arr = array (
        'info' => $msg,
        'status' => $status.'',
        'url' => $url
    );
    return json_encode_k ( $arr );
}

function json_encode_k($array)
{

    return json_encode ( $array );

}

/**
 * @param array $list
 * @param int $parent_id
 * @param int $deep
 * @return array
 * 无限极分类
 */
function infinite($list = [],$parent_id = 0,$deep = 0)
{
    static $arr = [];
    foreach ($list as $v)
    {
        if($v['p_id'] == $parent_id)
        {
            $v['deep'] = $deep;
            $arr[] = $v;
            infinite($list,$v['id'],$deep + 1);
        }
    }
    return $arr;
}



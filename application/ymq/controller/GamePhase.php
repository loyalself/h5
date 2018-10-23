<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2018/9/17
 * Time: 15:10
 */

namespace app\ymq\controller;


use app\common\BaseController;
use think\Db;

class GamePhase extends BaseController
{
    private $tableName = 'game_phase';

    /**
     * 查看赛事阶段列表
     * @return \think\response\View
     */
    public function phaseList()
    {
        $where = [];
        $bigGame_id = intval(input('param.id'));
        $where['bigGame_id'] = $bigGame_id;
        $list = $this->comList($this->tableName,$where);
        //dump($list);
        return view('',[
            'bigGame_id'=>$bigGame_id,
            'list'=>$list
        ]);
    }

    /**
     * 大赛阶段赛的添加和修改
     * @return bool|\think\response\View|void
     * @param   big_game_id  大赛id
     * @param   id           修改时的阶段赛的主键id
     * @throws \think\exception\DbException
     * @return json Array
     */
    public function phase()
    {
        $bigGame_id = intval(input('bigGame_id'));
        if(request()->isPost())
        {
            $post = input('post.');
            $post['bigGame_id'] = $bigGame_id;
            try{
                $res = model('GamePhase')->addGamePhase($post);
            }catch (\Exception $e){
                return json_show($e->getMessage(),0);
            }
            if($res)
            {
                return json_show('操作成功',1);
            }else{
                return json_show('操作失败',0);
            }
        }
        $id = intval(input('param.id'));
        $one = Db::table($this->tableName)->where('id',$id)->find();

        return view('',[
            'one'=>$one,
            'bigGame_id'=>$bigGame_id
        ]);
    }
}
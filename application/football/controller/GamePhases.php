<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2018/9/17
 * Time: 15:10
 */

namespace app\football\controller;


use app\common\BaseController;
use think\Db;

class GamePhase extends Common
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

        $list = $this->db->table('game_phase')->where($where)->select();

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
        $one = $this->db->table('game_phase')->where('id',$id)->find();

        return view('',[
            'one'=>$one,
            'bigGame_id'=>$bigGame_id
        ]);
    }

    public function del()
    {
        $id = intval(input('post.id'));
        try{
            $res = $this->db->table('game_phase')->where('id',$id)->delete();
        }catch (\Exception $e){
            return json_show($e->getMessage(),0);
        }
        if($res)
        {
            return json_show('删除成功',1);
        }else{
            return json_show('删除失败',0);
        }
    }
}
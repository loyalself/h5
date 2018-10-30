<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2018/9/17
 * Time: 17:23
 */

namespace app\billiards\controller;


use app\common\BaseController;
use think\Db;
use JMessage\JMessage;
use JMessage\IM\ChatRoom;
class GameLive extends Common
{
    private $tableName = 'game_live';

    //极光开发账号,创建聊天室用
    private $appKey = '89e7574f3a1c28e6c1ecb9ce';

    private $masterSecret = '5efc3d5d44723d692fd5f1ea';

    private $owner = 'root';

    /**
     * 查看赛程列表,这里具体到某一场比赛
     * @param int bigGame_id 大赛id     是从阶段列表查看赛程传过来的
     * @param int phase_id   阶段赛id   是从阶段列表查看赛程传过来的
     */
    public function liveList()
    {
        $where = [];
        $phase_id = input('param.phase_id');
        $bigGame_id = input('param.bigGame_id');
        $where['phase_id'] =  $phase_id;
        $where['bigGame_id'] = $bigGame_id;
        $list = $this->db->table('game_live')->where($where)->select();
        foreach($list as $k=>$v)
        {
            //查看当前比赛有无竞猜,比赛表里的主键id关联竞猜表里的game_id
            $game_id = $v['id'];
            //查询当前比赛是否已经结算  isSettlement 1代表已经结算 0代表未结算
            $isSettlement = $this->db->table('guess_userbet')
                ->where('game_id',$game_id)
                ->where('bet_status',1)
                ->value('isSettlement');
            if($isSettlement)
            {
                $list[$k]['isSettlement'] = $isSettlement;
            }else{
                $list[$k]['isSettlement'] = 0;
            }

            //查询是否有竞猜
            $is_guess = $this->db->table('guess_list')->where('game_id',$game_id)->find();
            if($is_guess)
            {
                $list[$k]['is_guess'] = 1;
            }else{
                $list[$k]['is_guess'] = 0;
            }
            if(empty($v['winner']))
            {
                $list[$k]['winner'] = '胜负未分';
            }else{
                $list[$k]['winner'] = $this->db->table('star_list')->where('id',$v['winner'])->value('c_name');
            }
            $list[$k]['who_beat_who'] = $v['play_a_name'].'&nbsp;<strong>VS</strong>&nbsp;'.$v['play_b_name'];
        }
        //dump($list);

        return view('',[
            'list'=>$list,
            'bigGame_id'=>$bigGame_id,
            'phase_id'=>$phase_id
        ]);
    }

    /**
     * 添加比赛(直播)或修改
     */
    public function live()
    {
        $bigGame_id = input('param.bigGame_id');
        $phase_id = input('param.phase_id');
        if(request()->isPost())
        {
            $post = input('post.');
            $post['start_time'] = strtotime($post['start_time']);
            if($post['play_a_name'] == $post['play_b_name'] && (empty($post['play_a_name']) || empty($post['play_b_name'])))
            {
                return $this->error('两边的对战名称不能相同或者对战名称不能为空',0);
            }
            $play_a_name = $post['play_a_name'];
            $play_b_name = $post['play_b_name'];
            $play_a_id = $this->db->table('star_list')->where('c_name',$play_a_name)->value('id');
            $play_b_id = $this->db->table('star_list')->where('c_name',$play_b_name)->value('id');
            $post['play_a_id'] = $play_a_id;
            $post['play_b_id'] = $play_b_id;

            //将对战人员的主键id存进去,没有存中文
            if(!empty($play_a_id) && !empty($play_b_id))
            {
                $post['who_beat_who'] = $play_a_id.','.$play_b_id;
            }
            if(empty($post['a_win_num']))
            {
                $post['a_win_num'] = 0;
            }
            if(empty($post['b_win_num']))
            {
                $post['b_win_num'] = 0;
            }
            //如果 a_win_num 或 b_win_num有一个有值,就代表比赛已经结束
            if(!empty($post['a_win_num']) || !empty($post['b_win_num']))
            {
                $post['is_end'] = 3;        // 3代表比赛结束
                if($post['a_win_num'] > $post['b_win_num'])
                {
                    $post['winner'] = $post['play_a_id'];
                    //TODO:根据比分更新投注为输的球员(或国家)投注状态为失败
                }elseif($post['a_win_num'] < $post['b_win_num'])
                {
                    $post['winner'] = $post['play_b_id'];
                    //TODO:根据比分更新投注为输的球员(或国家)投注状态为失败
                }
            }

            //判断是否有直播源 isLive 1有  2无
            if(!empty($post['liveUrl']))
            {
                $name = 'ft'.time();
                $description = $post['live_notice'] ?:'';
                $roomId = $this->genrateChatRoomId($name,$description);
                if(!$roomId)
                {
                    return $this->error('聊天室创建失败');
                }
                $post['roomId'] = $roomId;
                $post['live_notice'] = $description;
                $post['isLive'] = 1;
            }else{
                $post['isLive'] = 2;
            }

            //一定要编辑比赛时,is_end 为4就代表当前比赛弃赛,直接退钱
            if(!empty($post['id']) && !empty($post['is_end']))
            {
                if($post['is_end'] == 4)
                {
                    $ctime = time();
                    $game_id = $post['id'];
                    $qisai_data = $this->db->table('guess_userbet')->where('isWin', 0)
                        ->where('game_id', $game_id)->where('bet_status', 1)->select();
                    if (!empty($qisai_data))
                    {
                        foreach ($qisai_data as $k => $v)
                        {
                            $user_id = $v['uid'];
                            $wager = $v['wager'];
                            $jc_type = $v['jc_type'];
                            //直接退钱
                            try {
                                $sql = "update userinfo set recharge_amount = recharge_amount + $wager,
                            total_amount=total_amount+$wager where id = $user_id limit 1";
                                $res = $this->db->execute($sql);
                            } catch (\Exception $e) {
                                return $this->error($e->getMessage(), 0);
                            }
                            //插入信息到弃赛表
                            try {
                                $sql = "insert into guess_qisai (user_id, game_id,wager,jc_type,ctime) 
					        values ($user_id,$game_id,$wager,$jc_type,$ctime)";
                                $res = $this->db->execute($sql);
                            } catch (\Exception $e) {
                                return $this->error($e->getMessage(), 0);
                            }
                        }
                    }
                    try {
                        //更新比赛状态为流局
                        $sql = "update guess_userbet set isWin=3,isSettlement=1,mtime='{$ctime}' where game_id='{$game_id}'";
                        $res = $this->db->execute($sql);
                    } catch (\Exception $e) {
                        return $this->error($e->getMessage(), 0);
                    }
                }

            }

            //添加或修改比赛数据
            try{
                $id = model('GameLive')->addLive($post);  //成功后的主键id
            }catch (\Exception $e){
                return $this->error($e->getMessage(),0);
            }
            if($id && empty($post['id']))  //表示新增
            {
                //比赛场次编号:大赛id + 阶段id  第一场:为大赛id + 阶段id + 1,然后依次递增
                $game_number = $this->db->table($this->tableName)->where(['bigGame_id'=>$bigGame_id,'phase_id'=>$phase_id])->value('game_number');
                $game_number = intval($game_number);
                if(empty($game_number))
                {
                    $game_number = 1;
                    $game_number = $bigGame_id.$phase_id.$game_number;
                }else{
                    $game_number = $game_number+1;
                }
                try{
                    $res = model('GameLive')->isUpdate(true)->save(['id'=>$id,'game_number'=>$game_number]);
                }catch (\Exception $e){
                    return $this->error($e->getMessage(),0);
                }
                return $this->result(['jump_url'=>url('gameLive/liveList',['bigGame_id'=>$bigGame_id,'phase_id'=>$phase_id])],1,'ok');
            }else{
                $bigGame_id = input('post.bigGame_id');
                $phase_id = input('post.phase_id');
                return $this->result(['jump_url'=>url('gameLive/liveList',['bigGame_id'=>$bigGame_id,'phase_id'=>$phase_id])],1,'ok');
            }
        }
        //修改,这个id是通过url传进来的,是比赛的主键id
        $id = input('id');
        $one = $this->db->table($this->tableName)->where('id',$id)->find();
        return view('',[
            'bigGame_id'=>$bigGame_id,
            'phase_id'=>$phase_id,
            'one'=>$one
        ]);
    }

    /**
     * @param $name  聊天室名称,唯一的才能生成不同的聊天室ID
     * @param string $description 聊天室简介
     */
    private function genrateChatRoomId($name,$description = '')
    {
        $client = new JMessage($this->appKey, $this->masterSecret);
        $room = new ChatRoom($client);
        //$name = 'ft'.time();
        $roomData = $room->create($name, $this->owner,$members = [], $description);
        if(empty($roomData['body']['chatroom_id']))
        {
            return false;
        }
        $roomId = $roomData['body']['chatroom_id'];
        return $roomId;
    }
    /**
     * 对战对手实时搜索
     * @param name string 名字
     * @param who  int  哪一边 1代表左边 | 2代表右边
     * @return array | string
     */
    public function search()
    {
        $name = input('get.name');
        $who = input('get.who');
        $result = $this->db->table('star_list')->where('c_name','like',"{$name}%")->select();
        $res = '';
        if($result)
        {
            foreach($result as $v)
            {
                $res .= '<li onclick="choice(this, ' .$who.')">' . $v['c_name'] . '</li>';
            }
        }else{
            $res = '暂时没有结果,请添加';
        }
        echo $res;
        exit;
    }
    /**
     * 删除
     */
    public function del()
    {
        if(request()->isPost())
        {
            $id = input('post.id');
            halt($id);
            try{
                $res = $this->db->table($this->tableName)->where('id',$id)->delete();
            }catch (\Exception $e){
                return json_show($e->getMessage(),0);
            }
            if($res)
            {
                return json_show('删除成功',1);
            }else{
                return json_show('删除失败',0);
            }
        }else{
            return json_show('操作异常,请稍后再试',0);
        }
    }

    /**
     * 结算
     * @param id 比赛的主键id,根据id查出竞猜信息
     */
    public function settlement()
    {
        if(request()->isGet())
        {
            $id = intval(input('get.id'));     //比赛的主键id

            //查询这场比赛的胜利者
            $game_data = $this->db->table('game_live')->where('id',$id)->find();
            $winner = $game_data['winner']; //winner对应比赛对手的id,即play_a_id 或者 play_b_id
            //dump($winner);
            //1、根据比赛结果找胜利者的赔率  guess_winner
            for($i=1;$i<=3;$i++)
            {   //1_winner_id字段的作用:标识谁赢了；标识左胜
                $guess_winner = $this->db->table('guess_winner')->where('game_id',$id)->where($i.'_winner_id',$winner)->find();
                // 找到获胜者对应的 赔率 odds
                if(!empty($guess_winner))
                {
                    //竞猜赔率id
                    $jc_pl_id_sf = $i;
                    $jc_odds = $i.'_winner_odds';   //找到对应的赔率
                    break;
                }
            }
            //dump($guess_winner);

            //给投注胜利的用户加钱,只是更新投注表里的金钱,还没有更新用户表里的真实金钱
            if(!empty($guess_winner))
            {
                $mtime = time();
                //获得相应竞猜表的主键id,对应guess_userbet表里的jc_id
                $jc_id = $guess_winner['id'];
                // 更新单选竞猜中的 guess_winner 胜利用户，并给胜利者竞猜结算盈利的钱
                $sql = "update guess_userbet set isWin=1,profit_loss = wager * odds,mtime = $mtime where
                     game_id = $id and jc_id = $jc_id and jc_pl_id = $jc_pl_id_sf and jc_type = 1 and bet_status=1";
                //echo $sql;
                try{
                    $res1 = $this->db->execute($sql);
                }catch (\Exception $e){
                    return json_show($e->getMessage(),0);
                }

               //更新单选竞猜中的 guess_winner 失败用户
                $sql = "update guess_userbet set isWin=2,profit_loss=wager, mtime='{$mtime}' 
                      where profit_loss='' and  game_id='{$id}' and jc_type = 1 and bet_status = 1";
                //echo $sql;
                try{
                    $res2 = $this->db->execute($sql);
                }catch (\Exception $e){
                    return json_show($e->getMessage(),0);
                }
            }
            ###################################################
            //2.让分结算
            //$sql = "select 1_winner_rangfen from guess_winner_rangfen where game_id={$id}";
            try{
                //先查询出当前比赛的让分数值
                $rangfen = $this->db->table('guess_winner_rangfen')->where('game_id',$id)->value('1_winner_rangfen');
            }catch (\Exception $e){
                return json_show($e->getMessage(),0);
            }
            //如果是平局,更新投注表选择平局的比赛状态isWin为1
            if(($game_data['a_win_num'] + $rangfen) == $game_data['b_win_num'])
            {
                try{
                    $sql = "update guess_userbet set isWin=1, profit_loss=wager * odds, mtime={$mtime}
                      where game_id={$id} and jc_pl_id=3 and jc_type=2 and bet_status=1";
                    $res = $this->db->execute($sql);
                }catch (\Exception $e){
                    return json_show($e->getMessage(),0);
                }

                try{
                    $sql = "update guess_userbet set isWin=2, isSettlement=1, profit_loss=wager, mtime={$mtime}
                    where profit_loss='' and game_id={$id} and jc_pl_id!=3 and jc_type=2 and bet_status=1";
                    $res = $this->db->execute($sql);
                }catch (\Exception $e){
                    return json_show($e->getMessage(),0);
                }
            }

            //a胜
            if(($game_data['a_win_num'] + $rangfen) > $game_data['b_win_num'])
            {
                try{
                    $sql = "update guess_userbet set isWin=1, profit_loss = wager * odds, mtime={$mtime}
                      where game_id={$id} and jc_pl_id=1 and jc_type=2 and bet_status=1";
                    $res = $this->db->execute($sql);
                }catch (\Exception $e){
                    return json_show($e->getMessage(),0);
                }

                try{
                    $sql = "update guess_userbet set isWin=2, isSettlement=1, profit_loss=wager, mtime={$mtime}
                    where profit_loss='' and game_id={$id} and jc_pl_id!=1 and jc_type=2 and bet_status=1";
                    $res = $this->db->execute($sql);
                }catch (\Exception $e){
                    return json_show($e->getMessage(),0);
                }
            }

            //b胜
            if(($game_data['a_win_num'] + $rangfen) < $game_data['b_win_num'])
            {
                try{
                    $sql = "update guess_userbet set isWin=1,profit_loss=wager*odds, mtime={$mtime}
                      where game_id={$id} and jc_pl_id=2 and jc_type=2 and bet_status=1";
                    $res = $this->db->execute($sql);
                }catch (\Exception $e){
                    return json_show($e->getMessage(),0);
                }

                try{
                    $sql = "update guess_userbet set isWin=2,isSettlement=1,profit_loss=wager, mtime={$mtime}
                    where profit_loss='' and game_id={$id} and jc_pl_id!=2 and jc_type=2 and bet_status=1";
                    $res = $this->db->execute($sql);
                }catch (\Exception $e){
                    return json_show($e->getMessage(),0);
                }
            }

            //3.是否都进球结算 jc_type 7
            if($game_data['a_win_num']!= 0 && $game_data['b_win_num'] !=0)
            {
                //如果两队都进球
                try{
                    $sql = "update guess_userbet set isWin=1,profit_loss=wager*odds, mtime={$mtime}
                    where game_id={$id} and jc_pl_id=1 and jc_type=7 and bet_status=1";
                    $res = $this->db->execute($sql);
                }catch (\Exception $e){
                    return json_show($e->getMessage(),0);
                }

                try{
                    $sql = "update guess_userbet set isWin=2,isSettlement=1, profit_loss=wager,mtime={$mtime}
                    where profit_loss='' and game_id={$id} and jc_pl_id=2 and jc_type=7 and bet_status=1";
                    $res = $this->db->execute($sql);
                }catch (\Exception $e){
                    return json_show($e->getMessage(),0);
                }
            }else{
                //否
                try{
                    $sql = "update guess_userbet set isWin=1, profit_loss=wager*odds, mtime={$mtime}
                    where game_id={$id} and jc_pl_id=2 and jc_type=7 and bet_status=1";
                    $res = $this->db->execute($sql);
                }catch (\Exception $e){
                    return json_show($e->getMessage(),0);
                }

                try{
                    $sql = "update guess_userbet set isWin=2,isSettlement=1, profit_loss=wager, mtime={$mtime}
                    where profit_loss='' and game_id={$id} and jc_pl_id=1 and jc_type=7 and bet_status=1";
                    $res = $this->db->execute($sql);
                }catch (\Exception $e){
                    return json_show($e->getMessage(),0);
                }

            }

            //4.进球大小盘结算 jc_type 6
            if(($game_data['a_win_num'] + $game_data['b_win_num']) > 2.5)
            {
                try{
                    $sql = "update guess_userbet set isWin=1,profit_loss=wager*odds, mtime={$mtime}
                    where game_id={$id} and jc_pl_id=1 and jc_type=6 and bet_status=1";
                    $res = $this->db->execute($sql);
                }catch (\Exception $e){
                    return json_show($e->getMessage(),0);
                }
            }else{
                try{
                    $sql = "update guess_userbet set isWin=2,isSettlement=1,profit_loss=wager,mtime={$mtime}
                    where profit_loss='' and game_id={$id} and jc_pl_id=2 and jc_type=6 and bet_status=1";
                    $res = $this->db->execute($sql);
                }catch (\Exception $e){
                    return json_show($e->getMessage(),0);
                }
            }
            #################################
            /*****
             *
             * 用户获胜 ~ 加钱
             *
             */
            // 给用户加钱，当前比赛所有下注胜利并且未结算的用户，
            //找到该场比赛下的所有投注
           $sql = "select uid from guess_userbet where game_id = $id and isWin = 1 and isSettlement=0 group by uid";
           //echo $sql;
            try{
                $currentGameBetUser_all = $this->db->query($sql);
            }catch (\Exception $e){
                return json_show($e->getMessage(),0);
            }
            //halt($currentGameBetUser_all); //有多个用户就是数组,为空就不会走到下面的foreach循环

            foreach ($currentGameBetUser_all as $k=>$v)
            {
                $uid = $v['uid'];
                //查询用户余额,即通过投注返现的余额
                $sql = "select operation_amount from userinfo where id='{$uid}' limit 1";
                try{
                    $operation_amount = $this->db->query($sql);  //获得用户的余额
                }catch (\Exception $e){
                    return json_show($e->getMessage(),0);
                }
                //dump($operation_amount);

                /**
                 * 投注赢取总钱
                 * isSettlement = 0 未结算
                 */
//                $sql="select sum(profit_loss) as userWinWager
//             from guess_userbet where game_id={$id} and isWin=1 and isSettlement=0 and uid={$uid}";
                //echo $sql;
                try{
                    $userWinWager_array = $this->db->table('guess_userbet')->where('game_id',$id)->where('isWin',1)->where('isSettlement',0)
                        ->where('uid',$uid)->field('profit_loss as userWinWager')->find();
                }catch (\Exception $e){
                    return json_show($e->getMessage(),0);
                }

                //dump($userWinWager['userWinWager']);
                $userWinWager = $userWinWager_array['userWinWager'];
                //插入用户收支记录表
                $ctime = time();
                //sz_type 1支出  2 收入
                $sql="insert into income_records(uid,amount,sz_name,sz_type,ctime) 
			   values ($uid,'{$userWinWager}','单选竞猜',2,$ctime)";
                //echo $sql;
                try{
                    $userincome_record_id = $this->db->execute($sql);
                }catch (\Exception $e){
                    return json_show($e->getMessage(),0);
                }
                //标记为已结算
                $sql="update guess_userbet set isSettlement=1
			     where game_id = {$id} and isWin=1 and isSettlement=0 and uid={$uid} ";
                //echo $sql;
                try{
                    $yes_quiz_id = $this->db->execute($sql);
                }catch (\Exception $e){
                    return json_show($e->getMessage(),0);
                }
                //dump($yes_quiz_id);

                //给用户加钱
                $sql="update userinfo set operation_amount=operation_amount+{$userWinWager},
                      total_amount = operation_amount+recharge_amount
                      where id={$uid} limit 1";
                //echo $sql;
                try{
                    $useradd_money_id = $this->db->execute($sql);
                }catch (\Exception $e){
                    return json_show($e->getMessage(),0);
                }
                //halt($useradd_money_id);
                if(empty($userincome_record_id) || empty($yes_quiz_id) || empty($useradd_money_id))
                {
                    return json_show('结算失败',0);
                }
            }
            //竞猜标记为已结束
            $sql="update guess_list set status=2 where game_id={$id} limit 1";
            try{
                $guess_is_end = $this->db->execute($sql);
            }catch (\Exception $e){
                return json_show($e->getMessage(),0);
            }
            return json_show('结算竞猜成功,用户已收到竞猜胜利的钱币',1);
        }
    }
}

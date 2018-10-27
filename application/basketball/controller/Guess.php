<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2018/9/21
 * Time: 10:27
 */

namespace app\basketball\controller;
use app\common\BaseController;
use app\basketball\model\GuessList;
use app\basketball\model\GuessWinner;
use app\basketball\model\GuessWinnerRangfen;
use app\basketball\model\GuessIsScore;
use app\basketball\model\GuessTotalScore;
use app\basketball\model\GameLive;
use think\Db;
class Guess extends Common
{
    /**
     * 竞猜信息列表
     */
    public function guessList()
    {
        //获得比赛的主键id,去竞猜表里查找当前比赛有没有竞猜信息
        $game_id = input('param.game_id');
        $game_number = $this->db->table('game_live')->where('id',$game_id)->value('game_number');
        $list = $this->db->table('guess_list')->alias('a')
             ->join('game_live b','a.game_id = b.id','left')
             ->join('game_phase c','b.phase_id = c.id','left')
             ->join('big_game_list d','c.bigGame_id = d.id','left')
             ->field('a.id,d.big_game_name,b.game_number,b.play_a_name,
               b.play_b_name,c.phasegame_name,a.start_time,a.end_time,a.status,a.manual_open')
             ->where(['a.game_id'=>$game_id])
             ->select();  // 用find,查询出是一维数组,去视图页面遍历拿不到值
        foreach ($list as $k=>$v)
        {
            $game_id = $v['id'];
            //查处当前比赛的总投注数
            $sql = "select count(id) from guess_userbet where game_id = $game_id";
            $list[$k]['betting_allcount'] = $this->db->execute($sql);

            //查询出胜负数量
            $sql = "select count(id) from guess_userbet where game_id = $game_id and isWin = 1";
            $list[$k]['win_count'] = $this->db->execute($sql);

            $sql = "select count(id) from guess_userbet where game_id = $game_id and isWin = 2";
            $list[$k]['loss_count'] = $this->db->execute($sql);
        }
        //dump($list);
        return view('',[
            'list'=>$list,
            'game_id'=>$game_id,
            'game_number'=>$game_number
        ]);
    }
    /**
     * 添加竞猜,从比赛列表页传进来的live_list
     * 从这个页面传递进来的参数有game_id和game_number(大赛唯一编号),对应game_live表里的主键
     * @param game_id       比赛id,game_live表里的主键id
     * @param game_number   比赛场次编号
     */
    public function guess()
    {
        $time = time();                                 //竞猜开始的时间就是默认当前时间
        $game_id = input('param.game_id');
        $game_number = input('param.game_number');
        //先将这场比赛的数据查询出来
        $game_data = $this->db->table('game_live')
            ->where('id',$game_id)
            ->field('game_number,play_a_name,play_b_name,start_time')
            ->select();
        //dump($game_data);
        foreach ($game_data as $k=>$v)
        {
            $play_a_name = $v['play_a_name'];
            $play_b_name = $v['play_b_name'];
            $guess_end_time = $v['start_time'];   //竞猜结束时间,也就是比赛开始的时间
        }
        //dump($guess_end_time);
        //有post请求,代表添加了竞猜数据过来
        if(request()->isPost())
        {
            $post = input('post.');
            $game_id = $post['game_id'];
            $realgame_data = $this->db->table('game_live')
                ->where('id',$game_id)
                ->field('game_number,play_a_name,play_b_name,start_time')
                ->find();
            $realgame_starttime = $realgame_data['start_time'];
            $game_number = $post['game_number'];
            $start_time = strtotime($post['start_time']);
            $end_time = strtotime($post['end_time']);           //获取到用户提交的竞猜结束的时间
            $game_win_number = isset($_POST['game_win_number'])?$post['game_win_number']:0;
            $play_a_name = $post['play_a_name'];
            $play_b_name = $post['play_b_name'];
            $play_a_id = $this->db->table('star_list')->where('c_name',$play_a_name)->value('id'); //这个也等于$winner_id_1
            $play_b_id = $this->db->table('star_list')->where('c_name',$play_b_name)->value('id'); // $winner_id_2

            $winner_id_1 = $post['1_winner_id'];
            $winner_id_2 = $post['2_winner_id'];

             if($start_time > $end_time)
             {
                return $this->result('',0,'竞猜开猜时间不能大于截止时间');
             }elseif($end_time > $realgame_starttime)
             {
                return $this->result('',0,'竞猜结束时间不能大于比赛的真实开始时间');
             }elseif(empty($winner_id_1))
             {
                 return $this->result('',0,'胜负赔率A不能为空');
             }elseif (empty($winner_id_2))
             {
                 return $this->result('',0,'胜负赔率B不能为空');
             }
            //整合guess_list表信息
            $guess_list['game_id'] = $game_id;
            $guess_list['game_number'] = $game_number;
            $guess_list['play_a_id'] = $play_a_id;
            $guess_list['play_b_id'] = $play_b_id;
            $guess_list['play_a_name'] = $play_a_name;
            $guess_list['play_b_name'] = $play_b_name;
            $guess_list['start_time'] = $start_time;
            $guess_list['end_time'] = $end_time;
            $guess_list['game_win_number'] = $game_win_number;
            try{
                $res = GuessList::create($guess_list);
            }catch (\Exception $e){
                return $this->error($e->getMessage());
            }
            //如果竞猜信息插入成功,更改当前比赛的is_giuess为1,代表有竞猜信息录入
            if($res)
            {
                try{
                    $gameLive = new GameLive();
                    $id = $gameLive->allowField('is_guess')->save(['is_guess'=>1],['id'=>$game_id]);
                }catch (\Exception $e){
                    return $this->error($e->getMessage());
                }
            }
            //整合guess_winner表信息
            //胜负赔率表   guess_winner
            $guess_winner['game_id'] = $game_id;
            $guess_winner['game_number'] = $game_number;
            $guess_winner['1_winner_id'] = $play_a_id;
            $guess_winner['2_winner_id'] = $play_b_id;
            $guess_winner['1_winner_odds'] = $winner_id_1;
            $guess_winner['2_winner_odds'] = $winner_id_2;

            try{
                $res = GuessWinner::create($guess_winner);
            }catch (\Exception $e){
                return $this->error($e->getMessage());
            }

            //整合guess_winner_rangfen表信息
            //让分赔率表  guess_winner_rangfen
            $guess_winner_rangfen['game_id'] = $game_id;
            $guess_winner_rangfen['game_number'] = $game_number;
            $rangfen_winner_1 = $post['1_winner_rangfen']?:0;
            $guess_winner_rangfen['1_rangfen_odds'] = $post['1_rangfen_odds'] ?: 0;
            $guess_winner_rangfen['2_rangfen_odds'] = $post['2_rangfen_odds'] ?: 0;
            $guess_winner_rangfen['1_winner_rangfen'] = $rangfen_winner_1;
            $guess_winner_rangfen['2_winner_rangfen'] = 0 - ($rangfen_winner_1);
            $guess_winner_rangfen['1_winner_rangfen_id'] = $play_a_id;
            $guess_winner_rangfen['2_winner_rangfen_id'] = $play_b_id;
            try{
                $res = GuessWinnerRangfen::create($guess_winner_rangfen);
            }catch (\Exception $e){
                return $this->error($e->getMessage());
            }

             //进球大小盘   guess_total_score
            $guess_total_score['game_id'] = $game_id;
            $guess_total_score['game_number'] = $game_number;
            $guess_total_score['total_score'] = $post['total_score']?:0;
            $guess_total_score['1_compare_odds'] = $post['1_compare_odds']?:0;
            $guess_total_score['2_compare_odds'] = $post['2_compare_odds']?:0;
            try{
                $res = GuessTotalScore::create($guess_total_score);
            }catch (\Exception $e){
                return $this->error($e->getMessage());
            }
            if($res)
            {
                return $this->result(['jump_url'=>url('guess/guessList',['game_id'=>$game_id])],1,'ok');
            }else{
                return $this->result('',0,'操作失败');
            }
        }
        return view('',[
            'game_id'=>$game_id,
            'play_a_name'=>$play_a_name,
            'play_b_name'=>$play_b_name,
            'game_number'=>$game_number,
            'time'=>$time,
            'guess_end_time'=>$guess_end_time,
        ]);
    }

    /**
     * 编辑竞猜
     * @param id  guess_list primary key id
     */
    public function editGuess()
    {
        $guess_id = intval(input('param.id'));
        $guessData = $this->db->table('guess_list')->where('id',$guess_id)->find();
        $game_id = $guessData['game_id'];
        $game_number = $guessData['game_number'];
        $start_time = $guessData['start_time'];
        $end_time = $guessData['end_time'];
        $play_a_id = $guessData['play_a_id'];
        $play_b_id = $guessData['play_b_id'];
        $play_a_name = $this->db->table('star_list')->where('id',$play_a_id)->value('c_name');
        $play_b_name = $this->db->table('star_list')->where('id',$play_b_id)->value('c_name');
        //查出后台人员添加过的比赛竞猜信息
        $guess_list_one = $this->db->table('guess_list')->where('game_id',$game_id)->find();
        $guess_winner_one = $this->db->table('guess_winner')->where('game_id',$game_id)->find();
        $guess_winner_rangfen_one = $this->db->table('guess_winner_rangfen')->where('game_id',$game_id)->find();
        $guess_is_score_one = $this->db->table('guess_is_score')->where('game_id',$game_id)->find();
        $guess_total_score_one = $this->db->table('guess_total_score')->where('game_id',$game_id)->find();

        //表单提交逻辑
        if(request()->isPost())
        {
            $post = input('post.');         //获取表单提交过来的数据
            $game_id = $post['game_id'];
            $realgame_data = $this->db->table('game_live')
                ->where('id',$game_id)
                ->field('game_number,play_a_name,play_b_name,start_time')
                ->find();
            $realgame_starttime = $realgame_data['start_time'];
            $game_number = $post['game_number'];
            $start_time = strtotime($post['start_time']);
            $end_time = strtotime($post['end_time']);           //获取到用户提交的竞猜结束的时间
            $game_win_number = isset($_POST['game_win_number'])?$post['game_win_number']:0;
            $play_a_name = $post['play_a_name'];
            $play_b_name = $post['play_b_name'];
            $play_a_id = $this->db->table('star_list')->where('c_name',$play_a_name)->value('id'); //这个也等于$winner_id_1
            $play_b_id = $this->db->table('star_list')->where('c_name',$play_b_name)->value('id'); // $winner_id_2

            $winner_id_1 = $post['1_winner_id'];    //代表左边胜
            $winner_id_2 = $post['2_winner_id'];    //代表右胜
            //$winner_id_3 = $post['3_winner_id'];    //代表平局

            if($start_time > $end_time)
            {
                return $this->result('',0,'竞猜开猜时间不能大于截止时间');
            }elseif($end_time > $realgame_starttime)
            {
                return $this->result('',0,'竞猜结束时间不能大于比赛的真实开始时间');
            }elseif(empty($winner_id_1))
            {
                return $this->result('',0,'胜负赔率A不能为空');
            }elseif (empty($winner_id_2))
            {
                return $this->result('',0,'胜负赔率B不能为空');
            }
            //guess_list
            $guess_list['game_id'] = $game_id;
            $guess_list['game_number'] = $game_number;
            $guess_list['play_a_id'] = $play_a_id;
            $guess_list['play_b_id'] = $play_b_id;
            $guess_list['start_time'] = $start_time;
            $guess_list['end_time'] = $end_time;
            $guess_list['game_win_number'] = $game_win_number;
            $guess_list['id'] = intval($post['guess_list_id']);

            //竞猜信息表,存放某场比赛是否有竞猜 guess_list(录入比赛的信息,几局获胜)
            try{
                $res = model('GuessList')->insGL($guess_list);
            }catch (\Exception $e){
                return $this->result($e->getMessage(),0);
            }

            //guess_winner
            $guess_winner['game_id'] = $game_id;
            $guess_winner['game_number'] = $game_number;
            $guess_winner['1_winner_id'] = $play_a_id;
            $guess_winner['2_winner_id'] = $play_b_id;
            $guess_winner['1_winner_odds'] = $winner_id_1;
            $guess_winner['2_winner_odds'] = $winner_id_2;
            $guess_winner['id'] = intval($post['guess_winner_id']);
            try{
                $res = model('GuessWinner')->insGW($guess_winner);
            }catch (\Exception $e){
                return $this->error($e->getMessage());
            }

            //guess_winner_rangfen
            $guess_winner_rangfen['game_id'] = $game_id;
            $guess_winner_rangfen['game_number'] = $game_number;
            $rangfen_winner_1 = $post['1_winner_rangfen']?:0;
            $guess_winner_rangfen['1_rangfen_odds'] = $post['1_rangfen_odds'] ?: 0;
            $guess_winner_rangfen['2_rangfen_odds'] = $post['2_rangfen_odds'] ?: 0;
            $guess_winner_rangfen['1_winner_rangfen'] = $rangfen_winner_1;
            $guess_winner_rangfen['2_winner_rangfen'] = 0 - ($rangfen_winner_1);
            $guess_winner_rangfen['1_winner_rangfen_id'] = $play_a_id;
            $guess_winner_rangfen['2_winner_rangfen_id'] = $play_b_id;
            $guess_winner_rangfen['id'] = intval($post['guess_winner_rangfen_id']);
            try{
                $res = model('GuessWinnerRangfen')->insGWR($guess_winner_rangfen);
            }catch (\Exception $e){
                return $this->result($e->getMessage(),0);
            }


            //进球大小盘   guess_total_score
            $guess_total_score['game_id'] = $game_id;
            $guess_total_score['game_number'] = $game_number;
            $guess_total_score['total_score'] = $post['total_score'];
            $guess_total_score['1_compare_odds'] = $post['1_compare_odds']?:0;
            $guess_total_score['2_compare_odds'] = $post['2_compare_odds']?:0;
            $guess_total_score['id'] = input('post.guess_total_score_id');
            //halt($guess_total_score);
            try{
                $gts = new GuessTotalScore();
                $res = $gts->allowField(true)->save($guess_total_score,$guess_total_score['id']);
            }catch (\Exception $e){
                return $this->error($e->getMessage());
            }

            if($res)
            {
                return $this->result(['jump_url'=>url('guess/guessList',['game_id'=>$game_id])],1,'修改成功');
            }else{
                return $this->result('',0,'操作失败');
            }


        }
        return view('',[
            'game_id'=>$game_id,
            'game_number'=>$game_number,
            'start_time'=>$start_time,
            'end_time'=>$end_time,
            'play_a_name'=>$play_a_name,
            'play_b_name'=>$play_b_name,
            'guess_list_one'=>$guess_list_one,
            'guess_winner_one'=>$guess_winner_one,
            'guess_winner_rangfen_one'=>$guess_winner_rangfen_one,
            'guess_is_score_one'=>$guess_is_score_one,
            'guess_total_score_one'=>$guess_total_score_one,
        ]);
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
                $res = $this->db->table('guess_list')->where('id',$id)->delete();
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
     * 添加竞猜或修改竞猜
     * @param game_id       比赛id,game_live表里的主键id
     * @param game_number   比赛场次编号
     */
    public function guess_old()
    {
        $time = time();                                 //竞猜开始的时间就是默认当前时间
        $guess_id =input('param.id');
        $guess_list_one = '';
        $guess_list_one = $this->db->table('guess_list')->where('id',$guess_id)->find();
        $game_id_s = $guess_list_one['game_id'];
        $game_number = $guess_list_one['game_number'];
        $play_a_name = $this->db->table('star_list')->where('id',$guess_list_one['play_a_id'])->value('c_name');
        $play_b_name = $this->db->table('star_list')->where('id',$guess_list_one['play_b_id'])->value('c_name');

        $guess_winner_one = $this->db->table('guess_winner')->where('game_id',$game_id_s)->find();
        $guess_winner_rangfen_one = $this->db->table('guess_winner_rangfen')->where('game_id',$game_id_s)->find();
        $guess_gamenumber_one = $this->db->table('guess_gamenumber')->where('game_id',$game_id_s)->find();
        if(!empty($guess_gamenumber_one))
        {
            $jushu_2 = $guess_gamenumber_one['2_jushu'];
            $jushu_2_arr = explode('-',$jushu_2);
            $guess_gamenumber_one['2_jushu_1'] = $jushu_2_arr[0];
            $guess_gamenumber_one['2_jushu_2'] = $jushu_2_arr[1];
        }
        $guess_winner_jujian_one = $this->db->table('guess_winner_jujian')->where('game_id',$game_id_s)->find();
        $guess_score_one = $this->db->table('guess_score')->where('game_id',$game_id_s)->find();

        $game_data = $this->db->table('game_live')->where('id',$game_id_s)->find();
        $guess_end_time = $game_data['start_time'];

        $game_id = input('param.game_id');
        $game_number_s = input('param.game_number');

        $game_data = $this->db->table('game_live')
                ->where('id',$game_id)
                ->field('game_number,play_a_name,play_b_name,start_time')
                ->select();
        foreach ($game_data as $k=>$v)
        {
            $play_a_name = $v['play_a_name'];
            $play_b_name = $v['play_b_name'];
            $guess_end_time = $v['start_time'];   //竞猜结束时间,也就是比赛开始的时间
        }

        $pl_arr = '';
        for ($i=1; $i <=$guess_list_one['game_win_number']*2; $i++)
        {
            $ele = $i.'_peilv_bf';
            $pl_arr .= $guess_score_one[$ele].',';
        }
        $pl_arr = trim($pl_arr,',');
        $pl_arr = '[' . $pl_arr. ']';

        //有值的时候dump($pl_arr);  //  string(25) "[1.1,2.2,3.3,4.4,5.5,6.6]",就是赔率
        //没值的时候dump($pl_arr);  // []
        if(request()->isPost())
        {
            $domain = request()->domain();
            $post = input('post.');

            $game_id = $post['game_id'];
            $game_number = $post['game_number'];
            $start_time = strtotime($post['start_time']);
            $end_time = strtotime($post['end_time']);
            $game_win_number = isset($_POST['game_win_number'])?$post['game_win_number']:0;

            $winner_id_1 = $post['1_winner_id'];
            $winner_id_2 = $post['2_winner_id'];
            $play_a_name = $post['play_a_name'];
            $play_b_name = $post['play_b_name'];

            $play_a_id = $this->db->table('star_list')->where('c_name',$play_a_name)->value('id'); //这个也等于$winner_id_1
            $play_b_id = $this->db->table('star_list')->where('c_name',$play_b_name)->value('id'); // $winner_id_2

           /* if($start_time > $end_time)
            {
                $errMsg = '竞猜开猜时间不能大于截止时间';
            }*/
           /* if(empty($game_win_number))
            {
                $errMsg = '比赛几局获胜不能为空';
            }
            elseif(empty($winner_id_1))
            {
                $errMsg = '胜负赔率A不能为空';
            }elseif (empty($winner_id_2))
            {
                $errMsg = '胜负赔率B不能为空';
            }*/
            if(!empty($errMsg))
            {
                echo json_html($errMsg,0); exit;
            }
            $guess_list['game_id'] = $game_id;
            $guess_list['game_number'] = $game_number;
            $guess_list['play_a_id'] = $play_a_id;
            $guess_list['play_b_id'] = $play_b_id;
            $guess_list['start_time'] = $start_time;
            $guess_list['end_time'] = $end_time;
            $guess_list['game_win_number'] = $game_win_number;
            $guess_list['id'] = intval($post['guess_list_id']);

            //竞猜信息表,存放某场比赛是否有竞猜 guess_list(录入比赛的信息,几局获胜)
           try{
               $res = model('GuessList')->insGL($guess_list);
            }catch (\Exception $e){
                echo json_html($e->getMessage(),0);
                exit;
            }

            //胜负赔率表   guess_winner
            $guess_winner['game_id'] = $game_id;
            $guess_winner['game_number'] = $game_number;
            $guess_winner['1_winner_id'] = $play_a_id;
            $guess_winner['2_winner_id'] = $play_b_id;
            $guess_winner['1_winner_odds'] = $winner_id_1;
            $guess_winner['2_winner_odds'] = $winner_id_2;
            $guess_winner['id'] = intval($post['guess_winner_id']);        //获取到竞猜胜负赔率表的主键id


            try{
                $res = model('GuessWinner')->insGW($guess_winner);
            }catch (\Exception $e){
                    echo json_html($e->getMessage(),0);
                    exit;
            }


            //让分赔率表  guess_winner_rangfen
            $guess_winner_rangfen['game_id'] = $game_id;
            $guess_winner_rangfen['game_number'] = $game_number;
            $rangfen_winner_1 = $post['1_winner_rangfen']?:0;
            $guess_winner_rangfen['1_rangfen_odds'] = $post['1_rangfen_odds'] ?: 0;
            $guess_winner_rangfen['2_rangfen_odds'] = $post['2_rangfen_odds'] ?: 0;
            $guess_winner_rangfen['1_winner_rangfen'] = $rangfen_winner_1;
            $guess_winner_rangfen['2_winner_rangfen'] = 0-($rangfen_winner_1);
            $guess_winner_rangfen['1_winner_rangfen_id'] = $play_a_id;
            $guess_winner_rangfen['2_winner_rangfen_id'] = $play_b_id;
            $guess_winner_rangfen['id'] = intval($post['guess_winner_rangfen_id']);
            try{
                $res = model('GuessWinnerRangfen')->insGWR($guess_winner_rangfen);
            }catch (\Exception $e){
                echo json_html($e->getMessage(),0);
                exit;
            }

            //局数赔率表 guess_gamenumber
            $guess_gamenumber['game_id'] = $game_id;
            $guess_gamenumber['game_number'] = $game_number;
            $guess_gamenumber['1_jushu'] = $post['1_jushu'];
            $guess_gamenumber['2_jushu'] = $post['2_jushu_1'].'-'.$post['2_jushu_2'];
            $guess_gamenumber['3_jushu'] = $post['3_jushu'];
            $guess_gamenumber['1_odds_js'] = $post['1_odds_js'];
            $guess_gamenumber['2_odds_js'] = $post['2_odds_js'];
            $guess_gamenumber['3_odds_js'] = $post['3_odds_js'];
            $guess_gamenumber['id'] = intval($post['guess_gamenumber_id']);
            try{
                 $res = model('GuessGamenumber')->insGG($guess_gamenumber);
            }catch (\Exception $e){
                echo json_html($e->getMessage(),0);
                exit;
            }

            //局间竞猜表 guess_winner_jujian
            $guess_winner_jujian['game_id'] = $game_id;
            $guess_winner_jujian['game_number'] = $game_number;
            $guess_winner_jujian['1_winner_id'] = $play_a_id;
            $guess_winner_jujian['2_winner_id'] = $play_b_id;
            $guess_winner_jujian['1_odds_jujian'] = $post['1_odds_jujian'];
            $guess_winner_jujian['2_odds_jujian'] = $post['2_odds_jujian'];
            $guess_winner_jujian['is_open'] = isset($_POST['is_open'])?$post['is_open'] : 0;
            $guess_winner_jujian['id'] = intval($post['guess_winner_jujian_id']);
            try{
                 model('GuessWinnerJujian')->insGWJ($guess_winner_jujian);
            }catch (\Exception $e){
                echo json_html($e->getMessage(),0);
                exit;
            }

            //比分赔率表  guess_score(因为这里你不知道它有多少个字段)
            $i = 1;
            $bifen_ = '';
            $peilv_bf_ = '';
            $fields = '';
            $values = '';
            $guess_score_id = input('param.guess_score_id');
            if($guess_score_id)
            {
                $msg = '修改成功';
                foreach ($_POST as $k => $v)
                {
                    //查找有几个比分赔率
                    if(strstr($k, 'peilv_bf'))
                    {
                        //比分
                        $bf = $bifen_.$i;
                        $bf = $_POST['bifen_'.$i];

                        //赔率
                        $pl = $peilv_bf_.$i;
                        $pl = $v;
                        $fields .= $i."_bifen='$bf',".$i."_peilv_bf='$pl',";
                        $i++;
                    }
                }
                $fields = "game_id='{$game_id}',"."game_number='{$game_number}',".$fields;
                $fields = trim($fields,',');

                try{
                    $res = $this->db->execute("update guess_score set $fields  where id= $guess_score_id");

                }catch (\Exception $e){
                    echo json_html($e->getMessage(),0);
                    exit;
                }
            }else{
                $msg = '操作成功';
                foreach($post as $k=>$v)
                {
                    //查找有几个比分赔率
                    if (strstr($k, 'peilv_bf'))
                    {
                        //比分
                        $bf = $bifen_.$i;
                        $bf = $_POST['bifen_'.$i];

                        //赔率
                        $pl = $peilv_bf_.$i;
                        $pl = $v ?: 0;;
                        $fields .= $i."_bifen".",".$i."_peilv_bf,";
                        $values .= "'$bf'".','."'$pl'".',';
                        $i++;
                    }
                }
                $fields = trim($fields,',');
                $values = trim($values,',');
                $create_time = time();
                if(empty($fields))
                {
                    $fields = 'game_id'.'game_number'.'create_time'.$fields;
                    $values = $game_id.$game_number.$create_time.$values;
                }else{
                    $fields = 'game_id,'.'game_number,'.'create_time,'.$fields;
                    $values = $game_id.','.$game_number.','.$create_time.','.$values;
                }
                try{
                    $res = $this->db->execute("insert guess_score($fields) values($values)");
                }catch (\Exception $e){
                    echo json_html($e->getMessage(),0);
                    exit;
                }
            }


            if($res)
            {
                echo json_html($msg,1,$domain."/ymq/guess/guessList/game_id/".$game_id);
                exit;
            }

        }

        return view('',[
            'game_id'=>$game_id,
            'game_id_s'=>$game_id_s,
            'play_a_name'=>$play_a_name,
            'play_b_name'=>$play_b_name,
            'game_number'=>$game_number,
            'game_number_s'=>$game_number_s,
            'time'=>$time,
            'guess_end_time'=>$guess_end_time,
            'guess_list_one'=>$guess_list_one,
            'guess_winner_one'=>$guess_winner_one,
            'guess_winner_rangfen_one'=>$guess_winner_rangfen_one,
            'guess_gamenumber_one'=>$guess_gamenumber_one,
            'guess_winner_jujian_one'=>$guess_winner_jujian_one,
            'guess_score_one'=>$guess_score_one,
            'pl_arr'=>$pl_arr
        ]);
    }

    /**
     * 手动开启这场比赛的竞猜
     * @param id 竞猜id
     */
    public function manualOpenGuess()
    {
        if(request()->isPost())
        {
            $id = input('post.id');
            try{
                $res = $this->db->table('guess_list')->where('id',$id)->setField('manual_open', 1);
            }catch (\Exception $e){
                return json_show($e->getMessage(),0);
            }
            if($res)
            {
                return json_show('开启成功',1);
            }else{
                return json_show('操作失败',0);
            }
        }else{
            return json_show('操作异常,请稍后再试',0);
        }
    }
    /**
     * 手动关闭这场比赛的竞猜
     * @param id 竞猜id
     */
    public function manualCloseGuess()
    {
        if(request()->isPost())
        {
            $id = input('post.id');
            try{
                $res = $this->db->table('guess_list')->where('id',$id)->setField('manual_open', 0);
            }catch (\Exception $e){
                return json_show($e->getMessage(),0);
            }
            if($res)
            {
                return json_show('关闭成功',1);
            }else{
                return json_show('操作失败',0);
            }
        }else{
            return json_show('操作异常,请稍后再试',0);
        }
    }
}

/* $game_win_number = $this->db->table('game_phase')
                       ->alias('a')
                       ->join('game_live b','b.phase_id = a.id and b.bigGame_id = a.bigGame_id','left')
                       ->field('a.game_win_number')
                       ->where(['b.id'=>$game_id])
                       ->find();
       $game_win_number = $game_win_number['game_win_number']; //获得比赛胜利局数*/

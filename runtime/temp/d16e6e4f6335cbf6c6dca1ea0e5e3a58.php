<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:60:"/www/h5/public/../application/football/view/guess/guess.html";i:1540128354;s:50:"/www/h5/application/football/view/public/meta.html";i:1539429417;s:52:"/www/h5/application/football/view/public/footer.html";i:1539429417;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="Bookmark" href="/favicon.ico" >
    <link rel="Shortcut Icon" href="/favicon.ico" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/static/lib/html5shiv.js"></script>
    <script type="text/javascript" src="/static/lib/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/static/static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/static/static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="/static/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/static/static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/static/static/h-ui.admin/css/style.css" />


    <!--引入上传插件uploadify的css样式-->
    <link rel="stylesheet" type="text/css" href="/static/admin/uploadify/uploadify.css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="/static/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->

    <!--uploadify插件上传图片配置-->
    <script type="text/javascript">
        swf = '/static/admin/uploadify/uploadify.swf';
        image_upload_url = "<?php echo url('image/upload'); ?>";
    </script>
    <title>H5</title>
<body>

<style type="text/css">
    table td{
        line-height: 30px;
    }
    table td input{
        border:1px solid #c8cccf;
        height:40px;
        padding-left: 1em;
    }
    table td label{
        padding: 20px;
    }
    table td span{
        color: red;
        padding-right: 6px;
    }
    .text-c .radio-style input{
        width: 13px;
        height: 15px;
    }
    .text-c .number-game-guess input{
        width: 60px;
        height:30px;
    }
    .text-c .number-game-guess span{
        font-weight:bold;
        color:black;
        padding-left: 8px;
    }
    .span-score{
        padding:0.3em 1em;
        line-height: 2;
        font-weight: 400;
        font-size: 1.3em;
        text-align: center;
        color: #555;
        background-color: #eee;
        border: 1px solid #ccc;
    }
    .calres_show{
        color: green;
    }
    /*.input-score{*/
        /*height:50px;*/
    /*}*/
</style>


<h2 style="text-align: center">
    <?php if(empty($guess_list_one) || (($guess_list_one instanceof \think\Collection || $guess_list_one instanceof \think\Paginator ) && $guess_list_one->isEmpty())): ?>新加竞猜<?php else: ?>修改竞猜<?php endif; ?>
</h2>
<br><br>
<form method="post" class="form form-horizontal" id="add-game-guess">
    <table class="table table-border table-hover" align="center" style="width: 90%">
        <!--比赛id-->
        <input hidden type="text" value="<?php echo $game_id; ?>" name="game_id">
        <input hidden type="text" value="<?php echo $game_number; ?>" name="game_number">

        <tbody>
            <tr class="text-c">
                <td><strong><span>*</span>场次编号:</strong></td>
                <td>
                   <!--场次编号-->
                    <input type="text" name="game_number" value="<?php echo $game_number; ?>" disabled>

                </td>
                <td><strong><span>*</span>开猜时间</strong></td>
                <td>
                    <input type="text"
                           onfocus="selecttime()"
                           value="<?php echo date('Y-m-d H:i:s',$time); ?>"
                           name="start_time"
                           id="countTimestart" class="input-text Wdate radius"
                           style="width:180px;height: 40px"
                           autocomplete="off">
                </td>
                <td><strong><span>*</span>竞猜截止</strong></td>
                <td><input type="text"
                           onfocus="selecttime()"
                           value="<?php echo date('Y-m-d H:i:s',$guess_end_time); ?>"
                           name="end_time"
                           id="countTimeend" class="input-text Wdate radius"
                           style="width:180px;height: 40px"
                           autocomplete="off">
                </td>
            </tr>
            <tr class="text-c">
                <td><strong><span>*</span>对手A</strong></td>
                <td>
                    <input type="text" name="play_a_name" value="<?php echo $play_a_name; ?>" hidden>
                    <input type="text" name="play_a_name" value="<?php echo $play_a_name; ?>" disabled>
                </td>
                <td><strong><span>*</span>对手B</strong></td>
                <td>
                    <input type="text" name="play_b_name" value="<?php echo $play_b_name; ?>" hidden>
                    <input type="text" name="play_b_name" value="<?php echo $play_b_name; ?>" disabled>
                </td>
            </tr>

            <tr class="text-c">
                <td><strong><span>*</span>胜负赔率</strong></td>
                <td>
                    <input id="1_winner_id" type="text" name="1_winner_id"
                           onblur="winner_odds()"
                           placeholder="A胜" autocomplete="off">
                </td>
                <td><strong><span>*</span>胜负赔率</strong></td>
                <td>
                    <input id="2_winner_id" type="text" name="2_winner_id"
                           onblur="winner_odds()"
                           placeholder="B胜" autocomplete="off">
                </td>
                <td><strong><span>*</span>平局赔率</strong></td>
                <td>
                    <input id="3_winner_id" type="text" name="3_winner_id"
                           onblur="winner_odds()"
                           placeholder="B胜" autocomplete="off">
                </td>
                <td id="odds_Calculation">
                    <span id="calres_winner"></span>
                </td>
                <script type="text/javascript">
                    function winner_odds()
                    {
                        var winner_id_1 =  $("input[id='1_winner_id']").val();
                        var winner_id_2 =  $("input[id='2_winner_id']").val();
                        var winner_id_3 =  $("input[id='3_winner_id']").val();
                        if(winner_id_1 !=0 && winner_id_2 !=0 && winner_id_3 !=0)
                        {
                            var odds = 1/winner_id_1 + 1/winner_id_2 + 1/winner_id_3;
                            var calres = (1/odds).toFixed(2);
                            if(  0.92<= calres >= 0.8)
                            {
                                //显示绿色
                                //$("#odds_Calculation").append("<span style='color: green'>{carles}</span>");
                                var calres_winner = document.getElementById('calres_winner');
                                $('#calres_winner').addClass('calres_show');
                                calres_winner.innerText = calres;
                            }else{
                                //显示红色
                                //$("#odds_Calculation").append("<span>{carles}</span>");
                                var calres_winner = document.getElementById('calres_winner');
                                calres_winner.innerText = calres;
                            }
                        }else{
                            return;
                        }
                    }
                </script>
            </tr>

            <tr class="text-c">
                <td width="10%"><strong>让分赔率</strong></td>
                <td>
                    <input type="text" name="1_winner_rangfen"
                           value="" placeholder="A让分数值" autocomplete="off">
                </td>
                <td><input type="text" name="1_rangfen_odds" id="1_rangfen_odds"
                           onblur="rf_odds()"
                           value="" placeholder="A让分赔率" autocomplete="off"></td>

                <td>
                    <input type="text" name="2_rangfen_odds" id="2_rangfen_odds"
                           onblur="rf_odds()"
                           value="" placeholder="B让分赔率" autocomplete="off">
                </td>
                <td>
                    <input type="text" name="3_rangfen_odds" id="3_rangfen_odds"
                           onblur="rf_odds()"
                           value="" placeholder="平局赔率" autocomplete="off">
                </td>
                <td>
                    <span id="calres_rf"></span>
                </td>
                <script type="text/javascript">
                    function rf_odds()
                    {
                        var rf_id_1 =  $("input[id='1_rangfen_odds']").val();
                        var rf_id_2 =  $("input[id='2_rangfen_odds']").val();
                        var rf_id_3 =  $("input[id='3_rangfen_odds']").val();
                        if(rf_id_1 !=0 && rf_id_2 !=0 && rf_id_3 !=0)
                        {
                            var odds = 1/rf_id_1 + 1/rf_id_2 + 1/rf_id_3;
                            var calres = (1/odds).toFixed(2);
                            if(  0.92<= calres >= 0.8)
                            {
                                //显示绿色
                                var calres_rf = document.getElementById('calres_rf');
                                $('#calres_rf').addClass('calres_show');
                                calres_rf.innerText = calres;
                            }else{
                                //显示红色
                                var calres_rf = document.getElementById('calres_rf');
                                calres_rf.innerText = calres;
                            }
                        }else{
                            return;
                        }
                    }
                </script>
            </tr>

            <!--<tr class="text-c">-->
                <!--<td><strong>局数赔率</strong></td>-->
                <!--<td colspan="6" class="number-game-guess">-->
                    <!--<span>小于等于</span>-->
                    <!--<input type="text" name="1_jushu"-->
                           <!--value="" placeholder="局数" style="width: 60px;" autocomplete="off"><span>局,赔率为</span>-->
                    <!--<input type="text" name="1_odds_js"-->
                           <!--value="" placeholder="" style="width: 60px" autocomplete="off">-->
                    <!--<br><br>-->
                    <!--<input type="text" name="2_jushu_1"-->
                           <!--value="" placeholder="局数" autocomplete="off">-->
                    <!--&#45;&#45;-->
                    <!--<input type="text" name="2_jushu_2"-->
                           <!--value="" placeholder="局数" autocomplete="off"><span>局,赔率为</span>-->
                    <!--<input type="text" name="2_odds_js"-->
                           <!--value="" placeholder="" autocomplete="off">-->
                    <!--<br><br>-->
                    <!--<span>大于等于</span><input type="text" name="3_jushu"-->
                                            <!--value="" placeholder="局数" autocomplete="off"><span>局,赔率为</span>-->
                    <!--<input type="text" name="3_odds_js"-->
                           <!--value="" placeholder="" autocomplete="off">-->
                <!--</td>-->
            <!--</tr>-->
            <tr class="text-c">
                <input type="hidden" name="is_score" value="1">
                <td><strong><span>*</span>两队是否得分:</strong></td>
                <td><input type="text" id="1_score_odds" name="1_score_odds"
                           onblur="isscore_odds()"
                           value="" placeholder="是"></td>
                <td><input type="text" id="2_score_odds" name="2_score_odds"
                           onblur="isscore_odds()"
                           value="" placeholder="否"></td>
                <td>
                    <span id="calres_isscore"></span>
                </td>
                <script type="text/javascript">
                    function isscore_odds()
                    {
                        var score_id_1 =  $("input[id='1_score_odds']").val();
                        var score_id_2 =  $("input[id='2_score_odds']").val();
                        if(score_id_1 !=0 && score_id_2 !=0 )
                        {
                            var odds = 1/score_id_1 + 1/score_id_2;
                            var calres = (1/odds).toFixed(2);
                            if(  0.92<= calres >= 0.8)
                            {
                                //显示绿色
                                var calres_rf = document.getElementById('calres_isscore');
                                $('#calres_isscore').addClass('calres_show');
                                calres_rf.innerText = calres;
                            }else{
                                //显示红色
                                var calres_rf = document.getElementById('calres_isscore');
                                calres_rf.innerText = calres;
                            }
                        }else{
                            return;
                        }
                    }
                </script>
            </tr>


            <tr class="text-c">
                <input type="hidden" name="total_score" value="1">
                <td><strong><span>*</span>进球大小盘:</strong></td>
                <td><input type="text" name="total_score" value="" placeholder="请输入两队总进球数"></td>
                <td><input type="text" name="1_compare_odds"
                           id="1_compare_odds" onblur="totalscore_odds()"
                           value="" placeholder="大于进球数赔率"></td>
                <td><input type="text" name="2_compare_odds"
                           id="2_compare_odds" onblur="totalscore_odds()"
                           value="" placeholder="小于进球数赔率"></td>
                <td>
                    <span id="calres_totalscore"></span>
                </td>
                <script type="text/javascript">
                    function totalscore_odds()
                    {
                        var score_id_1 =  $("input[id='1_compare_odds']").val();
                        var score_id_2 =  $("input[id='2_compare_odds']").val();
                        if(score_id_1 !=0 && score_id_2 !=0 )
                        {
                            var odds = 1/score_id_1 + 1/score_id_2;
                            var calres = (1/odds).toFixed(2);
                            if(  0.92<= calres >= 0.8)
                            {
                                //显示绿色
                                var calres_rf = document.getElementById('calres_totalscore');
                                $('#calres_totalscore').addClass('calres_show');
                                calres_rf.innerText = calres;
                            }else{
                                //显示红色
                                var calres_rf = document.getElementById('calres_totalscore');
                                calres_rf.innerText = calres;
                            }
                        }else{
                            return;
                        }
                    }
                </script>
            </tr>


            <!--<tr class="text-c">-->
                <!--<td><strong>局间竞猜</strong></td>-->
                <!--<td><input type="text" name="1_odds_jujian" value="" placeholder="A胜" autocomplete="off"></td>-->
                <!--<td><input type="text" name="2_odds_jujian" value="" placeholder="B胜" autocomplete="off"></td>-->
                <!--<td><strong>是否开启</strong></td>-->
                <!--<td class="radio-style" style="text-align: left">-->
                    <!--<label><input type="radio"-->

                                  <!--name="is_open" value="1">是</label>-->
                    <!--<label><input type="radio"-->

                                  <!--name="is_open" value="0">否</label>-->
                <!--</td>-->
            <!--</tr>-->

           <tr class="text-c score-odds">
               <td><strong>比分赔率</strong></td>
               <td colspan="8"></td>
           </tr>
        </tbody>
    </table>

    <br>
    <div style="text-align: center">


        <button type="button" class="btn btn-success radius size-XL" onclick="history.go(-1)"> < </button>
        <!--<button onClick="removeIframe();" class="btn btn-success radius size-XL" type="button">&nbsp;&nbsp;<&nbsp;</button>
-->
        <button type="submit" class="btn btn-primary radius size-XL" id="add-guess">提交</button>
    </div>

</form>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/static/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/static/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/static/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/static/static/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="/static/admin/js/common.js"></script>

<!--引入uploadify上传的js文件-->
<script type="text/javascript" src="/static/admin/uploadify/jquery.uploadify.min.js"></script>
<script type="text/javascript" src="/static/admin/js/image.js"></script>


<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/static/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript" src="/static/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/static/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
    $(function(){
        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });

        $("#add-game-guess").validate({

            submitHandler:function(form)
            {
                var data = $(form).serialize();  //获取表单里的数据
                url = "<?php echo url('guess/guess'); ?>";
                $.post(url,data,function(result)
                {
                    if(result.code == 1)
                    {
                        layer.msg(result.msg,{icon:1,time:2000},function(){
                            self.location = result.data.jump_url;
                        });
                        //setInterval("removeIframe()",2000);
                    }else{
                        layer.msg(result.msg,{icon:5,time:2000});
                    }
                },'JSON')
            }
        });
    });
    function closeWindow()
    {
        var index = parent.layer.getFrameIndex(window.name);
        window.parent.location.reload();
    }





</script>
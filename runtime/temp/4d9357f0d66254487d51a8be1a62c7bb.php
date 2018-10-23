<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:65:"E:\laragon\www\h5\public/../application/ymq\view\guess\guess.html";i:1538293588;s:55:"E:\laragon\www\h5\application\ymq\view\public\meta.html";i:1537249833;s:57:"E:\laragon\www\h5\application\ymq\view\public\footer.html";i:1537249833;}*/ ?>
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
    /*.input-score{*/
        /*height:50px;*/
    /*}*/
</style>


<h2 style="text-align: center">
    <?php if(empty($guess_list_one) || (($guess_list_one instanceof \think\Collection || $guess_list_one instanceof \think\Paginator ) && $guess_list_one->isEmpty())): ?>新加竞猜<?php else: ?>修改竞猜<?php endif; ?>
</h2>
<br><br>
<form method="post" class="form form-horizontal" id="add-game-guess">
    <table class="table table-border table-hover" align="center" style="width: 80%">
        <?php if(empty($guess_list_one) || (($guess_list_one instanceof \think\Collection || $guess_list_one instanceof \think\Paginator ) && $guess_list_one->isEmpty())): ?>
        <input hidden type="text" value="<?php echo $game_id; ?>" name="game_id">
        <?php else: ?>
        <input hidden type="text" value="<?php echo $game_id_s; ?>" name="game_id">
        <?php endif; ?>

        <tbody>
            <tr class="text-c">
                <td><strong><span>*</span>场次编号:</strong></td>
                <td>
                    <?php if(empty($guess_list_one) || (($guess_list_one instanceof \think\Collection || $guess_list_one instanceof \think\Paginator ) && $guess_list_one->isEmpty())): ?>
                    <input type="text" name="game_number" value="<?php echo $game_number_s; ?>" disabled>
                    <?php else: ?>
                    <input type="text" name="game_number" value="<?php echo $game_number; ?>" disabled>
                    <?php endif; ?>
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

                    <input type="text" name="play_a_name" value="<?php echo $play_a_name; ?>" disabled>


                </td>
                <td><strong><span>*</span>对手B</strong></td>
                <td><input type="text" name="play_b_name" value="<?php echo $play_b_name; ?>" disabled></td>
            </tr>
            <tr class="text-c">
                <td><strong><span>*</span>几局获胜</strong></td>
                <td colspan="12" class="radio-style">
                    <label><input type="radio" name="game_win_number" value="2" <?php echo $guess_list_one['game_win_number']==2?'checked':''; ?>>2</label>
                    <label><input type="radio" name="game_win_number" value="3" <?php echo $guess_list_one['game_win_number']==3?'checked':''; ?>>3</label>
                    <label><input type="radio" name="game_win_number" value="4" <?php echo $guess_list_one['game_win_number']==4?'checked':''; ?>>4</label>
                    <label><input type="radio" name="game_win_number" value="5" <?php echo $guess_list_one['game_win_number']==5?'checked':''; ?>>5</label>
                    <label><input type="radio" name="game_win_number" value="6" <?php echo $guess_list_one['game_win_number']==6?'checked':''; ?>>6</label>
                    <label><input type="radio" name="game_win_number" value="7" <?php echo $guess_list_one['game_win_number']==7?'checked':''; ?>>7</label>
                    <label><input type="radio" name="game_win_number" value="8" <?php echo $guess_list_one['game_win_number']==8?'checked':''; ?>>8</label>
                    <label><input type="radio" name="game_win_number" value="9" <?php echo $guess_list_one['game_win_number']==9?'checked':''; ?>>9</label>
                    <label><input type="radio" name="game_win_number" value="10" <?php echo $guess_list_one['game_win_number']==10?'checked':''; ?>>10</label>
                    <label><input type="radio" name="game_win_number" value="11" <?php echo $guess_list_one['game_win_number']==11?'checked':''; ?>>11</label>
                    <label><input type="radio" name="game_win_number" value="12" <?php echo $guess_list_one['game_win_number']==12?'checked':''; ?>>12</label>
                    <label><input type="radio" name="game_win_number" value="13" <?php echo $guess_list_one['game_win_number']==13?'checked':''; ?>>13</label>
                    <label><input type="radio" name="game_win_number" value="14" <?php echo $guess_list_one['game_win_number']==14?'checked':''; ?>>14</label>
                    <label><input type="radio" name="game_win_number" value="15" <?php echo $guess_list_one['game_win_number']==15?'checked':''; ?>>15</label>
                    <label><input type="radio" name="game_win_number" value="16" <?php echo $guess_list_one['game_win_number']==16?'checked':''; ?>>16</label>
                    <label><input type="radio" name="game_win_number" value="17" <?php echo $guess_list_one['game_win_number']==17?'checked':''; ?>>17</label>
                    <label><input type="radio" name="game_win_number" value="18" <?php echo $guess_list_one['game_win_number']==18?'checked':''; ?>>18</label>
                </td>
            </tr>
            <tr class="text-c">
                <td><strong><span>*</span>胜负赔率</strong></td>
                <td>
                    <input type="text" name="1_winner_id" value="<?php echo $guess_winner_one['1_winner_odds']; ?>" placeholder="A胜" autocomplete="off">
                </td>
                <td><strong><span>*</span>胜负赔率</strong></td>
                <td>
                    <input type="text" name="2_winner_id" value="<?php echo $guess_winner_one['2_winner_odds']; ?>" placeholder="B胜" autocomplete="off">
                </td>
            </tr>

            <tr class="text-c">
                <td width="10%"><strong>让分赔率</strong></td>
                <td>
                    <input type="text" name="1_winner_rangfen"
                           value="<?php echo $guess_winner_rangfen_one['1_winner_rangfen']; ?>" placeholder="A让分数值" autocomplete="off">
                </td>
                <td><input type="text" name="1_rangfen_odds"
                           value="<?php echo $guess_winner_rangfen_one['1_rangfen_odds']; ?>" placeholder="A让分赔率" autocomplete="off"></td>

                <td>
                    <!--<input type="text" name="2_winner_rangfen" value="" placeholder="B让分数值" autocomplete="off">-->
                </td>
                <td>
                    <input type="text" name="2_rangfen_odds"
                           value="<?php echo $guess_winner_rangfen_one['2_rangfen_odds']; ?>" placeholder="B让分赔率" autocomplete="off">
                </td>
            </tr>

            <tr class="text-c">
                <td><strong>局数赔率</strong></td>
                <td colspan="6" class="number-game-guess">
                    <span>小于等于</span>
                    <input type="text" name="1_jushu"
                           value="<?php echo $guess_gamenumber_one['1_jushu']; ?>" placeholder="局数" style="width: 60px;" autocomplete="off"><span>局,赔率为</span>
                    <input type="text" name="1_odds_js"
                           value="<?php echo $guess_gamenumber_one['1_odds_js']; ?>" placeholder="" style="width: 60px" autocomplete="off">
                    <br><br>
                    <input type="text" name="2_jushu_1"
                           value="<?php echo $guess_gamenumber_one['2_jushu_1']; ?>" placeholder="局数" autocomplete="off">
                    --
                    <input type="text" name="2_jushu_2"
                           value="<?php echo $guess_gamenumber_one['2_jushu_2']; ?>" placeholder="局数" autocomplete="off"><span>局,赔率为</span>
                    <input type="text" name="2_odds_js"
                           value="<?php echo $guess_gamenumber_one['2_odds_js']; ?>" placeholder="" autocomplete="off">
                    <br><br>
                    <span>大于等于</span><input type="text" name="3_jushu"
                                            value="<?php echo $guess_gamenumber_one['3_jushu']; ?>" placeholder="局数" autocomplete="off"><span>局,赔率为</span>
                    <input type="text" name="3_odds_js"
                           value="<?php echo $guess_gamenumber_one['3_odds_js']; ?>" placeholder="" autocomplete="off">
                </td>
            </tr>

            <tr class="text-c">
                <td><strong>局间竞猜</strong></td>
                <td><input type="text" name="1_odds_jujian" value="<?php echo $guess_winner_jujian_one['1_odds_jujian']; ?>" placeholder="A胜" autocomplete="off"></td>
                <td><input type="text" name="2_odds_jujian" value="<?php echo $guess_winner_jujian_one['2_odds_jujian']; ?>" placeholder="B胜" autocomplete="off"></td>
                <td><strong>是否开启</strong></td>
                <td class="radio-style" style="text-align: left">
                    <label><input type="radio"
                                  <?php echo $guess_winner_jujian_one['is_open']==1?'checked':''; ?>
                                  name="is_open" value="1">是</label>
                    <label><input type="radio"
                                  <?php echo $guess_winner_jujian_one['is_open']==0?'checked':''; ?>
                                  name="is_open" value="0">否</label>
                </td>
            </tr>

           <tr class="text-c score-odds">
               <td><strong>比分赔率</strong></td>
               <td colspan="8"></td>
           </tr>
        </tbody>
    </table>

    <br>
    <div style="text-align: center">

        <input hidden value="<?php echo $guess_list_one['id']; ?>" name="guess_list_id">
        <input hidden value="<?php echo $guess_winner_one['id']; ?>" name="guess_winner_id">
        <input hidden value="<?php echo $guess_winner_rangfen_one['id']; ?>" name="guess_winner_rangfen_id">
        <input hidden value="<?php echo $guess_gamenumber_one['id']; ?>" name="guess_gamenumber_id">
        <input hidden value="<?php echo $guess_winner_jujian_one['id']; ?>" name="guess_winner_jujian_id">
        <input hidden value="<?php echo $guess_score_one['id']; ?>" name="guess_score_id">

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
    $('input[name="game_win_number"]').click(function(){
        var num=$(this).val();
        addTr(num);
    })

    //给动态生成的比分里面加赔率

    var game_win_number='<?php echo $guess_list_one['game_win_number']; ?>';
    if(game_win_number > 1)
    {
        var pl_arr=<?php echo $pl_arr; ?>;
        addTr(game_win_number);
        game_win_number = game_win_number * 2;
        for(var i=1 ; i<=game_win_number; i++)
        {
            var ele='input[name='+i+'_peilv_bf]';
            $(ele).val(pl_arr[i-1]);
        }
    }

    function addTr(num)
    {
        var ttr='';
        for(var i=0; i<num ; i++){
            if(i == 18) break;              //显示完整的比分额
            var left_bf= i == 0 ? (i+1) : (right_bf+1) ;   //左边的比分值,left和right_bf从1开始，依次往上加一
            var left_pl=num+':'+i;           //左边的比分赔率

            var right_bf=left_bf+1;          //右边的比分值i+1+parseInt(num);
            var right_pl=i+':'+num;          //右边的比分赔率


            //我要左右 1 2 这样的值

            var tr=" <tr>" +
                "<td width='10%'> </td>" +
                "<td width='10%' colspan=2>" +
                "<div> " +
                "<span class='span-score'>"+left_pl+"</span>" +
                "<input  type='hidden' name=bifen_"+left_bf+" value='"+left_pl+"' > " +
                "<input class='input-score' type='text' name="+left_bf+"_peilv_bf autocomplete=\"off\"></div>" +
                "</td> &nbsp;&nbsp;　　" +
                "<td  width='10%' colspan=2>" +
                "<div> " +
                "<span class='span-score'>"+right_pl+"</span>" +
                "<input type='hidden' name=bifen_"+right_bf+" value='"+right_pl+"' > " +
                "<input class='input-score' type='text' name="+right_bf+"_peilv_bf autocomplete=\"off\"> " +
                "</div> " +
                "</td> " +
                "</tr>";
            ttr+=tr;
        }
        $(".score-odds").nextAll().remove();
        $('tbody').append(ttr);
    }


    //序列化表单数据，通过ajax把表单数据提交给后台
    var xhr=new XMLHttpRequest();
    $("#add-guess").bind("click",function(){
        var _this=$(this);
        _this.attr('disabled',true);

        var form=$('#add-game-guess').get(0);
        var fd=new FormData();
        var parts=serailizeForm2(form);
        $.each(parts,function(index,element){
            fd.append(index,element);
        })
        var url = "<?php echo url('guess/guess'); ?>";
        xhr.open('POST',url,true);
        xhr.send(fd);
        xhr.onreadystatechange=function()
        {
            if(xhr.readyState == 4)
            {
                if(xhr.status == 200)
                {
                    res=xhr.responseText;
                    returnInfo(res);
                }
                _this.removeAttr('disabled');
            }
        }
    })


    //序列化表单要提交的数据，
    //返回一个数组对象
    function serailizeForm2(form){
        old_name="";
        var parts = {};
        for (var i = 0; i < form.elements.length; i ++) {
            var filed = form.elements[i];
            switch (filed.type) {  //遍历表单里面元素的类型，过滤掉没有值的元素；
                case undefined : break;
                case 'submit' :  break;
                case 'reset' :   break;
                case 'file' :    break;
                case 'button' :  break;
                case 'radio' :
                    if (!filed.checked) break;
                case 'checkbox' :
                    if (!filed.checked) break;
                    if(old_name != filed.name ){   //把一组checkbox放在一个数组里
                        var j=i;
                        var j=[];
                    }
                    old_name=filed.name;
                    filed.value=$.trim(filed.value);
                    j.push(filed.value);
                    parts[filed.name]=j; break;
                case 'select-multiple' :
                    for (var j = 0; j < filed.options.length; j ++) {
                        var option = filed.options[j];
                        if (option.selected) {
                            var optValue = '';
                            if (option.hasAttribute) {
                                optValue = (option.hasAttribute('value') ? option.value : option.text);
                            } else {  //ie支持attributes()
                                optValue = (option.attributes('value').specified ? option.value : option.text);
                            }
                            parts[filed.name] = optValue;
                        }
                    }
                    break;
                default :
                    parts[filed.name] = filed.value; //默认表单中要提交的name=value
            }
        }
        return parts;
    }

    //展示请求结果,1、返回的有url跳url | 2、没url、方法没传jump参数，返回上一个页面 | 3、否则重新加载页面
    function returnInfo(res)
    {
        //console.log(res) //{"info":"\u6dfb\u52a0\u6210\u529f","status":"1","url":"ymq\/guess\/guessList\/game_id\/15"}
        //console.log(jump) // undefined
        //return
        try{
            res=JSON.parse(res);
        }catch(err){
            layer.msg("返回数据有问题", {icon: 2, time: 1200 });
        }

        switch (parseInt(res.status)) {
            case 1:
                layer.msg(res.info, {
                    icon: 1,
                    time: 1000
                });
                setTimeout(function()
                {
                    if (res.url == null || res.url == '')
                    {
                        window.location.reload();
                    } else {
                        window.location.href = res.url;
                    }

                }, 1300);
                break;
            case 0 :
                layer.msg(res.info, {
                    icon: 2,
                    time: 2200
                });
                break;
            default:
                layer.msg("返回数据有问题", {
                    icon: 2,
                    time: 1200
                });
                break;
        }
    }




</script>
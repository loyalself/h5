<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:63:"/www/h5/public/../application/football/view/game_live/live.html";i:1539867338;s:50:"/www/h5/application/football/view/public/meta.html";i:1539429417;s:52:"/www/h5/application/football/view/public/footer.html";i:1539429417;}*/ ?>
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
    tr{
        line-height:60px
    }
    b{
        color: #bd362f;
        padding-right: 6px;
    }
    strong{
        padding-right: 30px;
    }
    .search_box{
        width: 280px;
        margin: 0 auto;
        background: #EAEAEA;
    }
    .player_box li:hover{
        background: #ccc;
    }
</style>


<h2 style="text-align: center">
    <?php if(empty($one) || (($one instanceof \think\Collection || $one instanceof \think\Paginator ) && $one->isEmpty())): ?>添加比赛<?php else: ?>修改比赛<?php endif; ?>
</h2>
<br><br>
<form method="post" class="form form-horizontal" id="add-game-live">
<table class="table table-border table-hover" align="center" style="width: 80%">
    <tbody>
    <tr class="text-c" >
        <td>
            <strong><b>*</b>比赛开始时间:</strong>

            <input type="text"
                   onfocus="selecttime(1)"
                   <?php if(empty($one) || (($one instanceof \think\Collection || $one instanceof \think\Paginator ) && $one->isEmpty())): ?>
                     value=""
                   <?php else: ?>
                     value="<?php echo date('Y-m-d H:i:s',$one['start_time']); ?>"
                   <?php endif; ?>
                   name="start_time"
                   id="countTimestart" class="input-text Wdate radius" style="width:180px;height: 40px" autocomplete="off">
        </td>

        <td>
            <strong><b>*</b>是否在首页显示:</strong>
            <input type="radio" id="is_show_index-1"
                   name="is_show_index" value="0" checked
                   <?php echo $one['is_show_index']==0?'checked':''; ?>>
            <label for="radio-1">不展示</label>
            <span style="padding-right: 20px"></span>
            <input type="radio" id="is_show_index-2" name="is_show_index"
                   <?php echo $one['is_show_index']==1?'checked':''; ?>
            value="1">
            <label for="radio-2">展示</label>
        </td>

    </tr>
    <tr class="text-c">
        <td>
            <strong>对战A名称:</strong>
            <input type="text" name="play_a_name" id="play_a_id"
                   autocomplete="off"
                   placeholder="请输入关键字搜索" onkeyup="showResult(this.value,1)"
                   value="<?php echo $one['play_a_name']; ?>"  style="width:60%;height:40px;" class="input-text radius size-XL">
            <div id="search_boxa" class="search_box" >
                <ul id="player_boxa" class="player_box">

                </ul>
            </div>
        </td>
        <td>
            <strong>对战B名称:</strong>
            <input type="text" name="play_b_name" id="play_b_id"
                   autocomplete="off"
                   placeholder="请输入关键字搜索" onkeyup="showResult(this.value,2)"
                   value="<?php echo $one['play_b_name']; ?>"  style="width:60%;height:40px" class="input-text radius size-XL">
            <div id="search_boxb" class="search_box" >
                <ul id="player_boxb" class="player_box">

                </ul>
            </div>

        </td>
    </tr>

    <tr class="text-c">
        <td>
            <strong><b>*</b>解析方式:</strong>
                <input type="radio" id="radio-1"
                       name="analysis_type" value="1" checked
                       <?php echo $one['analysis_type']==1?'checked':''; ?>>
                <label for="radio-1">点亮解析</label>
            <span style="padding-right: 20px"></span>
                <input type="radio" id="radio-2" name="analysis_type"
                       <?php echo $one['analysis_type']==2?'checked':''; ?>
                       value="2">
                <label for="radio-2">直接播放</label>
        </td>
        <td>
            <strong><b>*</b>播放方式:</strong>
            <input type="radio" id="radio11"
                   name="bofang_type" value="1" checked
                   <?php echo $one['bofang_type']==1?'checked':''; ?>>
            <label for="radio-1">点量点播</label>
            <span style="padding-right: 20px"></span>
            <input type="radio" id="radio12" name="bofang_type"
                   <?php echo $one['bofang_type']==2?'checked':''; ?>
            value="2">
            <label for="radio-2">点量直播</label>
        </td>
    </tr>

    <tr class="text-c">
        <td>
            <strong><b>*</b>直播房间:</strong>
            <input type="text"
                   autocomplete="off"
                   name="liveUrl" id="liveUrl"
                   value="<?php echo $one['liveUrl']; ?>" placeholder=""
                   style="width:60%;height:40px" class="input-text radius size-XL">
        </td>

    </tr>

    <tr class="text-c">
        <td>
            <strong style="text-align: center">直播间公告:</strong>
            <textarea name="live_notice" value="<?php echo $one['live_notice']; ?>"  class="radius" style="width:60%;height: 100px"></textarea>
        </td>

    </tr>

    <tr class="text-c">
        <td id="a_score_td">
            <strong><b>*</b>请输入比分:</strong>
            <strong>A分数:</strong>
            <input type="text"
                   name="a_win_num" id="a_win_num"
                   autocomplete="off"
                   value="" placeholder="A的分数"
                   onblur = "wirteScore1()"
                   style="width:60%;height:40px" class="input-text radius size-XL">
        </td>
        <td id="b_score_td">
            <strong>B分数:</strong>
            <input type="text"
                   name="b_win_num" id="b_win_num"
                   autocomplete="off"
                   value="" placeholder="B的分数"
                   onblur = "wirteScore2()"
                   style="width:60%;height:40px" class="input-text radius size-XL">
        </td>
    </tr>

    <tr class="text-c ">
        <td id="td_qisai">
            <strong><b>*</b>是否弃赛:</strong>

            <span style="padding-right: 20px"></span>
                <input type="radio" id="radio_qisai"
                       name="is_end" value="4"
                       onblur="qisai()"
                       <?php echo $one['is_end']==4?'checked':''; ?>>
                <label for="radio_qisai">弃赛</label>
        </td>

        <script type="text/javascript">
            function wirteScore1()
            {
                var a_win_num = document.getElementById('a_win_num').value;

                if(a_win_num.length != 0)
                {
                    $('#radio_qisai').attr("disabled",true);
                    document.getElementById("td_qisai").style.backgroundColor="silver";
                }
            }
            function wirteScore2()
            {
                var b_win_num = document.getElementById('b_win_num').value;
                if(b_win_num.length != 0)
                {
                    $('#radio_qisai').attr("disabled",true);
                    document.getElementById("td_qisai").style.backgroundColor="silver";
                }
            }
            function qisai()
            {
                $('#a_win_num').attr("disabled",true);
                $('#b_win_num').attr("disabled",true);
                document.getElementById("a_score_td").style.backgroundColor="silver";
                document.getElementById("b_score_td").style.backgroundColor="silver";
                document.getElementById("a_win_num").style.backgroundColor="silver";
                document.getElementById("b_win_num").style.backgroundColor="silver";
            }
        </script>
        <!--<input type="radio" id="radio-3" name="is_end" value="1"-->
        <!--<?php echo $one['is_end']==1?'checked':''; ?>-->
        <!--checked>-->
        <!--<label for="radio-3">未结束</label>-->
        <!--<span style="padding-right: 20px"></span>-->
        <!--<input type="radio" id="radio-4" name="is_end" value="3"-->
        <!--<?php echo $one['is_end']==3?'checked':''; ?>>-->
        <!--<label for="radio-4">已结束</label>-->

    </tr>

    <tr class="text-c">
        <td colspan="4">
            <div>
                <input hidden value="<?php echo $one['id']; ?>" name="id">
                <?php if(empty($one) || (($one instanceof \think\Collection || $one instanceof \think\Paginator ) && $one->isEmpty())): ?>
                    <input hidden value="<?php echo $bigGame_id; ?>" name="bigGame_id">
                    <input hidden value="<?php echo $phase_id; ?>" name="phase_id">
                <?php else: ?>
                    <input hidden value="<?php echo $one['bigGame_id']; ?>" name="bigGame_id">
                    <input hidden value="<?php echo $one['phase_id']; ?>" name="phase_id">
                <?php endif; ?>
                <!--<button type="button" class="btn btn-success radius size-XL" onclick="history.go(-1)"> < </button>-->
                <button onClick="removeIframe();" class="btn btn-success radius size-XL" type="button">&nbsp;&nbsp;<&nbsp;</button>
                <button type="submit" class="btn btn-primary radius size-XL">提交</button>
            </div>
        </td>
    </tr>

    </tbody>
</table>
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
        $('#add-game-live').validate({
            rules:{
               /* game_name:{
                    required:true,
                    minlength:2,
                    maxlength:16
                },*/
                /*countTimestart:{
                    required:true,
                },*/
                // analysis_type:{
                //     required:true,
                // },
                // is_end:{
                //     required:true,
                // },
                // play_a_id:{
                //     required:true,
                // },
                // play_b_id:{
                //     required:true
                // },
                /*isLive:{
                    required:true
                },*/
                /*liveUrl:{
                    required:true
                },*/
                a_win_num:{
                    digits:true
                },
                b_win_num:{
                    digits:true
                },
            },

            submitHandler:function(form)
            {
                var data = $(form).serialize();  //获取表单里的数据
                url = "<?php echo url('gameLive/live'); ?>";
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

/*输入关键词搜索球员或国家信息
* name:内容
* who:1指左边  2指右边
* */
function showResult(name,who)
{
    $.ajax({
        type:'get',
        url:'<?php echo url("gameLive/search"); ?>?name=' +name + "&who=" + who ,
        success:function(result)
        {
            //console.log(result)  //<li onclick="choice(this, 1)">中国</li><li onclick="choice(this, 1)">中美</li>
            if(who == '1')
            {
                $('#player_boxa').html(result);
            }else if(who == '2'){
                $('#player_boxb').html(result);
            }
        }
    },'JSON');
}

function choice(th,who)
{
    //alert($(th).text()+who);  选中时
    if(who == '1')
    {
        if($(th).text() == '暂时没有结果,请添加')
        {
            $('#play_a_id').val('');
        }else{
            $('#play_a_id').val($(th).text());
        }
        $('#player_boxa').html('');
        //$('#search_boxa').css('border','0px solid #ccc');
    }else if(who == '2')
    {
        if($(th).text()=='暂时没有结果,请添加')
        {
            $('#play_b_id').val('');
        }else{
            $('#play_b_id').val($(th).text());
        }
        $('#player_boxb').html('');
        //$('#search_boxa').css('border','0px solid #ccc');
    }
}

</script>
<!--<td>-->
<!--<strong><b>*</b>比赛名称:</strong>-->
<!--<input type="text" name="game_name" id="game_name"-->
<!--autocomplete="off"-->
<!--value="<?php echo $one['game_name']; ?>" placeholder="请输入比赛名" style="width:60%;height:40px" class="input-text radius size-XL">-->
<!--</td>-->
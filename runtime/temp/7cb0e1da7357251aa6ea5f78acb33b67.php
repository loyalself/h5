<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:71:"E:\laragon\www\h5\public/../application/taiqiu\view\game_live\live.html";i:1537955025;s:58:"E:\laragon\www\h5\application\taiqiu\view\public\meta.html";i:1537249833;s:60:"E:\laragon\www\h5\application\taiqiu\view\public\footer.html";i:1537249833;}*/ ?>
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
            <strong><b>*</b>比赛名称:</strong>
            <input type="text" name="game_name" id="game_name"
                   autocomplete="off"
                   value="<?php echo $one['game_name']; ?>" placeholder="请输入比赛名" style="width:60%;height:40px" class="input-text radius size-XL">
        </td>
        <td>
            <strong><b>*</b>比赛时间:</strong>

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
            <strong>有无直播源:</strong>
            <span class="select-box size-XL radius mt-10">
                    <select id="isLive" name="isLive" class="select" size="1">
                        <option value="">是否有直播源</option>
                        <option value="1" <?php echo $one['isLive']==1?'selected' : ''; ?>>有直播源</option>
                        <option value="3" <?php echo $one['isLive']==3?'selected' : ''; ?>>无直播源</option>
                    </select>
            </span>
        </td>
        <td>
            <strong><b>*</b>解析方式:</strong>
                <input type="radio" id="radio-1"
                       name="analysis_type" value="0" checked
                       <?php echo $one['analysis_type']==0?'checked':''; ?>>
                <label for="radio-1">点亮解析</label>
            <span style="padding-right: 20px"></span>
                <input type="radio" id="radio-2" name="analysis_type"
                       <?php echo $one['analysis_type']==1?'checked':''; ?>
                       value="1">
                <label for="radio-2">直接播放</label>
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
            <strong><b>*</b>A胜利局数:</strong>
            <input type="text"
                   name="a_win_num" id="a_win_num"
                   autocomplete="off"
                   value="<?php echo $one['a_win_num']; ?>" placeholder=""
                   style="width:60%;height:40px" class="input-text radius size-XL">
        </td>
        <td>
            <strong><b>*</b>B胜利局数:</strong>
            <input type="text"
                   name="b_win_num" id="b_win_num"
                   autocomplete="off"
                   value="<?php echo $one['b_win_num']; ?>" placeholder=""
                   style="width:60%;height:40px" class="input-text radius size-XL">
        </td>
    </tr>

    <tr class="text-c">
        <td>
            <strong style="text-align: center">直播间公告:</strong>
            <textarea name="live_notice" value="<?php echo $one['live_notice']; ?>"  class="radius" style="width:60%;height: 100px"></textarea>
        </td>

    </tr>

    <tr class="text-c ">
        <td>
            <strong><b>*</b>直播是否结束:</strong>
                <input type="radio" id="radio-3" name="is_end" value="1"
                       <?php echo $one['is_end']==1?'checked':''; ?>
                       checked>
                <label for="radio-3">未结束</label>
            <span style="padding-right: 20px"></span>
                <input type="radio" id="radio-4" name="is_end" value="3"
                       <?php echo $one['is_end']==3?'checked':''; ?>>
                <label for="radio-4">已结束</label>
            <span style="padding-right: 20px"></span>
                <input type="radio" id="radio-5" name="is_end" value="4"
                       <?php echo $one['is_end']==4?'checked':''; ?>>
                <label for="radio-5">弃赛</label>
        </td>

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
                game_name:{
                    required:true,
                    minlength:2,
                    maxlength:16
                },
                countTimestart:{
                    required:true,
                },
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
                isLive:{
                    required:true
                },
                liveUrl:{
                    required:true
                },
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
<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:63:"/www/h5/public/../application/ymq/view/game_live/live_list.html";i:1539504770;s:45:"/www/h5/application/ymq/view/public/meta.html";i:1537249833;s:47:"/www/h5/application/ymq/view/public/footer.html";i:1537249833;}*/ ?>
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

<nav class="breadcrumb">
    <i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span>阶段管理
    <span class="c-gray en">&gt;</span> 赛程列表
    <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" >
        <i class="Hui-iconfont">&#xe68f;</i>
    </a>
</nav>

<div class="page-container">
    <div class="text-c">
        <button onclick="removeIframe()" class="btn btn-primary radius">关闭选项卡</button>
        <input type="text" class="input-text" style="width:250px" placeholder="输入比赛名称" id="" name="">
        <button type="submit" class="btn btn-success" id="phasegame_name" name="phasegame_name">
            <i class="Hui-iconfont">&#xe665;</i> 搜索
        </button>
    </div>

    <div class="cl pd-5 bg-1 bk-gray mt-20">

			 <a class="btn btn-danger radius"
                data-title="添加比赛"
                data-href="<?php echo url('gameLive/live',['bigGame_id'=>$bigGame_id,'phase_id'=>$phase_id]); ?>"
                onclick="Hui_admin_tab(this)" href="javascript:;">
            <i class="Hui-iconfont">&#xe600;</i> 添加比赛
        </a>

			 <a class="btn btn-primary radius"
                onclick='' href="javascript:;">
            <i class="Hui-iconfont">&#xe600;</i> 开启全部竞猜
            </a>


    </div>

    <table class="table table-border table-bg">
        <thead>
        <tr class="text-c">
            <th width="40">场次编号</th>
            <th width="100">比赛名称</th>
            <th width="100">开始时间</th>
            <th width="100">是否有直播</th>
            <th width="100">对战人员</th>
            <th width="100">比分</th>
            <th width="100">胜利者</th>
            <th width="100">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
        <tr class="text-c">
            <td><?php echo $v['game_number']; ?></td>
            <td><?php echo $v['game_name']; ?></td>
            <td><?php echo date("Y-m-d H:i:s",$v['start_time']); ?></td>
            <td>
                <?php if($v['isLive'] == 1): ?>
                <span class="label label-success radius" style="font-size: 16px">有直播源</span>
                <?php elseif($v['isLive'] == 2): ?>
                <span class="label radius" style="font-size: 16px">无直播源</span>
                <?php endif; ?>
            </td>
            <td><?php echo $v['who_beat_who']; ?></td>
            <td><?php echo $v['a_win_num']; ?>/<?php echo $v['b_win_num']; ?></td>
            <td class="td-status"><?php echo $v['winner']; ?></td>
            <td class="td-manage">
              <!--  <a class="btn btn-primary radius"
                   data-title="编辑"
                   data-href="<?php echo url('gameLive/live',['id'=>$v['id']]); ?>"
                   onclick="Hui_admin_tab(this)" href="javascript:;">
                   修改
                </a>-->

                <a class="btn btn-primary radius"
                   onclick='xiugai_game("<?php echo url('gameLive/live',['id'=>$v['id']]); ?>")' href="javascript:;">
                    修改
                </a>

                <?php if($v['is_guess'] == 1): ?>
               <!-- <a class="btn btn-secondary radius"
                   href="javascript:;"
                   data-title="查看竞猜"
                   data-href="<?php echo url('guess/guessList',['game_id'=>$v['id']]); ?>"
                   onclick="Hui_admin_tab(this)" >
                    查看竞猜
                </a>-->

                <a class="btn btn-secondary radius"
                   href="javascript:;"
                   onclick='see_guess("<?php echo url('guess/guessList',['game_id'=>$v['id'],'game_number'=>$v['game_number']]); ?>")' >
                    查看竞猜
                </a>

                <?php elseif($v['is_guess'] == 0): ?>
               <!-- <a class="btn btn-default radius"
                   href="javascript:;"
                   data-title="添加竞猜"
                   data-href="<?php echo url('guess/guessList',['game_id'=>$v['id']]); ?>"
                   onclick="Hui_admin_tab(this)" >
                    添加竞猜
                </a>-->

                <a class="btn btn-default radius"
                   href="javascript:;"
                   onclick='add_guess("<?php echo url('guess/guess',['game_id'=>$v['id'],'game_number'=>$v['game_number']]); ?>")' >
                    添加竞猜
                </a>
                <?php endif; ?>

                <a class="btn btn-danger radius"
                   data-title="删除" href="javascript:;" onclick="del(this,'<?php echo $v['id']; ?>')" class="ml-5" >
                    删除
                </a>
            </td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
</div>
<!--_footer 作为公共模版分离出去-->
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/static/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/static/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/static/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/static/static/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="/static/admin/js/common.js"></script>

<!--引入uploadify上传的js文件-->
<script type="text/javascript" src="/static/admin/uploadify/jquery.uploadify.min.js"></script>
<script type="text/javascript" src="/static/admin/js/image.js"></script>



<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/static/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/static/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/static/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
    /*
        参数解释：
        title	标题
        url		请求的url
        id		需要操作的数据id
        w		弹出层宽度（缺省调默认值）
        h		弹出层高度（缺省调默认值）
    */

    /*添加竞猜*/
    function add_guess(url)
    {
        window.location.href = url;
    }
    /*查看竞猜*/
    function see_guess(url)
    {
        window.location.href = url;
    }
    function add_game(url)
    {
        window.location.href = url;
    }

    function xiugai_game(url)
    {
        window.location.href = url;
    }

    /*球员或国家-增加*/
    function add(title,url,w,h)
    {
        layer_show(title,url,w,h);
    }
    /*删除*/
    function del(obj,id)
    {
         // obj是当前链接接对象
        layer.confirm('确认要删除吗？',function(index)
        {
            $.ajax({
                type: 'POST',
                url: "<?php echo url('gameLive/del'); ?>",
                dataType: 'json',
                data:{'id':id},
                success: function(result)
                {
                    if(result.status == 1)
                    {
                        $(obj).parents("tr").remove();
                        layer.msg(result.msg,{icon:1,time:2000});
                    }else{
                        layer.msg(result.msg,{icon:5,time:2000});
                    }
                },
                error:function(result) {
                    console.log(result.msg);
                },
            });
        });
    }

    /*管理员-编辑*/
    function edit(title,url,id,w,h){
        layer_show(title,url,w,h);
    }
    /*管理员-修改密码*/
    function change_password(title,url,w,h){
        layer_show(title,url,w,h);
    }
    /*停用*/
    function changeStatus(id,value,field,message)
    {
        layer.confirm(message,function(index)
        {
            $.ajax({
                type:'post',
                url:"<?php echo url('sport/changeStatus'); ?>",
                data:{'id':id,'field':'status','value':value},
                success:function(result)
                {
                    if(typeof result === 'string')
                    {
                        result = jQuery.parseJSON(result);
                    }
                    if(result.status == 1){
                        layer.msg(result.msg,{icon: 1,time:1000});
                        setInterval("loadPage()",1200);
                    }else{
                        layer.msg(result.msg,{icon:5,time:1000});
                    }
                }
            });
        });
    }
    function loadPage() {
        location.reload();
    }

    /*管理员-启用*/
    // function admin_start(obj,id){
    //     layer.confirm('确认要启用吗？',function(index){
    //         //此处请求后台程序，下方是成功后的前台处理……
    //         $(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_stop(this,id)" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
    //         $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
    //         $(obj).remove();
    //         layer.msg('已启用!', {icon: 6,time:1000});
    //     });
    // }
</script>
</body>
</html>

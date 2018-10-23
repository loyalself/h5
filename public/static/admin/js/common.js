/**
 * 表单里的数据通过校验后 通过form表单提交的方法
 */
function add_save(form)
{
    var data = $(form).serialize();   //获取表单里的数据

    url = $(form).attr('url');        //这个attr里面的url没有打引号数据就不会填充成功,而且表单的提交方式变成了get请求

    //js ajax
    $.post(url,data,function(result)
    {
        if(result.code == 0)
        {
            layer.msg(result.msg,{icon:5,time:2000});   //layer弹出层
        }else if(result.code == 1)
        {
            layer.msg(result.msg,{icon:1,time:2000},function () {
                self.location = result.data.jump_url;
            });
        }

    },'JSON')
}

/**
 * 关于日期插件My97 DatePicker与Think php模版标签冲突的解决方法
 * @param flag
 */
function selecttime(flag)
{
    if(flag==1)
    {
        var endTime = $("#countTimeend").val();
        if(endTime != ""){
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm',maxDate:endTime})}else{
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})}
    }else{
        var startTime = $("#countTimestart").val();
        if(startTime != ""){
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm',minDate:startTime})}else{
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})}
    }
}

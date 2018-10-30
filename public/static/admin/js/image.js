$(function() {
    $("#file_upload").uploadify({
        swf           : swf,
        uploader      : image_upload_url,    //上传的链接
        buttonClass   : 'some-class',
        buttonText    : '请选择图片',
        fileTypeDesc  : 'Image files',
        fileObjName   : 'file',
        fileTypeExts  : '*.gif;*.jpg;*.png;*.jpeg',
        //这个data就是 uploader 链接响应的内容
        onUploadSuccess : function(file, data, response) {
            // 我们需要扩展内容
            if(response) {
                var obj = JSON.parse(data);
                console.log(obj)
                $('#upload_org_code_img').attr("src", obj.data);
                $('#file_upload_image').attr("value", obj.data);
                $('#upload_org_code_img').show();
            }
        }

    });
    $("#file_uploads").uploadify({
        swf           : swf,
        uploader      : image_upload_url,    //上传的链接
        buttonClass   : 'some-class',
        buttonText    : '请选择图片',
        fileTypeDesc  : 'Image files',
        fileObjName   : 'file',
        fileTypeExts  : '*.gif;*.jpg;*.png;*.jpeg',
        //这个data就是 uploader 链接响应的内容
        onUploadSuccess : function(file, data, response) {
            // 我们需要扩展内容
            if(response) {
                var obj = JSON.parse(data);
                console.log(obj)
                $('#upload_org_code_imgs').attr("src", obj.data);
                $('#file_upload_images').attr("value", obj.data);
                $('#upload_org_code_imgs').show();
            }
        }
    });
    $("#file_uploadsa").uploadify({
        swf           : swf,
        uploader      : image_upload_url,    //上传的链接
        buttonClass   : 'some-class',
        buttonText    : '请选择图片',
        fileTypeDesc  : 'Image files',
        fileObjName   : 'file',
        fileTypeExts  : '*.gif;*.jpg;*.png;*.jpeg',
        //这个data就是 uploader 链接响应的内容
        onUploadSuccess : function(file, data, response) {
            // 我们需要扩展内容
            if(response) {
                var obj = JSON.parse(data);
                console.log(obj)
                $('#upload_org_code_imgsa').attr("src", obj.data);
                $('#file_upload_imagesa').attr("value", obj.data);
                $('#upload_org_code_imgsa').show();
            }
        }
    });
    $("#file_uploadsv").uploadify({
        swf           : swf,
        uploader      : image_upload_url,    //上传的链接
        buttonClass   : 'some-class',
        buttonText    : '请选择图片',
        fileTypeDesc  : 'Image files',
        fileObjName   : 'file',
        fileTypeExts  : '*.gif;*.jpg;*.png;*.jpeg',
        //这个data就是 uploader 链接响应的内容
        onUploadSuccess : function(file, data, response) {
            // 我们需要扩展内容
            if(response) {
                var obj = JSON.parse(data);
                console.log(obj)
                $('#upload_org_code_imgsv').attr("src", obj.data);
                $('#file_upload_imagesv').attr("value", obj.data);
                $('#upload_org_code_imgsv').show();
            }
        }
    });

});
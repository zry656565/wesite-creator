/**
 * @author: Jerry Zou
 * @email: jerry.zry@outlook.com
 */

var $W = $W || {};

$W.pageInfo = {
    slides: [
        { assets: [] }
    ],
    currentPage: 1,
    currentAsset: 1
};

function errorHandle(err) {
    var errObj = JSON.parse(err.responseText);
    alert(errObj.message);
}

function uploadCallback(type, fileAttrName, successHandle) {
    var uploader;

    if (type === 'image') {
        uploader = $W.uploadImage;
    } else {
        uploader = $W.uploadMusic;
    }

    return function() {
        var form = new FormData();
        form.append("file", $('[name="'+ fileAttrName +'"]')[0].files[0]);
        form.append("policy", uploader.policy);
        form.append("signature", uploader.signature);
        $(this).html('正在上传');

        $.ajax({
            url: uploader.url,
            type: 'post',
            data: form,
            processData: false,
            contentType: false,
            success: successHandle,
            error: errorHandle
        });
    };

}

(function($){
    $(function(){
        $('.background-upload').click(
            uploadCallback('image', 'default-background', function(response){
                var bg,
                    $preview;

                response = JSON.parse(response);
                bg = 'http://women-image.b0.upaiyun.com' + response.url;
                $W.pageInfo.defaultBackground = bg;

                if (!($W.pageInfo.slides[$W.currentPage] && $W.pageInfo.slides[$W.currentPage].background)) {
                    $preview = $('.iphone');
                    if ($preview.find('.background').length === 0) {
                        $preview.append('<img class="background" src="' + bg + '"/>');
                    } else {
                        $preview.find('.background').attr('src', bg);
                    }
                }

                $('.background-upload + .help-block').html('已上传背景：' + $W.pageInfo.defaultBackground);
                $('.background-upload').html('重新上传');
            })
        );

        $('#slide-background-upload').click(
            uploadCallback('image', 'slide-background', function(response){
                var bg,
                    $preview;

                response = JSON.parse(response);
                bg = 'http://women-image.b0.upaiyun.com' + response.url;
                $W.pageInfo.slides[$W.currentPage] = $W.pageInfo.slides[$W.currentPage] || {};
                $W.pageInfo.slides[$W.currentPage].background = bg;

                $preview = $('.iphone');
                if ($preview.find('.background').length === 0) {
                    $preview.append('<img class="background" src="' + bg + '"/>');
                } else {
                    $preview.find('.background').attr('src', bg);
                }
                $('#slide-background-upload + .help-block').html('已上传背景：' + bg);
                $('#slide-background-upload').html('重新上传');
            })
        );

        $('#asset-upload').click(
            uploadCallback('image', 'asset-src', function(response){
                var bg,
                    $preview;

                response = JSON.parse(response);
                bg = 'http://women-image.b0.upaiyun.com' + response.url;
                $W.pageInfo.slides[$W.currentPage] = $W.pageInfo.slides[$W.currentPage] || {};
                $W.pageInfo.slides[$W.currentPage].background = bg;

                $preview = $('.iphone');
                if ($preview.find('.background').length === 0) {
                    $preview.append('<img class="background" src="' + bg + '"/>');
                } else {
                    $preview.find('.background').attr('src', bg);
                }
                $('#asset-upload + .help-block').html('已上传背景：' + bg);
                $('#asset-upload').html('重新上传');
            })
        );

        $('.music-upload').click(
            uploadCallback('music', 'bgm', function(response){
                response = JSON.parse(response);
                $W.pageInfo.bgm = 'http://women-music.b0.upaiyun.com' + response.url;
                $('.music-upload + .help-block').html('已上传音乐：' + $W.pageInfo.bgm);
                $('.music-upload').html('重新上传');
            })
        );

        var disable = false;
        $('.btn.post').click(function() {
            if (disable) return;

            if (!$W.pageInfo.title) {
                alert('请填写本页面的标题');
                return;
            }

            disable = true;
            $W.pageInfo.title = $('[name=title]').val();
            $W.pageInfo.description = $('[name=description]').val();
            $W.pageInfo.slides[0].assets[0].width = $('[name=asset-width]').val();
            $W.pageInfo.slides[0].assets[0].height = $('[name=asset-height]').val();
            $W.pageInfo.slides[0].assets[0].left = $('[name=asset-left]').val();
            $W.pageInfo.slides[0].assets[0].top = $('[name=asset-top]').val();
            $.ajax({
                url: 'handler.php',
                type: 'post',
                data: $W.pageInfo,
                success: function(result) {
                    disable = false;
                    window.location.href = "/";
                },
                error: function(result) {
                    alert('与服务器通信时发生错误。');
                    disable = false;
                }
            });
        });
    });
}(jQuery));
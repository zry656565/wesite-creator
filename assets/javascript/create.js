/**
 * @author: Jerry Zou
 * @email: jerry.zry@outlook.com
 */

var $W = $W || {};

currentPage = 1;
$W.pageInfo = {
    pages: [{}]
};

(function($){
    $(function(){
        $('[name="title"]').focusout(function() {
            $W.pageInfo.title = $(this).val();
        });
        $('[name="description"]').focusout(function() {
            $W.pageInfo.description = $(this).val();
        });

        function errorHandle(err) {
            var errObj = JSON.parse(err.responseText);
            alert(errObj.message);
        }

        $('.background-upload').click(function() {
            var form = new FormData();
            form.append("file", $('[name="default-background"]')[0].files[0]);
            form.append("policy", $W.uploadImage.policy);
            form.append("signature", $W.uploadImage.signature);
            $(this).html('正在上传');

            $.ajax({
                url: $W.uploadImage.url,
                type: 'post',
                data: form,
                processData: false,
                contentType: false,
                success: function (response) {
                    var bg,
                        $preview;

                    response = JSON.parse(response);
                    bg = 'http://women-image.b0.upaiyun.com' + response.url;
                    $W.pageInfo.defaultBackground = bg;

                    if (!($W.pageInfo.pages[currentPage] && $W.pageInfo.pages[currentPage].background)) {
                        $preview = $('.iphone');
                        if ($preview.find('.background').length === 0) {
                            $preview.append('<img class="background" src="' + bg + '"/>');
                        } else {
                            $preview.find('.background').attr('src', bg);
                        }
                    }

                    $('.background-upload + .help-block').html('已上传背景：' + $W.pageInfo.defaultBackground);
                    $('.background-upload').html('重新上传');
                },
                error: errorHandle
            });
        });

        $('#slide-background-upload').click(function() {
            var form = new FormData();
            form.append("file", $('[name="slide-background"]')[0].files[0]);
            form.append("policy", $W.uploadImage.policy);
            form.append("signature", $W.uploadImage.signature);
            $(this).html('正在上传');

            $.ajax({
                url: $W.uploadImage.url,
                type: 'post',
                data: form,
                processData: false,
                contentType: false,
                success: function (response) {
                    var bg,
                        $preview;

                    response = JSON.parse(response);
                    bg = 'http://women-image.b0.upaiyun.com' + response.url;
                    $W.pageInfo.pages[currentPage] = $W.pageInfo.pages[currentPage] || {};
                    $W.pageInfo.pages[currentPage].background = bg;

                    $preview = $('.iphone');
                    if ($preview.find('.background').length === 0) {
                        $preview.append('<img class="background" src="' + bg + '"/>');
                    } else {
                        $preview.find('.background').attr('src', bg);
                    }
                    $('#slide-background-upload + .help-block').html('已上传背景：' + bg);
                    $('#slide-background-upload').html('重新上传');
                },
                error: errorHandle
            });
        });

        $('.music-upload').click(function() {
            var form = new FormData();
            form.append("file", $('[name="bgm"]')[0].files[0]);
            form.append("policy", $W.uploadMusic.policy);
            form.append("signature", $W.uploadMusic.signature);
            $(this).html('正在上传');

            $.ajax({
                url: $W.uploadMusic.url,
                type: 'post',
                data: form,
                processData: false,
                contentType: false,
                success: function (response) {
                    response = JSON.parse(response);
                    $W.pageInfo.bgm = 'http://women-music.b0.upaiyun.com' + response.url;
                    $('.music-upload + .help-block').html('已上传音乐：' + $W.pageInfo.bgm);
                    $('.music-upload').html('重新上传');
                },
                error: errorHandle
            });
        });

        var disable = false;
        $('.btn.post').click(function() {
            if (disable) return;

            if (!$W.pageInfo.title) {
                alert('请填写本页面的标题');
                return;
            }

            disable = true;
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
/**
 * @author: Jerry Zou
 * @email: jerry.zry@outlook.com
 */

var $W = $W || {};

//$W.storage = {
//    get: function(key) {
//        return JSON.parse(localStorage.getItem(key));
//    },
//    set: function(key, value) {
//        return localStorage.setItem(key, JSON.stringify(value));
//    },
//    clear: function(props) {
//        if (Object.prototype.toString.call(props) === '[object Array]') {
//            for (var i = 0; i < props.length; i++) {
//                localStorage.removeItem(props[i]);
//            }
//        } else if (props.toString() === props) {
//            localStorage.removeItem(props);
//        }
//    }
//};

$W.pageInfo = {};

(function($){
    $(function(){
        $('[name="title"]').focusout(function() {
            $W.pageInfo.title = $(this).val();
        });
        $('[name="description"]').focusout(function() {
            $W.pageInfo.description = $(this).val();
        });
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
                    response = JSON.parse(response);
                    $W.pageInfo.defaultBackground = 'http://women-image.b0.upaiyun.com/' + response.url;
                    $('.iphone').append('<img class="background" src="' + $W.pageInfo.defaultBackground + '"/>');
                    $('.background-upload + .help-block').html('上传成功');
                    setTimeout(function(){
                        $('.background-upload + .help-block').html('请上传宽高比为2:3左右的背景图片');
                    }, 3000);
                    $('.background-upload').html('重新上传');
                },
                error: function () {
                    alert('ERROR: cannot connect to server');
                }
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
                    $W.pageInfo.bgm = 'http://women-music.b0.upaiyun.com/' + response.url;
                    $('.music-upload + .help-block').html('上传成功');
                    setTimeout(function(){
                        $('.music-upload + .help-block').html('为了让用户更快地加载出页面，请截取并压缩好背景音乐后再上传');
                    }, 3000);
                    $('.music-upload').html('重新上传');
                },
                error: function () {
                    alert('ERROR: cannot connect to server');
                }
            });
        });
    });
}(jQuery));
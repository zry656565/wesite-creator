/**
 * @author: Jerry Zou
 * @email: jerry.zry@outlook.com
 */

var $W = $W || {};

$W.pageInfo = {
    slides: [
        {
            background: null,
            assets: []
        }
    ],
    defaultBackground: null,
    currentSlide: 0,
    currentAsset: 0,
    pushAsset: function(asset) { this.slides[this.currentSlide].assets.push(asset); },
    saveAsset: function() {
        var asset = this.getCurrentAsset();
        if (asset) {
            asset.width = $('input[name="asset-width"]').val();
            asset.height = $('input[name="asset-height"]').val();
            asset.top = $('input[name="asset-top"]').val();
            asset.left = $('input[name="asset-left"]').val();
        }
    },
    getCurrentAsset: function() { return this.slides[this.currentSlide].assets[this.currentAsset]; },
    getAssets: function() { return this.slides[this.currentSlide].assets; },
    setBackground: function(bg, isSlideBackground) {
        var currentSlide = this.slides[this.currentSlide],
            $preview;

        if (isSlideBackground) {
            if (!currentSlide) {
                currentSlide = this.slides[this.currentSlide] = {
                    background: null,
                    assets: []
                };
            }
            currentSlide.background = bg;
        } else if (isSlideBackground) {
            this.defaultBackground = bg;
        }

        //refresh DOM
        if (isSlideBackground || !(currentSlide && currentSlide.background)) {
            $preview = $('.iphone');
            if ($preview.find('.background').length === 0) {
                $preview.append('<img class="background" src="' + bg + '"/>');
            } else {
                $preview.find('.background').attr('src', bg);
            }
        }
    },
    getBackground: function() {
        var currentSlide = this.slides[this.currentSlide];
        return (currentSlide && currentSlide.background) || this.defaultBackground;
    },
    refresh: function() {
        var self = $W.pageInfo,
            $preview = $('.iphone'),
            bg = self.getBackground(),
            assets = self.getAssets();

        self.saveAsset();
        $preview.empty();
        for (var i = 0; i < assets.length; i++) {
            $preview.append('<img class="sub" src="' + assets[i].src + '" style="' +
            'width:' + assets[i].width + '%;' +
            'height:' + assets[i].height + '%;' +
            'top:' + assets[i].top + '%;' +
            'left:' + assets[i].left + '%;"/>');
        }
        $preview.append('<img class="background" src="' + bg + '"/>');
    }
};

(function($){
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

    $(function(){
        $('.background-upload').click(
            uploadCallback('image', 'default-background', function(response){
                response = JSON.parse(response);
                var bg = 'http://women-image.b0.upaiyun.com' + response.url;
                $W.pageInfo.setBackground(bg);
                $('.background-upload + .help-block').html('已上传背景：' + bg);
                $('.background-upload').html('重新上传');
            })
        );

        $('#slide-background-upload').click(
            uploadCallback('image', 'slide-background', function(response){
                response = JSON.parse(response);
                var bg = 'http://women-image.b0.upaiyun.com' + response.url;
                $W.pageInfo.setBackground(bg, true);
                $('#slide-background-upload + .help-block').html('已上传背景：' + bg);
                $('#slide-background-upload').html('重新上传');
            })
        );

        $('#asset-upload').click(
            uploadCallback('image', 'asset-src', function(response){
                response = JSON.parse(response);
                var imgUrl = 'http://women-image.b0.upaiyun.com' + response.url;
                $W.pageInfo.pushAsset({
                    src: imgUrl
                });
                $('#asset-upload + .help-block').html('已上传资源图片：' + imgUrl);
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

        $('.btn.refresh').click($W.pageInfo.refresh);

        // 发布/保存页面
        var disable = false;
        $('.btn.post').click(function() {
            if (disable) return;

            var title = $('input[name=title]').val();

            if (!title) {
                alert('请填写本页面的标题');
                return;
            }

            disable = true;
            $.ajax({
                url: 'handler.php',
                type: 'post',
                data: {
                    title: title,
                    description: $('input[name=description]').val(),
                    slides: $W.pageInfo.slides,
                    defaultBackground: $W.pageInfo.defaultBackground,
                    bgm: $W.pageInfo.bgm
                },
                success: function(result) {
                    disable = false;
                    //window.location.href = "/";
                },
                error: function(result) {
                    alert('与服务器通信时发生错误。');
                    disable = false;
                }
            });
        });
    });
}(jQuery));
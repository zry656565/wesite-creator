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
    removedSlides: [],
    removedAssets: [],
    // method of slide
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
        } else {
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
    resetDeleteBtn: function() {
        if ($('.nav-slides').find('[data-slide-id]').length <= 1) {
            $('.btn.delete-slide').hide();
        } else {
            $('.btn.delete-slide').show();
        }
        if ($('.nav-assets').find('[data-asset-id]').length <= 1) {
            $('.btn.delete-asset').hide();
        } else {
            $('.btn.delete-asset').show();
        }
    },
    clearSlide: function() {
        $('[name="slide-background"]').val('');
        $('[name="slide-link"]').val('');
        $('.slide-bg.help-block').html('');
    },
    switchSlide: function() {
        var self = $W.pageInfo,
            $this = $(this),
            id = parseInt($this.attr('data-slide-id'), 10) - 1;

        if ($this.hasClass('active')) {
            return;
        }

        self.saveAsset();
        self.slides[self.currentSlide].link = $('[name="slide-link"]').val();
        self.changeSlide($this);
    },
    changeSlide: function($this) {
        var self = $W.pageInfo,
            id;

        if ($this.timeStamp > 0) { //it's a event object
            $this = $(this);
        }
        id = parseInt($this.attr('data-slide-id'), 10) - 1;

        self.clearAsset();
        self.currentAsset = 0;
        self.currentSlide = id;
        $('.nav-slides .active').removeClass('active');
        $('.nav-slides [data-slide-id="'+ (id + 1) +'"]').addClass('active');
        if (self.slides[id].background) {
            $('.slide-bg.help-block').html('已上传本页背景：' + self.slides[id].background);
        } else {
            $('.slide-bg.help-block').html('');
        }
        $('[name="slide-link"]').val(self.slides[id].link);
        $('.nav-assets').html('<li class="active" data-asset-id="1"><a>A1</a></li>');
        for (var i = 2; i <= self.slides[id].assets.length; i++) {
            $('.nav-assets').append('<li data-asset-id="'+ i +'"><a>A'+ i +'</a></li>');
        }
        $('.nav-assets').append('<li class="add"><a id="add-asset">+</a></li>');
        self.bindAssetBtnEvent();
        self.resetDeleteBtn();
        self.showAsset();
        self.refresh();
    },
    removeSlide: function() {
        var self = $W.pageInfo,
            curSlide = self.slides[self.currentSlide],
            $nav = $('.nav-slides'),
            i;

        if (curSlide.id) {
            self.removedSlides.push(curSlide.id);
        }

        for (i = self.currentSlide; i < self.slides.length - 1; i++) {
            var tmp = self.slides[i];
            self.slides[i] = self.slides[i+1];
            self.slides[i+1] = tmp;
        }
        self.slides.pop();
        self.currentSlide += (self.currentSlide >= self.slides.length ?  -1 : 0);

        //Modify DOM
        $nav.find('[data-slide-id]').remove();
        for (i = self.slides.length; i > 0; i--) {
            $nav.prepend('<li data-slide-id="' + i + '"><a>P' + i  + '</a></li>');
        }
        $('.nav-slides li').not('.add').click($W.pageInfo.changeSlide);
        $nav.find('[data-slide-id="' + (self.currentSlide + 1) + '"]').click();
    },
    // method of asset
    bindAssetBtnEvent: function() {
        var self = $W.pageInfo;
        $('#add-asset').click(function() {
            var asset = self.getCurrentAsset();
            if (!asset) {
                alert('请将当前资源上传后，再创建下一个资源');
                return;
            }
            self.clearAsset();
            $('.nav-assets .active').removeClass('active');
            self.currentAsset = self.getAssets().length;
            $('.nav-assets li:last-child').before('<li class="active" data-asset-id="'+ (self.currentAsset + 1) +'">' +
            '<a>A'+ (self.currentAsset + 1) +'</a></li>');
            $('.nav-assets .active').click(self.changeAsset);
        });

        $('.nav-assets li').not('.add').click(self.changeAsset);
    },
    pushAsset: function(asset) { this.slides[this.currentSlide].assets.push(asset); },
    saveAsset: function() {
        var asset = this.getCurrentAsset();
        if (asset) {
            asset.width = $('input[name="asset-width"]').val();
            asset.height = $('input[name="asset-height"]').val();
            asset.top = $('input[name="asset-top"]').val();
            asset.left = $('input[name="asset-left"]').val();
            asset.order = $('input[name="asset-order"]').val();
        }
    },
    getCurrentAsset: function() { return this.slides[this.currentSlide].assets[this.currentAsset]; },
    getAssets: function() { return this.slides[this.currentSlide].assets; },
    clearAsset: function() {
        $('[name|="asset"]').val('');
        $('.asset.help-block').empty();
    },
    showAsset: function() {
        var current = $W.pageInfo.getCurrentAsset();
        if (current) {
            $('[name="asset-width"]').val(current.width);
            $('[name="asset-height"]').val(current.height);
            $('[name="asset-left"]').val(current.left);
            $('[name="asset-top"]').val(current.top);
            $('[name="asset-order"]').val(current.order);
            $('.asset.help-block').html('已上传资源图片：' + current.src);
        }
    },
    changeAsset: function() {
        var self = $W.pageInfo,
            $this = $(this),
            id = parseInt($this.attr('data-asset-id'), 10) - 1,
            asset = self.getCurrentAsset();

        if ($this.hasClass('active')) {
            return;
        } else if (!asset) {
            alert('请将当前资源上传后，再跳转到别的页面');
            return;
        }

        self.refresh();
        self.clearAsset();
        $('.nav-assets .active').removeClass('active');
        self.currentAsset = id;
        $('.nav-assets [data-asset-id="'+ (id + 1) +'"]').addClass('active');
        self.showAsset();
    },
    removeAsset: function() {},
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

        $('#add-slide').click(function() {
            var W = $W.pageInfo;

            W.clearSlide();
            W.clearAsset();
            W.currentSlide = W.slides.length;
            W.slides.push({
                background: null,
                assets: []
            });
            W.refresh();

            $('.nav-slides .active').removeClass('active');
            $('.nav-assets').html('<li class="active" data-asset-id="1"><a>A1</a></li>' +
                '<li class="add"><a id="add-asset">+</a></li>');
            $('.nav-slides li:last-child').before('<li class="active" data-slide-id="'+ (W.currentSlide + 1) +'">' +
            '<a>P'+ (W.currentSlide + 1) +'</a></li>');
            $('.nav-slides .active').click($W.pageInfo.switchSlide);

            self.resetDeleteBtn();
        });

        $('.nav-slides li').not('.add').click($W.pageInfo.switchSlide);

        $W.pageInfo.bindAssetBtnEvent();

        $('.btn.delete-slide').click($W.pageInfo.removeSlide);
        $('.btn.delete-asset').click($W.pageInfo.removeAsset);
        $('.btn.refresh').click($W.pageInfo.refresh);
        $W.pageInfo.resetDeleteBtn();

        // 发布/保存页面
        var disable = false;
        $('.btn.post').click(function() {
            if (disable) return;

            var title = $('input[name=title]').val();
            $W.pageInfo.saveAsset();

            if (!title) {
                alert('请填写本页面的标题');
                return;
            }

            disable = true;
            $W.pageInfo.slides[$W.pageInfo.currentSlide].link = $('[name="slide-link"]').val();
            $.ajax({
                url: 'handler.php',
                type: 'post',
                data: {
                    id: $W.pageInfo.id,
                    title: title,
                    description: $('input[name=description]').val(),
                    slides: $W.pageInfo.slides,
                    bg: $W.pageInfo.defaultBackground,
                    bgm: $W.pageInfo.bgm,
                    removedSlides: $W.pageInfo.removedSlides,
                    removedAssets: $W.pageInfo.removedAssets
                },
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
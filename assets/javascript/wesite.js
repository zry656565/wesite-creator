/**
 * @author: Jerry Zou
 * @email: jerry.zry@outlook.com
 */

$(function(){
    //initialize spinner
    var opts = {
        lines: 7, // The number of lines to draw
        length: 0, // The length of each line
        width: 9, // The line thickness
        radius: 10, // The radius of the inner circle
        corners: 1, // Corner roundness (0..1)
        rotate: 0, // The rotation offset
        direction: 1, // 1: clockwise, -1: counterclockwise
        color: '#000', // #rgb or #rrggbb or array of colors
        speed: 1.4, // Rounds per second
        trail: 38, // Afterglow percentage
        shadow: true, // Whether to render a shadow
        hwaccel: false, // Whether to use hardware acceleration
        className: 'spinner', // The CSS class to assign to the spinner
        zIndex: 2e9, // The z-index (defaults to 2000000000)
        top: '50%', // Top position relative to parent
        left: '50%' // Left position relative to parent
    };
    var target = document.getElementById('spinner');
    var spinner = new Spinner(opts).spin(target);
    var animates = function(id) {
        var assets = $('[data-id="' + id + '"] .sub');
        assets = Array.prototype.filter.call(assets, function(a) {
            return parseInt($(a).attr('data-order'), 10) > 0;
        });
        Array.prototype.sort.call(assets, function(a, b) {
            return parseInt($(a).attr('data-order'), 10) - parseInt($(b).attr('data-order'), 10);
        });

        if (assets.length > 0) {
            var i = 0,
                animate = function() {
                    $.Velocity
                        .animate($(assets).eq(i), { opacity: 1 }, 1200)
                        .then(callback);
                    while ($(assets).eq(i).attr('data-order') === $(assets).eq(i+1).attr('data-order')) {
                        $(assets).eq(i+1).velocity({ opacity: 1 }, 1200);
                        i++;
                    }
                },
                callback = function(){
                    if (++i < assets.length) {
                        animate();
                    }
                };

            animate();
        }
    };
    var h = $(window).height(),
        w = $(window).width(),
        $canvas = $('.blur')
            .attr('width', w)
            .attr('height', h),

        wiper = function(id) {
            var $blurBg = $('.blur-bg[data-id="'+ id +'"]');
            if ($blurBg.length === 0) {
                return false;
            }
            var ctx = $canvas[0].getContext('2d'),
                img = new Image();

            img.src = $blurBg.attr('src');
            img.onload = function(){
                ctx.drawImage(img, 0, 0, w, h);
                $('.blur-bg[data-id="'+ id +'"]').hide();
                function clearCircle(x, y) {
                    ctx.save();
                    ctx.beginPath();
                    ctx.arc(x, y, 20, 0, 2*Math.PI, true);
                    ctx.clip();
                    ctx.clearRect(0, 0, w, h);
                    ctx.restore();
                }
                $canvas.bind('touchmove', function(e) {
                    e.preventDefault();
                    var event = e.originalEvent;
                    clearCircle(event.pageX, event.pageY);
                });
            };
            return true;
        },
        changedPage = function(id) {
            if (!wiper(id)) animates(id);
        };

    var mySwiper = $('.swiper-container').swiper({
        mode:'vertical',
        loop: true,
        onImagesReady: function(swiper) {
            $('#loading-hover').hide();
            $('#spinner').hide();

            //play music
            var music = $("#music")[0];
            var play = function() {
                if (music.paused) {
                    music.play();
                }
                $('body').unbind('touchstart');
            };
            play();
            $('body').on('touchstart', play);

            //bind play / pause event
            $('.music-icon').on('touchend', function() {
                if (music.paused) {
                    $('.music-icon').css('opacity', 1);
                    music.play();
                } else {
                    $('.music-icon').css('opacity', 0.5);
                    music.pause();
                }
            });
            changedPage(1);
        },
        onSlideChangeEnd: function(swiper) {
            changedPage(swiper.activeIndex);
        }
    });
});
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
            $('[data-id="1"] .sub').velocity({ opacity: 1 }, 1200);
            $('.fancybox-link').fancybox();
        },
        onSlideChangeEnd: function(swiper) {
            var id = swiper.activeIndex;
            $('[data-id="' + id + '"] .sub').velocity({ opacity: 1 }, 1200);
        }
    });
});
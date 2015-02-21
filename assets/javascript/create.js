/**
 * @author: Jerry Zou
 * @email: jerry.zry@outlook.com
 */

var $W = $W || {};

$W.storage = {
    get: function(key) {
        return JSON.parse(localStorage.getItem(key));
    },
    set: function(key, value) {
        return localStorage.setItem(key, JSON.stringify(value));
    },
    clear: function(props) {
        if (Object.prototype.toString.call(props) === '[object Array]') {
            for (var i = 0; i < props.length; i++) {
                localStorage.removeItem(props[i]);
            }
        } else if (props.toString() === props) {
            localStorage.removeItem(props);
        }
    }
};

(function($){
    $(function(){
        $('.background-upload').click(function() {
            var form = new FormData();
            form.append("file", $('[name="default-background"]')[0].files[0]);
            form.append("policy", $W.uploadImage.policy);
            form.append("signature", $W.uploadImage.signature);

            $.ajax({
                url: $W.uploadImage.url,
                type: 'post',
                data: form,
                processData: false,
                contentType: false,
                success: function (response) {
                    response = JSON.parse(response);
                    var fileUrl = response.url;
                    console.log(fileUrl);
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

            $.ajax({
                url: $W.uploadMusic.url,
                type: 'post',
                data: form,
                processData: false,
                contentType: false,
                success: function (response) {
                    response = JSON.parse(response);
                    var fileUrl = response.url;
                    console.log(fileUrl);
                },
                error: function () {
                    alert('ERROR: cannot connect to server');
                }
            });
        });
    });
}(jQuery));
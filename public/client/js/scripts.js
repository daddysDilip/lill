$(document).ready(function () {
    // console.log("------------------->", <?php var_dump(Auth::guard('user')->user()->id);?>);
    var my_check = typeof is_home !== 'undefined';
    console.log("----------is_home--------->", typeof is_home !== 'undefined');
    if(my_check == false)
    {
        $.ajax({
            type: "GET",
            url: "/get-unread-notification",
            data: {
                '_token': "{{csrf_token()}}"
            },
            success: function (data) {
                $('#notification-dropdown').html("");
                if (data.status == 200) {
                    $('#notification-dropdown').html(data.result);
                } else if (data.status == 204) {
                    $('#notification-dropdown').html(data.result);
                }
            },
            error: function () {
                $("#overlay").fadeOut(300);
            }
        }).done(function () {
            $("#overlay").fadeOut(300);
        });

    }
    
    var clipboard = new ClipboardJS('.btn-copy');
    clipboard.on('success', function (e) {
        $('.btn-copy').html('Copied!');
        setTimeout(function () {
            $('.btn-copy').html('Copy').fadeIn('slow');
        }, 1000)
        //$(".btn-copy").removeClass("btn-copy");
    });

    $('#client_website_url').keyup(function () {
        
        var pattern = /(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]/g;
        var url = $(this).val();

        if (!url.indexOf('http://') === 0 || !url.indexOf('https://') === 0) {
            url = "http://" + url;
        }

        if (pattern.test($(this).val())) {
            $('#client-url-one-error-msg').html("");
            $('.btn-shorten-url-one').prop("disabled", false);
        } else {
            $('#client-url-one-error-msg').html("Invalid URL.");
            $('.btn-shorten-url-one').prop("disabled", true);
        }

    });

    $('#client_website_url_two').keyup(function () {
        var pattern = /(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]/g;
        var url = $(this).val();

        if (!url.indexOf('http://') === 0 || !url.indexOf('https://') === 0) {
            url = "http://" + url;
        }

        if (pattern.test($(this).val())) {
            $('#client-url-two-error-msg').html("");
            $('.btn-shorten-url-two').prop("disabled", false);
        } else {
            $('#client-url-two-error-msg').html("Invalid URL.");
            $('.btn-shorten-url-two').prop("disabled", true);
        }
    });

    function shareFB(short_link) {
        var facebookWindow = window.open('https://www.facebook.com/sharer/sharer.php?u=' + short_link, 'facebook-popup', 'height=350,width=600');
        if (facebookWindow.focus) { facebookWindow.focus(); }
        return false;
    }

    function shareTwitter(short_link, referer) {
        var twitterWindow = window.open('https://twitter.com/intent/tweet?url=' + short_link + '&text=' + short_link + '&original_referer=' + referer + ',Flinks,share');
        if (twitterWindow.focus) { twitterWindow.focus(); }
        return false;
    }

    function shareLinkedin(short_link, link_title, website_url) {
        var linkedinWindow = window.open('https://www.linkedin.com/shareArticle?mini=true&url=' + short_link + '&title=' + link_title + '&summary=' + link_title + '&source=' + website_url);
        if (linkedinWindow.focus) { linkedinWindow.focus(); }
        return false;
    }

    function shareMail(short_link, link_title) {
        var mailWindow = window.open('mailto:?subject=Sharing You Short Link&body=' + link_title + encodeURIComponent('\r\n') + short_link);
        if (mailWindow.focus) { mailWindow.focus(); }
        return false;
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $(".img_file").change(function () {
        readURL(this);
    });

});
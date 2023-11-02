(function($) {
    var $validator = $("#g2hr-user-login-form").validate({
        "rules": {
            "user_email": {
                required: true,
                email: false
            },
            "user_password": {
                required: true
            }
        }
    });


    $("#btn-g2hr-user-login").on("click", function(e) {
        e.preventDefault();

        var $valid = $("#g2hr-user-login-form").valid();
        if (!$valid) {
             $validator.focusInvalid();
            return false;
        }

        let user_email = $("#user_email").val();
        let user_pass = $("#user_password").val();

        $(".g2hr-error-message-box").fadeOut("active");

        $.post(g2hr_user_login_object.ajax_url, {
            "data": {
                "user_email": user_email,
                "user_pass": user_pass
            },
            "action": "g2hruserlogin",
            "nonce": g2hr_user_login_object.nonce
        }, function(response) {
            window.location.href = response.data.redirect_url;
            return;
        })
        .fail(function(xhr, status, error) {
            var obj = jQuery.parseJSON(xhr.responseText);
            $(".g2hr-error-message-box").empty().html(obj.data);
            $(".g2hr-error-message-box").addClass("active").fadeIn();

            return;
        });

    });

})(jQuery);

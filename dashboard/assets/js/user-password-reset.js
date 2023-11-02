(function($) {
    var $validator = $("#g2hr-user-psw-reset-form").validate({
        "rules": {
            "user_email": {
                required: true,
                email: true
            }
        }
    });

    var $cvalidator = $("#g2hr-user-psw-change-form").validate({
        "rules": {
            "pass1": {
                required: true
            },
            "pass2": {
                required: true,
                equalTo: "#pass1"
            }
        }
    });

    /**
     * Handle the Password Reset form
     */
    $("#g2hr-password-reset-start").on("click", function(e) {
        e.preventDefault();

        var $valid = $("#g2hr-user-psw-reset-form").valid();
        if (!$valid) {
            $validator.focusInvalid();
            return false;
        }

        $.post(g2hr_user_psw_reset_object.ajax_url, {
            "user_login": $("[name='user_email']").val(),
            "action": "g2hruserpswreset",
            "nonce": g2hr_user_psw_reset_object.nonce
        }, function(response) {
            window.location.href = g2hr_user_psw_reset_object.redirect_url;
            return;
        })
        .fail(function(xhr, status, error) {
            var obj = jQuery.parseJSON(xhr.responseText);
            $(".g2hr-error-message-box").empty().html(obj.data);
            $(".g2hr-error-message-box").addClass("active").fadeIn();
        });
    });

    /**
     * Handle the Password Change form
     */
    $("#g2hr-password-reset-end").on("click", function(e) {
        e.preventDefault();

        console.log("aaa");
        var $valid = $("#g2hr-user-psw-change-form").valid();
        if (!$valid) {
            $cvalidator.focusInvalid();
            return false;
        }

        console.log($("[name='user_email']").val());

        $.post(g2hr_user_psw_change_object.ajax_url, {
            "data": {
                "user_login": $("[name='user_email']").val(),
                "pass1": $("[name='pass1']").val(),
                "pass2": $("[name='pass2']").val(),
            },
            "action": "g2hruserpswchange",
            "nonce": g2hr_user_psw_change_object.nonce
        }, function(response) {
            window.location.href = g2hr_user_psw_change_object.redirect_url;
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

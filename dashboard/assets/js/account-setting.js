(function($) {
    $.validator.addMethod("valueNotEquals", function(value, element, arg){
        return arg !== value;
    }, "This field is required.");

    var $validator = $("#g2hr-account-setting-form").validate({
        "rules": {
            "user_email": {
                required: true,
                email: true
            },
            "password": {
                minlength: 6
            }
        }
    });

    $("#g2hr-update-account-setting").on("click", function(e) {
        e.preventDefault();

        let $valid = $("#g2hr-account-setting-form").valid();
        if (!$valid) {
            $validator.focusInvalid();
            return false;
        }

        $(".g2hr-success-message-box").fadeOut();
        $(".g2hr-error-message-box").fadeOut();

        $.post(g2hr_account_setting_object.ajax_url, {
            "data": {
                "username": $("[name='username']").val(),
                "email": $("[name='user_email']").val(),
                "newsletter": $("[name='newsletter']").prop("checked") ? $("[name='newsletter']").val() : "",
                "password": $("[name='password']").val()
            },
            "action": "g2hraccountsettingupdate",
            "nonce": g2hr_account_setting_object.nonce
        }, function(response) {
            $(".g2hr-success-message-box").empty().html(response.data.message);
            $(".g2hr-success-message-box").fadeIn();

            return;
        })
        .fail(function(xhr, status, error) {
            var obj = jQuery.parseJSON(xhr.responseText);
            $(".g2hr-error-message-box").empty().html(obj.data);
            $(".g2hr-error-message-box").fadeIn();

            return;
        });

    });

})(jQuery);

(function($) {
    $.validator.addMethod("valueNotEquals", function(value, element, arg){
        return arg !== value;
    }, "This field is required.");

    $.validator.addMethod("zipcodeUSCA", function(value, element) {
        return /^\d{5}-\d{4}$|^\d{5}$|^[a-zA-Z][0-9][a-zA-Z](| )?[0-9][a-zA-Z][0-9]$/.test(value);
    }, "Invalid ZIP Code");

    $.validator.addMethod("cdnPostal", function(postal, element) {
        return this.optional(element) ||
        postal.match(/[a-zA-Z][0-9][a-zA-Z](-| |)[0-9][a-zA-Z][0-9]/);
    }, "Please specify a valid postal code.");

    var $validator = $("#g2hr-user-profile-form").validate({
        "rules": {
            "first_name": {
                required: true,
                minlength: 2
            },
            "last_name": {
                required: true,
                minlength: 2
            },
            "occupation": {
                required: true,
                valueNotEquals: -1
            },
            "user_phone": {
                required: true
            },
            "city": {
                required: true,
                minlength: 2
            },
            "postal_code": {
                required: true,
                cdnPostal: true
            }
        }
    });

    $('[name="user_phone"]').mask('(000) 000-0000');

    /**
     * Handle the User Modification form
     */
    $("#g2hr-update-account").on("click", function(e) {
        e.preventDefault();

        var $valid = $("#g2hr-user-profile-form").valid();
        if (!$valid) {
            $validator.focusInvalid();
            return false;
        }

        $(".g2hr-success-message-box").fadeOut("active");
        $(".g2hr-error-message-box").fadeOut("active");

        $.post(g2hr_user_profile_object.ajax_url, {
            "data": {
                "first_name": $("[name='first_name']").val(),
                "last_name": $("[name='last_name']").val(),
                "occupation": $("[name='occupation']").val(),
                "user_phone": $("[name='user_phone']").val(),
                "city": $("[name='city']").val(),
                "sector": $("[name='sector']").val(),
                "postal_code": $("[name='postal_code']").val(),
                "username": $("[name='username']").val(),
                "email": $("[name='password']").val(),
            },
            "action": "g2hruserprofileupdate",
            "nonce": g2hr_user_profile_object.nonce
        }, function(response) {
            $(".g2hr-success-message-box").empty().html(response.data.message);
            $(".g2hr-success-message-box").addClass("active").fadeIn();
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

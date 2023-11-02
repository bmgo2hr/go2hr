(function($) {

    $.validator.addMethod("isEmailTaken", function(value, element, param) {
        return ($("[name='user_email']").attr("data-taken") == 0);
    }, 'We\'re sorry, that email is taken.');

    $.validator.addMethod("isUsernameTaken", function(value, element, param) {
        return ($("[name='username']").attr("data-taken") == 0);
    }, 'We\'re sorry, that username is taken.');

    var $validator = $("#g2hr-subuser-profile-form").validate({
        "ignore": ".ignore",
        "rules": {
            "username": {
                required: true,
                minlength: 2,
                isUsernameTaken: true
            },
            "user_email": {
                required: true,
                email: true,
                isEmailTaken: true
            }
        }
    });

    /**
     * Fake debounce (delay) function for keypress
     */
    function debounce(fn, duration) {
        var timer;
        return function() {
            clearTimeout(timer);
            timer = setTimeout(fn, duration);
        };
    }

    /**
     * Check if email address is already taken while user i typing.
     * Since there is some kind of stupid issue with async validation and Firefox,
     * we need to validate it through change of data param
     */
    $("[name='user_email']").on('keyup', debounce(function() {

        const email = $("[name='user_email']").val();

        const user_id =  $("[name='user_id']").val();

        $("[name='user_email']").parent().find("i.fa-circle-o-notch").toggleClass("visible");

        $.ajax({
            type: "POST",
            url: g2hr_subuser_profile_object.ajax_url,
            data: "email="+email+"&user_id="+user_id+"&nonce="+g2hr_subuser_profile_object.nonce+"&action=g2hrsubuserprofilemailcheck",
            async: true,
            success: function (response) {
                $("[name='user_email']").parent().find("i.fa-circle-o-notch").toggleClass("visible");
                $("[name='user_email']").attr("data-taken", "0");

                $("#g2hr-subuser-profile-form").validate().element("[name='user_email']");


                return false;
            },
            error: function (request, status, error) {
                $("[name='user_email']").removeClass('ignore');

                $("[name='user_email']").attr("data-taken", "1");
                $("[name='user_email']").parent().find("i.fa-circle-o-notch").toggleClass("visible");
                $("#g2hr-subuser-profile-form").validate().element("[name='user_email']");

                return false;
            }
        });

    }, 1000));

    /**
     * Check if username address is already taken while user i typing.
     * Since there is some kind of stupid issue with async validation and Firefox,
     * we need to validate it through change of data param
     */
    $("[name='username']").on('keyup', debounce(function() {
        const username = $("[name='username']").val();
        const user_id =  $("[name='user_id']").val();

        $("[name='username']").parent().find("i.fa-circle-o-notch").toggleClass("visible");

        var response;
        $.ajax({
            type: "POST",
            url: g2hr_subuser_profile_object.ajax_url,
            data: "username="+username+"&user_id="+user_id+"&nonce="+g2hr_subuser_profile_object.nonce+"&action=g2hrsubuserprofilusernamecheck",
            async: true,
            success: function(response) {
                $("[name='username']").parent().find("i.fa-circle-o-notch").toggleClass("visible");
                $("[name='username']").attr("data-taken", "0");

                $("#g2hr-subuser-profile-form").validate().element("[name='username']");

                return false;
            },
            error: function (request, status, error) {
                var response = jQuery.parseJSON(request.responseText);

                $("[name='username']").removeClass('ignore');

                $("[name='username']").attr("data-taken", "1");
                $("[name='username']").parent().find("i.fa-circle-o-notch").toggleClass("visible");
                $("#g2hr-subuser-registration-form").validate().element("[name='username']");

                return false;
            }
        });

    }, 1000));

    /**
     * Handle the SubUser Registration form
     */
    $("#g2hr-modify-subuser-account").on("click", function(e) {
        e.preventDefault();

        let $valid = $("#g2hr-subuser-profile-form").valid();
        if (!$valid) {
            $validator.focusInvalid();
            return false;
        }

        $(".g2hr-success-message-box").fadeOut();
        $(".g2hr-error-message-box").fadeOut();

        $.post(g2hr_subuser_profile_object.ajax_url, {
            "data": {
                "first_name": $("[name='first_name']").val(),
                "last_name": $("[name='last_name']").val(),
                "user_email": $("[name='user_email']").val(),
                "status": $("[name='user-status[]']:checked").val(),
                "password": $("[name='password']").val(),
                "fid": $("[name='fid']").val()
            },
            "action": "g2hrsubuserprofileupdate",
            "nonce": g2hr_subuser_profile_object.nonce
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

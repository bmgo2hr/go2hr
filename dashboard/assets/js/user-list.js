(function($) {

    $('.delete-action').on('click', function(e) {
        e.preventDefault();

        $(".g2hr-success-message-box").fadeOut();
        $(".g2hr-error-message-box").fadeOut();

        let target_user_ids = Array();
        $('.delete_checkbox').each(function() {
          if ($(this).prop('checked')) {
              target_user_ids.push($(this).val());
          }
        });

        if (target_user_ids.length == 0) {
            $.alert({
                title: "Message",
                content: 'At least one checkbox must be selected.',
                buttons: {
                    ok: {
                        btnClass: "green-btn",
                    }
                }
            });
            return;
        }

        $.confirm({
            title: 'Confirmation Required',
            content: 'Are you sure you would like to inactivate the users?',
            buttons: {
                confirm: {
                    btnClass: "green-btn",
                    action: function () {
                        $.post(g2hr_user_list_object.ajax_url, {
                            "data": {
                                "target_user_ids": target_user_ids
                            },
                            "action": "g2hruserdelete",
                            "nonce": g2hr_user_list_object.nonce
                        }, function(response) {
                            window.location.href = g2hr_user_list_object.redirect_url;
                            return;
                        })
                        .fail(function(xhr, status, error) {
                            var obj = jQuery.parseJSON(xhr.responseText);
                            $(".g2hr-error-message-box").empty().html(obj.data);
                            $(".g2hr-error-message-box").fadeIn();

                            return;
                        });
                    }
                },
                cancel: {
                    btnClass: "border-green-btn",
                    action: function () {}
                },
            }
        });
    });


    // $("#btn-g2hr-user-login").on("click", function(e) {
    //     e.preventDefault();
    //
    //     var $valid = $("#g2hr-user-login-form").valid();
    //     if (!$valid) {
    //          $validator.focusInvalid();
    //         return false;
    //     }
    //
    //     let user_email = $("#user_email").val();
    //     let user_pass = $("#user_password").val();
    //
    //     $(".g2hr-error-message-box").fadeOut("active");
    //
    //     $.post(g2hr_user_login_object.ajax_url, {
    //         "data": {
    //             "user_email": user_email,
    //             "user_pass": user_pass
    //         },
    //         "action": "g2hruserlogin",
    //         "nonce": g2hr_user_login_object.nonce
    //     }, function(response) {
    //         window.location.href = response.data.redirect_url;
    //         return;
    //     })
    //     .fail(function(xhr, status, error) {
    //         var obj = jQuery.parseJSON(xhr.responseText);
    //         $(".g2hr-error-message-box").empty().html(obj.data);
    //         $(".g2hr-error-message-box").addClass("active").fadeIn();
    //
    //         return;
    //     });
    // });

})(jQuery);

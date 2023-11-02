$(function(e) {

    /** Create account **/
    const formItems = [
        'username',
        "user_email",
        "password"
    ];

    /** Step 1 **/
    const formItemsForStep1 = [
        'first_name',
        "last_name",
        "occupation",
        "user_phone",
        "city",
        "postal_code"
    ];

    /** Step 2 **/
    const formItemsForStep2 = [
        "company_name",
        "sector",
        "region",
        "size",
        "type",
        'company_description',
        'address',
        'company_city',
        'company_postal_code',
        "phone"
    ];

    /*======================== Switch the forms ========================*/
    /* From create account to step1 */
    $("#g2hr-create-account").click(function(e) {
        e.preventDefault();

        let $valid = $("#g2hr-user-registration-form").valid();

        if (!$valid) {
            $validator.focusInvalid();
            return false;
        }

        for (let key in formItems) {
            let item = formItems[key];
            $("[name='" +  item + "']").addClass("ignore");
        }

        for (let key in formItemsForStep1) {
            let item = formItemsForStep1[key];
            $("[name='" +  item + "']").removeClass("ignore");
        }

        $("#user-registration-form").fadeOut();
        $("#user-registration-form-step1").fadeIn();
    });

    /* From step1 to step2 */
    $("#g2hr-step1-btn").click(function(e) {
        e.preventDefault();

        let $valid = $("#g2hr-user-registration-form").valid();

        if (!$valid) {
            $validator.focusInvalid();
            return false;
        }

        for (let key in formItemsForStep1) {
            let item = formItems[key];
            $("[name='" +  item + "']").addClass("ignore");
        }

        for (let key in formItemsForStep2) {
            let item = formItemsForStep2[key];
            $("[name='" +  item + "']").removeClass("ignore");
        }

        $("#user-registration-form-step1").fadeOut();
        $("#user-registration-form-step2").fadeIn();
    });

    /* From step2 to step1 */
    $("#g2hr-step2-back-btn").click(function(e) {
        e.preventDefault();

        $("#user-registration-form-step1").fadeIn();
        $("#user-registration-form-step2").fadeOut();
    });

    /* finalize to go to dashboard */
    $("#g2hr-step2-finalize-btn").click(function(e) {
        e.preventDefault();

        let validSector = true;
        const sector = Array.from($('[name="sector[]"]:checked').map(function() {
            return $(this).val();
        }));

        if (!$('.g2hr-sector-container').hasClass('hidden') && sector.length == 0) {
            validSector = false;
            $('.sector-validation-error').removeClass('hidden');
        } else {
            $('.sector-validation-error').addClass('hidden');
        }

        let $valid = $("#g2hr-user-registration-form").valid();

        if (!$valid || !validSector) {
            $validator.focusInvalid();
            return false;
        }

        $.post(g2hr_user_registration_object.ajax_url, {
            "data": {
                "username": $("#username").val(),
                "user_email": $("#user_email").val(),
                "user_password": $("#user_password").val(),
                "first_name": $("#first_name").val(),
                "last_name": $("#last_name").val(),
                "occupation": $("#occupation").val(),
                "user_phone": $("#user_phone").val(),
                "city": $("#city").val(),
                "postal_code": $("#postal_code").val(),
                "company_name": $("#company_name").val(),
                "sector": sector,
                "region": $("#region").val(),
                "size": $("#size").val(),
                "type": $("#type").val(),
                "description": $("#company_description").val(),
                "address": $("#address").val(),
                "company_city": $("#company_city").val(),
                "company_postal_code": $("#company_postal_code").val(),
                "website": $("#website").val(),
                "phone": $("#phone").val(),
                "facebook": $("#facebook").val(),
                "twitter": $("#twitter").val(),
                "linkedin": $("#linkedin").val(),
                "instagram": $("#instagram").val(),
                "newsletter": $("#newsletter").val()
            },
            "action": "g2hruserregister",
            "nonce": g2hr_user_registration_object.nonce
        }, function(response) {
            if (g2Dropzone.getQueuedFiles().length > 0) {
                g2Dropzone.options.params.company_id = response.data.company_id;
                g2Dropzone.processQueue();
            } else {
                window.location.href = g2hr_user_registration_object.redirect_url;
            }
        });
    });

    /*======================== Validator ========================*/
    $.validator.addMethod("valueNotEquals", function(value, element, arg) {
        return arg !== value;
    }, "This field is required.");

    $.validator.addMethod("isEmailToken", function (value, element, param) {
        return ($("[name='user_email']").attr("data-token") == 0);
    }, "We're sorry, the email is token.");

    $.validator.addMethod("isUsernameTaken", function(value, element, param) {
        return ($("[name='username']").attr("data-token") == 0);
    }, "We're sorry, that username is taken.");

    $.validator.addMethod("cdnPostal", function(postal, element) {
        return this.optional(element) ||
        postal.match(/[a-zA-Z][0-9][a-zA-Z](-| |)[0-9][a-zA-Z][0-9]/);
    }, "Please specify a valid postal code.");

    $('[name="user_phone"]').mask('(000) 000-0000');
    $('[name="phone"]').mask('(000) 000-0000');

    var $validator = $("#g2hr-user-registration-form").validate({
        ignore: ".ignore",
        "rules": {
            "username": {
                required: true,
                isUsernameTaken: true
            },
            "user_email": {
                required: true,
                email: true,
                isEmailToken: true
            },
            "user_password": {
                required: true,
                minlength: 6,
            },
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
                valueNotEquals: "-1"
            },
            "user_phone": {
                required: true,
            },
            "city": {
                required: true,
                minlength: 2
            },
            "postal_code": {
                required: true,
                cdnPostal: true
            },
            "sector": {
                required: true,
                valueNotEquals: "-1"
            },
            "region": {
                required: true,
                valueNotEquals: "-1"
            },
            "size": {
                required: true,
                valueNotEquals: "-1"
            },
            "type": {
                required: true,
                valueNotEquals: "-1"
            },
            "company_description": {
                required: true,
                maxlength: 300
            },
            "address": {
                required: true
            },
            "company_city": {
                required: true,
                minlength: 2
            },
            "company_postal_code": {
                required: true,
                cdnPostal: true
            },
            "phone": {
                required: true
            },
            "website": {
                required: false,
                url: true
            },
            "facebook": {
                required: false,
                url: true
            },
            "twitter": {
                required: false,
                url: true
            },
            "linkedin": {
                required: false,
                url: true
            },
            "instagram": {
                required: false,
                url: true
            },
            "company_name": {
                required: true,
            },
            "policy": {
                required: function () {
                    return $('#policy').filter(':checked').length == 0;
                },
                minlength: 1
            },
        },
    });

    /*======================== Check if users can use the value ========================*/
    function debounce(fn, duration) {
        var timer;
        return function() {
            clearTimeout(timer);
            timer = setTimeout(fn, duration);
        }
    }

    /* User Email */
    $("[name='user_email']").on('keyup', debounce(function() {
        var email = $("[name='user_email']").val();
        $("[name='user_email']").parent().find("i.fa-circle-o-notch").toggleClass("visible");

        $.ajax({
            type: "POST",
            url: g2hr_user_registration_object.ajax_url,
            data: "email="+email+"&nonce="+g2hr_user_registration_object.nonce+"&action=g2hrusermailcheck",
            async: true,
            success: function(response) {
                $("[name='user_email']").attr("data-token", "0");
                $("[name='user_email']").parent().find("i.fa-circle-o-notch").toggleClass("visible");
                $("#g2hr-user-registration-form").validate().element("[name='user_email']");
                return false;
            },
            error: function(request, status, error) {
                const response = jQuery.parseJSON(request.responseText);
                $("[name='user_email']").attr("data-token", "1");
                $("[name='user_email']").parent().find("i.fa-circle-o-notch").toggleClass("visible");
                $("#g2hr-user-registration-form").validate().element("[name='user_email']");
                return false;
            }
        });
    }, 1000));

    /* User Name */
    $("[name='username']").on('keyup', debounce(function() {
        const username = $("[name='username']").val();
        $("[name='username']").parent().find("i.fa-circle-o-notch").toggleClass("visible");

        $.ajax({
            type: "POST",
            url: g2hr_user_registration_object.ajax_url,
            data: "username="+username+"&nonce="+g2hr_user_registration_object.nonce+"&action=g2hrusernamecheck",
            async: true,
            success: function(response) {
                $("[name='username']").attr("data-token", "0");
                $("[name='username']").parent().find("i.fa-circle-o-notch").toggleClass("visible");
                $('#g2hr-user-registration-form').validate().element("[name='username']");
                return false;
            },
            error: function(request, status, error) {
                const response = jQuery.parseJSON(request.responseText);
                $("[name='username']").attr("data-token", "1");
                $("[name='username']").parent().find("i.fa-circle-o-notch").toggleClass("visible");
                $('#g2hr-user-registration-form').validate().element("[name='username']");
                return false;
            }
        });
    }, 1000));

    /*======================== Company logo ========================*/
    if ($("div#file_dropzone").length) {
        Dropzone.autoDiscover = false;
        let currentFile = null;

        var g2Dropzone = new Dropzone ("div#file_dropzone", {
            url: g2hr_user_registration_object.ajax_url,
            maxFilesize: 2,
            paramName: 'file',
            maxFiles: 1,
            autoProcessQueue: false,
            thumbnailMethod: 'contain',
            thumbnailWidth: null,
            thumbnailHeight: 500,
            uploadMultiple: false,
            acceptedFiles: "image/jpeg,image/png,image/gif",
            params: {
                "nonce": g2hr_user_registration_object.nonce,
                "action": 'g2hrcompanylogoupload'
            }
        });

        g2Dropzone.on('queuecomplete', function(file) {
            window.location.href = g2hr_user_registration_object.redirect_url;
        });
    }

    $('.company-logo-box i').click(function() {
        $(this).fadeOut();
        $('.dz-current-image').fadeOut();

        if (currentFile) {
            g2Dropzone.removeFile(currentFile);
        }
    });

    g2Dropzone.on('addedfile', function(file) {
        $('.company-logo-box i').fadeIn();
        currentFile = file;
    });

    /*======================== Hide Sector Terms if Company type is not Tourism Operator ========================*/
    $('[name="type"]').on("change", function() {
        if ($(this).find(':selected').data('slug') == 'tourism-operator') {
            $('.g2hr-sector-container').removeClass('hidden').fadeIn();
        } else {
            $('.g2hr-sector-container').addClass('hidden').fadeOut();
        }
    });
})

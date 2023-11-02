(function($) {
    // $.validator.prototype.checkForm = function() {
    //     this.prepareForm();
    //     for (var i = 0, elements = (this.currentElements = this.elements()); elements[i]; i++) {
    //         if (this.findByName(elements[i].name).length !== undefined && this.findByName(elements[i].name).length > 1) {
    //             for (var cnt = 0; cnt < this.findByName(elements[i].name).length; cnt++) {
    //                 this.check(this.findByName(elements[i].name)[cnt]);
    //             }
    //         } else {
    //             this.check(elements[i]);
    //         }
    //     }
    //     return this.valid();
    // };

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

    $('[name="phone"]').mask('(000) 000-0000');

    var $validator = $("#g2hr-company-profile-form").validate({
        "rules": {
            "company_name": {
                required: true,
                minlength: 2
            },
            "region": {
                required: true,
                valueNotEquals: -1
            },
            "size": {
                required: true,
                valueNotEquals: -1
            },
            "type": {
                required: true,
                valueNotEquals: -1
            },
            "company_description": {
                required: true,
                maxlength: 300
            },
            "address": {
                required: true
            },
            "city": {
                required: true
            },
            "postal_code": {
                required: true,
                zipcodeUSCA: true,
                cdnPostal: true
            },
            "phone": {
                required: true,
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
        },
        "messages" : {
            "website": {
                "url" : "Please enter a valid URL - a proper website format is http://example.com"
            }
        }
    });

    /**
     * Configure Dropzone
     */
    Dropzone.autoDiscover = false;
    let currentFile = null;
    var g2Dropzone = new Dropzone ("div#file_dropzone", {
        url: g2hr_company_profile_object.ajax_url,
        maxFilesize: 1,
        paramName: 'file',
        maxFiles: 1,
        autoProcessQueue: false,
        thumbnailMethod: 'contain',
        thumbnailWidth: 250,
        thumbnailHeight: null,
        uploadMultiple: false,
        acceptedFiles: "image/jpeg,image/png,image/gif",
        params: {
            "nonce": g2hr_company_profile_object.nonce,
            "action": 'g2hrcompanylogoupdate'
        }
    });

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

    /**
     * Handle the User Registration form
     */
    $("#g2hr-update-company").on("click", function(e) {
        e.preventDefault();

        var $valid = $("#g2hr-company-profile-form").valid();

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

        if (!$valid || !validSector) {
            $validator.focusInvalid();
            return false;
        }

        $(".g2hr-success-message-box").removeClass("active").fadeOut();
        $(".g2hr-error-message-box").removeClass("active").fadeOut();

        $.post(g2hr_company_profile_object.ajax_url, {
            "data": {
                "company_name": $("[name='company_name']").val(),
                "sector": sector,
                "region": $("[name='region']").val(),
                "size": $("[name='size']").val(),
                "type": $("[name='type']").val(),
                "company_description": $("[name='company_description']").val(),
                "address": $("[name='address']").val(),
                "city": $("[name='city']").val(),
                "postal_code": $("[name='postal_code']").val(),
                "phone": $("[name='phone']").val(),
                "website": $("[name='website']").val(),
                "facebook": $("[name='facebook']").val(),
                "twitter": $("[name='twitter']").val(),
                "linkedin": $("[name='linkedin']").val(),
                "instagram": $("[name='instagram']").val(),
                "fid": $("[name='fid']").val(),
            },
            "action": "g2hrcompanyprofileupdate",
            "nonce": g2hr_company_profile_object.nonce
        }, function(response) {
            if (g2Dropzone.getQueuedFiles().length > 0) {
                g2Dropzone.options.params.company_id = $("[name='fid']").val();
                g2Dropzone.processQueue();
            }
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

    /**
     * Update changes on Job management Rights form
     */
    // TODO check
    $("#g2hr-update-company-management-rights").on("click", function(e) {
        e.preventDefault();

        var t = $("#g2hr-update-company-management-rights");
        t.button('loading');

        $(".g2hr-error-message-box").removeClass("active");
        var d = JSON.stringify($('#g2hr-company-management-rights-form').serializeObject());

         $.post(g2hr_company_profile_object.ajax_url, {
            "data": d,
            "action": "g2hrcompanymanagementupdate",
            "nonce": g2hr_company_profile_object.nonce
        }, function(response) {
            t.button('reset');
            $.toaster({ message : response.data.message, title : response.data.title, priority : 'info' });
            return;
        })
        .fail(function(xhr, status, error) {
            var obj = jQuery.parseJSON(xhr.responseText);
            $.toaster({ message : obj.data.message, title : obj.data.title, priority : 'danger' });

            t.button('reset');

            return;
        });
    });

    /**
     * Hide Sector Terms if Company type is not Tourism Operator
     */
    $('[name="type"]').on("change", function() {
        if ($(this).find(':selected').data('slug') == 'tourism-operator') {
            $('.g2hr-sector-container').removeClass('hidden').fadeIn();
        } else {
            $('.g2hr-sector-container').addClass('hidden').fadeOut();
        }
    });

})(jQuery);

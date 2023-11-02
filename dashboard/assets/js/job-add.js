(function($) {
    $.validator.addMethod("valueNotEquals", function(value, element, arg) {
        return arg !== value;
    }, "This field is required.");

    $.validator.addMethod("emailOrUrl", function(value, element) {
        var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        var email = pattern.test(value);

        var pattern2 = new RegExp(/^((http)?(s)?:\/\/)?(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i);
        var url = pattern2.test(value);

        return email || url;

    }, "Please enter an email or URL");


    $(".delete-action").click(function(e) {
        e.preventDefault();

        const type = $(this).data('type');

        $(".g2hr-success-message-box").fadeOut();
        $(".g2hr-error-message-box").fadeOut();

        let target_job_ids = Array();
        $('.delete_checkbox').each(function() {
            if ($(this).prop('checked')) {
                target_job_ids.push($(this).val());
            }
        });

        if (target_job_ids.length == 0) {
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

        let confirm_message_action = type == 'not-expired' ? "archive" : "delete";

        $.confirm({
            title: 'Confirmation Required',
            content: `Are you sure you would like to ${confirm_message_action} the jobs?`,
            buttons: {
                confirm: {
                    btnClass: "green-btn",
                    action: function () {
                        $.post(g2hr_jobs_object.ajax_url, {
                            "data": {
                                "target_job_ids": target_job_ids,
                                "type": type
                            },
                            "action": "g2hrjobdelete",
                            "nonce": g2hr_jobs_object.nonce
                        }).done(function(response) {

                            $(".g2hr-success-message-box").empty().html(response.data.message);
                            $(".g2hr-success-message-box").fadeIn();

                            let url = "";
                            if (type == 'not-expired') {
                                url = "/dashboard/my-jobs";
                            } else {
                                url = "/dashboard/my-jobs/archived";
                            }
                            window.location.href = url;
                            return;
                        }).fail(function(xhr, status, error) {

                            var obj = jQuery.parseJSON(xhr.responseText);
                            $(".g2hr-error-message-box").empty().html(obj.data.message);
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

  // $.validator.addMethod("endDate", function(value, element) {
  //   var startDate = $('[name="start_date"]').val();
  //   return Date.parse(startDate) <= Date.parse(value) || value == "";
  // }, "End date must be after start date.");

  var $validator = $("#g2hr-add-job-form").validate({
    ignore: ".ignore",
    rules: {
      "title": {
        required: true,
        minlength: 2
      },
      "level": {
        required: true,
        valueNotEquals: '-1'
      },
      "assessible_employer": {
        required: true,
        valueNotEquals: '-1'
      },
      "is_open_work_permit": {
        required: true,
        valueNotEquals: '-1'
      },
      "region": {
        required: true,
        valueNotEquals: '-1'
      },
      "different_address1": {
          required: true,
      },
      "description": {
          required: true,
      },
      "qualifications": {
        required: true,
      },
      "salary": {
        required: false,
      },
      "application_action": {
        required: true,
        emailOrUrl: true
      },
      // "deadline": {
      //   required: false
      // },
      // "expiration": {
      //   required: false
      // },

      // "application_process": {
      //   required: false
      // },
      // "start_date": {
      //   required: true
      // },
      // "end_date": {
      //   required: true,
      //   endDate: true
      // }
    }
  });

  /**
   * Init Datepicker
   */
  // $('[name="expiration"]').datepicker({
  //   format: 'mm/dd/yyyy',
  //   defaultDate: new Date(),
  //   setDate: '-0d',
  //   startDate: '-3d'
  // });

  // $('[name="deadline"]').datepicker({
  //   format: 'mm/dd/yyyy',
  //   defaultDate: new Date(),
  //   setDate: '-0d',
  //   startDate: '-3d'
  // });

  // $('[name="start_date"]').datepicker({
  //   format: 'mm/dd/yyyy',
  //   defaultDate: new Date(),
  //   setDate: '-0d',
  //   startDate: '-3d'
  // });

  // $('[name="end_date"]').datepicker({
  //   format: 'mm/dd/yyyy',
  //   defaultDate: new Date(),
  //   setDate: '-0d',
  //   startDate: '-3d'
  // });

  /**
   * Handle the Job Registration form
   */
  $("#g2hr-add-job").on("click", function(e) {
    e.preventDefault();

    let validJobType = true;
    if ($("[name='type[]']:checked").length == 0) {
        validJobType = false;
        $('.type-validation-error').removeClass('hidden');
    } else {
        $('.type-validation-error').addClass('hidden');
    }

    let validJobStatus = true;
    if ($("[name='employment_status[]']:checked").length == 0) {
        validJobStatus = false;
        $('.status-validation-error').removeClass('hidden');
    } else {
        $('.status-validation-error').addClass('hidden');
    }

    let sectorStatus = true;
    if ($("[name='sector[]']:checked").length == 0) {
        sectorStatus = false;
        $('.sector-validation-error').removeClass('hidden');
    } else {
        $('.sector-validation-error').addClass('hidden');
    }

    const $valid = $("#g2hr-add-job-form").valid();
    if (!$valid || !validJobType || !validJobStatus || !sectorStatus) {
      $validator.focusInvalid();
      return false;
    }

    $(".g2hr-success-message-box").fadeOut();
    $(".g2hr-error-message-box").fadeOut();

    const type = Array.from($('[name="type[]"]:checked').map(function() {
        return $(this).val();
    }));

    const status = Array.from($('[name="employment_status[]"]:checked').map(function() {
        return $(this).val();
    }));

    const sector = Array.from($('[name="sector[]"]:checked').map(function() {
        return $(this).val();
    }));

    const suggested_training = Array.from($('[name="suggested_training"]:checked').map(function() {
        return $(this).val();
    }));

    $.post(g2hr_jobs_object.ajax_url, {
      "data": {
          "title": $("[name='title']").val(),
          "level": $("[name='level']").val(),
          "type": type,
          "employment_status": status,
          "positions": $("[name='positions']").val(),
          "assessible_employer": $("[name='assessible_employer']").val(),
          "is_open_work_permit": $("[name='is_open_work_permit']").val(),
          "sector": sector,
          "region": $("[name='region']").val(),
          "address1": $("[name='address1']").val(),
          "description": $("[name='description']").val(),
          "qualifications": $("[name='qualifications']").val(),
          "salary": $("[name='salary']").val(),
          "application_action": $("[name='application_action']").val(),
          "benefits": $("[name='benefits']").val(),
          "suggested_training": suggested_training,
          "application_process": $("[name='application_process']").val(),
          "fid": $("[name='fid']").val(),
          "use_different_address": $("[name='use_different_address']").prop('checked') ? 1 : 0,
          "different_address1": $("[name='different_address1']").val(),
      },
      "action": "g2hrjobadd",
      "nonce": g2hr_jobs_object.nonce
    }).done(function(response) {
        $(".g2hr-success-message-box").empty().html(response.data.message);
        $(".g2hr-success-message-box").fadeIn();

        return;
    }).fail(function(xhr, status, error) {
        var obj = jQuery.parseJSON(xhr.responseText);
        $(".g2hr-error-message-box").empty().html(obj.data);
        $(".g2hr-error-message-box").fadeIn();

        return;
    });
  });

    $("#use_different_address").click(function() {
        if ($(this).prop("checked")) {
            $("#use_company_address").prop("checked", false);
            $("[name='different_address1']").fadeIn();
            $("[name='different_address1']").removeClass("ignore");
        } else {
            $("#use_company_address").prop("checked", true);
            $("[name='different_address1']").hide();
            $("[name='different_address1']").addClass("ignore");
            $("#different_address1-error").remove();
        }
    });

    $("#use_company_address").click(function() {
        if ($(this).prop("checked")) {
            $("#use_different_address").prop("checked", false);
            $("[name='different_address1']").hide();
            $("[name='different_address1']").addClass("ignore");
        } else {
            $("#use_different_address").prop("checked", true);
            $("[name='different_address1']").fadeIn();
            $("[name='different_address1']").removeClass("ignore");
            $("#different_address1-error").remove();
        }
  });

})(jQuery);

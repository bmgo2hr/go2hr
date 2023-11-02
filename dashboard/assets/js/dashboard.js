$(function() {

    $('.card-header i').click(function() {
        $(this).toggleClass("fa-angle-down fa-angle-up");
    });

    $('.logout').click(function(e) {
        e.preventDefault();

        $.confirm({
            title: 'Confirmation Required',
            content: 'Are you sure you would like to logout?',
            buttons: {
                confirm: {
                    btnClass: "green-btn",
                    action: function () {
                        $.post(g2hr_dashboard_object.ajax_url, {
                            "data": {},
                            "action": "g2hrlogout",
                            "nonce": g2hr_dashboard_object.nonce
                        }).done(function(response) {
                            return window.location.href = g2hr_dashboard_object.redirect_url;
                        }).fail(function(xhr, status, error) {});
                    }
                },
                cancel: {
                    btnClass: "border-green-btn",
                    action: function () {}
                },
            }
        });
    });
})



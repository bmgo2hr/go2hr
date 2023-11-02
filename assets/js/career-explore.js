$('[id^=Tab-]').click(function(){
    let targetIndex = $(this).attr("id").split("-")[1];
    let elems = $('[class^=popular_content]');
    elems.each(function(idx, elem) {
        if ($(elem).hasClass('is_open')) {
            $(elem).removeClass('is_open').addClass('d-none').animate(300);
        };
    });
    $(elems).eq(targetIndex - 1).addClass('is_open').removeClass("d-none").animate(300);
});

$('.ViewAll-row').click(function(event) {
    let idx = $(this).data('idx');
    event.preventDefault();
    $("#more_popular" + idx).slideToggle(300);
    $("i", this).toggleClass("fa-caret-down fa-caret-up");
});

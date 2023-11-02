/*
 * Put all your regular jQuery in here.
*/
jQuery(function ($) {

    function filtering() {
        const filter = $('#filter');
        const sort_by = $('#sort_by').val();
        const taxonomy = $('#jobs_sectors-filter').val();

        $.ajax({
            url: filter.attr('action'),
            data: filter.serialize() + "&sort_by=" + sort_by + "&jobs_sectors-filter=" + taxonomy,
            type: filter.attr('method'),
            beforeSend:function(xhr) {},
            success: function(data){

                $('#response').html(data);
                const returned_count = $('#avl_job_count').val();
                const updated_count_html = "Currently viewing: "+returned_count+" jobs"

                $('.list-counter p').html(updated_count_html);
                window.location.href = "#job-board-section";
            }
        });
        return false;
    }

    $('#sort_by').change(function() {
        filtering();
    });

    $('#filter').submit(function(){
        return filtering();
    });

    $(document).on('click', '.job-board .D-radius a', function(e) {
        e.preventDefault();

        let page_no = $(this).html();
        if ($(this).hasClass('next')) {
            page_no = parseInt($(".page-numbers.current").html()) + 1;
        } else if ($(this).hasClass('prev')) {
            page_no = parseInt($(".page-numbers.current").html()) - 1;
        }

        $('#paged_value').val(page_no);
        $('#filter').trigger('submit');
    });

    $('.auto_filter').on('click',function(){
        $('#paged_value').val(1);
        $('#filter').trigger('submit')
    })

    // Social
    $('.share-text').click(function(event){
        event.stopPropagation();
        $(this).parent().children('.social-box').toggle();
    });

    $('.social-box').click(function(event){
        event.stopPropagation();
    });

    $(document).click(function(){
        $('.social-box').hide();
    });


    $("#searchsubmit").click(function(e) {
        e.preventDefault();

        const search_word = $("[name='search_word']").val();
        const search_city = $("[name='search_city']").val();

        let search = ""
        if (search_word) search = search_word;
        if (search_city) search = search + " " + search_city;
        $("#searchform").append($('<input>').attr({'type': 'hidden', 'name': 'search', 'value': search}));

        $("#searchform").submit();
    });

    $(".filter-btn").click(function() {
        if ($('.ResourceFilter').css("display") == 'none') { $('.ResourceFilter').fadeIn(); }
        else { $('.ResourceFilter').fadeOut(); }
    });
});









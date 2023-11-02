<?php get_header()?>

<?php
    $region_array = array();
    if (isset($_GET['comp_region']) && !empty($_GET['comp_region'])){
        $region = $_GET['comp_region'];
        $region_array = explode(',', $region);
        $tax_array['relation'] = 'OR';
        $tax_array[1]['taxonomy'] = 'company_region';
        $tax_array[1]['field'] = 'term_id';
        $tax_array[1]['terms'] = $region_array;
        $tax_array[1]['operator'] = 'IN';
    }

    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = $_GET['search'];
    }

    if (isset($_GET['sort_by']) && !empty($_GET['sort_by'])) {
        $sort_by = $_GET['sort_by'];
    }
?>

<main class="inr-page Training-page Recruit-page" id="newsDetail">
    <div class="individual-job-page">
    <?php echo get_template_part('company-directory/find-company-search')?>
        <section class="Find-jobs space pt-0">
        <?php echo get_template_part('company-directory/query-sectors-tabs')?>
            <div class="ResourceExplore mt-5 pt-5">
                <div class="container">
                    <div class="row">
                        <?php echo get_template_part('company-directory/filter-company-directory', null, array('selected_items' => $region_array))?>
                            <div class="col-lg-9 col-md-12 col-12" style="padding: 0px 15px;">
                                <div class="grid-top">
                                    <div class="list-counter"></div>
                                    <div class="short-by">
                                        <label>Sort by:</label>
                                        <select name="sort_by">
                                            <option value="asc" <?php if($sort_by == 'asc') echo " selected"; ?>>A-Z</option>
                                            <option value="desc" <?php if($sort_by == 'desc') echo " selected"; ?>>Z-A</option>
                                        </select>
                                    </div>
                                </div>

                                <div id="response">
                                    <div class="row">
                                    <?php
                                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                                        $query_args = array (
                                                'post_type' => 'go2hr_companies',
                                                'posts_per_archive_page' => 15,
                                                'paged' => $paged,
                                                'tax_query' => $tax_array,
                                                'orderby'   => 'title',
                                                'order'      => $sort_by ?? 'asc',
                                                's'         => $search,
                                            );

                                        $the_query = new WP_Query($query_args);

                                        $totalpost = $the_query->found_posts;
                                    ?>


                                    <?php  if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
                                    <?php
                                        $company_id = get_field('company_id');
                                        $no_company_logo = get_stylesheet_directory_uri() . '/assets/images/no-company-logo.png';
                                    ?>

                                        <div class="col-md-4 col-sm-4">
                                            <a href="<?php the_permalink() ?>">
                                                <div class="company-grid">
                                                    <div class="company-grid-image">
                                                        <img src="<?php echo (!empty($company_id)) ? $company_id : $no_company_logo ?>">
                                                    </div>

                                                    <div class="company-grid-content">
                                                        <h4><?php the_title()?></h4>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endwhile; ?>
                                        <div class="col-12 mt-5">
                                            <?php
                                                if ($the_query->have_posts()) {
                                                    $paged = (get_query_var('paged')) ? get_query_var( 'paged' ) : 1;
                                                    $total_pages = $the_query->max_num_pages;
                                                    echo '<div class="pagination D-radius dynmic-pagi">';
                                                    if ($total_pages > 1) {
                                                        $current_page = max(1, get_query_var('paged'));
                                                           echo paginate_links(array(
                                                              'base'      => get_pagenum_link(1) . '%_%',
                                                              'format'    => '/page/%#%',
                                                              'current'   => $current_page,
                                                              'total'     => $total_pages,
                                                              'prev_text' => '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
                                                              'next_text' => '<i class="fa fa-chevron-right" aria-hidden="true"></i>',
                                                        ));
                                                    }
                                                    echo '<li class="page-item article-count">' . $totalpost . ' Articles</li>';
                                                    echo '</div>';
                                                }
                                            ?>
                                        </div>
                                    <?php else : ?>
                                        <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                                    <?php endif;  wp_reset_postdata(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<?php
    $path = $_SERVER['REQUEST_URI'];
    $path_array = explode('/',$path);
    $path_array = explode('?',$path_array[1]);
    $page_url = home_url().'/'.$path_array[0];
    $queryString = $_SERVER['QUERY_STRING'];
?>

<script>

jQuery("[name='sort_by']").change(function() {
    formUrl();
});

function formUrl() {
    // Add company region parameter
    let url = "/?comp_region=";
    $("[name='company_region_filter']").each(function() {
        if ($(this).is(":checked")) {
            url = url + $(this).attr("id") + ",";
        }
    });
    // remove the last , of the url
    url = url.slice(0, -1);

    // Add sort by parameter
    url = url + "&sort_by=" + $('[name="sort_by"]').val();

    window.location.href = '<?php echo home_url(); ?>/company-directory' + url;
}

jQuery('.D-radius a').each(function() {
     const page_no = jQuery(this).html();
     const current_page_no = jQuery('.current').html();
     if (jQuery(this).hasClass('prev')) {
        console.log(current_page_no);
        const prev_page_no = parseInt(current_page_no) - 1;
        jQuery(this).attr('href', '<?php echo $page_url; ?>'+'/page/'+prev_page_no+'/?<?php echo $queryString; ?>');
     } else if(jQuery(this).hasClass('next')) {
        const next_page_no = parseInt(current_page_no)+1;
        jQuery(this).attr('href', '<?php echo $page_url; ?>'+'/page/'+next_page_no+'/?<?php echo $queryString; ?>');
     } else {
        jQuery(this).attr('href', '<?php echo $page_url; ?>'+'/page/'+page_no+'/?<?php echo $queryString; ?>');
     }
})

</script>

<?php get_footer()?>

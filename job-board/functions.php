<?php

function go2hr_job_board_search($template) {
    global $wp_query;
    $post_type = get_query_var('post_type');
    if ($wp_query->is_search && $post_type == 'go2hr_jobs') {
        return locate_template('job-board/search-job-board.php');
    }
    return $template;
}
add_filter('template_include', 'go2hr_job_board_search');

function job_board_enqueue_scripts() {
    if (is_archive('go2hr_jobs')) {
        wp_enqueue_script('job_board_js', get_template_directory_uri() . '/job-board/assets/js/main.js', array('jquery'));
    }
}
add_action('wp_enqueue_scripts', 'job_board_enqueue_scripts');

add_action('wp_ajax_myfilter_job_board_regions', 'job_board_filter');
add_action('wp_ajax_nopriv_myfilter_job_board_regions', 'job_board_filter');


function job_board_filter() {

    // to get only not expired jobs as there are jobs that have the status of not expired but actually they are based on the post date
    $paged = $_POST['paged_value'];
    $sort_by = $_POST['sort_by'];
    $job_board_ad_display = $_POST['job_board_ad_display'];
    $job_board_ad_url = $_POST['job_board_ad_url'];
    $job_board_ad_image = $_POST['job_board_ad_image'];

    $posts_per_page = 15;

    $args = array(
        'post_type' => 'go2hr_jobs',
        'post_status' => 'publish',
        'posts_per_archive_page' => 15,
        'offset' => ($paged - 1) * $posts_per_page,
        "s"     => $_POST['s'] ?? "",
        "orderby" => "date",
        "order" => (empty($sort_by) || $sort_by == "newest") ? "DESC" : "ASC"
    );

    $tax_array = array();

    // Region
    if (isset($_POST['jobs_region-filter'])) {
        $tax_array['relation'] = 'AND';
        $tax_array[0]['taxonomy'] = 'jobs_region';
        $tax_array[0]['field'] = 'term_id';
        $tax_array[0]['terms'] = $_POST['jobs_region-filter'];
    }

    // Job status
    if (isset($_POST['jobs_status-filter'])) {
        $tax_array['relation'] = 'AND';
        $tax_array[1]['taxonomy'] = 'jobs_status';
        $tax_array[1]['field'] = 'term_id';
        $tax_array[1]['terms'] = $_POST['jobs_status-filter'];
    }

    // Job Type
    if (isset($_POST['jobs_types-filter'])) {
        $tax_array['relation'] = 'AND';
        $tax_array[2]['taxonomy'] = 'jobs_types';
        $tax_array[2]['field'] = 'term_id';
        $tax_array[2]['terms'] = $_POST['jobs_types-filter'];
    }

    //Level
    if (isset($_POST['jobs_levels-filter'])) {
        $tax_array['relation'] = 'AND';
        $tax_array[3]['taxonomy'] = 'jobs_levels';
        $tax_array[3]['field'] = 'term_id';
        $tax_array[3]['terms'] = $_POST['jobs_levels-filter'];
    }

    // Job Sectors
    if (isset($_POST['jobs_sectors-filter']) && !empty($_POST['jobs_sectors-filter'])) {
        $tax_array['relation'] = 'AND';
        $tax_array[4]['taxonomy'] = 'jobs_sectors';
        $tax_array[4]['field'] = 'slug';
        $tax_array[4]['terms'] = $_POST['jobs_sectors-filter'];
    }

    $args['tax_query'] = $tax_array;

    $the_query = new WP_Query($args);

    $idx = 0;
?>

<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
    <?php $idx++; ?>

    <?php if ($job_board_ad_display && $idx == 7) : ?>
        <a href="<?php echo $job_board_ad_url; ?>" target="_blank" style="margin-bottom: 40px; display: inline-block;">
            <img src="<?php echo $job_board_ad_image; ?>" alt="" style="max-width: 100%;">
        </a>
    <?php endif; ?>

    <div class="ExploreAll-main">
    <?php $job_company = get_field('field_5946b72feab10'); ?>
        <div class="ExploreBox w-100 d-flex">
        <?php if (!empty(get_field('company_id', $job_company->ID))) : ?>
            <figure>
                <img src="<?php echo get_field('company_id', $job_company->ID) ?>" alt="" class="w-100" />
            </figure>
        <?php else : ?>
            <figure>
                <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/no-company-logo.png" alt="" class="w-100" />
            </figure>
        <?php endif; ?>

        <figcaption>
            <div class="job-top">
                <div class="find-content">
                    <?php if ($job_company) : ?>
                        <p><?php echo esc_html($job_company->post_title); ?></p>
                    <?php endif; ?>

                    <p><b><?php the_title(); ?></b></p>

                    <div class="d-flex flex-wrap">
                        <p class="mr-4">
                            <?php if (!empty(get_field('company_locations', $job_company->ID)[0]['company_city'])) : ?>
                                <?php echo get_field('company_locations', $job_company->ID)[0]['company_city'] ?>
                            <?php endif; ?>
                        </p>

                        <?php if (!empty(get_the_terms(get_the_ID(), 'jobs_types'))) : ?>
                            <?php foreach (get_the_terms(get_the_ID(), 'jobs_types') as $jobs_types) : ?>
                                <p><?php echo __($jobs_types->name); ?>&nbsp;-&nbsp;</p>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php if (!empty(get_the_terms(get_the_ID(), 'jobs_status'))) : ?>
                            <?php foreach (get_the_terms(get_the_ID(), 'jobs_status') as $jobs_status) : ?>
                                <p><?php echo __($jobs_status->name); ?></p>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="share-btn social-share">
                        <div class="ShareIcon share-text">
                            <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/region/share-icon.png" class="" alt="" />
                        </div>
                        <div class="social-box" style="display: none;">
                            <div class="share-job">
                                <ul>
                                    <li>
                                        <a target="_blank" rel="nofollow noopener" href="https://twitter.com/intent/tweet?url=<?php the_permalink() ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                    </li>
                                    <li>
                                        <a target="_blank" rel="nofollow noopener" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    </li>
                                    <li>
                                        <a target="_blank" rel="nofollow noopener" href="https://www.linkedin.com/shareArticle?url=<?php the_permalink() ?>&title=<?php the_title() ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                    </li>
                                    <li>
                                        <a target="_blank" rel="nofollow noopener" href="<?php the_permalink() ?>"><i class="fa fa-link" aria-hidden="true"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
            </div>

            <p><?php the_excerpt(); ?></p>

            <a href="<?php the_permalink() ?>" class="btn-border">Read More</a>
        </figcaption>
    </div>
<?php endwhile; ?>

<div class="col-12 mt-5">
<?php $query = new WP_Query($args); $total_post = $query->found_posts; ?>
<?php if ( $query->have_posts() ) : ?>
<?php $total_pages = $query->max_num_pages; ?>
    <div class="pagination D-radius dynmic-pagi arch_pagi">
    <?php if ($total_pages >= 1) : ?>
        <?php $current_page = max(1, get_query_var('paged'));
            echo paginate_links(array(
              'base'      => '/job-board/%_%',
              'format'    => '/page/%#%',
              'current'   => $paged,
              'total'     => $total_pages,
              'prev_text' => '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
              'next_text' => '<i class="fa fa-chevron-right" aria-hidden="true"></i>',
            ));
        ?>
        <li class="page-item article-count"><?php echo $total_post; ?> Jobs</li>
    </div>
    <?php endif; ?>
    </div>
    <input type="hidden" id="avl_job_count" value="<?= $total_post ?>">
    <?php else : ?>
    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
    <input type="hidden" id="avl_job_count" value="0">
    <?php endif; ?>
    <?php wp_reset_postdata(); exit; ?>
<?php endif; ?>

<?php  }

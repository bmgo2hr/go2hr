<?php

get_header();

$urlExplodedBySlash = explode('/', $_SERVER['REQUEST_URI']);
$targetActiveSlug = end($urlExplodedBySlash);

$args = array(
    'post_type'              => 'go2hr_jobs',
    'post_status'            => 'publish',
    'posts_per_archive_page' => 15,
    'paged'                  => $paged,
    's'                     => $_GET['search'],
    'order'                 => 'DESC',
    'tax_query'             => array(
        array(
            'taxonomy' => 'jobs_sectors',
            'field'    => 'slug',
            'terms'    => $targetActiveSlug
        )
    ),
    'date_query'             => array(
            array(
                'date_query' => [
                    'after'     => '30 days ago',
                    'inclusive' => true
                ]
            ),
    )
);
$the_query = new WP_Query($args);

$job_board_ad = get_field('job_board_ad', 'option');
$job_board_ad_image = $job_board_ad['image'];
$job_board_ad_url = $job_board_ad['url'];
$job_board_ad_display = $job_board_ad['display'];

?>

<main class="inr-page Training-page Recruit-page job-board" id="newsDetail">
    <div class="individual-job-page">

        <?php echo get_template_part('job-board/subheader') ?>

        <section class="Find-jobs space" id="job-board-section">

            <?php echo get_template_part('job-board/menu-tabs') ?>

            <div class="ResourceExplore mt-5 pt-5">
                <div class="container">
                    <div class="row">
                        <?php echo get_template_part('job-board/filters-jobboard', null, array("targetActiveSlug" => $targetActiveSlug)) ?>
                        <div class="col-lg-9 col-md-12 col-12">
                            <!-- grid -->
                            <div class="col-12">
                                <div class="grid-top">
                                    <div class="list-counter">
                                        <p>Currently viewing: <?php echo $count_posts = $the_query->found_posts; ?> jobs</p>
                                    </div>
                                    <div class="short-by">
                                        <label>Sort by:</label>
                                        <select name="sort_by" id="sort_by">
                                            <option value="newest">Newest</option>
                                            <option value="oldest">Oldest</option>
                                        </select>
                                    </div>
                                </div>

                                <div id="response">

                                    <!-- Big loop -->
                                    <div class="ExploreAll-main">
                                        <?php
                                            $current_page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' )  : 1;
                                            $idx = 0;
                                        ?>

                                        <?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
                                                <?php $idx++; ?>
                                                <?php $job_company = get_field('field_5946b72feab10'); ?>
                                                <?php if ($job_board_ad_display == true && $idx == 7) : ?>
                                                    <a href="<?php echo $job_board_ad_url; ?>" target="_blank" style="margin-bottom: 40px; display: inline-block;">
                                                        <img src="<?php echo $job_board_ad_image; ?>" alt="" style="max-width: 100%;">
                                                    </a>
                                                <?php endif; ?>

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

                                                                <?php

                                                                if ($job_company) : ?>
                                                                    <p><?php echo esc_html($job_company->post_title); ?></p>
                                                                <?php endif; ?>

                                                                <p><b><?php the_title(); ?></b></p>

                                                                <div class="d-flex flex-wrap">
                                                                    <p class="mr-4"><?php if (!empty(get_field('company_locations', $job_company->ID)[0]['company_city'])) : ?>
                                                                            <?php echo get_field('company_locations', $job_company->ID)[0]['company_city'] ?>
                                                                        <?php endif; ?></p>

                                                                    <?php
                                                                    //Type
                                                                    if (!empty(get_the_terms(get_the_ID(), 'jobs_types'))) :
                                                                        foreach (get_the_terms(get_the_ID(), 'jobs_types') as $jobs_types) {
                                                                            echo '<p>' . __($jobs_types->name) . '&nbsp;|&nbsp; </p>';
                                                                        }
                                                                    endif;

                                                                    //Status
                                                                    if (!empty(get_the_terms(get_the_ID(), 'jobs_status'))) :
                                                                        foreach (get_the_terms(get_the_ID(), 'jobs_status') as $jobs_status) {
                                                                            echo '<p>' . __($jobs_status->name) . '</p>';
                                                                        }
                                                                    endif;
                                                                    ?>

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
                                                        <p>
                                                            <?php the_excerpt() ?>
                                                        </p>

                                                        <a href="<?php the_permalink() ?>" class="btn-border">Read More</a>
                                                    </figcaption>



                                                </div>



                                            <?php endwhile; ?>

                                            <div class="col-12 mt-5">
                                                <?php
                                                    $query = new WP_Query($args);
                                                    $totalpost = $query->found_posts;
                                                    if ( $query->have_posts() ) {
                                                        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' )  : 1;
                                                        $total_pages = $query->max_num_pages;
                                                        echo '<div class="pagination D-radius dynmic-pagi arch_pagi">';
                                                        if ($total_pages > 1){
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
                                                        echo '<li class="page-item article-count">'.$totalpost.' Jobs</li>';
                                                        echo '</div>';
                                                    }
                                                ?>
                                            </div>


                                        <?php else : ?>
                                            <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                                        <?php endif;
                                        wp_reset_postdata(); ?>

                                    </div>
                                </div>



                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<?php get_footer() ?>

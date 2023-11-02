<?php
get_header();

$paged     = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args      = array(
    'post_type'              => 'go2hr_jobs',
    'post_status'            => 'publish',
    's'                      => get_search_query(),
    'posts_per_archive_page' => 5,
    'paged'                  => $paged,
);
$the_query = new WP_Query($args);

?>

<main class="inr-page Training-page Recruit-page job-board" id="newsDetail">
    <div class="individual-job-page">
        <?php echo get_template_part('job-board/subheader') ?>

        <section class="Find-jobs space">

            <?php echo get_template_part('job-board/menu-tabs') ?>

            <div class="ResourceExplore mt-5 pt-5">
                <div class="container">
                    <div class="row">
                        <?php echo get_template_part('job-board/filters-jobboard') ?>
                        <div class="col-lg-9 col-md-12 col-12">
                            <!-- grid -->
                            <div class="col-12">
                                <div class="grid-top">
                                    <div class="list-counter">
                                        <p>Currently viewing: <?php echo $count_posts = $the_query->found_posts; ?> jobs</p>
                                    </div>
                                    <div class="short-by">
                                        <label>Sort by:</label>
                                        <select>
                                            <option>Newest</option>
                                        </select>
                                    </div>
                                </div>

                                <div id="response">
                                    <div class="ExploreAll-main">

                                        <?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>

                                            <?php $job_company = get_field('job_company'); ?>

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

                                                            <div class="d-flex">
                                                                <p class="mr-4">
                                                                    <?php if (!empty(get_field('company_locations', $job_company->ID)[0]['company_city'])) : ?>
                                                                        <?php echo get_field('company_locations', $job_company->ID)[0]['company_city'] ?>
                                                                    <?php endif; ?>
                                                                </p>

                                                                <p><?php the_terms(get_the_ID(), 'jobs_types', '', ', ', ''); ?></p>

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
                                                                            <a target="_blank" rel="nofollow noopener" href="https://twitter.com/intent/tweet?url=<?php the_permalink() ?>"><i class="fa fa-twitter" aria-hidden="true"></i>
                                                                            </a>
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
                                                        echo '<li class="page-item article-count">'.$totalpost.' Articles</li>';
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
            </div>
        </section>
    </div>
</main>

<?php get_footer() ?>

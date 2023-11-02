<?php

get_header();?>

<main class="inr-page Training-page Recruit-page bg-grey" id="Recruit">

        <!-- Breadcrumb -->
<!--        <section class="Breadcrumb-go2">-->
<!--         <div class="container">-->
<!--            <div class="row">-->
<!--               <div class="col-lg-12">-->
<!--                  <div class="pagination-box">-->
<!--                     <ul>-->
<!--                        <li><a href="--><?//=get_site_url();?><!--">Home</a></li>-->
<!--                        <li><a href="--><?//=get_page_link(205);?><!--">Human Resources</a></li>-->
<!--                        <li><span>--><?php //echo ($pageHeading)? $pageHeading : get_the_title();?><!--</span></li>-->
<!--                     </ul>-->
<!--                  </div>-->
<!--               </div>-->
<!--            </div>-->
<!--         </div>-->
<!--      </section>-->

    <section class="contactUs-sec space">
        <div class="container">
            <div class="row">
                <div class="col-12 mx-auto">
                    <div class="heading-pnel line-head">
                        <h2>Search Results for "<?php echo htmlspecialchars(get_search_query(), ENT_QUOTES, "utf-8"); ?>"</h2>
<!--                        <p>Our experts have curated a selection of articles to help you start recruiting in the tourism and hospitality industry.</p>-->
                    </div>
                    <div class="mt-5 pt-5">
                        <?php get_template_part("template-parts/entire-search-bar", null, array("s" => get_search_query())); ?>
                    </div>
                    <?php
                        $index = 0;
                        $totalpost = $wp_query->found_posts;
                    ?>
                    <?php if ( have_posts() ) : ?>
                        <div class="results">
                        <?php while ( have_posts() ) : ?>
                        <?php $index++; ?>
                        <?php the_post(); ?>
                            <div class="bg-white p-5 search-result-item">
                                <?php the_title( sprintf( '<a href="%s"><h2>', esc_url( get_permalink() ) ), '</h2></a>' ); ?>
<!--                                <time class="updated" style="font-size: 1.5rem;" datetime="--><?//= get_post_time('c', true); ?><!--">--><?//= get_the_date(); ?><!--</time>-->
                                <?php //twenty_twenty_one_post_thumbnail(); ?>
                                <p><?php echo sprintf(get_the_custom_excerpt(get_the_content(), 300), esc_url( get_permalink() )); ?></p>
                            </div>
                        <?php endwhile; ?>
                        </div>
                        <div class="col-12 mt-5">
                            <?php

                                if ( $wp_query->have_posts() ) {
                                    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' )  : 1;
                                    $total_pages = $wp_query->max_num_pages;
                                    echo '<div class="pagination D-radius dynmic-pagi arch_pagi">';
                                    if ($total_pages > 1) {
                                        $current_page = max(1, get_query_var('paged'));
                                        echo paginate_links(array(
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
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>



<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */


//if ( have_posts() ) {
//	?>
<!--	<header class="page-header alignwide">-->
<!--		<h1 class="page-title">-->
<!--			--><?php
//			printf(
//				/* translators: %s: Search term. */
//				esc_html__( 'Results for "%s"', 'twentytwentyone' ),
//				'<span class="page-description search-term">' . esc_html( get_search_query() ) . '</span>'
//			);
//			?>
<!--		</h1>-->
<!--	</header><!-- .page-header -->-->
<!---->
<!--	<div class="search-result-count default-max-width">-->
<!--		--><?php
//		printf(
//			esc_html(
//				/* translators: %d: The number of search results. */
//				_n(
//					'We found %d result for your search.',
//					'We found %d results for your search.',
//					(int) $wp_query->found_posts,
//					'twentytwentyone'
//				)
//			),
//			(int) $wp_query->found_posts
//		);
//		?>
<!--	</div><!-- .search-result-count -->-->
<!--	--><?php
//	// Start the Loop.
//	while ( have_posts() ) {
//		the_post();
//
//		/*
//		 * Include the Post-Format-specific template for the content.
//		 * If you want to override this in a child theme, then include a file
//		 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
//		 */
//		get_template_part( 'template-parts/content/content-excerpt', get_post_format() );
//	} // End the loop.
//
//	// Previous/next page navigation.
//	twenty_twenty_one_the_posts_navigation();
//
//	// If no content, include the "No posts found" template.
//} else {
//	get_template_part( 'template-parts/content/content-none' );
//}
//
//get_footer();

<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();
?>

	<!--<header class="page-header alignwide">
		<h1 class="page-title"><?php esc_html_e( 'Nothing here', 'twentytwentyone' ); ?></h1>
	</header>

	<div class="error-404 not-found default-max-width">
		<div class="page-content">
			<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentytwentyone' ); ?></p>
			<?php get_search_form(); ?>
		</div>
	</div>-->
	<main class="inr-page Training-page Recruit-page" id="newsDetail">
            <div class="individual-job-page">
                <section class="EventSearch space bg-blue">
                    <div class="container">
                        <div class="individual-width page404">
                            <div class="row">
                                <div class="col-12">
                                    <div class="heading-pnel fff text-left">
                                        <h2>Are you lost?</h2>
                                    </div>
                                </div>
                                 
                                <div class="col-12 mx-auto">
                                    <div class="heading-pnel fff text-left">
                                        <p>
                                            It’s ok, we get lost too sometimes in the beauty of this province.</p>

                                            <p> But you seem to have hit a dead end on this page. Why don’t you go back and visit our homepage? Along the way, we’d appreciate if you could let us know about this dead end so other visitors don’t get lost as well.
                                        </p>
                                        <p><b>Check out some of our most popular content:</b></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-6">
                                    <div class="page404-btn">
                                    <a href="<?php echo home_url(); ?>/job-board" class="green-btn ">Job Board </a>
                                </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-3 col-6">
                                    <div class="page404-btn">
                                    <a href="<?php echo home_url(); ?>/health-safety" class="green-btn ">Healthy & Safety</a>
                                </div>
                                </div>


                                <div class="col-lg-3 col-md-3 col-sm-3 col-6">
                                    <div class="page404-btn">
                                    <a href="<?php echo home_url(); ?>/human-resources" class="green-btn ">Human Resources</a>
                                </div>
                                </div>


                                <div class="col-lg-3 col-md-3 col-sm-3 col-6">
                                    <div class="page404-btn">
                                    <a href="<?php echo home_url(); ?>/training" class="green-btn ">Training</a>
                                </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </section>
               
            </div>
        </main>

<?php
get_footer();

<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
<?php get_template_part( 'template-parts/footer/footer-widgets' ); ?>
<footer class="footer">
            
                <div class="foooer-top">
				<div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="foooer-heading">
                                <h4>sign up for our newsletter</h4>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="foooer-button">
							<?php //if ( is_active_sidebar( 'newsletter-1' ) ) : ?>
							<div id="your-sidebar" class="widget-area" role="complementary">
							<?php //dynamic_sidebar( 'newsletter-1' ); ?>
							</div>
						<?php //endif; ?>
                                <a href="https://myprojectdemonstration.com/development1/CPN/web/join/" class="btn green-btn">Sign up now</a>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                
				<div class="container-fluid">
				<div class="foooer-bottom">
                    <div class="row">
                        <div class="col-lg-6 col-md-4 col-sm-4">
                            <div class="footer-content">
							<?php if ( is_active_sidebar( 'footerlogo-1' ) ) : ?>
							<?php dynamic_sidebar( 'footerlogo-1' ); ?>
							<?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-8 col-sm-8">
                            <div class="row">
                                <div class="col-lg-5 col-md-4 col-sm-4 mobile-order-2">
                                    <div class="footer_Box">
                                        <h3>Quick Links</h3>
                                        <div class="footer_links">
                                            <?php if ( has_nav_menu( 'footer' ) ) : ?>
			<nav aria-label="<?php esc_attr_e( 'Secondary menu', 'twentytwentyone' ); ?>" class="footer-navigation">
				<ul class="footer-navigation-wrapper">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'items_wrap'     => '%3$s',
							'container'      => false,
							'depth'          => 1,
							'link_before'    => '<span>',
							'link_after'     => '</span>',
							'fallback_cb'    => false,
						)
					);
					?>
				</ul><!-- .footer-navigation-wrapper -->
			</nav><!-- .footer-navigation -->
		<?php endif; ?>
                                        </div>
										
                                    </div>
                                </div>

                                <div class="col-lg-7 col-md-8 col-sm-8 mobile-order-1">
                                    <?php if ( is_active_sidebar( 'connectwithus-1' ) ) : ?>
									<?php dynamic_sidebar( 'connectwithus-1' ); ?>
									<?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

<?php wp_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-2.2.3.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/owl.carousel.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.js "></script> 
<script src="<?php echo get_template_directory_uri(); ?>/js/main.js "></script>
<script>
    function AddReadMore() {
        //This limit you can set after how much characters you want to show Read More.
        var carLmt = 0;
        // Text to show when text is collapsed
        var readMoreTxt = " ... Read More";
        // Text to show when text is expanded
        var readLessTxt = " Read Less";


        //Traverse all selectors with this class and manupulate HTML part to show Read More
        $(".addReadMore").each(function() {
            if ($(this).find(".firstSec").length)
                return;

            var allstr = $(this).text();
            if (allstr.length > carLmt) {
                var firstSet = allstr.substring(0, carLmt);
                var secdHalf = allstr.substring(carLmt, allstr.length);
                var strtoadd = firstSet + "<span class='SecSec'>" + secdHalf + "</span><span class='readMore'  title='Click to Show More'>" + readMoreTxt + "</span><span class='readLess' title='Click to Show Less'>" + readLessTxt + "</span>";
                $(this).html(strtoadd);
            }

        });
        //Read More and Read Less Click Event binding
        $(document).on("click", ".readMore,.readLess", function() {
            $(this).closest(".addReadMore").toggleClass("showlesscontent showmorecontent");
        });
    }
    $(function() {
        //Calling function after Page Load
        AddReadMore();
    });
    </script>
    <style>
    .addReadMore.showlesscontent .SecSec,
    .addReadMore.showlesscontent .readLess {
        display: none;
    }

    .addReadMore.showmorecontent .readMore {
        display: none;
    }

    .addReadMore .readMore,
    .addReadMore .readLess {
        font-weight: bold;
        margin-left: 2px;
        color: blue;
        cursor: pointer;
    }

    .addReadMoreWrapTxt.showmorecontent .SecSec,
    .addReadMoreWrapTxt.showmorecontent .readLess {
        display: block;
    }
    </style>
</body>
</html>

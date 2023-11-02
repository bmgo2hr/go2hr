<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
  */
$newsId = get_the_ID();
$newsName = get_the_title();
$newsShortDesc = get_the_excerpt();
$newsImg = get_the_post_thumbnail_url();
$newsdate = get_the_date('M d, Y');
get_header(); ?>

<main class="inr-page Training-page Recruit-page" id="newsDetail">
         <!-- section -->
         <section class="EventDetail-sec space" style="background:#fff;">
            <div class="container">
                     <div class="row align-items-center justify-content-between">
					 <?php if(!empty($newsImg)){ ?>
						<div class="col-lg-5 col-12 Img_Outer">
                           <div class="EventDetail-img">
                              <img src="<?=$newsImg;?>" class="w-100" alt="" />
                           </div>
					 </div><?php } ?>
                        <div class="col-lg-6 col-12">
                           <div class="EventDetail-content">
                              <div class="EventLabel">
                                 <p>
                                    <span>News</span>
                                    <span><?=$newsdate;?></span>
                                 </p>
                              </div>
                             <?php if(!empty($newsName)){ ?> <h2><?=$newsName;?></h2><?php } ?>
                              <?php if(!empty($newsShortDesc)){ ?><p class="mt-4"><?=$newsShortDesc;?></p><?php } ?>
                           </div>
                        </div>
                   </div>
            </div>
         </section>

         <!-- section -->
         <section class="NewsDetail-content space pt-0">
            <div class="container">
				<div class="row">
					<div class="col-lg-7 col-12 mx-auto">
						<div class="NewsContent-box">

						<?php
							$content = get_the_content();
							$read_time = display_read_time($content);
						?>

						<div class="sharejob-main post-time">
							<p><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $read_time; ?> min read</p>
							<div class="share-job">
							   <ul class="share-area">
								  <li><a target="_blank" href="https://twitter.com/share?url=<?=get_the_permalink();?>&text=<?=$newsName;?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
								  <li><a target="_blank" href="https://www.facebook.com/sharer.php?u=<?=get_the_permalink();?>&t=<?=$newsName;?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								  <li><a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?=get_the_permalink();?>&t=<?=$newsName;?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
								  <li><a onclick="copyToClipboard('#copy_link')"href="javascript:void(0)"><i class="fa fa-link" aria-hidden="true"></i></a></li>
							   </ul>
							</div>
						</div>

                        <div class="resource-library__article-main" style="padding-top: 0px;">
                        <div class="page-content article__main-content">
						<?php the_content();?>

						<!--<div class="news-video Our-Videos-section">

								<a href="#" class="popup-youtube">
									<div class="PopupHead">
										<span>Video</span>
										<h3>News title lorem ipsum dolor sit ament undes</h3>
									</div>
									<div class="video-box wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
										<img src="<?=get_template_directory_uri()?>/assets/images/news/pexels-cottonbro.png">
										<div class="video-box-icon">
											<img src="<?=get_template_directory_uri()?>/assets/images/news/play.png">
											<span></span>
										</div>

									</div>
									<p><i>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy.</i></p>
								</a>
       						</div> -->

						</div>
                        </div>
                        </div>

						</div>
					</div>
				</div>
            </div>
         </section>


		 <!-- Related News -->
		  <section class="Related-news space pt-0">
			<div class="container">

				<div class="row">
					<div class="col-12">
						<div class="heading-pnel text-center">
							<h2>Related Content</h2>
						</div>
					</div>
				</div>

				<div class="row">
					<?php
						wp_reset_postdata();

						/* Condition for category based related post
						$cat_ids = array();
						$categories = array();
						$taxonomy  = 'news_region';
						$categories = get_terms($taxonomy, array('hide_empty' => false));

						if(!empty($categories) && !is_wp_error($categories)):
							foreach ($categories as $category):
								array_push($cat_ids, $category->term_id);
							endforeach;
						endif;
						*/
						$current_post_type = get_post_type($newsId);

						$query_args = array(
							//'category__in'   => $cat_ids,
							'post_type'      => $current_post_type,
							'post__not_in'    => array($newsId),
							'posts_per_page'  => '4',
						);
						$related_cats_post = new WP_Query( $query_args );

						if($related_cats_post->have_posts()):
							while($related_cats_post->have_posts()): $related_cats_post->the_post(); ?>
								<div class="col-lg-3 col-md-6 col-sm-6 col-12">
									<div class="R-news-box">
										<figure>
											<img src="<?php echo get_the_post_thumbnail_url(); ?>" class="w-100" alt="" />
										</figure>
										<figcaption>
											<span>News</span>
											<a href="<?php the_permalink() ?>"><h4><?php the_title(); ?></h4></a>
										</figcaption>
									</div>
								</div>
						<?php endwhile;
						endif;
						wp_reset_postdata();
					?>
				</div>
            </div>
         </section>


         <!-- Strip -->
        <?php get_template_part( 'template-parts/content/footer-section' ); ?>
      </main>
<p id="copy_link" style="display:none;"><?php echo get_the_permalink(); ?></p>
<input type="hidden" placeholder="" />
<?php get_footer(); ?>
<script>
function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
}
</script>

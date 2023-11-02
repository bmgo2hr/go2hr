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
						


						<div class="sharejob-main post-time">
							<p><i class="fa fa-clock-o" aria-hidden="true"></i> 3 min read</p>
							<div class="share-job">
							   <ul>
								  <li><a target="_blank" href="https://twitter.com/share?url=<<?=get_the_permalink();?>>&text=<<?=$newsName;?>>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
								  <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<<?=get_the_permalink();?>>&t=<<?=$newsName;?>>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								  <li><a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<<?=get_the_permalink();?>>&t=<<?=$newsName;?>>""><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
								  <li><a target="_blank" href="#"><i class="fa fa-link" aria-hidden="true"></i></a></li>
							   </ul>
							</div>
						</div>
						
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
         </section>

         <!-- Strip -->
        <?php get_template_part( 'template-parts/content/footer-section' ); ?>
		
      </main>

<?php get_footer();

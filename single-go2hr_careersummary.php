<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
  */


get_header();

?>


<main class="inr-page Training-page Recruit-page" id="careerSummary">
    <!-- banner -->
    <section class="inr-banner" style="background-image: url(<?=the_post_thumbnail_url()?>);">
        <div class="container h-100">
           <div class="row h-100">
              <div class="col-lg-7 col-md-9  col-sm-12 col-12 h-100">
                 <div class="banner_top_title  wow fadeInUp h-100" style="visibility: visible; animation-name: fadeInUp;">
                    <h1><?php echo $pageHeading ?? get_the_title();?></h1>
                 </div>
              </div>
           </div>
        </div>
     </section>

    <!-- Breadcrumb -->
    <section class="Breadcrumb-go2 mt-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="pagination-box">
                        <ul>
                            <li><a href="<?=get_site_url();?>">Home</a></li>
                            <li><a href="#">For Workers</a></li>
                            <li><span><?php echo get_the_title();?></span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="share-job">
                       <ul class="justify-content-lg-end">
                            <li><a target="_blank" href="https://twitter.com/share?url=<?=get_the_permalink();?>&text=<?=$newsName;?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a target="_blank" href="https://www.facebook.com/sharer.php?u=<?=get_the_permalink();?>&t=<?=$newsName;?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?=get_the_permalink();?>&t=<?=$newsName;?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            <li><a onclick="copyToClipboard('#copy_link')"href="javascript:void(0)"><i class="fa fa-link" aria-hidden="true"></i></a></li>
                       </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- career summary -->
    <section id="career-summary" class="mt-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-12"><?php echo the_content(); ?></div>
            </div>
        </div>
    </section>

    <!-- career responsibilities-->
    <section class="career-responsibilities mt-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="mb-5">Responsibilities</h2>
                    <?php echo the_field("career_responsibilities"); ?>
                </div>
            </div>
        </div>
    </section>

    <!-- career knowledge, skills and abilities -->
    <section class="career-skills mt-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="mb-5">Knowledge, Skills and Abilities</h2>
                    <?php echo the_field("career_skills"); ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Possible future career paths -->
    <section class="career-paths mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="mb-5">Possible Future Career Paths</h2>
                    <?php echo the_field("career_paths"); ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer section -->
    <section class="blue-strip bg-blue">
        <div class="container">
            <div class="row">
                 <div class="col-lg-8 col-md-10 col-12 mx-auto">
                     <div class="heading-pnel fff text-center m-0">
                        <h2>Explore Jobs</h2>
                         <p>The leading free job board for tourism and hospitality jobs in BC. From front line customer service to culinary/trades/technical to senior executive positions, BC’s vibrant tourism and hospitality industry offers a variety of occupations. Whatever your career goals are, the go2HR Job board can help get you there.</p>
                        <a href="https://www.go2hr.ca/job-board" class="green-btn">View Our Job Board<i class="fa fa-angle-right" aria-hidden="true"></i></a>
                      </div>
                   </div>
            </div>
        </div>
    </section>


</main>

<?php

/*
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
					<div class="col-lg-3 col-md-6 col-sm-6 col-12">
						<div class="R-news-box">
							<figure>
								<img src="<?=get_template_directory_uri()?>/assets/images/news/nd-1.png" class="w-100" alt="" />
							</figure>
							<figcaption>
								<span>News</span>
								<a href="#"><h4>Lorem ipsum dolor sit amet, consetetur.</h4></a>
							</figcaption>
						</div>
					</div>

					<div class="col-lg-3 col-md-6 col-sm-6 col-12">
						<div class="R-news-box">
							<figure>
								<img src="<?=get_template_directory_uri()?>/assets/images/news/nd-2.png" class="w-100" alt="" />
							</figure>
							<figcaption>
								<span>News</span>
								<a href="#"><h4>Lorem ipsum dolor sit amet, consetetur.</h4></a>
							</figcaption>
						</div>
					</div>

					<div class="col-lg-3 col-md-6 col-sm-6 col-12">
						<div class="R-news-box">
							<figure>
								<img src="<?=get_template_directory_uri()?>/assets/images/news/nd-3.png" class="w-100" alt="" />
							</figure>
							<figcaption>
								<span>News</span>
								<a href="#"><h4>Lorem ipsum dolor sit amet, consetetur.</h4></a>
							</figcaption>
						</div>
					</div>

					<div class="col-lg-3 col-md-6 col-sm-6 col-12">
						<div class="R-news-box">
							<figure>
								<img src="<?=get_template_directory_uri()?>/assets/images/news/nd-4.png" class="w-100" alt="" />
							</figure>
							<figcaption>
								<span>News</span>
								<a href="#"><h4>Lorem ipsum dolor sit amet, consetetur.</h4></a>
							</figcaption>
						</div>
					</div>
				</div>
            </div>
         </section>


         <!-- Strip -->
        <?php get_template_part( 'template-parts/content/footer-section' ); ?>

      </main>

<?php
*/
?>
<p id="copy_link" style="display:none;"><?php echo get_the_permalink(); ?></p>
<input type="hidden" placeholder="" />
<?php get_footer();
?>
<script>
function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
}
</script>


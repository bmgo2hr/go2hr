<?php
/**
 * The main template file
 *
  * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
  */
$pageHeading = get_field('page_heading',14);
$PageBanner = get_field('banner_image',14);

get_header(); ?>

<main class="inr-page Training-page NewsPage" id="NewsPage">
         <!-- banner -->
		 <?php if(!empty($PageBanner)){ ?>
         <section class="inr-banner" style="background-image: url(<?=$PageBanner;?>);">
            <div class="container">
               <div class="row">
                  <div class="col-lg-7 col-md-9 col-sm-12 col-12">
                     <div class="banner_top_title  wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <h1><?php echo ($pageHeading)? $pageHeading : get_the_title(14);?></h1>
                     </div>
                  </div>
               </div>
            </div>
         </section><?php } ?>
		 
         <!-- Breadcrumb -->
         <section class="Breadcrumb-go2">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="pagination-box">
                        <ul>
                           <li><a href="<?=get_site_url();?>">Home</a></li>
                           <li><a href="#">About Us</a></li>
                           <li><span><?php echo ($pageHeading)? $pageHeading : get_the_title(14);?></span></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- section  -->
         <section class="NewsSec space " >
            <div class="container">
			
              <!-- <div class="event-filter">
                  <div class="row">
                     <div class="col-7">
                        <div class="heading-pnel line-head">
                           <h2>2022</h2>
                        </div>
                     </div>
                     <div class="col-5 text-right">
                        <a href="#" class="green-btn"><img src="<?=get_template_directory_uri()?>/assets/images/events/filter.png" class="" width="19" /> Filter by Year</a>
                     </div>
                  </div>
               </div> -->
			   
               <div class="News_listing">
                  <!-- row -->
                  <div class="row">
                     <!-- box -->
					  <?php 
						$news = new WP_Query(array('post_type' => 'post','post_status' =>'publish','posts_per_page' => 3,'orderby' => 'date','order' => 'DESC')); // getting all blog news
						  if ( $news -> have_posts() ) {
							
						  while ( $news -> have_posts() ) { $news -> the_post();
						  
						  $newsName = get_the_title();
						  $newsShortDesc = get_the_excerpt();
						  $newsImg = get_the_post_thumbnail_url();
						  $newsdate = get_the_date('M d, Y');
						 if(!empty($newsImg)){
				        ?>
                     <div class="col-lg-4 col-md-6 col-12 item">
                        <div class="News-box">
                           <?php if(!empty($newsImg)){ ?><figure>
                              <img src="<?=$newsImg;?>" class="w-100" alt="" />
                           </figure><?php } ?>
                           <figcaption>
                             <?php if(!empty($newsName)){ ?> <a href="<?=get_the_permalink();?>">
                                 <h3><?=$newsName;?></h3>
							 </a><?php } ?>
                              <h4><?=$newsdate;?></h4>
                              <?php if(!empty($newsShortDesc)){ ?><p><?=$newsShortDesc;?></p><?php } ?>
                              <a href="<?=get_the_permalink();?>" class="btn-border">Read More</a>
                           </figcaption>
                        </div>
						  </div><?php } } } wp_reset_postdata();?>
                     
                  <div class="row">
                     <div class="col-12">
                        <div class="ViewAll-row text-center mt-0">
                           <button class="green-btn lm">Load more <i class="fa fa-angle-right" aria-hidden="true"></i></button>
                        </div>
                     </div>
                  </div>
				  
               </div>
            </div>
			 </div>
         </section>
      </main>

<?php get_footer(); ?>

<script>

$(function() {
  var colEl = $('.item').length,
    loadedEl = 3,
    start = 3,
    loadPo = 3;

  for (var i = 0; i < start; i++) {
    $('.item').eq(i).css('display', 'block');
  }

  $('.lm').on('click', loadMore);

  function loadMore() {
    if (colEl - loadedEl < loadPo) loadPo = colEl - loadedEl;
    for (var i = 1; i <= loadPo; i++) {
      $('.item').eq(loadedEl).fadeIn(400);
      loadedEl = loadedEl + 1;
    }
    if (colEl - loadedEl === 0) $(this).hide();
  }
});

</script>
<?php
/**
 * Template Name: Team-template
 *
  */
$pageId = get_the_ID();
$pageHeading = get_field('page_heading',$pageId);

get_header();?>

<!-- header end -->
      <main class="inr-page Training-page" id="Speakers">
			
		<?php get_template_part( 'template-parts/content/inner-page-banner' ); ?>
		
		<!-- Breadcrumb -->
		
		<section class="Breadcrumb-go2">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="pagination-box">
                     <ul>
                        <li><a href="<?=get_site_url();?>">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><span><?php echo ($pageHeading)? $pageHeading : get_the_title();?></span></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </section>

		
         <!-- section -->
         <section class="Speakers-listing-sec space">
            <div class="container">
			<?php $pageContent = get_the_content(); if(!empty($pageContent)){ ?>
               <div class="row">
                  <div class="col-lg-8 col-12 mx-auto">
                     <div class="heading-pnel text-center">
                        <?php the_content();?>
						</div>
                  </div>
			</div><?php } ?>
			
                     <div class="row align-items-center justify-content-center">
					 <?php 
						$team = new WP_Query(array('post_type' => 'team','post_status' =>'publish','posts_per_page' => -1,'orderby' => 'date','order' => 'DESC')); // getting all training resources
						if ( $team -> have_posts() ) {
							$flg = 0;
						while ( $team -> have_posts() ) { $team -> the_post();
						  
						  $memberName = get_the_title();
						  $memberShortDesc = get_the_excerpt();
						  $memberImg = get_the_post_thumbnail_url();
						  $flg++;
				        ?>
                        <div class="col-lg-3 col-md-6 col-12">
                           <div class="Speaker-box">
                             <?php if(!empty($memberImg)){ ?> <figure>
                                 <a href="#" data-toggle="modal" data-target="#SpeakerInfo<?=$flg;?>"><img src="<?=$memberImg;?>" class="" alt="" /></a>
							 </figure><?php } ?>
                              <figcaption>
                                 <?php if(!empty($memberName)){ ?><a href="#" data-toggle="modal" data-target="#SpeakerInfo<?=$flg;?>"><h4><?=$memberName;?></h4></a><?php } ?>
                                <?php if(!empty($memberShortDesc)){ ?> <p><?=$memberShortDesc;?></p><?php } ?>
                              </figcaption>
                           </div>
                        </div>
						<?php } } wp_reset_postdata();?>


            </div>
         </section>

      </main>
	  
	
<!-- Modal -->
<?php 
	$teams = new WP_Query(array('post_type' => 'team','post_status' =>'publish','posts_per_page' => -1,'orderby' => 'date','order' => 'DESC')); // getting all training resources
	if ( $teams -> have_posts() ) {
		$flag = 0;
	while ( $teams -> have_posts() ) { $teams -> the_post();
	  
	  $membersName = get_the_title();
	  $membersDesc = get_the_content();
	  $membersImg = get_the_post_thumbnail_url();
	  $flag++;
	?>
<div class="modal fade SpeakerInfo" id="SpeakerInfo<?=$flag;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			<div class="Speaker-info-box">
				<?php if(!empty($membersImg)){ ?><figure>
					<img src="<?=$membersImg;?>" alt="" class="w-100" />
				</figure><?php } ?>
				<figcaption>
					<?php if(!empty($membersName)){ ?><h3><?=$membersName;?></h3><?php } ?>
					<?php (!empty($membersDesc))? the_content() : '';?>
				</figcaption>
			</div>
      </div>
    </div>
  </div>
	</div><?php } } wp_reset_postdata();?>


<?php get_footer();

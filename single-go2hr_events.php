<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
  */

$eventImg = get_the_post_thumbnail_url();
$eventName = get_the_title();
$eventShortDesc = get_the_content();

$eventStartTime = get_field('event_start_time');
$eventEndTime = get_field('event_end_time');
$eventStartDate = get_field('event_start_date');

$address = get_field('event_address');
$city = get_field('event_city');

$date = date("D, M d", strtotime($eventStartDate));

$eventEndDate = get_field('event_end_date');
if(!empty($eventEndDate)){
   $end_date = date("D, M d", strtotime($eventEndDate));
   $date = $date." - ".$end_date;
}
$eventVenueName = get_field('event_venue_name');
$button = get_field('button');

$eventAboutText = get_field('about_text');

get_header(); ?>

 <main class="inr-page Training-page Recruit-page" id="EventDetail">
         <!-- section -->
         <section class="EventDetail-sec space">
            <div class="container">
               <div class="row">
                  <div class="col-lg-11 col-12 mx-auto">
                     <div class="row align-items-center">
                        <div class="col-lg-7 col-12">
                           <div class="EventDetail-content">
                              <div class="EventLabel">
                               <!--  <p>
                                    <span>Webinar</span>
                                    <span>July 15, 2021</span>
                                 </p> -->
                              </div>
                             <?php if(!empty($eventName)){ ?> <h2><?=$eventName;?></h2><?php } ?>
                              <div class="EventTime">
                                 <p>
                                     <span><?=$date;?></span>

                                     <?php if (!empty($eventStartTime)) : ?>
                                     <br><span><?php echo ($eventStartTime)? $eventStartTime : '';?> - <?php echo ($eventEndTime)? $eventEndTime : '';?></span>
                                     <?php endif; ?>
                                     <br><span><?=$eventVenueName;?> </span>
                                     <?php if (!empty($address) && !empty($city)) : ?>
                                     <br><span><?=$address;?>, <?=$city;?></span>
                                     <?php endif; ?>
                                 </p>
                              </div>
                              <p><?php echo ($eventShortDesc)? $eventShortDesc : '';?></p>
                             <?php if(!empty($button)){ ?> <a href="<?php echo ($button["url"])? $button["url"] : '#';?>" class="green-btn" target="_blank"><?=$button["title"];?> <i class="fa fa-angle-right" aria-hidden="true"></i></a><?php } ?>
                           </div>
                        </div>
						<?php if(!empty($eventImg)){ ?>
                        <div class="col-lg-5 col-12 Img_Outer">
                           <div class="EventDetail-img">
                              <img src="<?=$eventImg;?>" class="w-100" alt="" />
                           </div>
                        </div>
						<?php } ?>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- section -->
        <?php if(!empty($eventSpeakerHeading) && have_rows('speakers') > 0){ ?>
        <section class="Speakers-listing-sec space">
            <div class="container">
               <div class="row">
                  <div class="col-lg-11 col-12 mx-auto">
                     <div class="heading-pnel">
                        <h2><?=$eventSpeakerHeading;?></h2>
                     </div>
                  </div>
			    </div>
               <div class="row">
                  <div class="col-lg-11 col-12 mx-auto">
                     <div class="row align-items-center">
					 <?php
						 $tmp =0;
						 while( have_rows('speakers') ){ the_row();

						  $speakerName = get_sub_field('speaker_name');
						  $speakerShortDesc = get_sub_field('speaker_short_description');
						  $speakerImg = get_sub_field('speaker_image');

						 if(!empty($speakerImg)){    $tmp++;
						?>
                        <div class="col-lg-4 col-md-6 col-12">
                           <div class="Speaker-box">
                              <?php if(!empty($speakerImg)){ ?><figure>
                                 <a href="#" data-toggle="modal" data-target="#SpeakerInfo<?=$tmp;?>"><img src="<?=$speakerImg;?>" class="" alt="" /></a>
                              </figure><?php } ?>
                              <figcaption>
                                 <?php if(!empty($speakerName)){ ?><a href="#" data-toggle="modal" data-target="#SpeakerInfo"><h4><?=$speakerName;?></h4></a><?php } ?>
                                 <?php if(!empty($speakerName)){ ?><p><?=$speakerShortDesc;?></p><?php } ?>
                              </figcaption>
                           </div>
                         </div>
					   <?php } } ?>

                     </div>
                  </div>
               </div>
            </div>
         </section>
         <?php } ?>
         <!-- section -->
		 <?php if(!empty($eventAboutText)){ ?>
        <div class="page-content">
        <section class="space bg-grey">
            <div class="container">
               <div class="row">
                  <div class="col-lg-11 col-12 mx-auto">
                     <div class="row align-items-center">
                        <div class="col-12">
                           <div class="EventDetail-content">
                              <?=$eventAboutText;?>
							  </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
        </div>
		 <?php } ?>
         <!-- Strip -->

        <?php get_template_part( 'template-parts/content/footer-section' ); ?>

<!-- Modal -->
<?php if(have_rows('speakers')){
 $temp =0;
 while( have_rows('speakers') ){ the_row();

  $speakerName = get_sub_field('speaker_name');
  $speakerShortDesc = get_sub_field('speaker_short_description');
  $speakerDesc = get_sub_field('speaker_description');
  $speakerImg = get_sub_field('speaker_image');

 if(!empty($speakerImg)){    $temp++;
?>
<div class="modal fade" id="SpeakerInfo<?=$temp;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			<div class="Speaker-info-box">
				<?php if(!empty($speakerImg)){ ?><figure>
					<img src="<?=$speakerImg;?>" alt="" class="w-100" />
				</figure><?php } ?>
				<figcaption>
					<?php if(!empty($speakerName)){ ?><h3><?=$speakerName;?></h3><?php } ?>
					<?php if(!empty($speakerName)){ ?><h4><?=$speakerShortDesc;?></h4><?php } ?>
					<?php echo ($speakerDesc)? $speakerDesc : '';?>
				</figcaption>
			</div>
      </div>
    </div>
  </div>
</div>
<?php } } } ?>

<?php get_footer();

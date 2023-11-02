<?php
/**
 * Template Name: Event Resources-template
 *
 */
$pageId = get_the_ID();
$pageHeading = get_field('page_heading',$pageId);

get_header();?>

 <main class="inr-page Training-page" id="Events_res">
         <!-- banner -->
         <?php get_template_part( 'template-parts/content/inner-page-banner' ); ?>

         <!-- Breadcrumb -->
         <section class="Breadcrumb-go2">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="pagination-box">
                        <ul>
                           <li><a href="<?=get_page_link(8);?>">Home</a></li>
                           <li><span><?php echo ($pageHeading)? $pageHeading : get_the_title();?></span></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </section>

        <div class="page-content">
         <!-- grid -->
         <section class="WEbinar-video space" >
            <div class="container">
			<?php $content = get_the_content(); if(!empty($content)){ ?>
               <div class="row">
                  <div class="col-lg-10 col-12 mx-auto">
                     <div class="heading-pnel line-head text-center">
                       <?php the_content();?>
					   </div>
                  </div>
			</div><?php } ?>
			<?php $section1Heading = get_field('section_1_heading'); if(!empty($section1Heading)){ ?>
               <div class="row">
                  <div class="col-12 mx-auto">
                     <div class="heading-pnel text-center">
                        <h4 class="green-text mt-4"><?=$section1Heading;?></h4>
                     </div>
                  </div>
			</div><?php } ?>
               <div class="row justify-content-center">
			    <?php
			    if(have_rows('section_1_content')){
				while( have_rows('section_1_content') ){ the_row();

				  $contentTitle = get_sub_field('content_heading');
				  $contentDesc = get_sub_field('content_description');

				  if(!empty($contentTitle) || !empty($contentDesc)){
				?>
                  <div class="col-md-5 col-sm-6 col-12 pr-0">
                     <div class="value-box benefit-box D-radius">
                        <figcaption>
				         <?php if(!empty($contentTitle)){ ?><h5 class="check"><?=$contentTitle;?></h5><?php } ?>
                           <?php if(!empty($contentDesc)){ ?><p><?=$contentDesc;?></p><?php } ?>
                        </figcaption>
                     </div>
                  </div>
				<?php } } } ?>

               </div>
            </div>
         </section>

		<!-- section  -->
		<section class="WEbinar-video space bg-blue" >
            <div class="container">
               <div class="row">
                  <div class="col-12 mx-auto">
                     <div class="heading-pnel fff text-center">
                        <h2>Search for Resources</h2>
                     </div>
                  </div>
               </div>



			   <div class="row">
                  <div class="col-lg-8 col-md-9 col-12 mx-auto">
						<div class="resource-search-form">

							<form action="<?php echo home_url();?>/explore-all-resources" method="get" id="resource-search-form">
								<label>I need advice related to</label>
								<!--<select class="form-control" name="type">
									<option value="">All Sectors</option>
									<?php
										$eventCat = get_terms('resource_type');
										if(!empty($eventCat)){
										foreach($eventCat as $cat){ ?>
										<option value="<?=$cat->term_id;?>"><?=$cat->name;?></option>
										<?php } } ?>
								</select>
								<label>in</label>
								<select class="form-control" name="sector">
									<option value="">All Sectors</option>
									<?php
										$eventCat = get_terms('resource_sector');
										if(!empty($eventCat)){
										foreach($eventCat as $cat){ ?>
										<option value="<?=$cat->term_id;?>"><?=$cat->name;?></option>
										<?php } } ?>
								</select>
								<label>and need advice related to</label>-->
								<select class="form-control" name="topic">
									<option value="">Select a Topic</option>
									<?php
										$eventCat = get_terms('resource_topic');
										if(!empty($eventCat)){
										foreach($eventCat as $cat){ ?>
										<option value="<?=$cat->term_id;?>"><?=$cat->name;?></option>
										<?php } } ?>
								</select>
								<label>about Select a</label>
								<select class="form-control" name="resource_subtopic">
									<option value=""> SubTopic</option>
									<?php
										$eventCat = get_terms('subtopic');
										if(!empty($eventCat)){
										foreach($eventCat as $cat){ ?>
										<option value="<?=$cat->term_id;?>"><?=$cat->name;?></option>
										<?php } } ?>
								</select>
							</form>

						</div>
                  </div>
               </div>




			    <div class="row mt-5">
                  <div class="col-12 text-center">
					<a onclick="$('#resource-search-form').submit();" href="javascript:void(0);" class="green-btn"><span class="fa fa-search" aria-hidden="true"></span> &nbsp;&nbsp;Search <i class="fa fa-angle-right" aria-hidden="true"></i></a>
				 </div>
				</div>


            </div>
         </section>


		 <!-- sectipon -->
         <section class="long-sec double-sec space pb-0">
            <div class="container">
			<?php $section2Heading = get_field('section_2_heading'); if(!empty($section2Heading)){ ?>
               <div class="row">
                  <div class=" col-12 mx-auto">
                     <div class="heading-pnel line-head">
                        <h2><?=$section2Heading;?></h2>
                     </div>
                  </div>
			</div><?php } ?>
			   <!-- Box -->
			   <?php
			   if(have_rows('topics')){
				while( have_rows('topics') ){ the_row();

				  $topicName = get_sub_field('topic_name');
				  $topicDesc = get_sub_field('topic_description');
				  $topicBtntext = get_sub_field('topic_view_all_button_text');
				  $topicBtntLink = get_sub_field('topic_view_all_button_link');

				  $topicKey = get_sub_field('key_topic_heading');

				  if(!empty($topicName) || !empty($topicDesc)){
				?>
               <div class="long-main-box pnel-zig long-full-width">
                  <div class="row no-gutters">
                     <div class="col-12">
                        <!-- box -->
                        <div class="D-radius full-w-cont">
                           <div class="double-side">
                              <div class="long-left-content">
                                 <?php if(!empty($topicName)){ ?><h3><?=$topicName;?></h3><?php } ?>
                                 <?php echo ($topicDesc)? $topicDesc : '';?>
                                 <?php if(!empty($topicBtntext)){ ?><a href="<?php echo ($topicBtntLink)? $topicBtntLink : '#';?>" class="btn-border"><?=$topicBtntext;?></a><?php } ?>
                              </div>
                              <div class="long-right-content">
                                 <div class="row">
                                    <div class="col-12">
                                       <div class="tab-grid-content ">
                                          <?php if(!empty($topicKey)){ ?><h4 class="ml-5 pl-3"><?=$topicKey;?></h4><?php } ?>
                                          <div class="Recruit-list">
										     <?php
												if(have_rows('key_topics')){
												while( have_rows('key_topics') ){ the_row();

												  $keyTitle = get_sub_field('topic');
												  $keyURL = get_sub_field('topic_url');

												  if(!empty($keyTitle)){
												?>
												 <div class="Recruit-list-item">
													<h3>
													   <a href="<?php echo ($keyURL)? $keyURL : '#';?>">
														<span class="icon-light"><img src="<?=get_template_directory_uri()?>/assets/images/recruit/arrow-light.svg"></span>
														  <span class="icon-dark"><img src="<?=get_template_directory_uri()?>/assets/images/recruit/arrow.svg"></span>
														  <p><?=$keyTitle;?></p>

													   </a>
													</h3>
												 </div>
												<?php } } } ?>

                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

			<?php } } } ?>

            </div>
         </section>


		<!-- section  -->
		<section class="events_sec space pt-0" >
            <div class="container">
			 <div class="events_listing D-radius">
			 <?php $section3Heading = get_field('section_3_heading'); if(!empty($section3Heading)){ ?>
               <div class="row">
                  <div class="col-12 mx-auto">
                     <div class="heading-pnel">
                        <h2><?=$section3Heading;?></h2>
                     </div>
                  </div>
			 </div><?php } ?>

				   <div class="row">
					   <div class="col-12">

					   <?php
					   $date_now = date('Y-m-d H:i:s');
					   $args= array(
						  'posts_per_page'	=> 4,
						  'post_type'			=> 'go2hr_events',
						  'meta_query' 		=> array(
							 'relation' 			=> 'AND',
							 array(
								  'key'			=> 'event_start_date',
								  'compare'		=> '>=',
								  'value'			=> $date_now,
								  'type'			=> 'DATETIME'
							  )
						   ),
						  'order'				=> 'ASC',
						  'orderby'			=> 'meta_value',
						  'meta_key'			=> 'event_start_date',
						  'meta_type'			=> 'DATE'
						  );
					   $latestEvent = new WP_Query($args);
				        if ( $latestEvent -> have_posts() ) {
						   while ( $latestEvent -> have_posts() ) { $latestEvent -> the_post();

							$eventTitle = get_the_title();
							$eventShortDesc = get_the_excerpt();
							$eventDate = get_field('event_start_date');
							$eventLink = get_the_permalink();

							$month = @date("F", strtotime($eventDate));
							$date = @date("d", strtotime($eventDate));
							$year = @date("Y", strtotime($eventDate));

						?>
						  <div class="event-box">
							 <div class="blog-date">
								<h4><span><?=$month;?></span> <?=$date;?></h4>
							 </div>
							 <figcaption>
								<?php if(!empty($eventTitle)){ ?><h3><a href="<?=get_permalink();?>"><?=$eventTitle;?><span class="icon-light"><img src="<?=get_template_directory_uri()?>/assets/images/blue-arrow.svg"></span></a></h3><?php } ?>
								<?php if(!empty($eventShortDesc)){ ?><p><?=$eventShortDesc;?></p><?php } ?>
							 </figcaption>
						  </div>
						<?php } } wp_reset_postdata(); ?>

					   </div>
				   </div>


				   <div class="row">
					<div class="col-12">
						<div class="ViewAll-row text-center">
							<a href="<?php echo home_url(); ?>/events-calendar" class="btn-border">View Events Calender</a>
						</div>
					</div>
				</div>

				</div>

            </div>
         </section>

		 <!-- newsletter -->
		<section class="space pt-0 Newsletter-section">
			<div class="container">

               <div class="row">
			   <?php
			   if(have_rows('section_4_rows')){ $flg = 0;
				while( have_rows('section_4_rows') ){ the_row();

				  $rowImage = get_sub_field('row_image');
				  $rowName = get_sub_field('row_name');
				  $rowDesc = get_sub_field('row_content');
				  $rowBtntext = get_sub_field('row_button_text');
				  $rowBtntLink = get_sub_field('row_button_link');

				  if(!empty($rowName) || !empty($rowDesc)){ $flg++;
				?>
				<div class="col-lg-6 col-12">
					 <div class="newsletter-main">
					<div class="letter-box text-center">
						 <?php if(!empty($rowImage)){ ?><div class="Newsletter-image">
							<img src="<?=$rowImage;?>" class="newsletter">
						 </div><?php } ?>
						<div class="Newsletter-form">
                        <div class="heading-pnel mb-5 fff <?php if($flg==1) echo 'text-left'; ?>">
                           <?php if(!empty($rowName)){ ?><h3><?=$rowName;?></h3><?php } ?>
                          <?php echo ($rowDesc)? $rowDesc : '';?>
                        </div><?php if($flg == 1){ ?>
                        <form method="">
                            <div class="Newsletter-box">
                                <a href="/newsletters" type="submit" class="btn btn-default subscribe region-subscribe">Subscribe</a>
                            </div>
                        </form>
						<?php }else{ if(!empty($rowBtntext)){ ?>
						<div class="col-12 text-center">
							<a href="<?php echo ($rowBtntLink)? $rowBtntLink : '#';?>" class="green-btn"><?=$rowBtntext;?> <i class="fa fa-angle-right" aria-hidden="true"></i></a>
						 </div>
						<?php } } ?>
                     </div>
					</div>
				</div>
               </div>
			   <?php } } } ?>

            </div>
         </div>
      </section>
        </div>
      </main>

<?php get_footer();

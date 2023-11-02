<?php
/**
 * Template Name: Sexual-harassment-template
 *
 */
$pageId = get_the_ID();
$pageHeading = get_field('page_heading',$pageId);

get_header();?>

 <!-- header end -->
      <main class="inr-page Training-page Recruit-page SaferSpaceTab sexual-harassment" id="Recruit">

		  <?php get_template_part( 'template-parts/content/inner-page-banner' ); ?>
         <!-- Breadcrumb -->
         <section class="Breadcrumb-go2">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="pagination-box">
                        <ul>
                           <li><a href="<?=get_site_url();?>">Home</a></li>
                           <li><a href="/health-safety">Health & Safety</a></li>
                           <li><span><?php echo ($pageHeading)? $pageHeading : get_the_title();?></span></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- Warinng Strip -->
		 <?php
		  $section1Title = get_field('section_1_title');
		  $section1Desc = get_field('section_1_description');
		  $section1Image = get_field('section_1_image');
		  if(!empty($section1Title) || !empty($section1Desc)){
		 ?>
         <div class="page-content">
         <section class="WarningStrip">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="warning-strip-box">
                        <?php if(!empty($section1Image)){ ?><div class="Warning-icon">
                           <img src="<?=$section1Image;?>" class="" alt="" />
                        </div><?php } ?>
                        <div class="WarningContent">
                           <?php if(!empty($section1Title)){ ?><h4><?=$section1Title;?></h4><?php } ?>
                           <?php echo ($section1Desc)? $section1Desc : '';?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
		  </section><?php }

		  $section2Title = get_field('section_2_title');
		  $section2Desc = get_field('section_2_description');
		  $section2Image = get_field('section_2_image');
		  if(!empty($section2Title) || !empty($section2Desc)){
		  ?>
         <!-- section -->
         <section class="space pb-0">
            <div class="container">
               <div class="row">
                  <div class="col-lg-9 col-md-10 col-12 mx-auto">
                     <div class="benefit-box servay-strip D-radius">
                        <figcaption>
                           <?php if(!empty($section2Image)){ ?><figure>
                              <img src="<?=$section2Image;?>" class="" alt="">
                           </figure><?php } ?>
                           <div class="servay-content">
                              <?php if(!empty($section2Title)){ ?><h4><?=$section2Title;?> </h4><?php } ?>
                              <?php echo ($section2Desc)? $section2Desc : '';?>
                           </div>
                        </figcaption>
                     </div>
                  </div>
               </div>
            </div>
         </section><?php }

		  $section3Title = get_field('section_3_heading');
		  $section3Desc = get_field('section_3_description');
		  $section3Image = get_field('section_3_image');
		  if(!empty($section3Title) || !empty($section3Desc)){
		 ?>
         <!-- section -->
         <section class="long-sec safer-space space">
            <div class="container">
               <div class="long-main-box">
                  <div class="row align-items-center">
                     <div class="<?php echo ($section3Image)? 'col-lg-7' : 'col-lg-12';?> col-md-12">
                        <div class="outimg-center">
                           <?php if(!empty($section3Title)){ ?><h4 class="mb-3"><?=$section3Title;?></h4><?php } ?>
                           <?php echo ($section3Desc)? $section3Desc : '';?>
                        </div>
                     </div>
                     <?php if($section3Image){ ?><div class="col-lg-5 col-md-12 mx-auto">
                        <div class="">
                           <figure>
                              <img src="<?=$section3Image;?>" class="w-100" alt="" />
                           </figure>
                        </div>
                     </div><?php } ?>
                  </div>
               </div>
            </div>
		  </section><?php } ?>
         <!-- section -->
         <section class="CanHelp-sec space pt-0">
            <div class="container">
			<?php $section4Heading = get_field('section_4_heading'); if(!empty($section4Heading)){ ?>
               <div class="row">
                  <div class="col-12">
                     <div class="heading-pnel line-head text-center">
                        <h2><?=$section4Heading;?></h2>
                     </div>
                  </div>
			   </div><?php } ?>

               <div class="theme-tabs">
                  <div class="row">
				  <?php
				  $section4Tab1Name = get_field('section_4_tab_1_name');
				  $section4Tab2Name = get_field('section_4_tab_2_name');
				  ?>
                     <div class="col-lg-10 col-md-10 col-12 mx-auto">
                        <ul class="nav nav-tabs" role="tablist">
                          <?php if(!empty($section4Tab1Name)){ ?> <li class="nav-item">
                              <a class="nav-link active" data-toggle="tab" href="#Attraction" role="tab"><?=$section4Tab1Name;?></a>
						  </li><?php } if(!empty($section4Tab2Name)){ ?>
                           <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#Sourcing" role="tab"><?=$section4Tab2Name;?></a>
						  </li><?php } ?>
                        </ul>
                        <!-- Tab panes -->
                     </div>
                  </div>
                  <!-- tab content -->
                  <div class="tab-content">
                     <!-- tab one -->
                     <div class="tab-pane fade active" id="Attraction" role="tabpanel">
                        <div class="OnlineTraining-Tab">
                           <div class="row">
						    <?php
							  $section4Tab1Img1 = get_field('section_4_tab1__image_1');
							  $section4Tab1Desc1 = get_field('section_4_tab1_description_1');
							  if(!empty($section4Tab1Img1) || !empty($section4Tab1Desc1)){
							  ?>
                              <div class="col-lg-6 col-md-6 col-12">
                                 <div class="OT-box D-radius">
                                    <?php if(!empty($section4Tab1Img1)){ ?><figure>
                                       <img src="<?=$section4Tab1Img1;?>" class="" alt="">
                                    </figure><?php } if(!empty($section4Tab1Desc1)){ ?>
                                    <figcaption>
                                       <?=$section4Tab1Desc1;?>
                                    </figcaption><?php } ?>
                                 </div>
                              </div><?php }
							  $section4Tab1Img2 = get_field('section_4_tab1__image_2');
							  $section4Tab1Desc2 = get_field('section_4_tab1_description_2');
							  if(!empty($section4Tab1Img2) || !empty($section4Tab1Desc2)){
							  ?>
                              <div class="col-lg-6 col-md-6 col-12">
                                 <div class="OT-box D-radius">
                                   <?php if(!empty($section4Tab1Img2)){ ?> <figure>
                                       <img src="<?=$section4Tab1Img2;?>" class="" alt="">
                                    </figure><?php } if(!empty($section4Tab1Desc2)){ ?>
                                    <figcaption>
                                       <?=$section4Tab1Desc2;?>
                                    </figcaption><?php } ?>
                                 </div>
                              </div><?php } ?>

                           </div>
                        </div>
                     </div>
                     <!-- tab two -->
                     <div class="tab-pane fade" id="Sourcing" role="tabpanel">
					<?php
					  $section4Tab2MainHeading = get_field('section_4_tab2_main_heading');
					  $section4Tab2Heading = get_field('section_4_tab2_heading');
					  ?>
					 <div class="CampaignSec">
						<?php if(!empty($section4Tab2MainHeading)){ ?><p class="text-center"><?=$section4Tab2MainHeading;?></p><?php } ?>
						<div class="Campaign-main D-radius">
							<div class="SetWidthPnel">
								<?php if(!empty($section4Tab2Heading)){ ?><h4><?=$section4Tab2Heading;?></h4><?php }

							 if(have_rows('section_4_tab_description')){
								while( have_rows('section_4_tab_description') ){ the_row();
								  $tabIcon = get_sub_field('description_icon');
								  $tabText = get_sub_field('description_text');
								  if(!empty($tabIcon) || !empty($tabText)){
								?>
								<div class="Campaign-box">
									<?php if(!empty($tabIcon)){ ?><img src="<?=$tabIcon;?>" alt="" class="" /><?php } ?>
									<?php if(!empty($tabText)){ ?><p><?=$tabText;?></p><?php } ?>
							 </div><?php } } } ?>

							</div>
						</div>
					 </div>


                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- section -->
         <section class="whyCare-sec space bg-grey">
            <div class="container">
			<?php  $section5Heading = get_field('section_5_heading'); if(!empty($section5Heading)){ ?>
               <div class="row">
                  <div class="col-12">
                     <div class="heading-pnel text-center">
                        <h2><?=$section5Heading;?></h2>
                     </div>
                  </div>
			</div><?php } ?>
               <div class="row">
			   <?php
			   if(have_rows('section_5_content')){
				while( have_rows('section_5_content') ){ the_row();
				  $section5Icon = get_sub_field('section_5_icon');
				  $section5Text = get_sub_field('section_5_text');
				  if(!empty($section5Icon) || !empty($section5Text)){
			   ?>
                  <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                     <div class="whycare-box text-center">
                        <?php if(!empty($section5Icon)){ ?><figure>
                           <img src="<?=$section5Icon;?>" class="" alt="" />
                        </figure><?php } if(!empty($section5Text)){ ?>
                        <p><?=$section5Text;?></p><?php } ?>
                     </div>
			   </div><?php } } } ?>

				  <?php  $section5Notes = get_field('section_5_notes'); if(!empty($section5Notes)){ ?>
                  <div class="col-12">
                     <div class="web-link-box">
                        <?=$section5Notes;?>
                     </div>
                  </div><?php } ?>
               </div>
            </div>
         </section>
         <!-- grid -->
         <section class="training-prog-sec space" >
            <div class="container-fluid">
			<?php  $section6Heading = get_field('section_6_heading'); if(!empty($section6Heading)){ ?>
               <div class="row">
                  <div class="col-12">
                     <div class="heading-pnel line-head">
                        <h2><?=$section6Heading;?></h2>
                     </div>
                  </div>
			</div><?php } ?>

         <div class="row">
				<div class="col-12">
					<div class="training-prog-main">
					<?php get_template_part( 'template-parts/content/cor/sb-resources1' ); ?>

					</div>
					</div>
					</div>

				</div>

            </div>
         </section>


         <section class="NeedHelp-sec space pt-0">
            <div class="container-fluid">
               <div class="row">
			   <?php  $section7Img = get_field('section_7_image'); if(!empty($section7Img)){ ?>
                  <div class="col-lg-6 col-md-12 col-12 Img_Outer">
                     <div class="tab-grid-img">
                        <img src="<?=$section7Img;?>" alt="" class="w-100">
                     </div>
			      </div><?php } ?>
                  <div class="col-lg-6 col-md-12 col-12">
                     <div class="tab-grid-content pr-5">
					 <?php  $section7Heading = get_field('section_7_heading');
					 $section7Desc = get_field('section_7_description');
					 if(!empty($section7Heading) || !empty($section7Heading)){ ?>
                        <div class="ml-5 pl-3">
                           <?php if(!empty($section7Heading)){  ?><h4 class="mb-3"><?=$section7Heading;?></h4><?php } ?>
                           <?php echo ($section7Desc)? $section7Desc : '';?>
					     </div><?php } ?>
                        <div class="Recruit-list">
						<?php
						   if(have_rows('section_7_item_lists')){
							while( have_rows('section_7_item_lists') ){ the_row();
							  $section7ItemLink = get_sub_field('item_link');
							  $section7ItemName = get_sub_field('item_name');
							  if(!empty($section7ItemName) || !empty($section7ItemLink)){
						   ?>
                           <div class="Recruit-list-item">
                              <h3>
                                 <a href="<?php echo ($section7ItemLink)? $section7ItemLink : '';?>">
                                    <?php if(!empty($section7ItemName)){ ?><p><?=$section7ItemName;?></p><?php } ?>
                                    <span class="icon-light"><img src="<?=get_template_directory_uri()?>/assets/images/recruit/arrow-light.svg"></span>
                                    <span class="icon-dark"><img src="<?=get_template_directory_uri()?>/assets/images/recruit/arrow.svg"></span>
                                 </a>
                              </h3>
						   </div><?php } } } ?>

                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <?php get_template_part( 'template-parts/content/footer-section' ); ?>
         </main>
      </main>


<?php get_footer();

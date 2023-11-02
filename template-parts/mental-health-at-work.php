<?php
/**
 * Template Name: MH-at-work-template
 *
 */
$pageId = get_the_ID();
$pageHeading = get_field('page_heading',$pageId);

get_header();?>

 <!-- header end -->

      <main class="inr-page Training-page Recruit-page mental-health" id="Recruit">

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

        <div class="page-content">
         <!-- section -->
        <?php $aboutContent = get_the_content(); if($aboutContent){ ?>
         <section class="full-content space">
            <div class="container">
               <div class="row">
                  <div class="col-lg-10 col-12 mx-auto">
                     <div class="heading-pnel line-head text-center m-0">
                        <?php the_content();?>
                     </div>
                  </div>
               </div>
            </div>
         </section>
        <?php } ?>
         <!-- section -->
         <section class="grey-strip space bg-grey">
            <div class="container">
               <div class="grey-strip-box">
                  <div class="row align-items-center">
					<?php
					$section1Heading = get_field('section_1_heading',$pageId);
					$section1Desc = get_field('section_1_description',$pageId);
					$section1Img = get_field('section_1_image',$pageId);
					?>
                     <div class="col-lg-4 col-md-3 col-12">
                        <?php if($section1Img){ ?><figure>
                           <img src="<?=$section1Img;?>" class="" alt="" />
                        </figure><?php } ?>
                     </div>
                     <div class="col-lg-8 col-md-9 col-12">
                        <figcaption>
                          <?php if($section1Heading){ ?> <h4><?=$section1Heading;?></h4><?php } ?>
                           <?php echo ($section1Desc)? $section1Desc : '';?>
                        </figcaption>
                     </div>
				 </div>
               </div>
            </div>
         </section>
         <!-- section -->
         <section class="CanHelp-sec space">
            <div class="container-fluid p-0">
               <div class="row">
                <?php
					$section2Heading = get_field('section_2_heading',$pageId); if($section2Heading){ ?>
                  <div class="col-12">
                     <div class="heading-pnel line-head text-center">
                        <h2><?=$section2Heading;?></h2>
                     </div>
                  </div>
					<?php } ?>
               </div>
               <div class="theme-tabs">
                  <div class="row">
                     <div class="col-lg-9 col-md-10 col-12 mx-auto">
					<?php
                     $section2Tab1Name = get_field('tab1_accordian_name',$pageId);
					 $section2Tab2Name = get_field('tab2_accordian_name',$pageId);
					 $section2Tab3Name = get_field('tab3_accordian_name',$pageId);
					 ?>
                        <ul class="nav nav-tabs" role="tablist">
                          <?php if($section2Tab1Name){ ?> <li class="nav-item">
                              <a class="nav-link active" data-toggle="tab" href="#Attraction" role="tab"><?=$section2Tab1Name;?></a>
						  </li><?php } if($section2Tab2Name){ ?>
                           <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#Sourcing" role="tab"><?=$section2Tab2Name;?></a>
                           </li><?php } if($section2Tab3Name){ ?>
                           <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#Selection" role="tab"><?=$section2Tab3Name;?></a>
                           </li><?php } ?>
                        </ul>
                        <!-- Tab panes -->
                     </div>
                  </div>
                  <!-- tab content -->

                  <div class="tab-content">
                     <!-- tab one -->
                     <div class="tab-pane fade active" id="Attraction" role="tabpanel">
                        <!-- grid -->
                        <section class="long-sec safety-basic-long" >
                           <div class="container-fluid p-0">
                              <div class="row no-gutters">
                                 <div class="col-lg-6 col-md-12 Img_Outer">
                                 <?php $section2Tab1Img = get_field('tab1_accordian_image',$pageId); if($section2Tab1Img){ ?>
                                    <div class="long-img">
                                       <img src="<?=$section2Tab1Img;?>" alt="" class="w-100" />
                                    </div>
								 <?php } ?>
                                 </div>
                                 <div class="col-lg-6 col-md-12">
                                <div class="long-content D-radius">
                                 <?php $section2Tab1Desc1 = get_field('tab1_accordian_description_1',$pageId);
								      echo ($section2Tab1Desc1)? $section2Tab1Desc1 : '';?>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </section>

		 <!-- section -->
         <section class="long-sec double-sec without-img space">
            <div class="container-fluid ">
               <div class="long-main-box">
                  <div class="row no-gutters">
                     <div class="col-lg-7 col-md-12 mx-auto">
                        <div class="D-radius">
                           <div class="outimg-center">
                              <?php $section2Tab1Desc2 = get_field('tab1_accordian_description_2',$pageId);
								  echo ($section2Tab1Desc2)? $section2Tab1Desc2 : ''; ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
         </section>

	 <!-- section -->
         <section class="team-sec">
         <div class="row no-gutters">
         <div class="col-lg-7 col-md-12 mx-auto">
         <div class="heading-pnel">
        <?php $section2Tab1Desc3 = get_field('tab1_accordian_description_3',$pageId);
			echo ($section2Tab1Desc3)? $section2Tab1Desc3 : ''; ?>
         </div>
         <div class="row">
         <!-- box -->
		 <?php get_template_part( 'template-parts/content/coaches' ); ?>
           </div>
         </div>
         </div>
         </section>

                     </div>

                     <!-- tab two -->
                     <div class="tab-pane fade" id="Sourcing" role="tabpanel">
					 <!-- section -->
					 <section class="long-sec double-sec without-img space pt-0">
						<div class="container-fluid">
						   <div class="long-main-box">
							  <div class="row no-gutters">
								 <div class="col-lg-6 col-md-12 mx-auto">
									<div class="D-radius">
									   <div class="outimg-center">
										  <?php $section2Tab2Desc1 = get_field('tab2_accordian_description_1',$pageId);
								              echo ($section2Tab2Desc1)? $section2Tab2Desc1 : ''; ?>
									   </div>
									</div>
								 </div>
							  </div>
						   </div>
					 </section>


		<section class="long-sec double-sec space pt-0">
            <div class="container">

                 <?php get_template_part( 'template-parts/content/training/mental-health-courses' ); ?>

            </div>
         </section>

	</div>

                  <!-- tab three  More Mental Health Resources & Helpful Links-->




            <div class="tab-pane fade" id="Selection" role="tabpanel">
					 <section class="long-sec double-sec space pt-0">
						<div class="container-fluid p-0">

						   <div class="long-main-box pnel-zag safety-zag">
							  <div class="row no-gutters">
								 <div class="col-lg-7 col-md-12 Img_Outer">
                              <?php $section2Tab3Img = get_field('tab3_accordian_image',$pageId); if($section2Tab3Img){ ?>
									<div class="long-img">
									   <img src="<?=$section2Tab3Img;?>" alt="" class="w-100">
									</div>
							  <?php } ?>
								 </div>
								 <div class="col-lg-5 col-md-12">
									<div class="long-content D-radius">
										 <?php $section2Tab3Desc1 = get_field('tab3_accordian_description_1',$pageId);
								            echo ($section2Tab3Desc1)? $section2Tab3Desc1 : ''; ?>
									</div>
								 </div>
							  </div>
						   </div>
						</div>
					 </section>

					 <section class="Helpful-links">
						<div class="container">
							<div class="row">
								<div class="col-12">
									<div class="heading-pnel text-center">
										<?php $section2Tab3Desc2 = get_field('tab3_accordian_description_2',$pageId);
								             echo ($section2Tab3Desc2)? $section2Tab3Desc2 : ''; ?>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-4 col-md-4 col-sm-12">
									<div class="helpful-link-sidebar D-radius">

                                 <!-- Tab menu -->
                                 <?php if( have_rows('starting_the_conversation') ): $count = 0;?>
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                                       <?php while( have_rows('starting_the_conversation') ) : the_row(); $count ++?>

                                          <a class="nav-link <?php echo ($count == 1)? 'active' : ''; ?>" id="v-pills-<?php echo $count ?>-tab" data-toggle="pill" href="#v-pills-<?php echo $count ?>" role="tab" aria-controls="v-pills-<?php echo $count ?>" aria-selected="true"><?php echo get_sub_field('title_tab')?></a>


                                       <?php endwhile;?>

                                    </div>
                                 <?php endif;?>
                           </div>
								</div>

                     <!-- tab content -->

                     <?php if( have_rows('starting_the_conversation') ): $count1 = 0;?>

                        <div class="col-lg-8 col-md-8 col-sm-12">
                           <div class="Helpful-link-table">
                              <div class="Recruit-list">

                                 <div class="tab-content" id="v-pills-tabContent">

                                       <?php while( have_rows('starting_the_conversation') ) : the_row(); $count1 ++;?>
                                             <?php
                                                   if( have_rows('starting_the_conversation_sub') ): ?>
                                                    <div class="tab-pane fade <?php echo ($count1 == 1)? 'show active' : ''; ?>" id="v-pills-<?php echo $count1 ?>" role="tabpanel" aria-labelledby="v-pills-<?php echo $count1 ?>-tab">
                                                      <?php while( have_rows('starting_the_conversation_sub') ) : the_row(); ?>


                                                         <div>

                                                               <div class="Recruit-list-item">
                                                                  <h3>

                                                                  <?php
                                                                     $link = get_sub_field('link');
                                                                     if( $link ):
                                                                        $link_url = $link['url'];
                                                                        $link_title = $link['title'];
                                                                        $link_target = $link['target'] ? $link['target'] : '_self';
                                                                        ?>

                                                                        <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                                                           <p><?php echo get_sub_field('title')?></p>
                                                                           <i> <?php echo get_sub_field('categoy')?></i>

                                                                           <span class="icon-light"><img src="<?=get_template_directory_uri();?>/assets/images/recruit/arrow-light.svg"></span>
                                                                           <span class="icon-dark"><img src="<?=get_template_directory_uri();?>/assets/images/recruit/arrow.svg"></span>
                                                                        </a>

                                                                     <?php endif; ?>


                                                                  </h3>
                                                               </div>

                                                         </div>

                                                <?php
                                                   endwhile; ?>
                                                </div>
                                                <?php endif;
                                                ?>

                                          <?php endwhile;?>
                                 </div>

                              </div>
                           </div>
                     </div>

               <?php endif;?>



								<!-- <div class="col-lg-8 col-md-8 col-sm-12">
									<div class="Helpful-link-table">
									<div class="Recruit-list">
									<?php if(have_rows('acccordian_description_4')){
										 while( have_rows('acccordian_description_4') ){ the_row();

										  $fld1 = get_sub_field('field1');
										  $fld2 = get_sub_field('field2');
										  $fldLink = get_sub_field('field_link');
										?>
										<div class="Recruit-list-item">
											<h3>
											<a href="<?php echo ($fldLink)? $fldLink : '#';?>">
												<?php if(!empty($fld1)){ ?><p><?=$fld1;?></p><?php } ?>
												<?php if(!empty($fld2)){ ?><i><?=$fld2;?></i><?php } ?>
												<span class="icon-light"><img src="<?=get_template_directory_uri();?>/assets/images/recruit/arrow-light.svg"></span>
												<span class="icon-dark"><img src="<?=get_template_directory_uri();?>/assets/images/recruit/arrow.svg"></span>
											</a>
											</h3>
										</div>
									<?php } } ?>

									</div>
									</div>
								</div> -->

							</div>

						</div>
					 </section>

					 </div>
                  </div>
               </div>
            </div>
         </section>
         </div>

         <!-- section -->
	  <?php get_template_part( 'template-parts/content/footer-section' ); ?>
      </main>


<?php get_footer();

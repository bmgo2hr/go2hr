<div class="long-main-box pnel-zig long-full-width">
                  <div class="row no-gutters">
                     <div class="col-12">

                        <!-- box -->
						<?php if(have_rows('mental_health_courses')){
							  while( have_rows('mental_health_courses') ){ the_row();
							  $courseHeading1 = get_sub_field('course_heading_1');
							  $courseHeading2 = get_sub_field('course_heading_2');

							  $courseDesc1 = get_sub_field('course_description_1');
							  $courseDesc2 = get_sub_field('course_description_2');

							  $course1BtnText = get_sub_field('description_1_button_text');
							  $course1BtnLink = get_sub_field('description_1_button_link');
							?>
                        <div class="D-radius full-w-cont">
                           <div class="double-side">
						   <div class="long-left-content">
						   <?php if(!empty($courseHeading1)){ ?><h3><?=$courseHeading1;?></h3><?php } ?>
                                 <?php echo !empty($courseDesc1)? $courseDesc1 : '';?>
								<?php if(!empty($course1BtnText)){ ?> <div class="long-btn"><a class="green-btn" href="<?php echo ($course1BtnLink)? $course1BtnLink : '#';?>" target="_blank"><?=$course1BtnText;?> <i class="fa fa-angle-right" aria-hidden="true"></i></a></div><?php } ?>
							</div>
                              <div class="long-right-content">
							  <?php if(!empty($courseHeading2)){ ?><h4><?=$courseHeading2;?></h4><?php } ?>
                                  <?php echo !empty($courseDesc2)? $courseDesc2 : '';?>
                              </div>

                           </div>
                        </div>
					<?php } } ?>

                     </div>
                  </div>
               </div>

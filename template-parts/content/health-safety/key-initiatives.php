
 <div class="row">
					   <?php if(have_rows('key_initiatives')){
						     while( have_rows('key_initiatives') ){ the_row();
							  
							  $keyImg = get_sub_field('key_initiatives_image');
							  $keyHeading = get_sub_field('key_initiatives_heading');
							  $keyDesc = get_sub_field('key_initiatives_description');
							  
							  $keyBtnText = get_sub_field('key_initiatives_button_text');
							  $keyBtnLink = get_sub_field('key_initiatives_button_link');
							  if(!empty($keyImg)){   
							?>
                              <div class="col-lg-6 col-md-6 col-12">
                                 <div class="OT-box D-radius">
                                    <figure>
                                       <img src="<?=$keyImg;?>" class="" alt="">
                                    </figure>
                                    <figcaption>
                                       <?php if(!empty($keyHeading)){ ?><h4><?=$keyHeading;?></h4><?php } ?>
                                       <?php if(!empty($keyDesc)){ ?><?=$keyDesc;?><?php } ?>
									  <?php if(!empty($keyBtnText)){ ?> <a class="green-btn" href="<?php echo ($keyBtnLink)? $keyBtnLink : '';?>"><?=$keyBtnText;?> <i class="fa fa-angle-right" aria-hidden="true"></i></a><?php } ?>
									   </figcaption>
                                 </div>
					   </div><?php } } } ?>
                              
                           </div>
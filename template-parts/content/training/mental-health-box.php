<?php if(have_rows('box_data')){
				   $count = count(get_field("box_data"));
					while( have_rows('box_data') ){ the_row();
					  $boxTitle = get_sub_field('box_heading');
					  $boxDesc = get_sub_field('box_description');
					  
					  if($count == 2){ ?>
				        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
					  <?php } else if($count == 3){ ?>
					  <div class="col-lg-4 col-md-6 col-sm-6 col-12">
					  <?php } else if($count == 4){ ?>
					  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
					  <?php } else if($count == 5){ ?>
					  <div class="col-lg-2 col-md-6 col-sm-6 col-12">
					  <?php } else if($count == 6){ ?>
					  <div class="col-lg-2 col-md-6 col-sm-6 col-12"> <?php } ?>
					  
                     <div class="counter-box">
                        <?php if(!empty($boxTitle)){ ?><h4 class="count-no"><?=$boxTitle;?></h4><?php } ?>
                        <?php if(!empty($boxDesc)){ ?><p><?=$boxDesc;?></p><?php } ?>
                     </div>
			        </div><?php } } ?>
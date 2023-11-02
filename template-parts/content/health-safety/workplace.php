<?php  
 if(have_rows('section_5_sub_sections')){
				$flg = 0;
				while( have_rows('section_5_sub_sections') ){ the_row();
				$flg ++;
				  $Img = get_sub_field('sub_section_image');
				  $heading1 = get_sub_field('sub_section_heading_1');
				  $heading2 = get_sub_field('sub_section_heading_2');

				  $desc1 = get_sub_field('sub_section_content-1');
				  $desc2 = get_sub_field('sub_section_content-2');

				  $btnText = get_sub_field('sub_section_1_button_text');
				  $btnLink = get_sub_field('sub_section_1_button_link');
				  if(!empty($Img)){  
				?>

				<div class="long-main-box">
					<div class="container-fluid px-0">
						<div class="row justify-content-center">
							<div class="bg-outside">
								<div class="background col-12">
									<div class="bg-in" style="background: url('<?=$Img;?>'); background-position: <?php echo ($flg%2==0)? 'left' : 'right';?>; right:<?php echo ($flg%2==0)? '0' : '';?>" ></div>
										<div class="col-md-12 col-lg-8 <?php echo ($flg%2==0)? '' : 'offset-lg-4';?>  col-12 long-content__block p-5">
											<div class=" text-white p-5">
											<!-- Content -->
		 										<div class="row">
													<div class="col-md-6 col-12">
														<?php  if(!empty($heading1)){ ?> <h3><?=$heading1;?></h3><?php } ?>

														<?php echo ($desc1)? $desc1 : '';?>
														<?php  if(!empty($btnText)){ ?> <div class="long-btn"><a class="green-btn" href="<?php echo ($btnLink)? $btnLink : '';?>"><?=$btnText;?> <i class="fa fa-angle-right" aria-hidden="true"></i></a>
														</div> <?php } ?>

													</div>
													<div class="col-md-6 col-12 long-right__block">
														<div class="">
														<?php echo $flg;?>
															<?php if(!empty($heading2)){ ?><h4><?=$heading2;?></h4><?php } ?>
															<?php echo ($desc2)? $desc2 : '';?>
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


				

			<!-- <div class="long-main-box pnel-<?php echo ($flg%2==0)? 'zig' : 'zag';?>">
					<div class="row no-gutters">
					<div class="col-lg-7 col-md-12 Img_Outer">
					<div class="long-img long-img-<?php echo ($flg - 1); ?>">
						<img src="<?=$Img;?>" alt="" class="w-100" />
					</div>
				</div>
				<div class="col-lg-5 col-md-12">
					<div class="long-content D-radius">
					<div class="double-side">
					<div class="long-left-content">
					<?php  if(!empty($heading1)){ ?> <h3><?=$heading1;?></h3><?php } ?>
					<?php echo ($desc1)? $desc1 : '';?>
					<?php  if(!empty($btnText)){ ?> <div class="long-btn"><a class="green-btn" href="<?php echo ($btnLink)? $btnLink : '';?>"><?=$btnText;?> <i class="fa fa-angle-right" aria-hidden="true"></i></a>
					</div><?php } ?>

					</div>
							<div class="long-right-content">
							<?php if(!empty($heading2)){ ?><h4><?=$heading2;?></h4><?php } ?>
								<?php echo ($desc2)? $desc2 : '';?>
							</div>

						</div>
					</div>
				</div>

				</div>
			</div> -->
		 <?php } } } ?>

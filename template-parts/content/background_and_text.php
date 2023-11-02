<?php  
 if(have_rows('background_and_text')){
				$flg = 0;
				while( have_rows('background_and_text') ){ the_row();
				$flg ++;
				
                $section1Heading = get_sub_field('section_1_heading');
				$section1Desc = get_sub_field('section_1_description');
				$section1Img = get_sub_field('section_1_image');
				$section1Link = get_sub_field('section_1_button_link');

				  if(!empty($section1Img)){  
				?>

				<div class="long-main-box">
					<div class="container-fluid px-0">
						<div class="row justify-content-center">
							<div class="bg-outside">
								<div class="background col-12">
									<div class="bg-in" style="background: url('<?=$section1Img;?>'); background-position: <?php echo ($flg%2==0)? 'left' : 'right';?>; right:<?php echo ($flg%2==0)? '0' : '';?>" ></div>
										<div class="col-md-8 <?php echo ($flg%2==0)? '' : 'offset-md-4';?>  col-12 long-content__block p-5">
											<div class=" text-white p-md-5 p-0">
											<!-- Content -->
		 										<div class="row">
													<div class="col-md-12 col-12">
														<?php  if(!empty($section1Heading)){ ?> <h3 class="mb-4"><?=$section1Heading;?></h3><?php } ?>

														<?php echo ($section1Desc)? $section1Desc : '';?>

														<?php if(!empty($section1Link)){ ?> 

															<?php 
																	if( $section1Link ): 
																		$link_url = $section1Link['url'];
																		$link_title = $section1Link['title'];
																		$link_target = $section1Link['target'] ? $section1Linkk['target'] : '_self';
																		?>

																		<div class="long-btn">
																			<a class="green-btn" target="<?php echo esc_attr( $link_target ); ?>" href="<?php echo esc_url( $link_url ); ?>"><?php echo esc_html( $link_title ); ?>
																				<i class="fa fa-angle-right" aria-hidden="true"></i>
																			</a>
																			</div> 

																	<?php endif; ?>
																?>

                                                        
														<?php } ?> 

													</div>
													<!-- <div class="col-md-6 col-12 long-right__block">
														<div class="">
														<?php echo $flg;?>
															<?php if(!empty($heading2)){ ?><h4><?=$heading2;?></h4><?php } ?>
															<?php echo ($desc2)? $desc2 : '';?>
														</div>
													</div> -->
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

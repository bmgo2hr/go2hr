<?php 
						$cr = new WP_Query(array('post_type' => 'cor-articles','post_status' =>'publish','posts_per_page' => 4,'orderby' => 'date','order' => 'DESC'));
						 if ( $cr -> have_posts() ) {
						   while ( $cr -> have_posts() ) { $cr -> the_post(); 
						
						    $crTitle = get_the_title();
				            $crShortDesc = get_the_excerpt();
							$img = get_the_post_thumbnail_url();
						?>
						<div class="training-prog-box">
							<?php if($img){ ?><figure>
								<img src="<?=$img;?>" class="w-100" />
							</figure><?php } ?>
							<span class="P-label">Accomodation Resources</span>
							<?php if($crTitle){ ?><h4><?=$crTitle;?></h4><?php } ?>
							<?php if($crShortDesc){ ?><p><?=$crShortDesc;?></p><?php } ?>
							<a href="#" class="btn-border">Read More</a>
						</div>
						 <?php } } wp_reset_postdata();?>
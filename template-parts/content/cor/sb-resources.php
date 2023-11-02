<?php
						$sb = new WP_Query(array('post_type' => 'sb-resources','post_status' =>'publish','posts_per_page' => 8,'orderby' => 'date','order' => 'DESC'));
						 if ( $sb -> have_posts() ) {
						   while ( $sb -> have_posts() ) { $sb -> the_post();

						    $sbTitle = get_the_title();
							$post_id = get_the_ID();
				            $sbShortDesc = get_the_excerpt();
							$sbimg = get_the_post_thumbnail_url();
						    $term_name = get_the_term_list( $post_id, 'sb_type', '', ', ' );


						?>
						<div class="training-prog-box">
							<span class="P-label"><a href=""><?=$term_name;?></a></span>
							<?php if(!empty($sbTitle)){ ?><h4><?=$sbTitle;?></h4><?php } ?>
							<?php if(!empty($sbShortDesc)){ ?><p><?=$sbShortDesc;?></p><?php } ?>
							<a href="#" class="btn-border">Read More</a>
						</div>
					 <?php } } wp_reset_postdata();?>

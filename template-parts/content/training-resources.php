<div class="row">
				<div class="col-12">
					
					<div class="training-prog-main">
					<?php 
					$trs = new WP_Query(array('post_type' => 'training-resources','post_status' =>'publish','posts_per_page' => 6,'orderby' => 'date','order' => 'DESC')); // getting all training resources
					if ( $trs -> have_posts() ) {
					while ( $trs -> have_posts() ) { $trs -> the_post();
	              
				  $eventTitle = get_the_title();
				  $eventShortDesc = get_the_excerpt();
				  $eventImg = get_the_post_thumbnail_url();
				  $term_name = get_the_term_list( $post_id, 'tr_type', '', ', ' );
				        ?>
						<div class="training-prog-box">
						   <?php if(!empty($eventImg)){ ?><figure>
								<img src="<?=$eventImg;?>" alt="" class="w-100">
						   </figure><?php } ?>
							<?php if(!empty($term_name)){ ?><span class="P-label"><a href=""><?=$term_name;?></a></span><?php } ?>
							<?php if($eventTitle){ ?><h4><?=$eventTitle;?></h4><?php } ?>
							<?php if($eventShortDesc){ ?><p><?=$eventShortDesc;?></p><?php } ?>
							<a href="#" class="btn-border">Read More</a>
						</div>
						<?php } } wp_reset_postdata(); ?>
					
					</div>
					
					</div>
			</div>
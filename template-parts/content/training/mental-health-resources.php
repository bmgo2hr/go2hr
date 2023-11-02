<div class="row">
                  <div class="col-12">
                     <div class="training-prog-main">
					 <?php
						$mhr = new WP_Query(array('post_type' => 'mh-resource','post_status' =>'publish','posts_per_page' => 6,'orderby' => 'date','order' => 'DESC'));
						 if ( $mhr -> have_posts() ) {
						   while ( $mhr -> have_posts() ) { $mhr -> the_post();

						    $mhrTitle = get_the_title();
				            $mhrShortDesc = get_the_excerpt();
							$term_name = get_the_term_list( $post_id, 'mhr_type', '', ', ' );
						?>
                        <div class="training-prog-box">
						<span class="P-label"><a href=""><?=$term_name;?></a></span>
                           <?php if($mhrTitle) { ?><h4><?=$mhrTitle;?></h4><?php } ?>
                           <?php if($mhrShortDesc){ ?><p><?=$mhrShortDesc;?></p><?php } ?>
                           <a href="#" class="btn-border">Read More</a>
                        </div>
						<?php } } wp_reset_postdata();?>

                     </div>
                  </div>
               </div>

<div class="row">
                  <div class="col-12">
                     <div class="training-prog-main">
					 <?php
					  $crs = new WP_Query(array('post_type' => 'resource','post_status' =>'publish','posts_per_page' => 8,'orderby' => 'date','order' => 'DESC'));
					  if ( $crs -> have_posts() ) {
					   while ( $crs -> have_posts() ) { $crs -> the_post();

						$crsTitle = get_the_title();
						$crsShortDesc = get_the_excerpt();
						$crsimg = get_the_post_thumbnail_url();
						?>
                        <div class="training-prog-box">
                           <span class="P-label">Ski Resources</span>
                           <?php if(!empty($crsTitle)){ ?><h4><?=$crsTitle;?></h4><?php } ?>
                           <?php if(!empty($crsShortDesc)){ ?><p><?=$crsShortDesc;?></p><?php } ?>
                           <a href="#" class="btn-border">Read More</a>
                        </div>
					  <?php } } wp_reset_postdata();?>

                     </div>
                  </div>
               </div>

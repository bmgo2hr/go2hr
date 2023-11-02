<div class="row">
                  <div class="col-12">
                     <div class="training-prog-main">
					 <?php 
					  $frs = new WP_Query(array('post_type' => 'featured-resourses','post_status' =>'publish','posts_per_page' => 8,'orderby' => 'date','order' => 'DESC'));
					  if ( $frs -> have_posts() ) {
					   while ( $frs -> have_posts() ) { $frs -> the_post(); 
					
						$frsTitle = get_the_title();
						$frsShortDesc = get_the_excerpt();
						$frsimg = get_the_post_thumbnail_url();
						$term_name = get_the_term_list( $post_id, 'fr_type', '', ', ' ); 
						?>
                        <div class="training-prog-box">
						    <?php if(!empty($frsimg)){ ?><figure>
								<img src="<?=$frsimg;?>" class="w-100" />
							</figure><?php } ?>
                           <?php if(!empty($term_name)){ ?><span class="P-label"><a href=""><?=$term_name;?></a></span><?php } ?>
                           <?php if(!empty($frsTitle)){ ?><h4><?=$frsTitle;?></h4><?php } ?>
                           <?php if(!empty($frsShortDesc)){ ?><p><?=$frsShortDesc;?></p><?php } ?>
                           <a href="#" class="btn-border">Read More</a>
                        </div>
					  <?php } } wp_reset_postdata();?>
											
                     </div>
                  </div>
               </div>
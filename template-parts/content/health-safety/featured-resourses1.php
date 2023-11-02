<div class="row">
                  <div class="col-12">
                     <div class="training-prog-main">
                    <?php
                        $resources = get_field('resources');
                    ?>
                    <?php if(!empty($resources)) : ?>
                    <?php foreach($resources as $resource) : ?>
                    <?php
                        $term_name =  get_the_term_list( $resource->ID, 'fr_type', '', ', ' );

                        $frsTitle = $resource->post_title;
                        $frsShortDesc = $resource->post_excerpt;
                        $image_attr = wp_get_attachment_image_src(get_post_thumbnail_id($resource->ID), "medium");
                        $frsimg = $image_attr[0];
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
					  <?php endforeach; ?>
                     <?php endif; ?>
                     </div>
                  </div>
               </div>

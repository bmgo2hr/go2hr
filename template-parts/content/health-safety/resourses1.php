<div class="row">
                  <div class="col-12">
                     <div class="training-prog-main">
					  <?php
                          $resources = get_field('resources');
                      ?>
                    <?php if(!empty($resources)) : ?>
                    <?php foreach($resources as $resource) : ?>
                    <?php
                        $term_name =  get_the_term_list( $resource->ID, 'resource_category', '', ', ' );
                        $crsTitle = $resource->post_title;
                        $crsShortDesc = $resource->post_excerpt;
//                        $image_attr = wp_get_attachment_image_src(get_post_thumbnail_id($resource->ID), "medium");
//                        $crsimg = $image_attr[0];
                    ?>
                        <div class="training-prog-box">
                           <span class="P-label"><?=$term_name;?></span>
                           <?php if(!empty($crsTitle)){ ?><h4><?=$crsTitle;?></h4><?php } ?>
                           <?php if(!empty($crsShortDesc)){ ?><p><?=$crsShortDesc;?></p><?php } ?>
                           <a href="#" class="btn-border">Read More</a>
                        </div>
					  <?php endforeach; ?>
                      <?php endif; ?>
                     </div>
                  </div>
               </div>

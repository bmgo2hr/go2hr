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

                        $eventTitle = $resource->post_title;
                        $eventShortDesc = $resource->post_excerpt;
                        $image_attr = wp_get_attachment_image_src(get_post_thumbnail_id($resource->ID), "medium");
                        $eventImg = $image_attr[0];
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
					<?php endforeach; ?>
					<?php endif; ?>
					</div>

					</div>
			</div>

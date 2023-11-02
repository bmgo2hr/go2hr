                        <?php
                            $resources = get_field('resources');
                            ?>
                        <?php if (!empty($resources)) : ?>
                        <?php foreach ($resources as $resource) : ?>
						<?php
						    $rrTitle = $resource->post_title;
				            $rrShortDesc = $resource->post_excerpt;
				            $term_name =  get_the_term_list( $resource->ID, 'rr_type', '', ', ' );
						?>
						<div class="training-prog-box">
							<span class="P-label"><?= $term_name; ?></span>
							<?php if($rrTitle){ ?><h4><?=$rrTitle;?></h4><?php } ?>
							<?php if($rrShortDesc){ ?><p><?=$rrShortDesc;?></p><?php } ?>
							<a href="#" class="btn-border">Read More</a>
						</div>
                        <?php endforeach;?>
                        <?php endif; ?>

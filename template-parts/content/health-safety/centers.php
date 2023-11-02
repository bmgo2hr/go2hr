<div class="row justify-content-center">
					<div class="outimg-center">
							<ul class="links-listing text-center">
							<?php if(have_rows('outing_center')){
								while( have_rows('outing_center') ){ the_row();
								  $centerTitle = get_sub_field('center_name');
								  $centerLink = get_sub_field('center_link');
								  if(!empty($centerTitle)){
							    ?>
							<li style="color: #014f9a; font-size: 1.6rem;"><?=$centerTitle;?></li><?php } } } ?>

						    </ul>
						</div>

			</div>

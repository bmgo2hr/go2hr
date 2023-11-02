<div class="row no-gutters">
	<div class="col-12">
		<div class="feature-main">
					<?php if( have_rows('slider') ): ?>
					<div id="Dashbaord" class="owl-carousel owl-theme">
					<?php while( have_rows('slider') ): the_row();
						$image = get_sub_field('slider_image');
						?>
							<img src="<?php echo $image; ?>" alt="">
					<?php endwhile; ?>
					</div>
				<?php endif; ?>
				<hr>
				<?php if(!empty($args['note'])) : ?>
				<div class="text-right"><?php echo $args['note']; ?></div>
				<?php endif; ?>
		</div>
	</div>
</div>

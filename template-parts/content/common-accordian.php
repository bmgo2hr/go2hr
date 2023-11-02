<div class="theme-tabs">
			<div class="row">
				<div class="col-12 mx-auto">

						<ul class="nav nav-tabs" role="tablist">
						<?php if(have_rows('accordians_tab')){
							$flg = 0;
				              while( have_rows('accordians_tab') ){ the_row();
					      		$tabName = get_sub_field('tab_name');
								if(!empty($tabName)){
								$flg++;
				            ?>
							<li class="nav-item">
								<a class="nav-link <?php echo ($flg == 1)? 'active' : '';?>" data-toggle="tab" href="#Tab<?=$flg;?>" id="Tab-<?=$flg;?>" role="tab"><?=$tabName;?></a>
						    </li>
						  <?php } } } ?>

						</ul><!-- Tab panes -->

				</div>
			</div>

			<!-- tab content -->
			<div class="tab-content">

				<!-- tab one -->
				<?php if(have_rows('accordians_tab')){
					$flag = 0;
					  while( have_rows('accordians_tab') ){ the_row();
						$tabDesc = get_sub_field('tab_description');
						$tabIcon = get_sub_field('tab_image');
						$flag++;
					?>
				<div class="tab-pane fade <?php echo ($flag == 1)? 'active' : '';?>" id="Tab<?=$flag;?>" role="tabpanel">

					<div class="row">
						<div class="JobExploreBox d-flex align-items-center">
							<?php if(!empty($tabIcon)){ ?><figure>
								<img src="<?=$tabIcon;?>">
							</figure><?php } if(!empty($tabDesc)){ ?>
							<figcaption class="ml-5">
								<?=$tabDesc;?>
						    </figcaption><?php } ?>
						</div>
					</div>

				</div>
				<?php } } ?>

			</div>
			</div>

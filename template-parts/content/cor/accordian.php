<div class="theme-tabs">
			<div class="row">
				<div class="col-lg-10 col-md-10 col-12 mx-auto">

						<ul class="nav nav-tabs" role="tablist">
						<?php
						  if(have_rows('hs_accordian')){
							  $flg = 0;
							 while( have_rows('hs_accordian') ){ the_row();
							  $accordianTitle = get_sub_field('accordian_name');
							  if(!empty($accordianTitle)){    $flg++;
							 ?>
							<li class="nav-item">
								<a class="nav-link <?php echo ($flg == 1)? 'active':'';?>" data-toggle="tab" href="#Accordian<?=$flg;?>" role="tab"><?=$accordianTitle;?></a>
						  </li><?php } } } ?>
						</ul><!-- Tab panes -->

				</div>
			</div>

			<!-- tab content -->
			<div class="tab-content">
		<!-- tab one -->

 <?php
			  if(have_rows('hs_accordian')){
				 $flag = 0;
				 while( have_rows('hs_accordian') ){ the_row();
				  $accordianImg = get_sub_field('accordian_image');
				  $accordianHeading = get_sub_field('accordian_heading');
				  $flag++;
				 ?>
				<div class="tab-pane fade <?php echo ($flag == 1)? 'active':'';?>" id="Accordian<?=$flag;?>" role="tabpanel">

					<div class="row">
					<?php if(!empty($accordianImg)){ ?>
					<div class="col-lg-6 col-md-12 col-12 Img_Outer">
							<div class="tab-grid-img d-flex justify-content-center">
								<img src="<?=$accordianImg;?>" alt="" class="w-75">
							</div>
					</div><?php } ?>

						 <div class="col-lg-6 col-md-12 col-12">
						  <div class="tab-grid-content pr-5">
							 <?php if(!empty($accordianHeading)){ ?>
							 <h4 class="ml-5 pl-3"><?=$accordianHeading;?></h4><?php } ?>

							<div class="Recruit-list">
							<?php
							  if(have_rows('accordian_description')){

								 while( have_rows('accordian_description') ){ the_row();
								  $tab1Link = get_sub_field('description_link');
								  $tab1Tittle = get_sub_field('description_text');
								  if(!empty($tab1Tittle)){
								 ?>
								<div class="Recruit-list-item">
									<h3>
									<?php $isExternal = strpos($tab1Link, str_replace("www.", "", $_SERVER["HTTP_HOST"])) === false; ?>
									<a href="<?php echo ($tab1Link)? $tab1Link : '#';?>" <?php if ($isExternal) echo " target=_blank"; ?>><p><?=$tab1Tittle;?></p>
									<span class="icon-light"><img src="<?=get_template_directory_uri();?>/assets/images/recruit/arrow-light.svg"></span>
									<span class="icon-dark"><img src="<?=get_template_directory_uri();?>/assets/images/recruit/arrow.svg"></span>
									</a></h3>
							  </div><?php } } } ?>

							</div>
						  </div>
					   </div>

					</div>

				</div>
			  <?php } } ?>


			</div>
			</div>

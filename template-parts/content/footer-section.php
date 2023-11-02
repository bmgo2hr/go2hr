<?php
			$footerSectionHeading = get_field('footer_section_heading');
			$footerSectionDesc = get_field('footer_section_description');
			$footerSectionButtonText = get_field('footer_section_button_text');
			$footerSectionButtonLink = get_field('footer_section_button_link');
            if(!empty($footerSectionHeading) || !empty($footerSectionDesc)){
			?>
			<section class="blue-strip bg-blue">
			<div class="container">
				<div class="row">
					 <div class="col-lg-8 col-md-10 col-12 mx-auto">
						 <div class="heading-pnel fff text-center m-0">
							<?php if($footerSectionHeading){ ?><h2><?=$footerSectionHeading;?></h2><?php } ?>
							<?php echo ($footerSectionDesc)? $footerSectionDesc : '';?>
							<?php $isExternal = strpos($footerSectionButtonLink, str_replace("www.", "", $_SERVER["HTTP_HOST"])) === false; ?>
							<?php if($footerSectionButtonText){ ?><a href="<?php echo ($footerSectionButtonLink)? $footerSectionButtonLink : '#';?>" class="green-btn" <?php if ($isExternal) echo " target=_blank"; ?>><?=$footerSectionButtonText;?> <i class="fa fa-angle-right" aria-hidden="true"></i></a><?php } ?>

						  </div>
					   </div>
				</div>
			</div>
		</section><?php } ?>

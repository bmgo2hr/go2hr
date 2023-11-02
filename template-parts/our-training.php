<?php
/**
 * Template Name: Training-template
  */
$pageId = get_the_ID();
$pageHeading = get_field('page_heading',$pageId);

get_header();?>

<main class="inr-page Training-page" id="Training">


		<?php get_template_part( 'template-parts/content/inner-page-banner' ); ?>


		<!-- Breadcrumb -->
		<section class="Breadcrumb-go2">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="pagination-box">
                     <ul>
                        <li><a href="<?=get_site_url();?>">Home</a></li>
                        <li><span><?php echo ($pageHeading)? $pageHeading : get_the_title();?></span></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </section>


		<!-- grid -->
      <div class="page-content">
      <section class="WEbinar-video space" >
         <div class="container">
		 <?php
		 $section1Heading = get_field('section_1_heading',$pageId);
         $section1Desc = get_field('section_1_description',$pageId);
         if(!empty($section1Heading) || !empty($section1Desc)){
		 ?>
            <div class="row">
               <div class="col-lg-10 col-12 mx-auto">
				 <div class="heading-pnel line-head text-center">
					<?php if($section1Heading):?><h2><?=$section1Heading;?></h2><?php endif;?>
                    <?php echo ($section1Desc)? $section1Desc : '';?>
					</div>
               </div>
		 </div><?php } $section2Heading = get_field('section_2_heading',$pageId);

		      if($section2Heading){ ?>

			 <div class="row">
				<div class="col-12 mx-auto">
					<div class="heading-pnel">
						<h4 class="green-text mt-4"><?=$section2Heading;?></h4>
					</div>
				</div>
			</div><?php } ?>



			<div class="row">
			<?php if(have_rows('box_data')){
				   $count = count(get_field("box_data"));
					while( have_rows('box_data') ){ the_row();
					  $boxTitle = get_sub_field('box_heading');
					  $boxDesc = get_sub_field('box_description');

					  if($count == 2){ ?>
				        <div class="col-md-6 col-sm-6 col-12 pr-0">
					  <?php } else if($count == 3){ ?>
					 <div class="col-md-4 col-sm-6 col-12 pr-0">
					  <?php } else if($count == 4){ ?>
					 <div class="col-md-3 col-sm-6 col-12 pr-0">
					  <?php } else if($count == 5){ ?>
					  <div class="col-md-2 col-sm-6 col-12 pr-0">
					  <?php } else if($count == 6){ ?>
					  <div class="col-md-2 col-sm-6 col-12 pr-0"> <?php } ?>

					 <div class="value-box benefit-box D-radius">
						<figcaption>
							<?php if(!empty($boxTitle)):?><h5 class="check"><?=$boxTitle;?></h5><?php endif;?>
							<?php if(!empty($boxDesc)):?><p><?=$boxDesc;?></p><?php endif;?>
						</figcaption>
					</div>
				</div>
			<?php } } ?>


			<?php
			$section2Box4Heading = get_field('section_2_box_4_heading',$pageId);
            $section2Box4Desc = get_field('section_2_box_4_description',$pageId);
			$section2Box4Img = get_field('section_2_box_4_image',$pageId);
            if(!empty($section2Box4Heading) || !empty($section2Box4Desc)){
			?>
				<div class="col-12 pr-0">
					<div class="benefit-box servay-strip D-radius">
						<figcaption>
							<?php if($section2Box4Img){ ?><img src="<?=$section2Box4Img;?>" class="" alt="" /><?php } ?>
							<?php if($section2Box4Heading){ ?><h5 class="check"><?=$section2Box4Heading;?></h5><?php } ?>
							<?php echo ($section2Box4Desc)? $section2Box4Desc : '';?>
						</figcaption>
					</div>
			</div><?php } ?>
			</div>



         </div>
      </section>


		<!-- grid -->
      <section class="long-sec double-sec space pt-0" >
         <div class="container-fluid p-0">
		 <?php $section3mainHeading = get_field('section_3_main_heading',$pageId); if($section3mainHeading){ ?>
		 <div class="row">
               <div class=" col-md-10 col-11 mx-auto">
				 <div class="heading-pnel line-head">
					<h2><?=$section3mainHeading;?></h2>
                  </div>
               </div>
		 </div><?php  } ?>





			<div class="long-main-box pnel-zig">
				<div class="row no-gutters">
				<?php
				    $section3Img = get_field('section_3_image',$pageId);
					$section3Tittle = get_field('section_3_tittle',$pageId);
					$section3Desc1 = get_field('section_3_description_1',$pageId);
					$section3Desc2 = get_field('section_3_description_2',$pageId);
					$section3ButtonText = get_field('section_3_button_text',$pageId);
					$section3ButtonLink = get_field('section_3_button_link',$pageId);
					if(!empty($section3Tittle) || !empty($section3Desc1) || !empty($section3Desc2)){
						if($section3Img){
					?>
				<div class="col-lg-7 col-md-12 Img_Outer">
                  <div class="long-img">
                     <img src="<?=$section3Img;?>" alt="" class="w-100" />
                  </div>
			</div><?php } ?>
               <div class="col-lg-5 col-md-12">
                  <div class="long-content D-radius">
                  <div class="double-side">
						<div class="long-left-content">
							 <?php if($section3Tittle){ ?><h3><?=$section3Tittle;?></h3><?php } ?>
							 <?php if($section3Desc1){ ?><p><?=$section3Desc1;?></p><?php } ?>
							<?php if($section3ButtonText){ ?> <div class="long-btn">
								<a href="<?php echo ($section3ButtonLink)? $section3ButtonLink : '#';?>" class="green-btn"><?=$section3ButtonText;?> <i class="fa fa-angle-right" aria-hidden="true"></i></a>
							</div><?php } ?>
						</div>
						<?php if($section3Desc2){ ?><div class="long-right-content">
							 <?=$section3Desc2;?>
						</div><?php } ?>
					</div>
                  </div>
					</div>
				<?php } ?>

            </div>
			</div>



			<div class="long-main-box pnel-zag">
			 <div class="row no-gutters">
			 <?php
				    $section4Img = get_field('section_4_image',$pageId);
					$section4Tittle = get_field('section_4_heading',$pageId);
					$section4Desc1 = get_field('section_4_description_1',$pageId);
					$section4Desc2 = get_field('section_4_description_2',$pageId);
					$section4ButtonText = get_field('section_4_button_text',$pageId);
					$section4ButtonLink = get_field('section_4_button_link',$pageId);
					if(!empty($section4Tittle) || !empty($section4Desc1) || !empty($section4Desc2)){
						if($section4Img){
					?>
				<div class="col-lg-7 col-md-12 Img_Outer">
                  <div class="long-img">
                     <img src="<?=$section4Img;?>" alt="" class="w-100" />
                  </div>
				</div><?php } ?>
               <div class="col-lg-5 col-md-12">
                  <div class="long-content D-radius">
                  <div class="double-side">
						<div class="long-left-content">
							 <?php if($section4Tittle){ ?><h3><?=$section4Tittle;?></h3><?php } ?>
							 <?php if($section4Desc1){ ?><p><?=$section4Desc1;?></p><?php } ?>
							 <?php if($section4ButtonText){ ?><div class="long-btn">
								<a href="<?php echo ($section4ButtonLink)? $section4ButtonLink : '#';?>" class="green-btn"><?=$section4ButtonText;?> <i class="fa fa-angle-right" aria-hidden="true"></i></a>
							 </div><?php } ?>
						</div>
						<?php if($section4Desc2){ ?><div class="long-right-content">
							   <?=$section4Desc2;?>
						</div><?php } ?>
					</div>
                  </div>
					</div><?php } ?>

            </div>
            </div>



			<div class="long-main-box pnel-zig">
				<div class="row no-gutters">
				 <?php
				    $section5Img = get_field('section_5_image',$pageId);
					$section5Tittle = get_field('section_5_heading',$pageId);
					$section5Desc1 = get_field('section_5_description_1',$pageId);
					$section5Desc2 = get_field('section_5_description_2',$pageId);
					$section5ButtonText = get_field('section_5_button_text',$pageId);
					$section5ButtonLink = get_field('section_5_button_link',$pageId);
					if(!empty($section5Tittle) || !empty($section5Desc1) || !empty($section5Desc2)){
						if($section5Img){
					?>
				<div class="col-lg-7 col-md-12 Img_Outer">
                  <div class="long-img">
                     <img src="<?=$section5Img;?>" alt="" class="w-100" />
                  </div>
				</div><?php } ?>
               <div class="col-lg-5 col-md-12">
                  <div class="long-content D-radius">
                  <div class="double-side">
						<div class="long-left-content">
							<?php if($section5Tittle){ ?> <h3><?=$section5Tittle;?></h3><?php } ?>
							 <?php if($section5Desc1){ ?><p><?=$section5Desc1;?></p><?php } ?>
							 <?php if($section5ButtonText){ ?><div class="long-btn">
								<a href="<?php echo ($section5ButtonLink)? $section5ButtonLink : '';?>" class="green-btn"><?=$section5ButtonText;?> <i class="fa fa-angle-right" aria-hidden="true"></i></a>
							 </div><?php } ?>
						</div>
						<?php if($section5Desc2){ ?><div class="long-right-content">
							 <?php echo $section5Desc2;?>
						</div><?php } ?>
					</div>
                  </div>
               </div><?php } ?>

            </div>
			</div>


         </div>
      </section>

				<!-- grid -->
      <section class="training-prog-sec space pt-0" >
         <div class="container">
		 <?php
		    $section6Heading = get_field('section_6_heading',$pageId); if($section6Heading){ ?>
		 <div class="row">
               <div class="col-12">
				 <div class="heading-pnel line-head">
					<h2><?=$section6Heading;?></h2>
                  </div>
               </div>
            </div><?php } ?>

			<div class="row">
				<div class="col-12">
					<div class="training-prog-main">
					<?php get_template_part( 'template-parts/content/cor/sb-resources1' ); ?>

					</div>
					</div>
					</div>

			</div>
			</section>

			<?php
			$footerSectionHeading = get_field('footer_section_heading',$pageId);
			$footerSectionDesc = get_field('footer_section_description',$pageId);
			$footerSectionButtonText = get_field('footer_section_button_text',$pageId);
			$footerSectionButtonLink = get_field('footer_section_button_link',$pageId);
            if(!empty($footerSectionHeading) || !empty($footerSectionDesc)){
			?>
		<section class="blue-strip bg-blue">
			<div class="container">
				<div class="row">
					 <div class="col-lg-8 col-md-10 col-12 mx-auto">
						 <div class="heading-pnel fff text-center m-0">
							<?php if($footerSectionHeading){ ?><h2><?=$footerSectionHeading;?></h2><?php } ?>
							<?php echo ($footerSectionDesc)? $footerSectionDesc : '';?>
							<?php if($footerSectionButtonText){ ?><a href="<?php echo $footerSectionButtonLink;?>" class="green-btn"><?=$footerSectionButtonText;?> <i class="fa fa-angle-right" aria-hidden="true"></i></a><?php } ?>
						  </div>
					   </div>
				</div>
			</div>
			</section><?php } ?>
        </div>
	</main>

<?php get_footer();

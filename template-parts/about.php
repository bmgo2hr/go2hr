<?php
/**
 * Template Name: About-template
 *
  */
$pageId = get_the_ID();
$pageHeading = get_field('page_heading',$pageId);

get_header();?>

<main class="inr-page About-page" id="aboutus">


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






      <div class="page-content">
		<!-- grid -->
      <section class="long-sec space pt-0" >
         <div class="container-fluid p-0">
            <div class="row no-gutters">
			<?php
			$section1Heading = get_field('section_1_heading');
			$section1Desc = get_field('section_1_description');
			$section1Img = get_field('section_1_image');
			?>
			<div class="col-lg-6 col-md-6 Img_Outer">
                  <?php if($section1Img){ ?><div class="long-img">
                     <img src="<?=$section1Img;?>" alt="" class="w-100" />
                  </div><?php } ?>
               </div>
               <div class="col-lg-6 col-md-6">
                  <div class="long-content D-radius">
                     <?php if($section1Heading){ ?><h3><?=$section1Heading;?></h3><?php } ?>
                     <?php if($section1Desc){ ?><p><?=$section1Desc;?></p><?php } ?>
                  </div>
               </div>

            </div>
         </div>
      </section>


	<section class="circle-sec grid-left space pt-0">
         <div class="container">
            <div class="row justify-content-between">
			<?php
			$section2Heading = get_field('section_2_heading');
			$section2Desc = get_field('section_2_description');
			$section2Desc1 = get_field('section_2__description_2');
			$section1Img = get_field('section_2_image');
			?>
               <div class="col-lg-6">
                  <div class="circle-content pr-5">
                     <?php if($section2Heading){ ?><h3 class="sub-title"><?=$section2Heading;?></h3><?php } ?>
                     <?php if($section2Desc){ ?><p><?=$section2Desc;?></p><?php } ?>
                     <?php echo ($section2Desc1)? $section2Desc1 : '';?>
                  </div>
               </div>
              <?php if($section1Img){ ?> <div class="col-lg-6 Img_Outer">
                  <div class="circle-img wow animated zoomIn animated" style="visibility: visible; animation-name: zoomIn;">
                     <img src="<?=$section1Img;?>" alt="" class="w-100">
                  </div>
			  </div><?php } ?>
            </div>
         </div>
      </section>

		<!-- our values -->
		<section class="our-value space pt-0">
         <div class="container">
            <div class="row">
			<?php
			$section3Heading = get_field('section_3_heading');
			$section3Desc = get_field('section_3_description');
			?>
               <div class="col-12">
                  <div class="heading-pnel line-head text-center D-radius">
                     <?php if($section3Heading){ ?><h2><?=$section3Heading;?></h2><?php } ?>
					 <?php if($section3Desc){ ?><p><?=$section3Desc;?></p><?php } ?>
                  </div>
               </div>
            </div>


			<div class="row">
			<?php if(have_rows('box_data')){
				        while( have_rows('box_data') ){ the_row();
					      $boxIcon = get_sub_field('box_icon');
						  $boxTitle = get_sub_field('box_heading');
						  $boxDesc = get_sub_field('box_description');
				    ?>
				<div class="col-lg-3 col-md-6 col-sm-6 col-12 pr-0">
					<div class="value-box D-radius">

						<?php if(!empty($boxIcon)){ ?><figure>
							<img src="<?=$boxIcon;?>"  alt="icon" class="" />
						</figure><?php } ?>
						<figcaption>
							<?php if(!empty($boxTitle)){ ?><h5 class="check"><?=$boxTitle;?></h5><?php } ?>
							<?php if(!empty($boxDesc)){ ?><p><?=$boxDesc;?></p><?php } ?>
						</figcaption>
					</div>
				</div>
			<?php } } ?>

			</div>

         </div>
      </section>


		<section class="about-gallery space pt-0">
         <div class="container">
         <div class="gallery-main">
		 <?php
			$section4Heading = get_field('section_4_heading');
			$section4Desc = get_field('section_4_description');

			?>
			<div class="row align-items-center justify-content-center align-items-center">
				<div class="col-lg-6 col-12 mx-auto">
					<div class="heading-pnel line-head text-center mb-0">
                     <?php if($section4Heading){ ?><h2><?=$section4Heading;?></h2><?php } ?>
					 <?php if($section4Desc){ ?><p><?=$section4Desc;?></p><?php } ?>
                  </div>
				</div>
			</div>

         </div>
         </div>
      </section>

      </div>
	</main>

<?php get_footer();

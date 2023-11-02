<?php
/**
 * Template Name: Go2-Health-Safety-Safety-Basics-template
 *
 */
$pageId = get_the_ID();
$pageHeading = get_field('page_heading',$pageId);




get_header();?>

<main class="inr-page basic-page" id="basic">

		<?php get_template_part( 'template-parts/content/inner-page-banner' ); ?>

		<!-- Breadcrumb -->
		<section class="Breadcrumb-go2">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="pagination-box">
                     <ul>
                        <li><a href="<?=get_site_url();?>">Home</a></li>
                        <li><a href="/health-safety">Health & Safety</a></li>
                        <li><a href="/health-safety/safety-basics">Safety Basics</a></li>
                        <li><span><?php echo ($pageHeading)? $pageHeading : get_the_title();?></span></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </section>


		<!-- grid -->
      <div class="page-content">
      <section class="long-sec safety-basic-long space pt-0" >
         <div class="container-fluid p-0">

            <div class="row no-gutters">
			<?php
				$section1Heading = get_field('section_1_heading',$pageId);
				$section1Desc = get_field('section_1_description',$pageId);
				$section1Img = get_field('section_1_image',$pageId);
				?>
			<div class="col-lg-6 col-md-12 Img_Outer">
                 <?php if($section1Img){ ?> <div class="long-img">
                     <img src="<?=$section1Img;?>" alt="" class="w-100" />
				 </div><?php } ?>
               </div>

               <div class="col-lg-6 col-md-12">
                  <div class="long-content D-radius">
                     <?php if($section1Heading){ ?><h3><?=$section1Heading;?></h3><?php } ?>
                     <?php echo ($section1Desc)? $section1Desc : '';?>
					 </div>
               </div>

            </div>
         </div>
      </section>

		<section class="long-sec double-sec without-img space pt-0">
            <div class="container-fluid p-0">

               <div class="long-main-box pnel-zag safety-zag">
                  <div class="row no-gutters">

                    <div class="col-lg-7 col-md-12 mx-auto">
                        <div class="D-radius">
						<?php
							$section2Heading = get_field('section_2_heading',$pageId);
							$section2Desc = get_field('section_2_description',$pageId); ?>
                        <div class="outimg-center">

                                <?php if($section2Heading){ ?> <h4><?=$section2Heading;?></h4><?php } ?>
                                 <?php echo ($section2Desc)? $section2Desc : '';?>
                        </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>

		<section class="CanHelp-sec space pt-0">
         <div class="container">
		 <?php
			$section3Heading = get_field('section_3_heading',$pageId);
			$section3Desc = get_field('section_3_description',$pageId); ?>
            <div class="row">
               <div class="col-lg-8 col-12">
                  <div class="heading-pnel line-head">
                     <?php if($section3Heading){ ?><h2><?=$section3Heading;?></h2><?php } ?>
					 <?php echo ($section3Desc)? $section3Desc : '';?>
                  </div>
               </div>
            </div>


			<?php get_template_part( 'template-parts/content/cor/accordian' ); ?>
         </div>
      </section>

	<!-- grid -->

      <section class="training-prog-sec space pt-0" >

         <div class="container-fluid">
		 <div class="row">
		  <?php $section4Heading = get_field('section_4_heading',$pageId); if($section4Heading){ ?>
			   <div class="col-12">
				 <div class="heading-pnel line-head">
					<h2><?=$section4Heading;?></h2>
                  </div>
		       </div><?php } ?>
            </div>


			<div class="row">

				<div class="col-12">
					<div class="training-prog-main">
					<?php //get_template_part( 'template-parts/content/cor/cor-resources1' ); ?>
               <?php get_template_part( 'template-parts/content/cor/sb-resources1' ); ?>

					</div>

					</div>
					</div>
				</div>
			</section>
			<?php get_template_part( 'template-parts/content/footer-section' ); ?>
      </div>
	</main>


<?php get_footer();

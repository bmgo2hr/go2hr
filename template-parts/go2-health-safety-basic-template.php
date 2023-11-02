<?php
/**
 * Template Name: Go2-Health-Safety-Basic-template
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
                        <li><span><?php echo ($pageHeading)? $pageHeading : get_the_title();?></span></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </section>


		<!-- grid -->
		<?php
		 $section1Heading = get_field('section_1_heading');
		 $section1Desc = get_field('section_1_description');
		 $section1Img = get_field('section_1_image');
		 $section1BtnText = get_field('section_1_button_text');
		 $section1BtnLink = get_field('section_1_button_link');
		?>
      <section class="long-sec space pt-0" >
         <div class="container-fluid p-0">
            <div class="row no-gutters">
			<?php if($section1Img): ?><div class="col-lg-6 col-md-12 col-12 Img_Outer">
                  <div class="long-img">
                     <img src="<?=$section1Img;?>" alt="" class="w-100" />
                  </div>
               </div><?php endif;?>
               <div class="col-lg-6 col-md-12 col-12">
                  <div class="long-content D-radius">
                     <?php if($section1Heading):?><h3><?=$section1Heading;?></h3><?php endif;?>
                     <?php echo ($section1Desc)? $section1Desc : '';?>
					 <?php if($section1BtnText): ?><a href="<?=$section1BtnLink;?>" class="green-btn scroll-below"><?=$section1BtnText;?> <i class="fa fa-angle-right" aria-hidden="true"></i></a><?php endif;?>
                  </div>
               </div>

            </div>
         </div>
      </section>


		<!-- our values -->
		<section class="CanHelp-sec space pt-0">
         <div class="container">
		 <?php
		 $section2Heading = get_field('section_2_heading');
		 $section2Desc = get_field('section_2_description');
		 ?>
            <div class="row">
               <div class="col-12">
                  <div class="heading-pnel line-head text-center">
                     <?php if($section2Heading): ?><h2><?=$section2Heading;?></h2><?php endif;?>
					<?php if($section2Desc): ?> <p><?=$section2Desc;?></p><?php endif;?>
                  </div>
               </div>
            </div>


			<div class="theme-tabs">



			<div class="row">
				<div class="col-12">
				<?php
					 $section2Tab1 = get_field('tab_1_name');
					 $section2Tab2 = get_field('tab_2_name');
					 $section2Tab3 = get_field('tab_3_name');
					 $section2Tab4 = get_field('tab_4_name');
					 ?>

						<ul class="nav nav-tabs" role="tablist">
							<?php if($section2Tab1): ?><li class="nav-item">
								<a class="nav-link active" data-toggle="tab" href="#Strategy" role="tab"><?=$section2Tab1?></a>
							</li><?php endif;?>

							<?php if($section2Tab2): ?><li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#Onboarding" role="tab"><?=$section2Tab2;?></a>
							</li><?php endif;?>

						<?php if($section2Tab3): ?>	<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#Retention" role="tab"><?=$section2Tab3;?></a>
							</li><?php endif;?>

							<?php if($section2Tab4): ?><li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#Advice" role="tab"><?=$section2Tab4;?></a>
							</li><?php endif;?>
						</ul><!-- Tab panes -->

				</div>
			</div>

			<!-- tab content -->
			<div class="tab-content">

				<!-- tab one -->
				<?php
					 $tab1About = get_field('tab1_about_text');
					 $tab1Desc = get_field('tab1_description');
					 $tab1Img = get_field('tab1_image');
					?>
				<div class="tab-pane fade active" id="Strategy" role="tabpanel">
					<div class="row">
						 <div class="col-lg-6 col-md-12 col-12">
						  <div class="tab-grid-content pr-5">

							<?php if($tab1About): ?> <p><?=$tab1About;?></p><?php endif;?>

							 <?php echo ($tab1Desc)? $tab1Desc : '';?>

						  </div>
					   </div>
						<?php if($tab1Img): ?><div class="col-lg-6 col-md-12 col-12 Img_Outer">
							<div class="tab-grid-img">
								<img src="<?=$tab1Img;?>" alt="" class="w-100" />
							</div>
						</div><?php endif;?>
					</div>
				</div>

				<!-- tab two -->
				<?php
					 $tab2About = get_field('tab2_about_text');
					 $tab2Desc = get_field('tab2_description');
					 $tab2Img = get_field('tab2_image');
					?>
				<div class="tab-pane fade" id="Onboarding" role="tabpanel">
					<div class="row">
				 <div class="col-lg-6 col-md-12 col-12">
                  <div class="tab-grid-content pr-5">
                     <?php if($tab2About):?><p><?=$tab2About;?></p><?php endif;?>

					 <?php echo ($tab2Desc)? $tab2Desc: '';?>

                  </div>
               </div>
			<?php if($tab2Img): ?><div class="col-lg-6 col-md-12 col-12 Img_Outer">
                  <div class="tab-grid-img">
                     <img src="<?=$tab2Img;?>" alt="" class="w-100" />
                  </div>
               </div><?php endif;?>

			</div>
				</div>


				<!-- tab three -->
				<?php
					 $tab3About = get_field('tab3_about_text');
					 $tab3Desc = get_field('tab3_description');
					 $tab3Img = get_field('tab3_image');
					?>
				<div class="tab-pane fade" id="Retention" role="tabpanel">
					<div class="row">
				 <div class="col-lg-6 col-md-12 col-12">
                  <div class="tab-grid-content pr-5">
                     <?php if($tab3About):?><p><?=$tab3About;?> </p><?php endif;?>

					<?php echo ($tab3Desc)? $tab3Desc : '';?>
                  </div>
               </div>
			   <?php  if($tab3Img): ?>
				<div class="col-lg-6 col-md-12 col-12 Img_Outer">
                  <div class="tab-grid-img">
                     <img src="<?=$tab3Img;?>" alt="" class="w-100" />
                  </div>
               </div><?php endif;?>
			</div>
				</div>


				<!-- tab four -->
				<?php
					 $tab4About = get_field('tab4_about_text');
					 $tab4Desc = get_field('tab4_description');
					 $tab4Img = get_field('tab4_image');
					?>
				<div class="tab-pane fade" id="Advice" role="tabpanel">
					<div class="row">
				 <div class="col-lg-6 col-md-6">
                  <div class="tab-grid-content pr-5">
					  <?php if($tab4About): ?> <p><?=$tab4About;?></p><?php endif;?>
					 <?php echo ($tab4Desc)? $tab4Desc : '';?>

                  </div>
               </div>
			<?php if($tab4Img): ?><div class="col-lg-6 col-md-6 Img_Outer">
                  <div class="tab-grid-img">
                     <img src="<?=$tab4Img;?>" alt="" class="w-100" />
                  </div>
               </div><?php endif;?>

			</div>
				</div>

			</div>

			</div>

         </div>
      </section>

	</main>


<?php get_footer(); ?>
<script>
	$(".scroll-below").click(function() {
    $('html, body').animate({
        scrollTop: $(".come-here").offset().top
    }, 2000);
});
</script>

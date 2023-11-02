<?php
/**
 * Template Name: HR-Child-template
 *
  */
$pageId = get_the_ID();
$pageHeading = get_field('page_heading',$pageId);

get_header();?>

<main class="inr-page Training-page Recruit-page" id="Recruit">

		<?php get_template_part( 'template-parts/content/inner-page-banner' ); ?>

				<!-- Breadcrumb -->
		<section class="Breadcrumb-go2">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="pagination-box">
                     <ul>
                        <li><a href="<?=get_site_url();?>">Home</a></li>
                        <li><a href="<?=get_page_link(205);?>">Human Resources</a></li>
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
			$section1Img = get_field('section_1_image',$pageId);
			$section1Heading = get_field('section_1_heading',$pageId);
			$section1Desc = get_field('section_1_description',$pageId);
			if($section1Img){
			?>
			<div class="col-lg-6 col-md-6 Img_Outer">
                <div class="long-img">
                     <img src="<?=$section1Img;?>" alt="" class="w-100" />
                  </div>
		    </div><?php } ?>
               <div class="col-lg-6 col-md-6">
                  <div class="long-content D-radius">
                    <?php if($section1Heading){ ?> <h3><?=$section1Heading;?></h3><?php } ?>
                    <?php echo ($section1Desc)? $section1Desc : '';?>
					</div>
               </div>

            </div>
         </div>
      </section>


		<!-- grid -->
      <section class="WEbinar-video space pt-0" >
         <div class="container">
		 <?php
			$section2Heading = get_field('section_2_heading',$pageId); if($section2Heading):?>
			<div class="row">
				<div class="col-12 mx-auto">
					<div class="heading-pnel">
						<h4 class="green-text mt-4"><?=$section2Heading;?></h4>
					</div>
				</div>
			</div><?php endif;?>

			<div class="row">

				<?php if(have_rows('box_data')){

					while( have_rows('box_data') ){ the_row();
					  $boxTitle = get_sub_field('box_heading');
					  $boxDesc = get_sub_field('box_description'); ?>

				<div class="col-md-4 col-sm-6 col-12 pr-0">
					<div class="value-box benefit-box D-radius">
						<figcaption>
							<?php if($boxTitle):?><h5 class="check"><?=$boxTitle;?></h5><?php endif;?>
							<?php if($boxDesc):?><p><?=$boxDesc;?></p><?php endif;?>
							</figcaption>
					</div>
				</div><?php } } ?>

				<div class="col-12 pr-0">
					<div class="benefit-box servay-strip D-radius">

						<?php
						 $section2Box4Img = get_field('section_2_box_4_image',$pageId);
						 $section2Box4Heading = get_field('section_2_box_4_tittle',$pageId);
						 $section2Box4Desc = get_field('section_2_box_4_description',$pageId);
						 ?>
						<figcaption>
							<?php if($section2Box4Img):?><figure>
								<img src="<?=$section2Box4Img;?>" class="" alt="" />
							</figure><?php endif;?>
							<div class="servay-content">
							<?php if($section2Box4Heading):?><h4><?=$section2Box4Heading;?></h4><?php endif;?>
							<?php echo ($section2Box4Desc)? $section2Box4Desc : '';?>
							</div>

						</figcaption>
					</div>
				</div>
			</div>
         </div>
      </section>


		<?php get_template_part('template-parts/content/popular_topic_tab')?>

	<!-- grid -->
      <section class="training-prog-sec space pt-0" >
         <div class="container">
		 <?php
			$section4Heading = get_field('section_4_heading',$pageId); if($section4Heading){ ?>
		 <div class="row">
               <div class="col-12">
				 <div class="heading-pnel line-head">
					<h2><?=$section4Heading;?></h2>
                  </div>
               </div>
            </div><?php } ?>



			<div class="row">
				<div class="col-12">

					<div class="training-prog-main">
                        <?php //get_template_part( 'template-parts/content/hr/recruiting-resource' ); ?>
						<?php get_template_part( 'template-parts/content/cor/sb-resources1' ); ?>
						<?php get_template_part( 'template-parts/content/post-job' ); ?>

					</div>

				</div>
			</div>
			</div>
			</section>

		<?php
			$tab5Heading = get_field('section_5_heading',$pageId);
			$tab5Desc = get_field('section_5_description',$pageId);
			if(!empty($tab5Heading) || !empty($tab5Desc)){
			?>
		<section class="blue-strip bg-blue">
			<div class="container">
				<div class="row">
					 <div class="col-lg-8 col-md-10 col-12 mx-auto">
						 <div class="heading-pnel fff text-center m-0">
							<?php if($tab5Heading){ ?><h2><?=$tab5Heading;?></h2><?php } ?>
							<?php echo ($tab5Desc)? $tab5Desc : '';?>
							</div>
					   </div>
				</div>
			</div>
			</section><?php } ?>

      </div>
	</main>

<?php get_footer();

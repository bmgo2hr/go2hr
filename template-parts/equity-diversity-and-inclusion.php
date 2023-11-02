<?php
/**
 * Template Name: Equity,Diversity and inclusion-template
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

		<section class="CanHelp-sec space pt-0">
         <div class="container">
		 <?php
			$section3Heading = get_field('section_3_heading',$pageId);
			$section3Desc = get_field('section_3_description',$pageId);
		    ?>
            <div class="row">
               <div class="col-lg-6 col-12">
                  <div class="heading-pnel line-head">
                     <?php if($section3Heading): ?><h2><?=$section3Heading;?></h2><?php endif;?>
					 <?php if($section3Desc): ?><p><?=$section3Desc;?></p><?php endif; ?>
                  </div>
               </div>
            </div>


			<div class="theme-tabs">

			<div class="row">
				<div class="col-lg-10 col-md-10 col-12 mx-auto">

					<ul class="nav nav-tabs" role="tablist">
						<?php
						  if(have_rows('hr_accordian')){
							 $flg = 0;
							 while( have_rows('hr_accordian') ){ the_row();
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
				  if(have_rows('hr_accordian')){
					 $flag = 0;
					 while( have_rows('hr_accordian') ){ the_row();
					  $accordianImg = get_sub_field('accordian_image');
					  $accordianHeading = get_sub_field('accordian_heading');
					  $flag++;
					 ?>
				<div class="tab-pane fade <?php echo ($flag == 1)? 'active':'';?>" id="Accordian<?=$flag;?>" role="tabpanel">
				<div class="row">
					<?php if(!empty($accordianImg)){ ?><div class="col-lg-6 col-md-12 col-12 Img_Outer">
							<div class="tab-grid-img">
								<img src="<?=$accordianImg;?>" alt="" class="w-100">
							</div>
					</div><?php } ?>
						 <div class="col-lg-6 col-md-12 col-12">
						  <div class="tab-grid-content pr-5">

							 <?php if(!empty($accordianHeading)){ ?><h4 class="ml-5 pl-3"><?=$accordianHeading;?></h4><?php } ?>

							<?php ?>
							<div class="Recruit-list">
							<?php
							if(have_rows('accordian_description')){
							  while( have_rows('accordian_description') ){ the_row();
							    $section1tab1Tittle = get_sub_field('accordian_description_text');
							    $section1tab1Link = get_sub_field('accordian_description_link');

								if(!empty($section1tab1Tittle)){
							  ?>
							      <div class="Recruit-list-item">
									<h3>
									<a href="<?php echo ($section1tab1Link)? $section1tab1Link : '#';?>"><p><?=$section1tab1Tittle;?> </p>
									<span class="icon-light"><img src="<?=get_template_directory_uri();?>/assets/images/recruit/arrow-light.svg"></span>
									<span class="icon-dark"><img src="<?=get_template_directory_uri();?>/assets/images/recruit/arrow.svg"></span>
									</a></h3>
								</div>
							<?php } } } ?>
								</div>
						  </div>
					   </div>

					</div>
				</div>
			<?php } } ?>

			</div>

			</div>

         </div>
      </section>



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

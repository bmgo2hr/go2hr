<?php
/**
 * Template Name: Human-resources-template
 *
  */
$pageId = get_the_ID();
$pageHeading = get_field('page_heading',$pageId);

get_header();?>

<!-- header end -->
      <main class="inr-page Training-page resource-page" id="Recruit">
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
         <section class="WEbinar-video space" >
            <div class="container">
			<?php $about = get_the_content(); if($about){ ?>
               <div class="row">
                  <div class="col-lg-10 col-12 mx-auto">
                     <div class="heading-pnel line-head text-center">
                        <?php the_content();?>
						</div>
                  </div>
               </div><?php } ?>
               <!-- Section 1-->
               <div class="row">
                  <div class="col-12 pr-0">
				  <?php
				   $section1Img = get_field('section_1_image',$pageId);
					$section1Tittle = get_field('section_1_heading',$pageId);
					$section1Desc = get_field('section_1_description',$pageId);
				   ?>
                     <div class="benefit-box servay-strip D-radius">
                        <figcaption>
                          <?php if($section1Img){ ?> <figure>
                              <img src="<?=$section1Img;?>" class="" alt="">
						  </figure><?php } ?>
                           <div class="servay-content">
                             <?php if($section1Tittle){ ?> <h4><?=$section1Tittle;?></h4><?php } ?>
                             <?php echo ($section1Desc)? $section1Desc : '';?>
							 </div>
                        </figcaption>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- grid -->

		 <!-- Section 2 -->
         <section class="long-sec double-sec space pt-0" >
            <div class="container-fluid p-0">
			<?php $section2MainHeading = get_field('section_2_main_heading',$pageId); if($section2MainHeading){ ?>

               <div class="row">
                  <div class=" col-md-10 col-11 mx-auto">
                     <div class="heading-pnel line-head">
                        <h2><?=$section2MainHeading;?></h2>
                     </div>
                  </div>
			      </div><?php } ?>

           <?php get_template_part( 'template-parts/content/health-safety/workplace' ); ?>


            </div>
         </section>
		  <!-- Section 8-->
		 <section class="space simple-sec pt-0">

		<!-- simple left right section	 -->
		<div class="long-main-box">
                  <div class="container-fluid">
				  <?php $section8MainHeading = get_field('section_8_main_heading',$pageId); if($section8MainHeading){ ?>

				  <div class="row">
                  <div class="col-12 mx-auto">
                     <div class="heading-pnel line-head">
                        <h2><?=$section8MainHeading;?></h2>
                     </div>
                  </div>
               </div><?php } ?>



                  <div class="row no-gutters align-items-center">
                    <?php
				    $section8Img = get_field('section_8_image',$pageId);
					$section8Tittle = get_field('section_8_heading',$pageId);
					$section8Desc = get_field('section_8_description',$pageId);
					$section8ButtonText = get_field('section_8_button_text',$pageId);
					$section8ButtonLink = get_field('section_8_button_link',$pageId);?>
                     <div class="col-lg-5 col-md-6 col-12">
                        <div class="simple-content">
                           <div class="double-side">
                              <div class="simple-content">
                                <?php if($section8Tittle){ ?> <h3><?=$section8Tittle;?></h3><?php } ?>
                                 <?php if($section8Desc){ ?><p><?=$section8Desc;?></p><?php } ?>
                                <?php if($section8ButtonText){ ?> <div class="simple-btn mt-5">
                                    <a href="<?php echo ($section8ButtonLink)? $section8ButtonLink : '#';?>" class="btn-border blue-border"><?=$section8ButtonText;?> <i class="fa fa-angle-right" aria-hidden="true"></i></a>
								</div><?php } ?>
                              </div>

                           </div>
                        </div>
                     </div>


					  <?php if($section8Img){ ?><div class="col-lg-7 col-md-6 col-12 Img_Outer">
                        <div class="long-img">
                           <img src="<?=$section8Img;?>" alt="" class="w-100" />
                        </div>
					  </div><?php } ?>


                  </div>
               </div>
               </div>

		 </section>

		  <!-- Section 9-->
         <section class="blue-strip bg-blue">
            <div class="container">

			<?php
			$footerSectionTittle = get_field('footer_section_heading',$pageId);
			$footerSectioDesc = get_field('footer_section_description',$pageId);
			$footerSectionButtonText = get_field('footer_section_button_text',$pageId);
			$footerSectionButtonLink = get_field('footer_section_button_link',$pageId);
			?>
               <div class="row">
                  <div class="col-lg-8 col-md-10 col-12 mx-auto">
                     <div class="heading-pnel fff text-center m-0">
                        <?php if($footerSectionTittle){ ?><h2><?=$footerSectionTittle;?></h2><?php } ?>
                        <?php echo ($footerSectioDesc)? $footerSectioDesc : '';?>
                        <?php if($footerSectionButtonText){ ?><a href="<?php echo ($footerSectionButtonLink)? $footerSectionButtonLink : '#';?>" class="green-btn"><?=$footerSectionButtonText;?> <i class="fa fa-angle-right" aria-hidden="true"></i></a><?php } ?>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         </div>
      </main>

<?php get_footer();

<?php
/**
 * Template Name: Go2-Health-Safety-COR-Basic-Form-template
 *
 */
$pageId = get_the_ID();
$pageHeading = get_field('page_heading',$pageId);

get_header();?>

 <main class="inr-page Training-page" id="Events_res">
         <!-- banner -->
         <?php get_template_part( 'template-parts/content/inner-page-banner' ); ?>

         <!-- Breadcrumb -->
         <section class="Breadcrumb-go2">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="pagination-box">
                        <ul>
                           <li><a href="<?=get_page_link(8);?>">Home</a></li>
	                       <li><a href="/health-safety">Health & Safety</a></li>
	                       <li><a href="/health-safety/cor">COR</a></li>
                           <li><span><?php echo ($pageHeading)? $pageHeading : get_the_title();?></span></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- grid -->
         <section class="WEbinar-video space" >
            <div class="container">
			<?php $content = get_the_content(); if(!empty($content)){ ?>
               <div class="row">
                  <div class="col-lg-10 col-12 mx-auto">
                     <div class="heading-pnel line-head text-center">
                       <?php the_content();?>
					   </div>
                  </div>
			</div><?php } ?>
			<?php $section1Heading = get_field('section_1_heading'); if(!empty($section1Heading)){ ?>
               <div class="row">
                  <div class="col-12 mx-auto">
                     <div class="heading-pnel text-center">
                        <h4 class="green-text mt-4"><?=$section1Heading;?></h4>
                     </div>
                  </div>
			</div><?php } ?>
               <div class="row justify-content-center">
			    <?php
			    if(have_rows('section_1_content')){
				while( have_rows('section_1_content') ){ the_row();

				  $contentTitle = get_sub_field('content_heading');
				  $contentDesc = get_sub_field('content_description');

				  if(!empty($contentTitle) || !empty($contentDesc)){
				?>
                  <div class="col-md-5 col-sm-6 col-12 pr-0">
                     <div class="value-box benefit-box D-radius">
                        <figcaption>
				         <?php if(!empty($contentTitle)){ ?><h5 class="check"><?=$contentTitle;?></h5><?php } ?>
                           <?php if(!empty($contentDesc)){ ?><p><?=$contentDesc;?></p><?php } ?>
                        </figcaption>
                     </div>
                  </div>
				<?php } } } ?>

               </div>
            </div>
         </section>

      </main>

<?php get_footer();

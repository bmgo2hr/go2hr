<?php
/**
 * Template Name: Contact-template
 *
  */
$pageId = get_the_ID();
$pageHeading = get_field('page_heading',$pageId);

get_header();?>

<!-- header end -->
      <main class="inr-page Training-page 	 bg-grey" id="ContactUs">
	  
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
		
		

		<section class="contactUs-sec space">
			<div class="container">
				<div class="row">
				<div class="col-lg-11 col-12 mx-auto">
				<div class="row">
					<div class="col-lg-6 col-12">
						<div class="contact-detail">
						<?php $contactHeading = get_field('contact_page_heading'); if(!empty($contactHeading)){ ?>
			
							<div class="heading-pnel line-head mb-4">
								<h2><?=$contactHeading;?></h2>
								
						</div><?php } ?>
							<!-- box -->
							<?php
							$contactNo = get_field('contact_number');
							$contactEmail = get_field('contact_email'); ?>
							<div class="C-info">
								<?php if(!empty($contactNo)){ ?><p><a href="tel:<?=$contactNo;?>"><i class="fa fa-phone" aria-hidden="true"></i> <?=$contactNo;?></a></p><?php } ?>
								<?php if(!empty($contactEmail)){ ?><p><a href="mailto:<?=$contactEmail?>"><i class="fa fa-envelope" aria-hidden="true"></i> <?=$contactEmail;?></a></p><?php } ?>
							</div>
							<!-- box -->
							<div class="C-inquiries">
							<?php $inquiriesHeading	= get_field('inquiries_section_heading'); if(!empty($inquiriesHeading)){ ?>
							
							<h4><?=$inquiriesHeading;?></h4><?php } 
							
							if(have_rows('inquiries')){
							  while( have_rows('inquiries') ){ the_row();
							    $depName = get_sub_field('department_name');
							    $depEmail = get_sub_field('department_email');
								
							if(!empty($depName) || !empty($depEmail)){ ?><p><span><?php echo ($depName)? $depName : '';?></span> <a href="mailto:<?=$depEmail;?>"><?php echo ($depEmail)? $depEmail : '';?></a></p><?php } } } ?>
								
							</div>
							<!-- box -->
							<div class="C-ofchours">
							<?php $officeHours = get_field('office_hours'); if(!empty($officeHours)){ ?>
							
							<div class="C-hour">
									<?=$officeHours;?>
								</div><?php } $officeAddress = get_field('office_address'); if(!empty($officeAddress)){ ?>
								
								<div class="C-address">
									<?=$officeAddress;?>
								</div><?php } ?>
							</div>
							
							<!-- box -->
							<?php $aboutText = get_field('about_us_text'); if(!empty($aboutText)){ ?>
							<div class="cDesp">
								<?=$aboutText;?>
							</div><?php } ?>
						</div>
					</div>
					<div class="col-lg-6 col-12">
						<div class="newsletter-box">
						<?php  $formHeading = get_field('form_heading'); if(!empty($formHeading)){ ?>
							<div class="heading-pnel">
								<h4><?=$formHeading;?></h4>
						</div><?php } ?>
						
							
							<?=do_shortcode('[contact-form-7 id="22" title="Contact us form"]');?>
							
						</div>
					</div>
				</div>
				</div>
				</div>
			</div>
		</section>
	  
	  
	  <!-- Map -->
	  <?php $mapLink = get_field('google_map_link'); if(!empty($mapLink)){ ?>
	  <section class="Mapsec">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-lg-12 p-0">
                     <?=$mapLink;?>
                  </div>
               </div>
            </div>
	  </section><?php } ?>
	
	  </main>

<?php get_footer();

<?php
/**
 * The template for displaying the footer
 *
 */
 $col1 = get_option('footer_1', 'option');
 $col2 = get_option('footer_2', 'option');
 $col3 = get_option('footer_3', 'option');
 $col3_link = get_option('footer_3_link', 'option');

 $fbLink = get_option('fb_link', 'option');
 $linkedinLink = get_option('linkedin_link', 'option');
 $instagramLink = get_option('Instagram_link', 'option');
 $copyrighText = get_option('copyright_text', 'option');
?>
<!-- footer -->
      <footer id="footer">
         <div class="container">
            <div class="row">
               <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                  <div class="footer_links">
                     <div class="foot-logo">
                       <a href="<?=home_url();?>"> <img src="<?=get_template_directory_uri();?>/assets/images/go2HR-logo.svg" class="w-100" alt="logo" /></a>
                     </div>
                  </div>
               </div>
               <div class="col-lg-2 col-md-2 col-sm-4 col-4">
                 <?php if($col1){ ?> <div class="footer-title">
                     <h4><?=$col1;?></h4>
				 </div><?php } ?>
                  <div class="link-list">
                     <?php wp_nav_menu( array( 'theme_location' => 'who-we-are', 'container'=> false,'depth'=> 1,'fallback_cb' => false,));  // to call the footer Who we are menu;?>

                  </div>
               </div>
               <div class="col-lg-2 col-md-3 col-sm-4 col-4">
                  <div class="footer_links">
                   <?php if($col2){ ?>  <div class="footer-title">
                        <h4><?=$col2;?></h4>
				   </div><?php } ?>
                     <div class="link-list">
                        <?php wp_nav_menu( array( 'theme_location' => 'footer', 'container'=> false,'depth'=> 1,'fallback_cb' => false,)); // to call the footer Secondary menu;?>

                     </div>
                  </div>
               </div>
               <div class="col-lg-2 col-md-2 col-sm-4 col-4">
                  <div class="footer_links">
                   <?php if($col3){ ?>  <div class="footer-title">
                       <a href="<?=$col3_link;?>"><h4><?=$col3;?></h4></a>
				   </div><?php } ?>
                  </div>
               </div>
               <div class="col-lg-3 col-md-2 col-sm-12 col-12">
                  <div class="footer_links">
                     <div class="footer_bottom_icon clearfix">
                        <ul>
                          <?php if($fbLink){ ?> <li class="facebook">
                              <a target="_blank" href="<?=$fbLink;?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
						  </li><?php } if($linkedinLink){ ?>
                           <li class="linkedin">
                              <a target="_blank" href="<?=$linkedinLink;?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
						  </li><?php } if($instagramLink){ ?>
                           <li class="instagram">
                              <a target="_blank" href="<?=$instagramLink;?>"><i class="fa fa-instagram" aria-hidden="true"></i></a>
						  </li><?php } ?>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         </div>
		 <div class="footer-strip">
         <div class="container">
            <div class="row justify-content-between">
              <?php if($copyrighText){ ?> <div class="col-md-8 col-sm-12 col-12">
                  <div class="copyright">
                     <p><?php echo strip_tags(html_entity_decode($copyrighText));?></p>
                  </div>
			  </div><?php } ?>
               <div class="col-md-4 col-sm-12 col-12">
                  <div class="policy">
                     <a href="<?=get_page_link(18);?>" class="link-btn fff">Privacy Policy</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      </footer>

<!--      <script src="--><?//=get_template_directory_uri();?><!--/assets/js/jquery-2.2.3.min.js"></script>-->
<!--      <script src="--><?//=get_template_directory_uri();?><!--/assets/js/owl.carousel.js"></script>-->
<!--      <script src="--><?//=get_template_directory_uri();?><!--/assets/js/bootstrap.js"></script>-->
<!--      <script src="--><?//=get_template_directory_uri();?><!--/assets/js/wow.js"></script>-->
<!--      <script src="--><?//=get_template_directory_uri();?><!--/assets/js/main.js"></script>-->
      <?php
      $scripts = [
            ['handle' => 'jquery-file', 'src'=>'jquery-2.2.3.min.js', 'dep'=>array( 'jquery' ), 'var'=>false, 'in_foot'=>true],
            ['handle' => 'bootstrap', 'src'=>'bootstrap.js','dep'=> array( 'jquery' ),'var'=> false,'in_foot'=> true],
            ['handle' => 'owl', 'src'=>'owl.carousel.js','dep'=> array( 'jquery' ),'var'=> false,'in_foot'=> true],
            ['handle' => 'wow', 'src'=>'wow.js','dep'=> array( 'jquery' ),'var'=> false,'in_foot'=> true],
            ['handle' => 'main', 'src'=>'main.js', 'dep'=>array( 'jquery' ), 'var'=>false, 'in_foot'=>true]
        ];

        for ($i=0; $i < sizeof($scripts); $i++) {

            wp_enqueue_script( $scripts[$i]['handle'], get_template_directory_uri() . '/assets/js/' . $scripts[$i]['src'], $scripts[$i]['dep'], $scripts[$i]['var'], $scripts[$i]['in_foot'] );

        }
      add_action( 'wp_enqueue_scripts', 'my_assets' );
     ?>

	  <?php wp_footer(); ?>
   </body>
</html>

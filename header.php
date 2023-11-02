<?php
/**
 * The header.
 *
 */
?>
<!DOCTYPE HTML>
<html lang="en">
   <head>

      <!-- Google tag (gtag.js) -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=UA-140175-1"></script>
      <script>
         window.dataLayer = window.dataLayer || [];
         function gtag(){dataLayer.push(arguments);}
         gtag('js', new Date());
         gtag('config', 'UA-140175-1');
      </script>
	  <script>
		   fbq('track', 'Lead', {content_category: "SearchBtn", content_name: Search clicked"});
	  </script>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <link rel="apple-touch-icon" sizes="180x180" href="<?=get_template_directory_uri();?>/assets/favicon_io/apple-touch-icon.png">
      <link rel="icon" type="image/png" sizes="32x32" href="<?=get_template_directory_uri();?>/assets/favicon_io/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="16x16" href="<?=get_template_directory_uri();?>/assets/favicon_io/favicon-16x16.png">
      <link rel="manifest" href="<?=get_template_directory_uri();?>/assets/favicon_io/site.webmanifest">


      <?php wp_head(); ?>
      <link href="<?=get_template_directory_uri();?>/assets/css/animate.min.css" rel='stylesheet' type='text/css' />
      <link href="<?=get_template_directory_uri();?>/assets/css/style.css" rel='stylesheet' type='text/css' />
      <link href="<?=get_template_directory_uri();?>/assets/css/responsive.css" rel='stylesheet' type='text/css' />
      <link href="<?=get_template_directory_uri();?>/assets/css/owl.carousel.min.css" rel='stylesheet' type='text/css' />
      <link href="<?=get_template_directory_uri();?>/assets/css/owl.theme.default.css" rel='stylesheet' type='text/css' />
       <?php if(empty($args) || !$args['no-fa4']): ?>
           <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       <?php endif; ?>
	   
	   <!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-MX3V34L');</script>
		<!-- End Google Tag Manager -->
	   
   </head>
   <body <?php body_class(); ?>>
	   <!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MX3V34L"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
	   
   <?php wp_body_open(); ?>
      <!-- header -->
      <header class="header js-header">
         <div id="topbar" class="top-bar">
            <div class="container">
               <div class="row align-items-center justify-content-end m-0">
                  <div class="top-bar-content">
                  <?php wp_nav_menu( array( 'theme_location' => 'top', 'container'=> false, 'menu_class'=> '','depth'=> 1,'fallback_cb' => false,));?>
                  </div>
               </div>
            </div>
         </div>
         <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
               <!-- logo -->
               <div class="logo-web">
                  <a class="navbar-brand text-capitalize" href="<?=home_url();?>">
                     <div class="logo-box">
                        <img src="<?=get_template_directory_uri();?>/assets/images/go2HR-logo.svg">
                     </div>
                  </a>
               </div>
           <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
               </button> -->
              <!-- <div class="mobile-menu" id="navbarSupportedContent"> -->
			   <?php wp_nav_menu( array( 'theme_location' => 'primary', 'container'=> false,'depth'=> 1, 'menu_class'=>'navbar-nav ml-lg-auto','fallback_cb' => false,));?>

              <!-- </div> -->
            </nav>
         </div>
      </header>

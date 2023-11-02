<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/

 */

get_header();

$pageId = get_the_ID();
$pageHeading = get_field('page_heading',$pageId);

$query_object = get_queried_object();
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' )  : 1;

?>

 <main class="inr-page Training-page" id="Training">
		
		
		<!-- banner -->
		<section class="inr-banner" style="background-image: url(<?=get_template_directory_uri();?>/assets/images/explore-all/banner.png);">
         <div class="container">
            <div class="row">
               <div class="col-lg-7 col-md-9  col-sm-12 col-12">
                  <div class="banner_top_title  wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                     <h1>Explore All <br>Resources </h1>
                  </div>
               </div>
            </div>
         </div>
      </section>
		
		
		
		<!-- grid -->
		<?php 
		$args = array('post_type'=>'featured-resourses','paged'=>$paged,'posts_per_page'=> 3,'post_status'=>'publish',
		           'tax_query'=>array(array('taxonomy'=>'fr_type','field'=> 'term_id','terms'=> $query_object->term_id,
				   'operator'  => 'IN') ),'orderby'=>'publish_date','order'=>'DESC');			 
		
        $fr = new WP_Query($args);
		$catName = $query_object->name;	?>
		<section class="ExploreAll space" >
         <div class="container">
				<div class="row">
				   <div class="col-12">
					 <div class="heading-pnel text-center">
						<h2><?=!empty($catName)? $catName : '';?></h2>
					  </div>
				   </div>
				</div>
				
				<div class="row">
					<div class="col-12">
						<div class="ExploreAll-main">
							<?php 
							if($fr->have_posts()){
								while($fr->have_posts()){ $fr->the_post();
						          $frTitle = get_the_title();
				                  $frShortDesc = get_the_excerpt();
							      $img = get_the_post_thumbnail_url();
								?>
								
								<div class="ExploreBox w-100 d-flex">
								<?php if(!empty($img)){ ?><figure>
									<img src="<?=$img;?>" class="w-100" />
								</figure><?php } ?>
								<figcaption>
							   <?php if(!empty($catName)){ ?><span class="P-label"><?=$catName;?></span><?php } ?>
							   <?php if(!empty($frTitle)){ ?><h4><?=$frTitle;?></h4><?php } ?>
							   <?php if(!empty($frShortDesc)){ ?><p><?=$frShortDesc;?></p><?php } ?>
							   </figcaption>
							   </div>
							<?php } } ?>
							
						</div>
					</div>
				</div>
						
				<div class="row">
				<?php pagination_bar(); ?>
				
				</div>
			
				
			</div>
			</section>
		
	</main>

<?php
get_footer();

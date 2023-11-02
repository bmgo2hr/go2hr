<?php
/**
 * Template Name: News-template
 *
  */
$pageId = get_the_ID();
$pageHeading = get_field('page_heading',$pageId);

get_header();?>

<main class="inr-page Training-page NewsPage" id="NewsPage">
         <!-- banner -->
		 <?php get_template_part( 'template-parts/content/inner-page-banner', null, array('option_prefix' => 'news') ); ?>

         <!-- Breadcrumb -->
         <section class="Breadcrumb-go2">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="pagination-box">
                        <ul>
                           <li><a href="<?=get_page_link(8);?>">Home</a></li>
                           <li><a href="#">About Us</a></li>
                           <li><span><?php echo ($pageHeading)? $pageHeading : get_the_title();?></span></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- section  -->
         <?php $terms_year = array(
                     'post_type'         => array('go2hr_news'),
                  );

                  $years = array();
                  $query_year = new WP_Query( $terms_year );

                  if ( $query_year->have_posts() ) :
                     while ( $query_year->have_posts() ) : $query_year->the_post();
                        $year = get_the_date('Y');
                        if(!in_array($year, $years)){
                              $years[] = $year;
                        }
                     endwhile;
                     wp_reset_postdata();
                  endif; ?>
         <?php $date_query = array();
               if(isset($_GET['years']) && !empty($_GET['years'])){
                  $selected_year = $_GET['years'];
                  $date_query = array(array('year' => $selected_year));
               }else{
                  $selected_year = $years[0];
               }

               $args = array(
                  'post_type' => 'go2hr_news',
                  'post_status' =>'publish',
                  'posts_per_page' => -1,
                  'orderby' => 'date',
                  'date_query' => $date_query,
                  'order' => 'DESC'
               ); ?>

         <section class="NewsSec space " >
            <div class="container">

             <div class="event-filter">
                  <div class="row">
                     <div class="col-7">
                        <div class="heading-pnel line-head">
                           <h2><?php echo $selected_year; ?></h2>
                        </div>
                     </div>
                     <div class="col-5 text-right">
                        <!-- dropdown--->
                        <div class="event-month-filter year-filter">
                           <a class="green-btn year-btn">
                              <img src="<?=get_template_directory_uri();?>/assets/images/events/filter.png" class="" width="19" />
                              <span> Filter by Year</span> <i class="fa fa-angle-down" aria-hidden="true"></i>
                           </a>
                           <ul class="month-dropdown yr-dropdown">
                           <?php foreach($years as $year){ ?>
									   <li id="<?php echo $year ?>"><?php echo $year ?></li>
								   <?php }	?>
                           </ul>
                           <span class="close-srch year-close"><i class="fa fa-times" aria-hidden="true"></i></span>
							   </div>
                        <!----/dropdown-->
                     </div>
                  </div>
               </div>

               <div class="News_listing">
                  <!-- row -->
                  <div class="row">
                     <!-- box -->
                     <?php
                        //print_r($args);
                        $news = new WP_Query( $args ); // getting all blog news
                        $total_post = $news->post_count;
                        if ( $news -> have_posts() ) {

                        while ( $news -> have_posts() ) { $news -> the_post();

                        $newsName = get_the_title();
                        $newsShortDesc = get_the_excerpt();
                        $newsImg = get_the_post_thumbnail_url();
                        $newsdate = get_the_date('M d, Y');
                        ?>
                           <div class="col-lg-4 col-md-6 col-12 item">
                              <div class="News-box">
                                 <?php if(!empty($newsImg)){ ?><figure>
                                    <img src="<?=$newsImg;?>" class="w-100" alt="" />
                                 </figure><?php } ?>
                                 <figcaption>
                                 <?php if(!empty($newsName)){ ?>
                                       <a href="<?=get_the_permalink();?>">
                                          <h3><?=$newsName;?></h3>
                                       </a>
                                    <?php } ?>
                                    <h4><?=$newsdate;?></h4>
                                    <?php if(!empty($newsShortDesc)){ ?><p><?=$newsShortDesc;?></p><?php } ?>
                                    <a href="<?=get_the_permalink();?>" class="btn-border">Read More</a>
                                 </figcaption>
                              </div>
                        </div>
                        <?php } //endwhile
                           }else{ ?>
                           <div class="col-lg-12 col-md-12 col-12 not-found text-center"> <h3> No News Found ! </h3></div>
                           <?php } wp_reset_postdata();?>
                  </div>
                  <?php if($total_post>9){ ?>
                  <div class="row">
                     <div class="col-12">
                        <div class="ViewAll-row text-center mt-0">
                           <button class="green-btn lm">Load more <i class="fa fa-angle-right" aria-hidden="true"></i></button>
                        </div>
                     </div>
                  </div>
                  <?php } ?>
               </div>
            </div>
			 </div>
         </section>
      </main>


<?php get_footer(); ?>
<script>

$(function() {
  var colEl = $('.item').length,
    loadedEl = 9,
    start = 9,
    loadPo = 9;

  for (var i = 0; i < start; i++) {
    $('.item').eq(i).css('display', 'block');
  }

  $('.lm').on('click', loadMore);

  function loadMore() {
    if (colEl - loadedEl < loadPo) loadPo = colEl - loadedEl;
    for (var i = 1; i <= loadPo; i++) {
      $('.item').eq(loadedEl).fadeIn(400);
      loadedEl = loadedEl + 1;
    }
    if (colEl - loadedEl === 0) $(this).hide();
  }
});

$(".event-month-filter .green-btn").click(function() {
   $(".event-month-filter").toggleClass("month-filter-open");
   $(".event-month-filter").removeClass("add-month");
});

$(".year-close").click(function() {
   //$(".event-month-filter").toggleClass("month-filter-open");
   $(".year-filter").removeClass("add-month");
});

$('ul.yr-dropdown li').each(function(){
	$(this).click(function(){
		var yr_id = $(this).attr('id');
      var url = '<?php echo get_the_permalink($pageId); ?>'+'/?years='+yr_id;
      window.location.href = url;
	})
})
</script>

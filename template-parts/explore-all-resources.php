<?php
/**
 * Template Name: Explore-all-resourse-template
 *
 */
 global $wp_query;
$pageId = get_the_ID();
$pageHeading = get_field('page_heading',$pageId);

$query_object = get_queried_object();
//$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' )  : 1;

get_header();?>

  <!-- header end -->
      <main class="inr-page Training-page Recruit-page" id="ExploreResources">

	   <?php get_template_part( 'template-parts/content/inner-page-banner' ); ?>


		 <section class="Res-filt-sec bg-blue">
            <div class="container">
               <div class="row">

					<div class="col-12">

						<div class="res-filt-box">
							<div class="res-srch-pnel">
								<div class="res-srch-filed">
									<a class="searchpopup"><i class="fa fa-search" aria-hidden="true"></i> Search</a>
									<form action="">
										<div class="form-group">
											<input class="form-control" name="search" type="text" value="" placeholder="Find anything" />
											<span class="close-srch"><i class="fa fa-times" aria-hidden="true"></i></span>
										</div>
									</form>
								</div>
							</div>
							<div class="ResFilter-items">
								<ul>

                        <?php    $topic_id ='';
                                 if(isset($_GET['topic']) && !empty($_GET['topic'])){
                                    $topic_id = $_GET['topic'];
                                    $selected = '';
                                 }else{
                                    $selected = 'selected';
                                 } ?>
									<li class="<?= $selected ?>"><a href="<?php echo get_permalink($pageId); ?>">All Topics</a></li>
									<?php
										$eventCat = get_terms('resource_topic');
										if(!empty($eventCat)){
                                 foreach($eventCat as $cat){
                                    if($topic_id == $cat->term_id){ $selected = 'selected'; }else{ $selected = ''; } ?>
                                 <li class="<?= $selected ?>">
                                    <a href="<?php echo get_permalink($pageId); ?>/?topic=<?php echo $cat->term_id; ?>">
                                       <?=$cat->name;?>
                                    </a>
                                 </li>
										<?php } //endif
                           } //end foreach ?>
								</ul>
							</div>
						</div>


					</div>

				</div>
			</div>
		 </section>
      <?php       // If any search form is submitted then create the tax query for data
                  $tax_array = array();
                  $event_array = array();
                  $region_array = array();
                  $topic_array = array();
                  $subtopic_array = array();
                  $tag_array = array();
                  $search = '';
                  $tax = '';
                  if(isset($_GET['type']) && !empty($_GET['type'])){
                     $event = $_GET['type'];
                     $event_array = explode(',',$event);
                     $tax_array['relation'] = 'AND';
                     $tax_array[0]['taxonomy'] = 'resource_type';
                     $tax_array[0]['field'] = 'term_id';
                     $tax_array[0]['terms'] = $event_array;
                  }
                  if(isset($_GET['sector']) && !empty($_GET['sector'])){
                     $region = $_GET['sector'];
                     $region_array = explode(',',$region);
                     $tax_array['relation'] = 'AND';
                     $tax_array[1]['taxonomy'] = 'resource_sector';
                     $tax_array[1]['field'] = 'term_id';
                     $tax_array[1]['terms'] = $region_array;
                  }
                  if(isset($_GET['topic']) && !empty($_GET['topic'])){
                     $topic = $_GET['topic'];
                     $topic_array = explode(',',$topic);
                     $tax_array['relation'] = 'AND';
                     $tax_array[2]['taxonomy'] = 'resource_topic';
                     $tax_array[2]['field'] = 'term_id';
                     $tax_array[2]['terms'] = $topic_array;
                  }
                  if(isset($_GET['subtopic']) && !empty($_GET['subtopic'])){
                     $subtopic = $_GET['subtopic'];
                     $subtopic_array = explode(',',$subtopic);
                     $tax_array['relation'] = 'AND';
                     $tax_array[3]['taxonomy'] = 'subtopic';
                     $tax_array[3]['field'] = 'term_id';
                     $tax_array[3]['terms'] = $subtopic_array;
                  }
                  if(isset($_GET['tag']) && !empty($_GET['tag'])){
                     $tag = $_GET['tag'];
                     $tag_array = explode(',',$tag);
                     $tax_array['relation'] = 'AND';
                     $tax_array[3]['taxonomy'] = 'resource_tag';
                     $tax_array[3]['field'] = 'term_id';
                     $tax_array[3]['terms'] = $tag_array;
                  }
                  if(isset($_GET['search']) && !empty($_GET['search'])){
                     $search = $_GET['search'];
                  }
                  ?>
         <section class="space ResourceExplore">
            <div class="container">
               <div class="row">
                  <div class="col-12 mb-4 desktop-none">
                     <div class="filter-mobile-btn text-right">
                        <button class="green-btn filter-btn"><i class="fa fa-filter" aria-hidden="true"></i> Filters</button>
                     </div>
                  </div>
                  <div class="col-lg-3 col-md-12 col-12 pr-0">
                     <div class="ResourceFilter D-radius">
                        <div class="close-filter desktop-none">
                           <i class="fa fa-times" aria-hidden="true"></i>
                        </div>
                        <div id="accordion" class="filter-accordion">
                           <!-- accordion -->
						         <?php
                           $unwanted_terms = ['resource_topic','resource_sector','resource_tag'];
                           $cats = get_object_taxonomies( 'go2hr_resources');// print_r($cats);
						         $flg =0;
						         if(!empty($cats)){
							      foreach($cats as $cat){
								       $termObj = get_taxonomy($cat); //print_r($termObj);
                               if(in_array($termObj->name, $unwanted_terms)) continue;
                               //echo '<pre>';
                               //print_r($termObj);
                               $flg++;
						         ?>
                              <div class="card" id="<?php echo $cat; ?>">
                              <?php
                                 $selected_terms = array();
                                 switch ($cat) {
                                    case 'resource_type':
                                       $selected_terms = $event_array;
                                       break;
                                    case 'resource_sector':
                                       $selected_terms = $region_array;
                                       break;
                                    case 'resource_topic':
                                       $selected_terms = $topic_array;
                                       break;
                                    case 'subtopic':
                                       $selected_terms = $subtopic_array;
                                       break;
                                    case 'resource_tag':
                                       $selected_terms = $tag_array;
                                       break;
                                 }
                              ?>

                                 <div class="card-header" id="heading<?=$flg;?>">
                                    <a href="javascript:void(0);" class="btn btn-link <?php echo ($flg == 1)? '':'collapsed';?>" data-toggle="collapse" data-target="#collapse<?=$flg;?>" aria-expanded="false" aria-controls="collapse<?= $flg?>">
                                       <?=$termObj->label;?>
                                    </a>
                                 </div>

                                 <div id="collapse<?=$flg;?>" class="collapse <?php echo ($flg == 1)? 'show':'show';?>" aria-labelledby="heading<?=$flg;?>" data-parent="#accordion" style="">
                                    <div class="card-body">
                                       <div class="child-checkboxes">
                                          <?php $terms = get_terms( array('taxonomy' => array($cat),'orderby' => 'name','hide_empty' => True) );
                                          if(!empty($terms)){
                                             foreach ( $terms as $term ){ ?>
                                             <div class="form-group">
                                                <label>
                                                   <?php
                                                   $selected ='';
                                                   if( in_array($term->term_id, $selected_terms))
                                                   $selected = "checked='checked'"; ?>
                                                   <input type="checkbox" name="" <?= $selected ?> value="<?php echo $term->slug ?>" name="sel[]" id="<?php echo $term->term_id; ?>" onclick="formUrl();">
                                                   <?php echo $term->name ?>
                                                </label>
                                             </div>
                                             <?php } //endforech
                                          } //endif ?>
                                       </div>
                                    </div>
                                 </div>

                              </div>
					            <?php } } ?>

                        </div>
                     </div>
                  </div>
                  <div class="col-lg-9 col-md-12 col-12">
                     <!-- grid -->
                     <section class="training-prog-sec" >
                        <div class="col-12">
                           <div class="training-prog-main" id="ajaxData">
						    <?php
                        $args = array(
                           'post_type' => 'go2hr_resources',
                           'post_status'     =>'publish',
                           'paged'           =>$paged,
                           'posts_per_page'  => 10,
                           'orderby'         => 'date',
                           'order'           => 'DESC',
                           'tax_query'       => $tax_array,
                           's'               => $search,
                        );
                        //echo '<pre>';
                        //print_r($args);
                        //echo '</pre>';
								$query = new WP_Query($args);
                        $total_article = 0;
								if ( $query -> have_posts() ) {
								while ( $query -> have_posts() ) { $query -> the_post();

								  $rsName = get_the_title();
								  $rsShortDesc = get_the_excerpt();
                           $post_id = get_the_ID();
								  $term_name = get_the_term_list( $post_id, 'resource_tag', '', '' );

                          //$term_list = get_the_terms($post_id, 'resource_tag');
								?>
                              <div class="training-prog-box">
                                 <?php if(!empty($term_name)){ ?>
                                    <span class="P-label"><?=$term_name;?></span>
                                 <?php } ?>
                                 <?php /*
                                    foreach($term_list as $term_single) {
                                       echo '<a href="'.get_term_link($term_single->slug, 'species').'"><span class="P-label">'.$term_single->name.'</span></a>';
                                  } */
                                 ?>
                                 <h4><a href="<?php echo get_the_permalink(); ?>"><h4><?=$rsName;?></h4></a></h4>
                                 <p><?=$rsShortDesc;?></p>
                              </div>
								<?php $total_article++; } }// wp_reset_postdata(); ?>
                              <!-- Not sure how this section works so leaving it static---->
                              <?php if(!is_paged()){ ?>
                                 <?php get_template_part( 'template-parts/content/post-job' ); ?>
                              <?php  } ?>
                           </div>
                        </div>
                     </section>
                     <div class="col-12 mt-5">
                        <?php
                           //$total_article = wp_count_posts( 'go2hr_resources' )->publish;
                           //global $wp_query;
                              if ( $query->have_posts() ) {
                                 $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' )  : 1;
                                 $total_pages = $query->max_num_pages;
                                 echo '<div class="pagination D-radius dynmic-pagi">';
                                 if ($total_pages > 1){
                                    $current_page = max(1, get_query_var('paged'));
                                       echo paginate_links(array(
                                          'base'      => get_pagenum_link(1) . '%_%',
                                          'format'    => '/page/%#%',
                                          'current'   => $current_page,
                                          'total'     => $total_pages,
                                          'prev_text' => '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
                                          'next_text' => '<i class="fa fa-chevron-right" aria-hidden="true"></i>',
                              ));
                              }
                              echo '<li class="page-item article-count">'.$total_article.' Articles</li>';
                              echo '</div>';
                           }

						      ?>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </main>
<?php
$path = $_SERVER['REQUEST_URI'];
$path_array = explode('/',$path);
$path_array = explode('?',$path_array[1]);
$page_url = home_url().'/'.$path_array[0];
$queryString = $_SERVER['QUERY_STRING'];
?>
<script>
function formUrl(){
   var data;
   var idArray = [];
   var acat = [];
   var cat;
   var url = '/?';
   jQuery('.card').each(function(){
      cat = jQuery(this).attr('id');
      if(cat=='resource_topic'){
         cat = 'topic';
      }
      if(cat=='resource_type'){
         cat = 'type';
      }
      if(cat=='resource_sector'){
         cat = 'sector';
      }
      if(cat=='resource_tag'){
         cat = 'tag';
      }
      if(cat=='subtopic'){
         cat = 'subtopic';
      }
      url = url+cat+'=';
      jQuery(this).find('input').each(function(){
         if (jQuery(this).is(':checked')) {
            var id = jQuery(this).attr('id');
            url = url+id+',';
         }
      });
      url = url+'&';
      //acat.push({[cat]:idArray});
      //idArray = [];
   })
   console.log(url);
   window.location.href = '<?php echo site_url(); ?>/explore-all-resources-2/'+url;
   //get_sortData(acat);
}

// callAjax can be used to get the data using ajax. Not using it due to pagination problem
function callAjax(){
   var data;
   var idArray = [];
   var acat = [];
   var cat;
   jQuery('.card').each(function(){
      cat = jQuery(this).attr('id');
      jQuery(this).find('input').each(function(){
         if (jQuery(this).is(':checked')) {
            var id = jQuery(this).attr('id');
            idArray.push(id);
         }
      });
      acat.push({[cat]:idArray});
      idArray = [];
   })
   console.log(acat);
   get_sortData(acat);
}
function get_sortData(alldata) {
	$.ajax({
	type:'POST',
	//dataType : "json",
	url : "<?php echo site_url(); ?>/wp-admin/admin-ajax.php",
	data : {
            action: "myfilter",
            data:JSON.stringify(alldata),
			   paged:<?php echo $paged;?>,
		   },
        success:function(data){
		      $('#ajaxData').html(data);
	      }
});
return false;

}
</script>
<script>
   jQuery(".filter-btn").click(function() {
      jQuery(".ResourceFilter").toggleClass("show-filter");
   });

   jQuery(".close-filter").click(function() {
      jQuery(".ResourceFilter").toggleClass("show-filter");
   });

   jQuery(".searchpopup").click(function() {
      jQuery(".res-srch-filed").toggleClass("show-search");
   });

   jQuery(".close-srch").click(function() {
      jQuery(".res-srch-filed").toggleClass("show-search");
   });
   // Code to modify the pagination default behaviour so that it can use query string
   jQuery('.D-radius a').each(function(){
         var page_no = jQuery(this).html();
         var current_page_no = jQuery('.current').html();
         if (jQuery(this).hasClass('prev')) {
            console.log(current_page_no);
            prev_page_no = parseInt(current_page_no)-1;
            jQuery(this).attr('href', '<?php echo $page_url; ?>'+'/page/'+prev_page_no+'/?<?php echo $queryString; ?>');
         }else if(jQuery(this).hasClass('next')){
            console.log(current_page_no);
            next_page_no = parseInt(current_page_no)+1;
            jQuery(this).attr('href', '<?php echo $page_url; ?>'+'/page/'+next_page_no+'/?<?php echo $queryString; ?>');
         }else{
            jQuery(this).attr('href', '<?php echo $page_url; ?>'+'/page/'+page_no+'/?<?php echo $queryString; ?>');
         }

   })
</script>
<?php get_footer();?>


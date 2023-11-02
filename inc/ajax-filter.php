<?php
/*
 This page contains ajax functions for
 1. Explore all resources filter (not being used for now).
 2. Event calander page painations
*/

add_action('wp_ajax_myfilter', 'resource_filter_function');
add_action('wp_ajax_nopriv_myfilter', 'resource_filter_function');

function resource_filter_function(){
  $selected_tax = $_POST['data'];
  $selected_tax = str_replace("\\",'', $selected_tax);
  $selected_tax = json_decode($selected_tax);
  $paged = $_POST['paged'];
  $count = 0;
  $tax_array['relation'] = 'OR';
  foreach($selected_tax as $tax){

    foreach($tax as $tax_name =>$term){    // echo $term;
      $tax_array[$count]['taxonomy'] = $tax_name;
      $tax_array[$count]['field'] = 'term_id';
      $tax_array[$count]['terms'] = $tax->$tax_name;
    }
    $count++;

  }
    $args = array(
      'post_type' => 'go2hr_resources',
	    'paged'=>$paged,
      'posts_per_page' => 10,
      'post_status' =>'publish',
      'orderby' => 'date',
      'order' => 'DESC',
      'tax_query' => $tax_array,
 );
if (isset($selected_tax) ) {

  $query = new WP_Query( $args );
  //print_r($query);
   if( $query->have_posts() ) {
    while( $query->have_posts() ): $query->the_post();
          $rsName = get_the_title();
		  $post_id = get_the_ID();
		  $rsShortDesc = get_the_excerpt();
		  $term_name = get_the_term_list( $post_id, 'resource_type', '', ', ' );
		?>
	  <div class="training-prog-box">
		 <?php if(!empty($term_name)){ ?><span class="P-label"><?=$term_name;?></span><?php } ?>
		 <h4><?=$rsName;?></h4>
		 <p><?=$rsShortDesc;?></p>
	  </div>

<?php    endwhile;
    //wp_reset_postdata();


   } ?>

    <?php get_template_part( 'template-parts/content/post-job' ); ?>

<?php }
die();
}





add_action('wp_ajax_archivepaginate', 'archive_event_paginate');
add_action('wp_ajax_nopriv_archivepaginate', 'archive_event_paginate');

function archive_event_paginate(){
  $paged = $_POST['paged'];
  $keyword = '';
  $date_now = date('Y-m-d H:i:s');
  $tax_array = array();
  $meta_array = array(
    'relation' 			=> 'AND',
    array(
       'key'			=> 'event_start_date',
       'compare'		=> '<=',
       'value'			=> $date_now,
       'type'			=> 'DATETIME'
     )
    );
  if(isset($_POST['tax_query']) && !empty($_POST['tax_query'])){
    $selected_tax = str_replace("\\",'', $_POST['tax_query']);
    $tax_array = json_decode($selected_tax ,true);
  }
  if(isset($_POST['meta_query']) && !empty($_POST['meta_query'])){
    $selected_meta = str_replace("\\",'', $_POST['meta_query']);
    $meta_array = json_decode($selected_meta ,true);
  }
  if(isset($_POST['serach']) && !empty($_POST['serach'])){
    $keyword = $_POST['serach'];
  }

  $args1= array(
    'posts_per_page'	=>  4,
    'paged'           => $paged,
    'post_type'			  => 'go2hr_events',
    'meta_query' 		=> $meta_array,
    'meta_key'		=> 'event_start_date',
    'orderby'			=> 'meta_value',
    'order'				=> 'DESC',
    'meta_type'		=> 'DATE',
    's' 				  => $keyword,
		'tax_query' 	=> $tax_array,
  );
  $archive_post_array = array();
			 $count=0;
			 $archive_years = array();
			 $event = new WP_Query($args1);
			 //echo '<pre>'; print_r($event); echo '</pre>';
				 if ( $event -> have_posts() ) {
				   while ( $event -> have_posts() ) {
					$event -> the_post();
					$post_id = get_the_id();
					$eventTitle = get_the_title();
					$eventShortDesc = get_the_excerpt();
					$eventLink = get_the_permalink();
					$eventDate = strtotime(get_field('event_start_date'));	//get value from start date custom field

					$month = date("F", $eventDate);
					$date = date("d", $eventDate);
					$year = date("Y", $eventDate);

					$startDate = strtotime(date('Y-m-d', $eventDate) );
					$currentDate = strtotime(date('Y-m-d'));
					$count = $count+1;
					if($startDate < $currentDate) {	//if date has passed
						//echo $startDate.'+++';
						if ( in_array($year,$archive_years) ) {
							//continue;
						}else{
							$archive_years[] = $year;
						}
						$archive_post_array[$year][$month][$count]['title']=$eventTitle;
						$archive_post_array[$year][$month][$count]['excerept']=$eventShortDesc;
						$archive_post_array[$year][$month][$count]['link']=$eventLink;
						$archive_post_array[$year][$month][$count]['date']=$date;
						$archive_post_array[$year][$month][$count]['month']=$month;
						$archive_post_array[$year][$month][$count]['year']=$year;


					}else{ //Do nothing

					}

					}

				}
				// Sort and array in descending order so that post can be displayed in date order
				//krsort($active_post_array);
				krsort($archive_post_array);

				rsort($archive_years);
				//usort($upcoming_months, "compare_months");
  ?>
      <div class="row mb-5 pb-5 archive_tab">
					<?php $total_article = 0; ?>
					<?php if(empty($archive_post_array)){ ?>
						<div class="col-lg-12 col-md-12 col-12 not-found text-center"><h3>No Event Found!</h3></div>
					   <?php } ?>
					<?php foreach ($archive_post_array as $archive_months){ ?> <!-- year loop-->
					   <?php foreach ($archive_months as $month=>$post){ ?> <!-- Month loop-->
								<?php $count = 0; //this variable is to set the html design?>
								<?php foreach($post as $get_year){?>
									<div class="row archive-list row-<?php echo $get_year['year'];?>">
								<?php break; } ?>
								<div class="col-lg-3 col-md-3 col-12">
									<div class="Event_month">
										<h3><?php echo $month; ?></h3>
									</div>
								</div>
							<?php foreach($post as $data){?>
									<?php if($count>0){ ?>
										<div class="col-lg-3 col-md-3 col-12"></div>
									<?php } ?>
									<?php $year_wise_count[$data['year']]=@$year_wise_count[$data['year']]+1; ?>
									<div class="col-lg-9 col-md-9 col-12">
										<div class="event-box">
											<div class="blog-date">
												<h4><span><?php echo $month; ?></span> <?php echo $data['date']; ?></h4>
											</div>
											<figcaption>
												<h3><a href="<?php echo $data['link']; ?>"><?php echo $data['title']; ?> <span class="icon-light"><img src="<?=get_template_directory_uri();?>/assets/images/blue-arrow.svg"></span></a></h3>
												<p><?php echo $data['excerept']; ?></p>
											</figcaption>
										</div>
									</div>
										<?php $count++; $total_article++;
								} ?>
							</div>
					   <?php  }
					   }	?>
				   </div>
<?php
  die();
}




add_action('wp_ajax_archivepaginatelink', 'archive_event_paginate_link');
add_action('wp_ajax_nopriv_archivepaginatelink', 'archive_event_paginate_link');

function archive_event_paginate_link(){
  $paged = $_POST['paged'];
  $keyword = '';
  $date_now = date('Y-m-d H:i:s');
  $meta_array = array(
    'relation' 			=> 'AND',
    array(
       'key'			=> 'event_start_date',
       'compare'		=> '<=',
       'value'			=> $date_now,
       'type'			=> 'DATETIME'
     )
    );
  $tax_array = array();
  if(isset($_POST['tax_query']) && !empty($_POST['tax_query'])){
    $selected_tax = str_replace("\\",'', $_POST['tax_query']);
    $tax_array = json_decode($selected_tax ,true);
  }
  if(isset($_POST['meta_query']) && !empty($_POST['meta_query'])){
    $selected_meta = str_replace("\\",'', $_POST['meta_query']);
    $meta_array = json_decode($selected_meta ,true);
  }
  if(isset($_POST['serach']) && !empty($_POST['serach'])){
    $keyword = $_POST['serach'];
  }

  $args1= array(
    'posts_per_page'	=>  4,
    'paged'           => $paged,
    'post_type'			  => 'go2hr_events',
    'meta_query' 		=> $meta_array,
    'meta_key'			=> 'event_start_date',
    'orderby'			=> 'meta_value',
    'order'				=> 'DESC',
    'meta_type'			=> 'DATE',
    's' 				  => $keyword,
		'tax_query' 	=> $tax_array,
  );


  $query = new WP_Query($args1);
  $count = $query->post_count;
    if ( $query->have_posts() ) {
        $total_pages = $query->max_num_pages;
        echo '<div class="pagination D-radius dynmic-pagi arch_pagi">';
        if ($total_pages > 1){
          $current_page = max(1, $paged);
              echo paginate_links(array(
                'base'      => get_pagenum_link(1) . '%_%',
                'format'    => '/page/%#%',
                'current'   => $current_page,
                'total'     => $total_pages,
                'prev_text' => '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
                'next_text' => '<i class="fa fa-chevron-right" aria-hidden="true"></i>',
    ));
    }
    echo '<li class="page-item article-count">'.$count.' Articles</li>';
    echo '</div>';
  }
  die();
}


// Next page data for upcoming event
add_action('wp_ajax_upcomingpaginate', 'upcoming_event_paginate');
add_action('wp_ajax_nopriv_upcomingpaginate', 'upcoming_event_paginate');

function upcoming_event_paginate(){
  $paged = $_POST['paged'];
  $keyword = '';
  $tax_array = array();
  if(isset($_POST['tax_query']) && !empty($_POST['tax_query'])){
    $selected_tax = str_replace("\\",'', $_POST['tax_query']);
    $tax_array = json_decode($selected_tax ,true);
  }
  if(isset($_POST['serach']) && !empty($_POST['serach'])){
    $keyword = $_POST['serach'];
  }
  $date_now = date('Y-m-d H:i:s');
  $args1= array(
    'posts_per_page'	=>  4,
    'paged'           => $paged,
    'post_type'			  => 'go2hr_events',
    'meta_query' 		=> array(
      'relation' 			=> 'AND',
        array(
          'key'			=> 'event_start_date',
          'compare'		=> '>=',
          'value'			=> $date_now,
          'type'			=> 'DATETIME'
        )
        ),
    'meta_key'			=> 'event_start_date',
    'orderby'			=> 'meta_value',
    'order'				=> 'ASC',
    'meta_type'			=> 'DATE',
    's' 				  => $keyword,
		'tax_query' 	=> $tax_array,
  );
  $active_post_array = array();
			 $count=0;
			 $upcoming_months = array();
			 $event = new WP_Query($args1);
			 //echo '<pre>'; print_r($event); echo '</pre>';
				 if ( $event -> have_posts() ) {
				   while ( $event -> have_posts() ) {
					$event -> the_post();
					$post_id = get_the_id();
					$eventTitle = get_the_title();
					$eventShortDesc = get_the_excerpt();
					$eventLink = get_the_permalink();
					$eventDate = strtotime(get_field('event_start_date'));	//get value from start date custom field

					$month = date("F", $eventDate);
					$date = date("d", $eventDate);
					$year = date("Y", $eventDate);

					$startDate = strtotime(date('Y-m-d', $eventDate) );
					$currentDate = strtotime(date('Y-m-d'));
					$count = $count+1;
					if($startDate < $currentDate) {	//if date has passed

					}else{ //If events are yet to come

						//if ( in_array($month,$upcoming_months) ) {
							//continue;
						//}else{
							//$upcoming_months[] = $month;
						//}
						$active_post_array[$year][$month][$count]['title']=$eventTitle;
						$active_post_array[$year][$month][$count]['excerept']=$eventShortDesc;
						$active_post_array[$year][$month][$count]['link']=$eventLink;
						$active_post_array[$year][$month][$count]['date']=$date;
						$active_post_array[$year][$month][$count]['month']=$month;
						$active_post_array[$year][$month][$count]['year']=$year;

					}

					}
					wp_reset_postdata();
				}
				// Sort and array in descending order so that post can be displayed in date order
				krsort($active_post_array);
  ?>
      <?php $total_article = 0; ?>
				   <div class="row mb-5 pb-5 upcoming_tab">
					   <?php if(empty($active_post_array)){ ?>
						<div class="col-lg-12 col-md-12 col-12 not-found text-center"><h3>No Event Found!</h3></div>
					   <?php } ?>
					  <?php foreach ($active_post_array as $active_months){ ?> <!-- year loop-->
						<?php //usort($active_months, "compare_months"); //sort by month ?>
					   <?php foreach ($active_months as $month=>$post){ ?> <!-- month loop-->
						<?php $count = 0; ?>
						<div class="row active-list" id="month-<?php echo $month; ?>">
					   <div class="col-lg-3 col-md-3 col-12">
							<div class="Event_month">
								<h3><?php echo $month; ?></h3>
							</div>
					   </div>
					   <?php foreach($post as $data){?> <!-- Event/date loop--->
						<?php if($count>0){ ?>
							<div class="col-lg-3 col-md-3 col-12"></div>
						<?php } ?>
					   <div class="col-lg-9 col-md-9 col-12">
						  <div class="event-box">
							 <div class="blog-date">
								<h4><span><?php echo $month; ?></span> <?php echo $data['date']; ?></h4>
							 </div>
							 <figcaption>
								<h3><a href="<?php echo $data['link']; ?>"><?php echo $data['title']; ?> <span class="icon-light"><img src="<?=get_template_directory_uri();?>/assets/images/blue-arrow.svg"></span></a></h3>
								<p><?php echo $data['excerept']; ?></p>
							 </figcaption>
						  </div>
					   </div>
							<?php $count++; $total_article++; } ?>
					   </div>
					   <?php  }

						  }  ?>
				   </div>
<?php
  die();
}



// Pagination links for upcoming events
add_action('wp_ajax_upcomingpaginatelink', 'upcoming_event_paginate_link');
add_action('wp_ajax_nopriv_upcomingpaginatelink', 'upcoming_event_paginate_link');

function upcoming_event_paginate_link(){
  $paged = $_POST['paged'];
  $keyword = '';
  $tax_array = array();
  if(isset($_POST['tax_query']) && !empty($_POST['tax_query'])){
    $selected_tax = str_replace("\\",'', $_POST['tax_query']);
    $tax_array = json_decode($selected_tax ,true);
  }
  if(isset($_POST['serach']) && !empty($_POST['serach'])){
    $keyword = $_POST['serach'];
  }
  $date_now = date('Y-m-d H:i:s');
  $args1= array(
    'posts_per_page'	=>  4,
    'paged'           => $paged,
    'post_type'			  => 'go2hr_events',
    'meta_query' 		=> array(
      'relation' 			=> 'AND',
        array(
          'key'			=> 'event_start_date',
          'compare'		=> '>=',
          'value'			=> $date_now,
          'type'			=> 'DATETIME'
        )
        ),
    'meta_key'			=> 'event_start_date',
    'orderby'			=> 'meta_value',
    'order'				=> 'DESC',
    'meta_type'			=> 'DATE',
    's' 				  => $keyword,
		'tax_query' 	=> $tax_array,
  );


  $query = new WP_Query($args1);
  $count = $query->post_count;
    if ( $query->have_posts() ) {
        $total_pages = $query->max_num_pages;
        echo '<div class="pagination D-radius dynmic-pagi upcoming_pagi">';
        if ($total_pages > 1){
          $current_page = max(1, $paged);
              echo paginate_links(array(
                'base'      => get_pagenum_link(1) . '%_%',
                'format'    => '/page/%#%',
                'current'   => $current_page,
                'total'     => $total_pages,
                'prev_text' => '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
                'next_text' => '<i class="fa fa-chevron-right" aria-hidden="true"></i>',
    ));
    }
    echo '<li class="page-item article-count">'.$count.' Articles</li>';
    echo '</div>';
  }
  die();
}
?>

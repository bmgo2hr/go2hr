<?php
/**
 * Template Name: Event Calendar-template
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
                           <li><a href="#">Events & Resources</a></li>
                           <li><span><?php echo ($pageHeading)? $pageHeading : get_the_title();?></span></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </section>
        <!-- section  -->
        <section class="EventSearch space bg-blue" >
            <div class="container">
               <div class="row">
                  <div class="col-12 mx-auto">
                     <div class="heading-pnel fff text-center">
                        <h2>Search for Events</h2>
                     </div>
                  </div>
               </div>

               <div class="row no-gutters">
                  <div class="col-12">
                        <div class="resource-search-form">
                            <form action="" method ="get" name="event_search">
                                <div class="form-group col">
                                    <input class="form-control" name="keyword" value="" placeholder="Enter Keyword" />
                                </div>
                                <div class="form-group col">
                                    <select class="form-control" id="category" name="events">
                                        <option value="">Select an event type</option>
                                        <?php $eventCat = get_terms('events_category'); ?>
                                        <?php if (!empty($eventCat)) : ?>
                                            <?php foreach ($eventCat as $cat) : ?>
                                                <option value="<?=$cat->term_id;?>"><?=$cat->name;?></option>
                                            <?php endforeach; ?>>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <select class="form-control" id="location" name="regions">
                                        <option value="">Your Region</option>
                                        <?php $eventCat = get_terms(array( 'post_types' => 'go2hr_events', 'taxonomy' => 'events_region' )); ?>
                                        <?php if (!empty($eventCat)) : ?>
                                            <?php foreach($eventCat as $cat) : ?>
                                                <option value="<?=$cat->term_id;?>"><?=$cat->name;?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="EventSearch-btn">
                                    <input Type="Submit" Value="Search" class="green-btn" />
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
         </section>
    <?php
        //If search form is submitted -- get the vale and create tax query
        $date_now = date('Y-m-d H:i:s');
        $archive_meta_query = array(
            'relation'             => 'AND',
            array(
                'key'            => 'event_start_date',
                'compare'        => '<=',
                'value'            => $date_now,
                'type'            => 'DATETIME'
            )
        );

        $upcoming_meta_query = array(
            'relation'             => 'AND',
            array(
                'key'            => 'event_start_date',
                'compare'        => '>=',
                'value'            => $date_now,
                'type'            => 'DATETIME'
            )
        );

        $tax_array = array();
        $keyword = '';
        $sel_event ='';
        $sel_reg = '';

        if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
        }

        if (isset($_GET['events']) && !empty($_GET['events'])) {
            $sel_event= $event = $_GET['events'];
            $tax_array['relation'] = 'OR';
            $tax_array[0]['taxonomy'] = 'events_category';
            $tax_array[0]['field'] = 'term_id';
            $tax_array[0]['terms'] = $event;
        }

        if (isset($_GET['regions']) && !empty($_GET['regions'])) {
            $sel_event= $region = $_GET['regions'];
            $tax_array['relation'] = 'OR';
            $tax_array[1]['taxonomy'] = 'events_region';
            $tax_array[1]['field'] = 'term_id';
            $tax_array[1]['terms'] = $region;
        }

        if (isset($_GET['years']) && !empty($_GET['years']) && is_numeric($_GET['years'])) {
            $selected_year          = $_GET['years'];
            $current_month          =  date('m');
            $current_date           = date('d');
            $year_start_date        = $selected_year.'-01-01 00:00:00';
            $year_end_date          = $selected_year.'-31-12 00:00:00';
            $archive_meta_query = array(
                'relation'             => 'AND',
                    array(
                        'key'            => 'event_start_date',
                        'compare'        => '<=',
                        'value'            => $year_end_date,
                        'type'            => 'DATETIME'
                    ),
                    array(
                        'key'             => 'event_start_date',
                        'compare'         => '>=',
                        'value'           => $year_start_date,
                        'type'            => 'DATETIME'
                    )
                );
        }

        //If month dropdown is selected for upcoming tab
        if (isset($_GET['month']) && !empty($_GET['month'])) {
            $selected_month         = $_GET['month'];
            $upcoming_meta_query = array(
                'relation'             => 'AND',
                array(
                        'key'            => 'event_start_date',
                        'compare'        => '>=',
                        'value'            => $date_now,
                        'type'            => 'DATETIME'
                    )
            );
        }

        //use the above value to modify the WP_query object and rest will work automatically

        //For Archive
        $args1 = array(
            'posts_per_page'    =>  4,
            'post_type'            => 'go2hr_events',
            'meta_query'         =>  $archive_meta_query,
            'meta_key'            => 'event_start_date',
            'orderby'            => 'meta_value',
            'order'                => 'DESC',
            'meta_type'            => 'DATE',
            's'                 => $keyword,
            'tax_query'         => $tax_array,
        );

                //For Upcoming
                $args2= array(
                    'posts_per_page'    =>  4,
                    'post_type'            => 'go2hr_events',
                    'meta_query'         => $upcoming_meta_query,
                    'meta_key'            => 'event_start_date',
                    'orderby'            => 'meta_value',
                    'order'                => 'ASC',
                    'meta_type'            => 'DATE',
                    's'                 => $keyword,
                    'tax_query'         => $tax_array,
                );

             $active_post_array = array();
             $count=0;
             $upcoming_months = array();
             $event = new WP_Query($args2);
             //echo '<pre>'; print_r($event); echo '</pre>';
                 if ( $event -> have_posts() ) {
                   while ( $event -> have_posts() ) {
                    $event -> the_post();
                    $post_id = get_the_id();
                    $eventTitle = get_the_title();
                    $eventShortDesc = get_the_excerpt();
                    $eventLink = get_the_permalink();
                    $eventDate = strtotime(get_field('event_start_date'));    //get value from start date custom field

                    $month = date("F", $eventDate);
                    $date = date("d", $eventDate);
                    $year = date("Y", $eventDate);

                    $startDate = strtotime(date('Y-m-d', $eventDate) );
                    $currentDate = strtotime(date('Y-m-d'));
                    $count = $count+1;
                    if($startDate < $currentDate) {    //if date has passed

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
                //usort($upcoming_months, "compare_months");

                function compare_months($a, $b) {
                    $monthA = date_parse($a);
                    $monthB = date_parse($b);
                    return $monthA["month"] - $monthB["month"];
                }



                // Get data for Archive
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
                    $eventDate = strtotime(get_field('event_start_date'));    //get value from start date custom field

                    $month = date("F", $eventDate);
                    $date = date("d", $eventDate);
                    $year = date("Y", $eventDate);

                    $startDate = strtotime(date('Y-m-d', $eventDate) );
                    $currentDate = strtotime(date('Y-m-d'));
                    $count = $count+1;
                    if($startDate < $currentDate) {    //if date has passed
                        //echo $startDate.'+++';
                        //if ( in_array($year,$archive_years) ) {
                            //continue;
                        //}else{
                            //$archive_years[] = $year;
                        //}
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
                krsort($archive_post_array);

                //rsort($archive_years);
                //usort($upcoming_months, "compare_months");
                ?>

        <?php
          //Get all the available archive years
          $all_archive_years     = array();
          $all_upcoming_months     = array();
          $args3 =  array(
                        'posts_per_page'    =>  -1,
                        'post_type'            => 'go2hr_events'
                    );
          $all_event = new WP_Query($args3);
          if ( $all_event -> have_posts() ) {
              while ( $all_event -> have_posts() ) {
                  $all_event -> the_post();
                  $eventDate     = strtotime(get_field('event_start_date'));
                  $post_year     = @date("Y", $eventDate);
                  $post_month     = @date("F", $eventDate);

                  $startDate     = strtotime(date('Y-m-d', $eventDate) );
                  $currentDate     = strtotime(date('Y-m-d'));

                  if($startDate < $currentDate) {
                      if ( in_array($post_year,$all_archive_years) ) {
                      }else{
                          $all_archive_years[] = $post_year;
                      }
                  }else{
                    if ( in_array($post_month,$all_upcoming_months) ) {
                    }else{
                        $all_upcoming_months[] = $post_month;
                    }
                  }
              }
              wp_reset_postdata();
          }
          rsort($all_archive_years);
          usort($all_upcoming_months, "compare_months");
          ?>
        <section class="events_sec Event-calendarw space pb-0" >
                         <!-- Nav tabs -->
        <ul class="nav nav-tabs text-center">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#Events">Upcoming Events</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#Archive">Events Archive</a>
          </li>
        </ul>

                <!-- Tab panes -->
        <div class="tab-content bg-grey pt-5 pb-5">
          <div class="tab-pane active" id="Events">

            <div class="container">
                <div class="event-filter">
                    <div class="row">
                        <div class="col-6 text-right">
                            <!--<div class="heading-pnel text-right m-0">
                                <h2>2022</h2>
                            </div> -->
                        </div>
                        <div class="col-6 text-right">
                            <div class="event-month-filter month-filter">
                                <!--<a class="green-btn month-btn"><img src="<?=get_template_directory_uri();?>/assets/images/events/filter.png" class="" width="19" />
                                     Month <i class="fa fa-angle-down" aria-hidden="true"></i>
                                </a>
                                <ul class="month-dropdown">
                                    <?php //foreach($all_upcoming_months as $month){ ?>
                                        <li id="<?php //echo $month ?>"><?php //echo $month ?></li>
                                    <?php //}    ?>
                                </ul>
                                <span class="close-srch month-close"><i class="fa fa-times" aria-hidden="true"></i></span>-->
                            </div>
                        </div>

                    </div>
                </div>
             <div class="events_listing">

                <!-- row -->
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

                   <div class="col-12 mt-5">
                        <?php
                                $query = new WP_Query($args2);
                                $totalpost = $query->found_posts;
                              if ( $query->have_posts() ) {
                                 $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' )  : 1;
                                 $total_pages = $query->max_num_pages;
                                 echo '<div class="pagination D-radius dynmic-pagi upcoming_pagi">';
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
                              echo '<li class="page-item article-count">'.$totalpost.' Articles</li>';
                              echo '</div>';
                           }

                              ?>
                     </div>
                   <!-- pagination
                   <div class="row">
                        <div class="col-12">
                            <ul class="pagination D-radius">
                                <li class="page-item"><a class="page-link" href="javascript:Void(0);"><i class="fa fa-chevron-left" aria-hidden="true"></i></a></li>
                                <li class="page-item"><a class="page-link" href="javascript:Void(0);">1</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:Void(0);"><i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
                                <li class="page-item article-count"><?php //echo $total_article; ?> Articles</li>
                            </ul>
                        </div>
                    </div>-->

                </div>

            </div>


          </div>

          <div class="tab-pane fade" id="Archive">
            <div class="container">
                <div class="event-filter">
                    <div class="row">
                        <div class="col-6 text-right">

                            <div class="heading-pnel text-right m-0">
                                <h2 class="title-year default-year"><?php if(isset($_GET['years'])){ echo $_GET['years']; }else{ echo @$all_archive_years[0]; } ?></h2>
                                <h2 class="title-year onchange-year" style="display:none;"></h2>
                            </div>

                        </div>
                        <div class="col-6 text-right">
                            <div class="event-month-filter year-filter">
                                <a class="green-btn year-btn">
                                    <img src="<?=get_template_directory_uri();?>/assets/images/events/filter.png" class="" width="19" />
                                    <span>Year</span> <i class="fa fa-angle-down" aria-hidden="true"></i>
                                </a>
                                <ul class="month-dropdown yr-dropdown">
                            <?php foreach($all_archive_years as $year){ ?>
                                    <li id="<?php echo $year ?>"><a href="#"><?php echo $year ?></a></li>
                                <?php }    ?>

                                </ul>
                                <span class="close-srch year-close"><i class="fa fa-times" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
             <div class="events_listing">
                <!-- row -->

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
                       }    ?>
                   </div>


                   <!-- pagination -->

                   <div class="col-12 mt-5">
                        <?php
                                $query = new WP_Query($args1);
                                $totalpost = $query->found_posts;
                              if ( $query->have_posts() ) {
                                 $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' )  : 1;
                                 $total_pages = $query->max_num_pages;
                                 echo '<div class="pagination D-radius dynmic-pagi arch_pagi">';
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
                              echo '<li class="page-item article-count">'.$totalpost.' Articles</li>';
                              echo '</div>';
                           }

                              ?>
                     </div>
                    <!--
                   <div class="row">
                        <div class="col-12">
                            <ul class="pagination D-radius">
                                <li class="page-item"><a class="page-link" href="javascript:Void(0);"><i class="fa fa-chevron-left" aria-hidden="true"></i></a></li>
                                <li class="page-item"><a class="page-link" href="javascript:Void(0);">1</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:Void(0);"><i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
                                <li class="page-item article-count total_art_count"><?php //echo $total_article; ?> Articles</li>
                                <?php
                                //if(isset($year_wise_count) && !empty($year_wise_count)){
                                    //foreach($year_wise_count as $available_year=>$count_value){ ?>
                                        <li class="page-item article-count foryear-<?php //echo $available_year ?>" style="display:none;"><?php //echo $count_value; ?> Articles</li>
                                <?php //}
                                //}?>
                            </ul>
                        </div>
                    </div>-->

                </div>

          </div>
        </div>

         </section>

<?php
$path = $_SERVER['REQUEST_URI'];
$path_array = explode('/',$path);
$path_array = explode('?',$path_array[1]);
$page_url = home_url().'/'.$path_array[0];
$queryString = $_SERVER['QUERY_STRING'];
$filter_url = $page_url.'/?keyword='.$keyword.'&events='.$sel_event.'&regions='.$sel_reg;

?>
<?php get_footer(); ?>
<?php
if(isset($_GET['years']) && !empty($_GET['years']) && is_numeric($_GET['years'])){ ?>
    <script>$('.nav-tabs li:eq(1) a').tab('show'); </script>
    <?php } ?>
<?php if($_GET['years']){ ?>
    <script>
        $(".event-month-filter").addClass("add-month");
        $('.year-filter a span').html('<?php echo $_GET['years']; ?>');
        </script>
<?php } ?>

<script>
      $(".event-month-filter .green-btn").click(function() {
        $(".event-month-filter").toggleClass("month-filter-open");
        $(".event-month-filter").removeClass("add-month");
    });
    $(".year-close").click(function() {
        //$(".event-month-filter").toggleClass("month-filter-open");
        $(".year-filter").removeClass("add-month");
        $('.year-filter a span').html('Year');
        var redirect_url = '<?php echo $filter_url; ?>';
        window.location.href = redirect_url;
        //$('.archive-list').show();
        //$('.default-year').show();
        //$('.onchange-year').hide();

        //$('.article-count').hide();
        //$('.total_art_count').show();
    });

    $(".month-close").click(function() {
        //$(".event-month-filter").toggleClass("month-filter-open");
        $(".month-filter").removeClass("add-month");
        //$('.year-filter a span').html('Year');
        //$('.archive-list').show();
        //$('.default-year').show();
        //$('.onchange-year').hide();

        //$('.article-count').hide();
        //$('.total_art_count').show();
    });


    $(".month-dropdown li").click(function() {
        $(".event-month-filter").toggleClass("month-filter-open");
    });
    $(".month-dropdown li").click(function() {
        $(".event-month-filter").addClass("add-month");
    });

//$('.archive-list').hide();
//var show = $('.yr-dropdown li:first-child').attr('id');
//$('#row-'+show).show();
$('ul.yr-dropdown li').each(function(){
    var year_data = $(this).attr('id');
    $(this).find('a').attr('href','<?php echo $filter_url; ?>'+'&years='+year_data);
});
/*
$('ul.yr-dropdown li').each(function(){
    $(this).click(function(){
        var yr_id = $(this).attr('id');
        //$('.archive-list').hide();
        //$('.row-'+yr_id).show();
        //$('.title-year').html(yr_id);
        $('.onchange-year').html(yr_id);
        $('.default-year').hide();
        $('.onchange-year').show();
        $('.year-filter a span').html(yr_id);
        var redirect_url = '<?php echo $page_url; ?>'+'/?<?php echo $queryString; ?>'+'&years='+yr_id;
        window.location.href = redirect_url;
        //$('.article-count').hide();
        //$('.foryear-'+yr_id).show();
    })
})
*/
$('.month-btn ul.month-dropdown li').each(function(){
    $(this).click(function(){
        var month_id = $(this).attr('id');
        $('.active-list').hide();
        $('#month-'+month_id).show();
    })
});

customizeArchivePagination();
customizeUpcomingPagination();

function customizeArchivePagination(){
$('.arch_pagi a').on('click', function(e){
    e.preventDefault();

    var link = $(this).attr('href');
    var page_no = jQuery(this).html();
    const current_page_no = jQuery('.current').html();

    if (jQuery(this).hasClass('prev')) {
        page_no = parseInt(current_page_no) - 1;
    } else if (jQuery(this).hasClass('next')) {
        page_no = parseInt(current_page_no) + 1;
    }  else {
        page_no = jQuery(this).html();
        // $(this).addClass('current');
    }

    $.ajax({
        type:'POST',
        url : "<?php echo site_url(); ?>/wp-admin/admin-ajax.php",
        data : {
                action: "archivepaginate",
                paged: page_no,
                tax_query:'<?php echo json_encode($tax_array );?>',
                meta_query:'<?php echo json_encode($archive_meta_query );?>',
                serach:'<?php echo $keyword; ?>',
            },
            success:function(data){
                $('.archive_tab').html(data);
            }
    });

    $.ajax({
        type:'POST',
        url : "<?php echo site_url(); ?>/wp-admin/admin-ajax.php",
        data : {
                action: "archivepaginatelink",
                paged:page_no,
                tax_query:'<?php echo json_encode($tax_array );?>',
                meta_query:'<?php echo json_encode($archive_meta_query );?>',
                serach:'<?php echo $keyword; ?>',
            },
            success:function(data){
                $('.arch_pagi').html(data);
                customizeArchivePagination();
            }
    });
});
}

function customizeUpcomingPagination(){
$('.upcoming_pagi a').on('click', function(e){
    e.preventDefault();
    console.log('paginate');
    var link = $(this).attr('href');
    var page_no = jQuery(this).html();
    //$('.current').removeClass('current');
    $(this).addClass('current');
    $.ajax({
        type:'POST',
        url : "<?php echo site_url(); ?>/wp-admin/admin-ajax.php",
        data : {
                action: "upcomingpaginate",
                paged:page_no,
                tax_query:'<?php echo json_encode($tax_array );?>',
                serach:'<?php echo $keyword; ?>',
            },
            success:function(data){
                $('.upcoming_tab').html(data);
            }
    });

    $.ajax({
        type:'POST',
        url : "<?php echo site_url(); ?>/wp-admin/admin-ajax.php",
        data : {
                action: "upcomingpaginatelink",
                paged:page_no,
                tax_query:'<?php echo json_encode($tax_array );?>',
                serach:'<?php echo $keyword; ?>',
            },
            success:function(data){
                $('.upcoming_pagi').html(data);
                customizeUpcomingPagination();
            }
    });
});
}


</script>

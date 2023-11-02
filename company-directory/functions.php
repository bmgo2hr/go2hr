<?php 
// Filter by Regions companies

add_action('wp_ajax_myfilter_company_region', 'company_region_filter'); 
add_action('wp_ajax_nopriv_myfilter_company_region', 'company_region_filter');

function company_region_filter (){


    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	//if( isset( $_POST['regionfilter'] ) )

    $args = array(
        'post_type' => 'go2hr_companies',
        'posts_per_archive_page' => 15,
        'paged' => $paged,
        
    );

   
    // Region
    if( isset( $_POST['company_region_filter'] ) ){

        $args['tax_query'] = array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'company_region',
                'field' => 'id',
                'terms' => $_POST['company_region_filter']
            )
        );

    }

        echo '<div class="row">';
        $the_query = new WP_Query( $args );
                    
        if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
                //echo '<p>' . $query->post->post_title . '</p>';?>

            <?php $company_id = get_field('company_id');
              $no_company_logo = get_stylesheet_directory_uri() . '/assets/images/no-company-logo.png';
               ?>
                                                
                    <div class="col-md-4 col-sm-4">
                        <a href="<?php the_permalink() ?>">
                            <div class="company-grid">

                                <div class="company-grid-image">
                                    <img src="<?php echo (!empty($company_id)) ? $company_id : $no_company_logo ?>">
                                </div>

                                <div class="company-grid-content">
                                    <h4><?php the_title()?></h4>
                                                                
                                </div>
                            </div>
                        </a>

                    </div>
        
        <?php endwhile; ?>

            <?php echo pagination_bar()?>


        <?php else : ?>
            <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
        <?php endif;  wp_reset_postdata();  exit; ?>

        <?php echo '</div>'?>
<?php  }   




//Custom Search Form
function go2hr_companies_search($template)   
{    
  global $wp_query;   
  $post_type = get_query_var('post_type');   
  if( $wp_query->is_search && $post_type == 'go2hr_companies' )   
  {
    return locate_template('company-directory/search-companies.php');  //  redirect to archive-search.php
  }   
  return $template;   
}
add_filter('template_include', 'go2hr_companies_search');   
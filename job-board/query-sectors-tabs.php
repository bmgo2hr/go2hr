
<div class="tab-content" id="pills-tabContent">

<?php 
     if( $terms = get_terms( array(
        'taxonomy' => 'jobs_sectors', // to make it simple I use default categories
        'orderby' => 'name'
        ) ) ) : 

        $count = 0;

       foreach ( $terms as $term ) :
        $count ++;

            echo '<div class="tab-pane fade '.($count == 1 ? 'show active' : '' ).' " id="pills-'.$term->slug.'" role="tabpanel" aria-labelledby="pills-'.$term->slug.'-tab">';

            echo $term->slug;
            echo '</div>';
           
            endforeach;
                                           
            endif;
    ?>

</div>


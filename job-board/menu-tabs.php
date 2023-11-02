<?php
    $urlExplodedBySlash = explode('/', $_SERVER['REQUEST_URI']);
    $targetActiveSlug = end($urlExplodedBySlash);
?>

<div class="container">
    <div class="row">
        <div class="col-lg-10 col-12 mx-auto">
            <div class="heading-pnel line-head text-center">
                <h2>Explore All Jobs Postings</h2>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="res-filt-box">
            <div class="ResFilter-items">
                <ul>

                    <?php
                        if( $terms = get_terms( array(
                            'taxonomy' => 'jobs_sectors', // to make it simple I use default categories
                            'orderby' => 'name'
                        ) ) ) :

                            echo '<li><a href="'.home_url('/job-board').'">All Jobs</a></li>';

                            foreach ( $terms as $term ) :
                                $style = "";
                                if ($targetActiveSlug == $term->slug) $style="background: #014f9a; color: #fff;";
                                echo '<li><a href="'.home_url('jobs_sectors/'.$term->slug).'" style="'.$style.'">'. $term->name .'</a></li>';

                            endforeach;

                        endif;
                    ?>

                </ul>


            </div>
        </div>
    </div>
</div>

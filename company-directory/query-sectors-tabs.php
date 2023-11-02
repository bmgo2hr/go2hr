<div class="row">
    <div class="col-12">
        <div class="res-filt-box">
            <div class="ResFilter-items">
                <ul>
                    <?php
                        if( $terms = get_terms( array(
                            'taxonomy' => 'company_sector', // to make it simple I use default categories
                            'orderby' => 'name',
                            'hide_empty' => false
                        ) ) ) :

                            echo '<li><a href="'.home_url('/company-directory').'">All Companies</a></li>';

                            foreach ( $terms as $term ) :

                                echo '<li><a href="'.home_url('company_sector/'.$term->slug).'">'. $term->name .'</a></li>';

                            endforeach;

                        endif;
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>

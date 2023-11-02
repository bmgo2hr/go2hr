<?php
    $resources = get_field('resources');
?>
<?php if(!empty($resources)) : ?>

<?php foreach($resources as $resource) : ?>
<?php

    //$term_name =  get_the_term_list( $resource->ID, 'sb_type', '', ', ' );
    $sbTitle = $resource->post_title;
    if(!empty($resource->post_excerpt)){
        $sbShortDesc = $resource->post_excerpt;
    }else{
        $sbShortDesc = $resource->post_content;
        $sbShortDesc = substr($sbShortDesc,0,200);
    }    
    $sbLink = get_permalink( $resource->ID );

    //Taxonomy name
    $taxonomy = 'resource_topic';

    $cat_array = ( get_the_terms( $resource->ID, $taxonomy) ); 
    $term_name = get_the_term_list( $resource->ID, 'resource_tag', '', '' );
   ?>
 
<div class="training-prog-box">
    <?php if(!empty($term_name)){ ?>
        <span class="P-label"><?=$term_name;?></span>
    <?php } ?>
    <?php /*
         foreach ($cat_array as $cat ) : 
            echo '<span class="P-label"><a href="'.get_term_link($cat->slug, $taxonomy).'">'.$cat->name.'</a></span>';
            
        endforeach; */
    ?>
    <a href="<?=$sbLink?>">
        <?php if(!empty($sbTitle)){ ?><h4><?=$sbTitle;?></h4><?php } ?>
        <?php if(!empty($sbShortDesc)){ ?><p><?=$sbShortDesc?></p><?php } ?>
    </a>
    <!--<a href="<?=$sbLink?>" class="btn-border">Read More</a>-->
</div>
<?php endforeach;?>
<?php endif; ?>

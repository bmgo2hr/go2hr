<?php
    $resources = get_field('resources');
?>
<?php foreach($resources as $resource) : ?>
<?php
    $term_name =  get_the_term_list( $resource->ID, 'cor_type', '', ', ' );

    $crTitle = $resource->post_title;
    $crShortDesc = $resource->post_excerpt;
    $image_attr = wp_get_attachment_image_src(get_post_thumbnail_id($resource->ID), "medium");
    $img = $image_attr[0];
?>
<div class="training-prog-box">
    <?php if($img){ ?><figure>
        <img src="<?=$img;?>" class="w-100" />
    </figure><?php } ?>
    <span class="P-label"><a href=""><?=$term_name;?></a></span>
    <?php if($crTitle){ ?><h4><?=$crTitle;?></h4><?php } ?>
    <?php if($crShortDesc){ ?><p><?=$crShortDesc;?></p><?php } ?>
    <a href="#" class="btn-border">Read More</a>
</div>
<?php endforeach; ?>

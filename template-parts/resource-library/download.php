<?php
    $thumbnail = get_the_post_thumbnail_url();
    $date = get_the_date();
    $title = get_the_title();
    $contents = get_the_content();
    $resource_url = get_field('resource_external_url');
    $button_text = get_field('button_text');
    $terms = get_the_terms(get_the_ID(), 'subtopic');
?>

<div class="resource-library__container resource-library__download">
    <div class="download">
        <div class="download__text-content">
            <div class="download__info">
                <ul class="download__tags">
                    <?php
                    $count = count($terms);
                    foreach ($terms as $index=>$term): ?>
                        <li>
                            <a href="/resource_tag/<?= $term->slug; ?>"><?= $term->name ?></a><?php if($count > 1 && $index < $count - 1): ?>,&nbsp;<?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <p class="download__date"><?php echo $date; ?></p>
            </div>
            <h2 class="download__title"><?php echo $title ?></h2>
            <div class="download__contents">
                <?php the_content(); ?>
            </div>
            <?php if(!empty($resource_url)): ?>
            <div class="download__btn">
                <?php $isExternal = strpos($resource_url, str_replace("www.", "", $_SERVER["HTTP_HOST"])) === false; ?>
                <a class="green-btn" href="<?php echo $resource_url;?>" <?php if ($isExternal) echo " target=_blank"; ?>>
                    <?php echo $button_text; ?>
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
            <?php endif; ?>
        </div>
        <div class="download__image">
            <img src="<?php echo $thumbnail; ?>" />
        </div>
    </div>
</div>

<?php get_template_part('template-parts/resource-library/continue-exploring'); ?>

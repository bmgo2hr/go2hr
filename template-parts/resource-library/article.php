<?php
$thumbnail = get_the_post_thumbnail_url();
$date = get_the_date();
$title = get_the_title();
$contents = get_the_content();
$excerpt = get_the_excerpt();
$resource_url = get_field('resource_external_url');
$button_text = get_field('button_text');
$terms = get_the_terms(get_the_ID(), 'subtopic');
?>

<div class="resource-library__container resource-library__article">
    <div class="download">
        <div class="download__text-content">
            <div class="download__info">
                <ul class="download__tags">
                    <?php
                        $count = count($terms);
                        foreach ($terms as $index=>$term): ?>
                        <li data-num="<?= $index ?>" data-total="<?= $count ?>">
                            <?= $term->name ?><?php if($count > 1 && $index < $count - 1): ?>,&nbsp;<?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <p class="download__date"><?php echo $date; ?></p>
            </div>
            <h2 class="download__title"><?php echo $title ?></h2>
            <div class="download__contents">
                <?php echo $excerpt; ?>
            </div>
            <?php if(!empty($resource_url)): ?>
            <div class="download__btn">
                <a class="green-btn" href="<?php echo $resource_url; ?>" target="_blank">
                    <?php echo $button_text; ?>
                    <i class="fas fa-angle-right"></i>
                </a>
            </div>
            <?php endif; ?>
        </div>
        <div class="download__image">
            <img src="<?php echo $thumbnail; ?>"/>
        </div>
    </div>
</div>

<article class="resource-library__article-main">
    <section class="NewsDetail-content space pt-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-12 mx-auto">
                    <div class="NewsContent-box">
                        <div class="sharejob-main post-time">
                            <p>
                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                                <?php echo do_shortcode('[rt_reading_time postfix="min read"]'); ?>
                            </p>
                            <div class="share-job">
                                <ul>
                                    <li>
                                        <a target="_blank"
                                           href="https://twitter.com/share?url=<<?= get_the_permalink(); ?>>&text=<<?= $title; ?>>">
                                            <i class="fab fa-twitter" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a target="_blank"
                                           href="https://www.facebook.com/sharer/sharer.php?u=<<?= get_the_permalink(); ?>>&t=<<?= $title; ?>>">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a
                                            target="_blank"
                                            href="https://www.linkedin.com/shareArticle?mini=true&url='<?= get_the_permalink(); ?>'&t=<?= $title; ?>"
                                        >
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="#">
                                            <i class="fas fa-link" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="article__main-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related News -->
    <?php
        $id = get_the_ID();
        $terms = get_the_terms($id, 'subtopic');
        $term_slug = null;
        if(!empty($terms)) {
            $term_slug = $terms[0]->slug;
        }
        $args = array(
            'post_type' => 'go2hr_resources',
            'post__not_in' => array($id),
            'posts_per_page' => 3,
            'orderby' => 'rand',
            'tax_query' => array(
                array(
                    'taxonomy' => 'subtopic',
                    'field' => 'slug',
                    'terms' => array($term_slug)
                )
            )
        );

        $query = new WP_Query($args);
    ?>

    <section class="Related-news space pt-0">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="heading-pnel text-center">
                        <h2>Related Content</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <?php
                    if($query->have_posts()):
                        while ($query->have_posts()):
                            $query->the_post();
                ?>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="R-news-box">
                                    <?php
                                        $thumbnail_url = get_the_post_thumbnail_url();
                                        if(!empty($thumbnail_url)):
                                    ?>
                                        <figure>
                                            <img
                                                src="<?= $thumbnail_url; ?>"
                                                class="w-100"
                                                alt=""
                                            />
                                        </figure>
                                    <?php else: ?>
                                        <figure>
                                            <div class="related_article__placeholder"></div>
                                        </figure>
                                    <?php endif; ?>
                                    <figcaption>
                                        <ul class="related_article__tags">
                                            <?php
                                            $related_post_terms = get_the_terms($post->ID, 'subtopic');
                                            $has_terms = !empty($related_post_terms);
                                            $count = 0;
                                            if ($has_terms) {
                                                $count = count($related_post_terms);
                                            }
                                            if($has_terms):
                                            foreach ($related_post_terms as $index=>$term): ?>
                                                <li data-num="<?= $index ?>" data-total="<?= $count ?>">
                                                    <?= $term->name; ?><?php if($count > 1 && $index < $count - 1): ?>,&nbsp;<?php endif; ?>
                                                </li>
                                            <?php
                                                endforeach;
                                                endif;
                                            ?>
                                        </ul>
                                        <a href="<?php echo get_permalink(); ?>">
                                            <h3><?= the_title(); ?></h3>
                                        </a>
                                    </figcaption>
                                </div>
                            </div>
                <?php
                        endwhile;
                    endif;
                ?>

            </div>
        </div>
    </section>
</article>


<script>
    jQuery(function() {
        $("a").click(function(e) {
            e.preventDefault();
            let url = $(this).attr("href");
            let domain = '<?= $_SERVER['HTTP_HOST']; ?>'.replace("www.", "");

            if (url.indexOf(domain) !== -1) {
                window.location.href = url;
            } else {
                window.open(url, '_blank');
            }
        })
    });
</script>

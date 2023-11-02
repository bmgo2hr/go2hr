<?php
/**
 * The template for Resource Library single page
 * /resource-library/[SLUG]
 *
 */
$args = ['no-fa4' => true];
get_header();
?>
</header>

<?php
    $id = get_the_ID();
    $terms = get_the_terms($id, 'resource_type');
    $category = null;
    if(!empty($terms)) {
        $category = $terms[0]->name;
    }
?>
<main class="resource-library" data-type="<?= $category ?>">
    <?php
        if(!empty($category)) {
            if ($category == 'Download' || $category == 'Linked Resource') {
                get_template_part('template-parts/resource-library/download');
            } else if ($category == 'Linked Video') {
                get_template_part('template-parts/resource-library/video');
            } else if ($category == 'Article') {
                get_template_part('template-parts/resource-library/article');
            } else {
                get_template_part('template-parts/resource-library/article');
            }
        }
    ?>
</main>

<?php get_footer();

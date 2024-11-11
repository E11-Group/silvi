<?php get_header(); the_post();
global $post;
if ($post->post_parent > 0) {
    $parents = get_post_ancestors($post->ID);
    $parent = array_pop($parents);
} else {
    $parent = $post->post_parent;
}
$enable_section_scroll = get_field('enable_section_scroll');

$mainClass = '';
if(!empty($enable_section_scroll)){
    $mainClass = 'has-section-scroll';
}
?>
<main class="page__default <?php echo $mainClass; ?>">
    <?php if (post_password_required(get_the_ID()) || post_password_required($parent)) { ?>
    <section>
        <div class="container">
    <?php } ?>
            <?php the_content(); ?>
        <?php if (post_password_required(get_the_ID()) || post_password_required($parent)) { ?>
        </div>
    </section>
    <?php } ?>
    <?php if (!post_password_required(get_the_ID()) && !post_password_required($parent)) { ?>
    <?php include('modules/flex-content/flex-content.php') ?>
    <?php } ?>
</main>
<?php get_footer(); ?>
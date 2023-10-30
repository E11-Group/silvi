<?php
if (!empty($data['module_id'])) {
    $block_id = $data['module_id'];
} else {
    $block_id = 'block-' . uniqid();
}

$args = array('post_type' => 'post');
$args['search_filter_id'] = 373;
$query = new WP_Query($args);

?>

<?php if ($query -> have_posts() ) : ?>
<section class="news-filter" id="<?php echo esc_attr($block_id); ?>">
    <div class="container">
    <?php echo do_shortcode('[searchandfilter id="373"]'); ?>
        <div class="news-filter__wrap">
            <?php while ( $query->have_posts() ) : ?>
                <?php $query->the_post();
                ?>
                <?php get_template_part( 'template-parts/loop-archive' ); ?>
            <?php endwhile; ?>
            <?php if (function_exists('wp_pagenavi')){ ?>
                <div class="news-filter__navigation">
                    <div class="pagination">
                        <?php wp_pagenavi( array( 'query' => $query ) ); ?>
                    </div>
                </div>
            <?php  } ?>
        </div>

        <?php wp_reset_postdata(); ?>
    </div>
</section>
<?php endif; ?>
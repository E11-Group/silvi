<?php
if (!empty($data['module_id'])) {
    $block_id = $data['module_id'];
} else {
    $block_id = 'block-' . uniqid();
}
?>

<section class="featured-news" id="<?php echo esc_attr($block_id); ?>">
    <div class="container">
        <?php foreach ($data['news'] as $item) :
            $permalink = get_permalink($item->ID);
            $title = get_the_title($item->ID);
            $post_date = get_the_date('F j, Y', $item->ID);
            ?>

            <div class="featured-news__wrap">
                <figure class="featured-news__thumbnail">
                    <a href="<?php echo $permalink; ?>">
                        <?php echo get_the_post_thumbnail($item->ID, 'large'); ?>
                    </a>
                </figure>
                <div class="featured-news__body">
                    <div class="featured-news__cat">
                        <?php the_terms($item->ID, 'category', '', ' '); ?>
                    </div>
                    <h3 class="featured-news__title">
                        <a href="<?php echo $permalink; ?>"><?php echo $title; ?></a>
                    </h3>
                    <p class="featured-news__meta"><?php echo $post_date; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
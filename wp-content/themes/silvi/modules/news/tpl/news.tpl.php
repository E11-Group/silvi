<?php
if (!empty($data['module_id'])) {
    $block_id = $data['module_id'];
} else {
    $block_id = 'block-' . uniqid();
}
?>

<section class="news" id="<?php echo esc_attr($block_id); ?>">
    <div class="container">
        <?php if (!empty($data['title'] || $data['link'])): ?>
            <header class="news__header">
                <?php if (!empty($data['title'])): ?>
                    <h2 class="news__title"><?php echo $data['title']; ?></h2>
                <?php endif; ?>

                <?php $link = $data['link'];
                    if ($link):
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                    <a class="more-link more-link--dark" href="<?php echo esc_url($link_url); ?>"
                        target="<?php echo esc_attr($link_target); ?>"><span><?php echo esc_html($link_title); ?></span></a>
                <?php endif; ?>
            </header>
        <?php endif; ?>

        <?php
        $post_per_page = $data['number_of_post_to_display'] ? $data['number_of_post_to_display'] : '3';


        $args = array(
                'post_type' => 'post',
                'posts_per_page' => $post_per_page
        );
        $query = new WP_Query($args);
            if($query->have_posts() || !empty($data['news'])):
        ?>
            <div class="news__grid js-news-slider">
                <?php
                if(!empty($data['news'])):
                    $selected_post_id = array();
                    $count = count($data['news']);
                foreach ($data['news'] as $item):
                    $permalink = get_permalink($item->ID);
                    $title = get_the_title($item->ID);
                    $post_date = get_the_date( 'F j, Y', $item->ID);
                    $selected_post_id[] = $item->ID;
                ?>
                    <div class="news__item">
                        <article class="news-card">
                            <figure class="news-card__media" style="background-image: url('<?php echo get_the_post_thumbnail_url($item->ID, 'large'); ?>');">
                                <a href="<?php echo $permalink; ?>">
                                    <?php echo get_the_post_thumbnail($item->ID, 'large'); ?>
                                </a>
                            </figure>
                            <div class="news-card__body">
                                <p class="news-card__meta"><?php echo $post_date; ?></p>
                                <h3 class="news-card__title">
                                    <a href="<?php echo $permalink; ?>"><?php echo $title; ?></a>
                                </h3>
                            </div>
                        </article>
                    </div>
                <?php
                endforeach; ?>
                    <?php
                        if($count < $post_per_page){
                            $remaining_post = $post_per_page - $count;
                            $args1 = array(
                                'post_type' => 'post',
                                'posts_per_page' => $remaining_post,
                                'post__not_in' => $selected_post_id, //Excluded previously loaded post
                            );
                            $query1 = new WP_Query($args1);
                            if($query1->have_posts()){
                                while ($query1->have_posts()){
                                    $query1->the_post();
                                    $permalink = get_permalink(get_the_ID());
                                    $title = get_the_title(get_the_ID());
                                    $post_date = get_the_date( 'F j, Y', get_the_ID());
                                    ?>
                                    <div class="news__item remaining-items">
                                        <article class="news-card">
                                            <figure class="news-card__media" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>');">
                                                <a href="<?php echo $permalink; ?>">
                                                    <?php echo get_the_post_thumbnail(get_the_ID(), 'large'); ?>
                                                </a>
                                            </figure>
                                            <div class="news-card__body">
                                                <p class="news-card__meta"><?php echo $post_date; ?></p>
                                                <h3 class="news-card__title">
                                                    <a href="<?php echo $permalink; ?>"><?php echo $title; ?></a>
                                                </h3>
                                            </div>
                                        </article>
                                    </div>
                             <?php   }
                                wp_reset_postdata();
                            }
                        }
                    ?>
                <?php
                else: // else load latest post
                    while ($query->have_posts()){
                        $query->the_post();
                        $permalink = get_permalink(get_the_ID());
                        $title = get_the_title(get_the_ID());
                        $post_date = get_the_date( 'F j, Y', get_the_ID());
                        ?>
                        <div class="news__item remaining-items">
                            <article class="news-card">
                                <figure class="news-card__media" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>');">
                                    <a href="<?php echo $permalink; ?>">
                                        <?php echo get_the_post_thumbnail(get_the_ID(), 'large'); ?>
                                    </a>
                                </figure>
                                <div class="news-card__body">
                                    <p class="news-card__meta"><?php echo $post_date; ?></p>
                                    <h3 class="news-card__title">
                                        <a href="<?php echo $permalink; ?>"><?php echo $title; ?></a>
                                    </h3>
                                </div>
                            </article>
                        </div>
                    <?php   }
                    wp_reset_postdata();

                    ?>

                <?php endif; ?>


            </div>
        <?php endif; ?>
    </div>
</section>
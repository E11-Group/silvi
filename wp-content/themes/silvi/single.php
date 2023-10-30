<?php get_header(); the_post();?>
<main class="page__single">
    <div class="post-container">
        <div class="container">

            <div class="post-container__inner">


                <article class="post-detail" id="post-<?php echo get_the_ID(); ?>">
                    <div class="post-detail__inner">

                        <?php if (has_post_thumbnail()) : ?>
                            <figure class="post-detail__thumbnail">
                                <?php the_post_thumbnail('full', array('class' => 'post-detail__thumbnail')); ?>
                            </figure>
                        <?php endif; ?>

                        <header class="post-detail__header">
                            <div class="featured-news__cat">
                                <?php the_terms($item->ID, 'category', '', ' '); ?>
                            </div>
                            <h1 class="post-detail__title"><?php the_title(); ?></h1>
                        </header>

                        <?php
                        $post_date = get_the_date('F j, Y', $post->ID);
                        ?>
                        <p><time><?php echo $post_date; ?></time></p>

                        <div class="post-content entry-content">
                                <?php the_content(); ?>
                        </div>

                        <div class="post-content__share">
                            <h5 class="post-content__share-title">
                                <?php esc_html_e('Share this post', 'silvi'); ?>
                            </h5>
                            <?php echo do_shortcode('[ssba-buttons]'); ?>
                        </div>
                    </div>
                </article>
                <aside class="post-sidebar">
                    <h3 class="post-sidebar__title">
                        <?php esc_html_e('Recent Posts', 'silvi'); ?>
                    </h3>
                    <?php

                    $args = array(
                        'numberposts'    => 4,
                    );
                    $custom_posts = get_posts($args);


                    foreach ($custom_posts as $post) :
                        $permalink = get_permalink($post->ID);
                        $title = get_the_title($post->ID);
                        $post_date = get_the_date('F j, Y', $post->ID);
                        ?>
                        <div class="post-sidebar__item">
                            <article class="news-filter__card news-filter__card--small" id="post-<?php echo get_the_ID(); ?>">
                                <?php if (has_post_thumbnail($item->ID)) : ?>
                                    <figure class="news-filter__media" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>');">
                                        <a href="<?php echo $permalink; ?>">
                                            <?php echo get_the_post_thumbnail($item->ID, 'large'); ?>
                                        </a>
                                    </figure>
                                <?php endif; ?>
                                <div class="featured-news__cat">
                                    <?php the_terms(get_the_ID(), 'category', '', ' '); ?>
                                </div>
                                <h3 class="news-filter__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

                                <p><time><?php echo $post_date; ?></time></p>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </aside>
            </div>
        </div>
    </div>
    <?php include('modules/flex-content-single/flex-content-single.php') ?>
</main>
<?php get_footer(); ?>
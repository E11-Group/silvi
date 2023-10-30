<?php get_header(); ?>
<main class="page__blog">
    <div class="blog-holder">
        <div class="container">
            <div class="page__blog-primary">
                <h1 class="page__title"><?php echo get_the_archive_title(); ?></h1>
                <?php

                if ( have_posts() ) : ?>
                    <div class="news-filter__wrap">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php get_template_part( 'template-parts/loop-archive' ); ?>
                        <?php endwhile; ?>
                    </div>
                    <?php if (function_exists('wp_pagenavi')){ ?>
                        <div class="news-filter__navigation">
                            <div class="pagination">
                                <?php wp_pagenavi(); ?>
                            </div>
                        </div>
                    <?php  } ?>
                <?php
                else : ?>
                    <?php echo 'Not Found.'; ?>
                <?php endif; ?>
            </div>
        </div>
    </div><!--.blog-holder-->
</main>
<?php get_footer(); ?>
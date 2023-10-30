<article class="news-filter__card" id="post-<?php echo get_the_ID(); ?>">
    <?php if (has_post_thumbnail()): ?>
        <figure class="news-filter__media" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>');">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('large'); ?>
            </a>
        </figure>
    <?php endif; ?>
    <div class="featured-news__cat">
        <?php the_terms(get_the_ID(), 'category', '', ' '); ?>
    </div>
    <h3 class="news-filter__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <?php 
        $post_date = get_the_date( 'F j, Y', get_the_ID());
    ?>
    <p><time><?php echo $post_date; ?></time></p>
</article>
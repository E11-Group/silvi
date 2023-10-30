<?php
get_header();
the_post();
?>
<main class="page__404">
    <div class="container">
        <h1><?php esc_html_e('Error 404. Page not found.', 'silvi'); ?></h1>
        <p><?php esc_html_e('Sorry, the page you are looking for no longer exists. Perhaps you can return back to the homepage.', 'silvi'); ?> </p>
        <a href="<?php echo site_url(); ?>" class="btn" target="_self">
            <?php esc_html_e('Back to Homepage', 'silvi'); ?>
        </a>
    </div>
</main>
<?php get_footer(); ?>
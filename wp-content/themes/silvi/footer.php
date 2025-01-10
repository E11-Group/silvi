<?php
$enable_section_scroll = get_field('enable_section_scroll');

$footerClass = 'footer';
if(!empty($enable_section_scroll)){
    $footerClass = 'footer scroll-section fp-auto-height';
}
?>

<footer class="<?php echo $footerClass; ?>" data-id="footer">
<?php
        $phone = get_field('phone_number', 'options');
        $linkedin = get_field('linkedin_url', 'options');
        $instagram = get_field('instagram_url', 'options');
        $facebook = get_field('facebook_url', 'options');
        $tiktok = get_field('tiktok_url', 'options');
        $youtube = get_field('youtube_url', 'options');
        $logo =  get_field('footer_logo', 'options');
        $footer_title = get_field('social_title', 'options');
        $footer_disclaimer = get_field('footer_disclaimer', 'options');
    ?>

    <div class="container">
        <div class="footer__primary">
            <div class="footer__column footer__column--branding">
                <div class="footer__branding">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="logo__link">
                        <div class="logo__wrap">
                            <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>">
                        </div>
                        <span class="visually-hidden"><?php bloginfo('name'); ?></span>
                        <meta itemprop="name" content="<?php bloginfo('name'); ?>">
                    </a>
                    <?php if(!empty($phone)): ?>
                        <a class="footer-link" href="tel:<?php echo preg_replace('/\D+/', '', $phone); ?>"><?php echo $phone; ?></a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="footer__column footer__column--menu">

                <?php
                $menuArgs = array(
                    'container' => false,
                    'theme_location' => 'utility-navigation',
                    'menu' => 'Utility Navigation',
                    'menu_class' => 'footer-nav'
                );
                wp_nav_menu($menuArgs);
                ?>
            </div>

            <div class="footer__column footer__column--additional">


                <?php
                $menuArgs = array(
                    'container' => false,
                    'theme_location' => 'footer-additional-links',
                    'menu' => 'Footer Additional Links',
                    'menu_class' => 'footer-nav'
                );
                wp_nav_menu($menuArgs);
                ?>
            </div>

            <?php if(!empty($facebook || $youtube || $instagram || $linkedin || $tiktok)): ?>
            <div class="footer__column footer__column--social">
                    <div class="footer__social">

                    <?php if (!empty($footer_title)) : ?>
                        <h2 class="footer__title">
                            <?php echo $footer_title; ?>
                        </h2>
                    <?php endif; ?>
                        <ul class="social-links">
                            <?php if (!empty($facebook)) : ?>
                                <li>
                                    <a href="<?php echo esc_url($facebook); ?>" target="_blank">
                                        <svg class="icon icon-facebook">
                                            <use xlink:href="#icon-facebook"></use>
                                        </svg>
                                        <span class="accessible-text">facebook</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (!empty($youtube)) : ?>
                                <li>
                                    <a href="<?php echo esc_url($youtube); ?>" target="_blank">
                                        <svg class="icon icon-youtube">
                                            <use xlink:href="#icon-youtube"></use>
                                        </svg>
                                        <span class="accessible-text">youtube</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (!empty($instagram)) : ?>
                                <li>
                                    <a href="<?php echo esc_url($instagram); ?>" target="_blank">
                                        <svg class="icon icon-instagram">
                                            <use xlink:href="#icon-instagram"></use>
                                        </svg>
                                        <span class="accessible-text">instagram</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (!empty($linkedin)) : ?>
                                <li>
                                    <a href="<?php echo esc_url($linkedin); ?>" target="_blank">
                                        <svg class="icon icon-linkedin">
                                            <use xlink:href="#icon-linkedin"></use>
                                        </svg>
                                        <span class="accessible-text">linkedin</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (!empty($tiktok)) : ?>
                                <li>
                                    <a href="<?php echo esc_url($tiktok); ?>" target="_blank">
                                        <svg class="icon icon-tiktok">
                                            <use xlink:href="#icon-tiktok"></use>
                                        </svg>
                                        <span class="accessible-text">tiktok</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="footer__secondary">
            <div class="policy__navigation">
                <?php if($footer_disclaimer) : ?>
                <p class="footer__disclaimer"><?php echo $footer_disclaimer; ?></p>
                <?php endif; ?>
                <?php
                $menuArgs = array(
                    'container' => false,
                    'theme_location' => 'policy-navigation',
                    'menu' => 'Policy Navigation',
                    'menu_class' => 'policy-nav'
                );
                wp_nav_menu($menuArgs);
                ?>
            </div>

            <div class="footer__copyright">
                <p class="copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
            </div>
        </div>
    </div>
</footer>
</div>
</div>
<?php wp_footer(); ?>
<?php get_template_part('template-parts/icons'); ?>
</body>
</html>
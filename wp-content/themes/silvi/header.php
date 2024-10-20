<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="google-site-verification" content="3j6HqcyrwbrO-1NeRL8pozLgHFD0qGWadTX6jsBabIk" />
    <?php wp_head(); ?>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "Silvi Materials",
        "image": "https://www.silvi.com/wp-content/uploads/2021/11/logo.svg",
        "@id": "",
        "url": "https://www.silvi.com/",
        "telephone": "+18004266273",
        "priceRange": "$$",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "355 Newbold Rd",
            "addressLocality": "Fairless Hills",
            "addressRegion": "PA",
            "postalCode": "19030",
            "addressCountry": "US"
        },
        "geo": {
            "@type": "GeoCoordinates",
            "latitude": 40.1893554,
            "longitude": -74.79340859999999
        },
        "openingHoursSpecification": {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": [
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday",
                "Saturday"
            ],
            "opens": "04:00",
            "closes": "19:00"
        },
        "sameAs": [
            "https://www.facebook.com/silvimaterials",
            "https://www.instagram.com/silvi_materials/",
            "https://www.youtube.com/channel/UCCCc2688AZROCgnJwZa9tDw",
            "https://www.linkedin.com/company/silvi-materials/",
            "https://www.tiktok.com/@silvi_materials"
        ]
    }
    </script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-XMS61DC37S"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-XMS61DC37S');
    </script>

</head>
<?php

if (is_single() && 'post' == get_post_type()) {
    $section_classes = ' header--alt';
} elseif (is_category() || is_archive() || is_single() || is_home() && 'post' == get_post_type()) {
    $section_classes = ' header--alt';
} elseif (is_404()) {
    $section_classes = ' header--alt';
} else {
    $section_classes = '';
}
$header_logo = get_field('header_logo', 'options');
// Determine if a hero module is first on the page
$pageBuilderClass = "no-hero-module";
$moduleCount = 0;
if (function_exists('have_rows')):
    if (have_rows('page_builder')):
        $page_id = get_the_ID();
        // loop through the rows of data
        while (have_rows('page_builder')):
            the_row();
            $moduleCount++;
            if ($moduleCount == 1) {
                $layout = get_row_layout();
                if ($layout == "hero" || $layout == "hero_links" || $layout == "hero_with_icons" || $layout == "page_banner") {
                    $pageBuilderClass = 'has-hero-module';
                }
            }

        endwhile;
    endif;
endif;
?>

<body <?php body_class($pageBuilderClass); ?>>
    <div class="site">
        <div class="site-wrapper">
            <?php
            $notice_content = get_field('notice_bar_text', 'option');
            $notice_images = get_field('notice_bar_images', 'option');
            if (is_front_page() && (!empty($notice_content) || !empty($notice_images))): ?>
                <div class="notice-bar">
                    <div class="container">
                        <div class="notice-bar__inner">
                            <?php if (!empty($notice_content)): ?>
                                <div class="notice-bar__content<?php if (empty($notice_images)) {
                                    echo ' full';
                                } ?>">
                                    <?php echo $notice_content; ?>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($notice_images)): ?>
                                <div class="notice-bar__images<?php if (empty($notice_content)) {
                                    echo ' full';
                                } ?>">
                                    <?php foreach ($notice_images as $notice_image):
                                        $img = $notice_image['image'];
                                        if (!empty($img)):
                                            ?>
                                            <figure class="notice-bar__image">
                                                <?php echo wp_get_attachment_image($img['ID'], 'full', '', array('class' => '')); ?>
                                            </figure>
                                        <?php endif; endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif;
            ?>
            <header class="header js-header<?php echo esc_attr($section_classes); ?>">
                <div class="container">
                    <div class="header-primary">

                        <div class="header__branding">
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo__link">
                                <div class="logo__wrap">
                                    <img src="<?php echo esc_url($header_logo['url']); ?>"
                                        alt="<?php echo esc_attr($header_logo['alt']); ?>">
                                </div>
                                <span class="visually-hidden"><?php bloginfo('name'); ?></span>
                                <meta itemprop="name" content="<?php bloginfo('name'); ?>">
                            </a>
                        </div>
                        <div class="header__navigation">

                            <div class="header__secondary">
                                <nav class="secondary-navigation">
                                    <?php
                                    $menuArgs = array(
                                        'container' => false,
                                        'theme_location' => 'secondary-navigation',
                                        'menu' => 'Secondary Navigation',
                                        'menu_class' => 'primaryNav',
                                        'walker' => new Mobile_Walker()
                                    );
                                    wp_nav_menu($menuArgs);
                                    ?>
                                </nav> <!-- .main-navigation ends -->

                            </div> <!-- .header__primary ends -->
                            <div class="header__primary">
                                <nav class="main-navigation">
                                    <?php
                                    $menuArgs = array(
                                        'container' => false,
                                        'theme_location' => 'main-navigation',
                                        'menu' => 'Main Navigation',
                                        'menu_class' => 'primaryNav',
                                        'walker' => new Mobile_Walker()
                                    );
                                    wp_nav_menu($menuArgs);
                                    ?>
                                </nav> <!-- .main-navigation ends -->

                            </div> <!-- .header__primary ends -->
                        </div>

                        <a href="#" class="mobileNav__toggle js-nav-toggle">
                            <span class="accessible-text">Click to toggle navigation menu.</span>
                            <div class="menuBar__container">
                                <span class="menuBar"></span>
                                <span class="menuBar"></span>
                                <span class="menuBar"></span>
                            </div>
                        </a>

                    </div>
                </div>
                <?php if (have_rows('mega_menu', 'option')): ?>
                    <div class="megamenu">
                        <?php while (have_rows('mega_menu', 'option')):
                            the_row();
                            $parent_menu_id = get_sub_field('mm_menu_id');
                            $title = get_sub_field('mm_title');
                            $content = get_sub_field('mm_content');
                            $card_title = get_sub_field('mm_cardtitle');
                            $card_image = get_sub_field('mm_cardimage');
                            $card_content = get_sub_field('mm_cardcontent');
                            $card_button = get_sub_field('mm_cardbutton');
                            $links = get_sub_field('mm_links');
                            $choose_mega_menu_styles = get_sub_field('choose_mega_menu_styles');
                            $mega_links_list = get_sub_field('mega_links_list');

                            ?>
                            <div class="megamenu__item <?php echo $parent_menu_id; ?>">
                                <div class="megamenu__inner">
                                    <?php if ($choose_mega_menu_styles == 'menu2'): ?>
                                        <div class="megamenu__card--style">
                                            <?php foreach ($mega_links_list as $link_item):
                                                $mega_links = $link_item['link_item'];
                                                $secondary_menu = $link_item['secondary_links'];
                                                if ($link_item):
                                                    $link_url = $mega_links['url'];
                                                    $link_title = $mega_links['title'];
                                                    $link_target = $mega_links['target'] ? $mega_links['target'] : '_self';
                                                    ?>
                                                    <div class="mega-menu__primary-link">
                                                        <a href="<?php echo esc_url($link_url); ?>"
                                                            target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?><svg
                                                                class="icon icon-silviRightArrow">
                                                                <use xlink:href="#icon-silviRightArrow"></use>
                                                            </svg></a>
                                                        <?php if (!empty($secondary_menu)): ?>
                                                            <div class="mega-menu__secondary-list">
                                                                <?php foreach ($secondary_menu as $secondary):
                                                                    $s_link = $secondary['s_link'];
                                                                    if ($s_link):
                                                                        $link_url = $s_link['url'];
                                                                        $link_title = $s_link['title'];
                                                                        $link_target = $s_link['target'] ? $s_link['target'] : '_self';
                                                                        ?>
                                                                        <a href="<?php echo esc_url($link_url); ?>"
                                                                            target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php else: ?>
                                        <div class="megamenu__content">
                                            <?php if (!empty($title)): ?>
                                                <h2 class="megamenu__title">
                                                    <?php echo $title; ?>
                                                </h2>
                                            <?php endif; ?>

                                            <?php if (!empty($content)): ?>
                                                <div class="megamenu__description entry-content">
                                                    <?php echo $content; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <?php if (!empty($links)): ?>
                                            <nav class="megamenu__navigation">
                                                <ul>
                                                    <?php foreach ($links as $item): ?>
                                                        <li>
                                                            <?php $link = $item['link'];
                                                            if ($link):
                                                                $link_url = $link['url'];
                                                                $link_title = $link['title'];
                                                                $link_target = $link['target'] ? $link['target'] : '_self';
                                                                ?>
                                                                <a href="<?php echo esc_url($link_url); ?>"
                                                                    target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                                                            <?php endif; ?>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </nav>
                                        <?php endif; ?>

                                        <div class="megamenu__card">
                                            <?php if (!empty($card_image)): ?>
                                                <figure class="megamenu__card-thumbnail">
                                                    <img src="<?php echo esc_url($card_image['url']); ?>"
                                                        alt="<?php echo esc_attr($card_image['alt']); ?>">
                                                </figure>
                                            <?php endif; ?>
                                            <div class="megamenu__card-body">
                                                <?php if (!empty($card_title)): ?>
                                                    <h3 class="megamenu__card-title">
                                                        <?php echo $card_title; ?>
                                                    </h3>
                                                <?php endif; ?>

                                                <?php if (!empty($card_content)): ?>
                                                    <div class="megamenu__card-excerpt entry-content">
                                                        <?php echo $card_content; ?>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($card_button)): ?>
                                                    <div class="megamenu__card-button-holder">
                                                        <?php $link = $card_button;
                                                        if ($link):
                                                            $link_url = $link['url'];
                                                            $link_title = $link['title'];
                                                            $link_target = $link['target'] ? $link['target'] : '_self';
                                                            ?>
                                                            <a class="btn btn--dark" href="<?php echo esc_url($link_url); ?>"
                                                                target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>

                <nav class="mobile-nav">
                    <div class="mobile-nav__wrapper">
                        <?php
                        $menuArgs = array(
                            'container' => false,
                            'theme_location' => 'secondary-navigation',
                            'menu_class' => 'secondaryNavMobile',
                            'walker' => new Mobile_Walker()
                        );
                        wp_nav_menu($menuArgs);
                        ?>
                        <?php
                        $menuArgs = array(
                            'container' => false,
                            'theme_location' => 'mobile-navigation',
                            'menu_class' => 'primaryNavMobile',
                            'walker' => new Mobile_Walker()
                        );
                        wp_nav_menu($menuArgs);
                        ?>
                    </div>
                </nav>
            </header>
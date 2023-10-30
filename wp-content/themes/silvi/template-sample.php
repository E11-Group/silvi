<?php
// Template Name: Sample Page
get_header();
?>
<main class="page__home">

    <?php //include('modules/flex-content/flex-content.php') 
    ?>

    <section class="hero">

        <div class="hero__slider js-hero-slider">
            <figure class="hero__image" style="background-image:url('<?php echo get_stylesheet_directory_uri(); ?>/uploads/hero.jpg')">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/uploads/hero.jpg" alt="">
            </figure>

            <figure class="hero__image" style="background-image:url('<?php echo get_stylesheet_directory_uri(); ?>/uploads/hero.jpg')">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/uploads/hero.jpg" alt="">
            </figure>

            <figure class="hero__image" style="background-image:url('<?php echo get_stylesheet_directory_uri(); ?>/uploads/hero.jpg')">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/uploads/hero.jpg" alt="">
            </figure>

            <figure class="hero__image" style="background-image:url('<?php echo get_stylesheet_directory_uri(); ?>/uploads/hero.jpg')">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/uploads/hero.jpg" alt="">
            </figure>

            <figure class="hero__image" style="background-image:url('<?php echo get_stylesheet_directory_uri(); ?>/uploads/hero.jpg')">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/uploads/hero.jpg" alt="">
            </figure>


        </div>

        <div class="hero__primary">
            <div class="container">
                <div class="hero__content">
                    <h1 class="hero__title">
                        Materials, Elevated.
                    </h1>
                    <h2 class="hero__subtitle">
                        High-Quality Materials. Exceptional Service. Built with Silvi. Built to Last.
                    </h2>
                </div>
            </div>
        </div>

        <div class="hero__secondary">
            <div class="hero__menu js-hero-thumbnail">
                <div class="hero__menu-item">
                    <div class="hero__menu-background" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/uploads/RIC-Google-Aerial-2016-900x800.jpg');"></div>
                    <h3 class="hero__menu-title">
                        <a href="#">Locations</a>
                    </h3>
                </div>

                <div class="hero__menu-item">
                    <div class="hero__menu-background" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/uploads/Cement-900x800.jpg');"></div>
                    <h3 class="hero__menu-title">
                        <a href="#">Silvi at home</a>
                    </h3>
                </div>

                <div class="hero__menu-item">
                    <div class="hero__menu-background" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/uploads/work-at-silvi.jpg');"></div>
                    <h3 class="hero__menu-title">
                        <a href="#">Working at Silvi</a>
                    </h3>
                </div>

                <div class="hero__menu-item">
                    <div class="hero__menu-background" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/uploads/SilviTruck.jpg');"></div>
                    <h3 class="hero__menu-title">
                        <a href="#">Silvi Swag</a>
                    </h3>
                </div>

                <div class="hero__menu-item">
                    <div class="hero__menu-background" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/uploads/Cement-900x800.jpg');"></div>
                    <h3 class="hero__menu-title">
                        <a href="#">Silvi at home</a>
                    </h3>
                </div>

            </div>
        </div>
    </section> <!-- .hero ends -->

    <section class="callout">
        <div class="callout__primary">
            <div class="callout-intro">
                <div class="callout-intro__body">
                    <h2 class="callout-intro__title">
                        Our Expertise
                    </h2>

                    <div class="callout-intro__description entry-content">
                        <p>
                            Silvi Materials has been helping companies, contractors, and homeowners build a better future since 1947. Today, Silvi Materials is a premier supplier of ready-mix concrete, cement, sand, stone, slag, and rock salt with a global reach.
                        </p>
                    </div>

                    <div class="callout-intro__button-holder">
                        <a href="#" class="btn btn--dark">
                            Learn More
                        </a>
                    </div>
                </div>

                <figure class="callout-intro__thumbnail">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/uploads/expertise.jpg" alt="">
                </figure>
            </div>
        </div>

        <div class="callout__secondary">
            <div class="callout-card">
                <figure class="callout-card__thumbnail" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/uploads/olena-sergienko-3BlVILvh9hM-unsplash.jpg');">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/uploads/olena-sergienko-3BlVILvh9hM-unsplash.jpg" alt="">
                </figure>
                <h3 class="callout-card__subtitle">
                    SUSTAINABILITY
                </h3>
                <h2 class="callout-card__title">
                    <a href="#">Thinking Green</a>
                </h2>
            </div>
            <div class="callout-card">
                <figure class="callout-card__thumbnail" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/uploads/SilviTruck.jpg');">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/uploads/SilviTruck.jpg" alt="">
                </figure>
                <h3 class="callout-card__subtitle">
                    FROM THE BEGINNING
                </h3>
                <h2 class="callout-card__title">
                    <a href="#">Our Story</a>
                </h2>
            </div>
        </div>
    </section> <!-- .callout ends -->

    <section class="products-slider">
        <header class="products-slider__header">
            <div class="container">
                <h2 class="products-slider__title">
                    Explore our Products
                </h2>
                <a href="#" class="more-link">View All Products</a>
            </div>
        </header>

        <div class="products-slider__slider js-products-showcase-slider">
            <div class="products-slider__slide">
                <div class="product-card">
                    <figure class="product-card__thumbnail" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/uploads/products/concrete.jpg');">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/uploads/products/concrete.jpg" alt="">
                    </figure>
                    <h2 class="product-card__title">
                        Concrete
                    </h2>

                    <div class="product-card__info">
                        <div class="product-card__inner">
                            <figure class="product-card__logo">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.svg" alt="">
                            </figure>
                            <div class="product-card__description entry-content">
                                <p>
                                    Our sand operation has all major varieties of sand, with reliable uniformity of both size and color.
                                </p>
                            </div>

                            <div class="product-card__button-holder">
                                <a href="#" class="btn">Learn More</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="products-slider__slide">
                <div class="product-card">
                    <figure class="product-card__thumbnail" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/uploads/products/sand.jpg');">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/uploads/products/sand.jpg" alt="">
                    </figure>
                    <h2 class="product-card__title">
                        Sand
                    </h2>

                    <div class="product-card__info">
                        <div class="product-card__inner">
                            <figure class="product-card__logo">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.svg" alt="">
                            </figure>
                            <div class="product-card__description entry-content">
                                <p>
                                    Our sand operation has all major varieties of sand, with reliable uniformity of both size and color.
                                </p>
                            </div>

                            <div class="product-card__button-holder">
                                <a href="#" class="btn">Learn More</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="products-slider__slide">
                <div class="product-card">
                    <figure class="product-card__thumbnail" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/uploads/products/stone.jpg');">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/uploads/products/stone.jpg" alt="">
                    </figure>
                    <h2 class="product-card__title">
                        Stone
                    </h2>

                    <div class="product-card__info">
                        <div class="product-card__inner">
                            <figure class="product-card__logo">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.svg" alt="">
                            </figure>
                            <div class="product-card__description entry-content">
                                <p>
                                    Our sand operation has all major varieties of sand, with reliable uniformity of both size and color.
                                </p>
                            </div>

                            <div class="product-card__button-holder">
                                <a href="#" class="btn">Learn More</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="products-slider__slide">
                <div class="product-card">
                    <figure class="product-card__thumbnail" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/uploads/products/slag.jpg');">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/uploads/products/slag.jpg" alt="">
                    </figure>
                    <h2 class="product-card__title">
                        A longer title
                    </h2>

                    <div class="product-card__info">
                        <div class="product-card__inner">
                            <figure class="product-card__logo">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.svg" alt="">
                            </figure>
                            <div class="product-card__description entry-content">
                                <p>
                                    Our sand operation has all major varieties of sand, with reliable uniformity of both size and color.
                                </p>
                            </div>

                            <div class="product-card__button-holder">
                                <a href="#" class="btn">Learn More</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="products-slider__slide">
                <div class="product-card">
                    <figure class="product-card__thumbnail" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/uploads/products/rock-salt.jpg');">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/uploads/products/rock-salt.jpg" alt="">
                    </figure>
                    <h2 class="product-card__title">
                        Salt
                    </h2>

                    <div class="product-card__info">
                        <div class="product-card__inner">
                            <figure class="product-card__logo">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.svg" alt="">
                            </figure>
                            <div class="product-card__description entry-content">
                                <p>
                                    Our sand operation has all major varieties of sand, with reliable uniformity of both size and color.
                                </p>
                            </div>

                            <div class="product-card__button-holder">
                                <a href="#" class="btn">Learn More</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- .products-slider ends -->

    <section class="cta-block" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/uploads/pexels-binyamin-mellish-186077.jpg');">
        <div class="container">
            <h2 class="cta-block__title">
                Silvi at home
            </h2>
            <div class="cta-block__description entry-content">
                <p>
                    We’ve got a wide selection of materials for home projects and renovations.
                </p>
            </div>
            <div class="cta-block__button-holder">
                <a href="#" class="btn">
                    Learn More
                </a>
            </div>
        </div>
    </section> <!-- .cta-block ends -->
</main>
<?php get_footer(); ?>
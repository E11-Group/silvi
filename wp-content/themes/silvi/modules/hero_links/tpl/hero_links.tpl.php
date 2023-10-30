<?php
if (!empty($data['module_id'])) {
    $block_id = $data['module_id'];
} else {
    $block_id = 'block-' . uniqid();
}
?>


<section class="hero hero__links" id="<?php echo esc_attr($block_id); ?>" data-animate>

        <div class="hero__slider">
            <div class="hero__image" style="background-image: url(<?php echo esc_url($data['image']['url']); ?>);">
                <?php if (!empty($data['background_video'])) : ?>
                    <div class="hero__video-container">
                        <video aria-hidden="true" class="hero__video video" playsinline autoplay muted loop>
                            <source src="<?php echo esc_url($data['background_video']); ?>" type="video/mp4">
                        </video>
                    </div>
                <?php endif; ?>

                <div class="hero__primary">
                    <div class="container">
                        <div class="hero__content">
                            <?php if (!empty($data['title'])) : ?>
                                <h1 class="hero__title"><?php echo $data['title']; ?></h1>
                            <?php endif; ?>
                            <?php if (!empty($data['subtitle'])) : ?>
                                <h2 class="hero__subtitle"><?php echo $data['subtitle']; ?></h2>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php if (!empty($data['image'])) : ?>
                    <figure>
                        <img src="<?php echo esc_url($data['image']['url']); ?>"
                             alt="<?php echo esc_attr($data['image']['alt']); ?>">
                    </figure>
                <?php endif; ?>
            </div>
        </div>

    <?php if (!empty($data['links'])) : ?>
        <div class="hero__secondary">
            <div class="hero__menu js-hero-links">
                <?php foreach ($data['links'] as $item) : ?>
                    <div class="hero__menu-item">
                        <a href="<?php echo $item['link']['url']; ?>" target="<?php echo $item['link']['target']; ?>">
                            <div class="hero__menu-background"
                                 style="background-image:url('<?php echo esc_url($item['image']['url']); ?>')"></div>
                        <h3 class="hero__menu-title">
                            <?php echo $item['link']['title']; ?>
                        </h3>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</section>
<!-- .hero ends -->

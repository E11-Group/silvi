<?php
if (!empty($data['module_id'])) {
    $block_id = $data['module_id'];
} else {
    $block_id = 'block-' . uniqid();
}
?><section class="hero" id="<?php echo esc_attr($block_id); ?>" data-animate>
    <?php if (!empty($data['slides'])) : ?>
        <div class="hero__slider js-hero-slider">
            <?php foreach ($data['slides'] as $item) :
                $bgImage = $item['image']['url'];
                if ($item['background_type'] == 'video') {
                    $add_video .= ' video-container';
                }

                ?>
                <div class="hero__image" <?php echo !empty($bgImage && 'image' == $item['background_type']) ? 'style="background-image:url(' . esc_url($bgImage) . ');"' : ''; ?>>
                    <?php if (!empty($item['video'] && $item['background_type'] == 'video')) : ?>
                        <div class="hero__video-container<?php echo esc_attr($add_video); ?>">
                            <video aria-hidden="true" class="hero__video video" autoplay="" muted="" loop="" playsinline
                                   webkit-playsinline>
                                <source src="<?php echo esc_url($item['video']); ?>" type="video/mp4">
                            </video>
                        </div>
                    <?php endif; ?>

                    <div class="hero__primary">
                        <div class="container">
                            <div class="hero__content">
                                <?php if (!empty($item['title'])) : ?>
                                    <h1 class="hero__title"><?php echo $item['title']; ?></h1>
                                <?php endif; ?>
                                <?php if (!empty($item['subtitle'])) : ?>
                                    <h2 class="hero__subtitle"><?php echo $item['subtitle']; ?></h2>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php if (!empty($item['image'] && 'image' == $item['background_type'])) : ?>
                        <figure>
                            <img src="<?php echo esc_url($item['image']['url']); ?>"
                                 alt="<?php echo esc_attr($item['image']['alt']); ?>">
                        </figure>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($data['slides'])) : ?>
        <div class="hero__secondary">
            <div class="hero__menu js-hero-thumbnail">
                <?php foreach ($data['slides'] as $item) : ?>
                    <div class="hero__menu-item">
                        <?php if (!empty($item['image'] && $item['background_type'] == 'image')) : ?>
                            <div class="hero__menu-background"
                                 style="background-image:url('<?php echo esc_url($item['image']['url']); ?>')"></div>
                        <?php endif; ?>
                        <?php if (!empty($item['video'] && $item['background_type'] == 'video')) : ?>
                            <div class="hero__menu-background"
                                 style="background-image:url('<?php echo esc_url($item['thumbnail_image']['url']); ?>')"></div>
                        <?php endif; ?>
                        <h3 class="hero__menu-title">
                            <?php echo $item['bullet_text']; ?>
                        </h3>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</section>
<!-- .hero ends -->
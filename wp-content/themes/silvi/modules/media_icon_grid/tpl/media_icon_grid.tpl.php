<?php
if (!empty($data['module_id'])) {
    $block_id = $data['module_id'];
} else {
    $block_id = 'block-' . uniqid();
}

$list_item = $data['list_item']
    ?>
<section class="media-icon-grid" id="<?php echo esc_attr($block_id); ?>" data-animate>
    <?php foreach ($list_item as $list):
        ?>
        <div class="media-icon-grid__item">
            <?php if (!empty($list['image'])): ?>
                <figure class="hero-icons__bg-image">
                    <img src="<?php echo esc_url($list['image']['url']); ?>"
                        alt="<?php echo esc_attr($list['image']['alt']); ?>">
                </figure>
            <?php endif; ?>
            <div class="hero-icons__video-container">
                <video aria-hidden="true" class="hero-icons__video video" playsinline autoplay muted loop>
                    <source src="<?php echo esc_url($list['background_video']['url']); ?>" type="video/mp4">
                </video>
            </div>
            <div class="hero-icons__wrap">
                <div class="hero-icons__primary">
                    <?php if (!empty($list['title'])): ?>
                        <h2 class="media_icon_grid__title">
                            <?php echo $list['title']; ?>
                        </h2>
                    <?php endif; ?>
                    <?php if (!empty($list['icons'])): ?>
                        <div class="hero-icons__secondary">
                            <?php foreach ($list['icons'] as $item): ?>
                                <div class="hero-icons__menu-item">
                                    <img src="<?php echo esc_url($item['icon_image']['url']); ?>"
                                        alt="<?php echo esc_attr($item['icon_image']['alt']); ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php if (!empty($list['link'])): ?>
                <div class="media-icon-grid__item--link-container">
                <a href="<?php echo $list['link']['url']; ?>" class="media-icon-grid__item--link btn">
                    <?php echo $list['link']['title']; ?>
                </a>
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</section>
<!-- .hero ends -->
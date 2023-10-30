<?php
if (!empty($data['module_id'])) {
    $block_id = $data['module_id'];
} else {
    $block_id = 'block-' . uniqid();
}
$bgImage = $data['image']['url'];
print_r();
$add_video = "";
if ( $data['bg_type']  == 'video') {
    $add_video .= ' video-container';
}

if ( $data['subtitle_style']  == 'long') {
    $title_classes .= ' hero__subtitle--alt';
}?>
<section class="hero hero--small" id="<?php echo esc_attr($block_id); ?>">
    <div class="hero__image" <?php echo !empty($bgImage) ? 'style="background-image:url(' . esc_url($bgImage) . ');"' : ''; ?>>
        <div class="hero__primary">
            <div class="container">
                <div class="hero__content">
                    <?php if (!empty($data['title'])): ?>
                        <h1 class="hero__title"><?php echo $data['title']; ?></h1>
                    <?php endif; ?>
                    <?php if (!empty($data['subtitle'])): ?>
                        <h2 class="hero__subtitle<?php echo esc_attr($title_classes); ?>"><?php echo $data['subtitle']; ?></h2>
                    <?php endif; ?>

                    <?php if (!empty($data['button'])): ?>
                        <?php $link = $data['button'];
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                            ?>
                        <a class="btn" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php if (!empty($data['image'])) : ?>
            <figure>
                <img src="<?php echo esc_url($data['image']['url']); ?>" alt="<?php echo esc_attr($data['image']['alt']); ?>">
            </figure>
        <?php endif; ?>

        <?php if (!empty($data['video'] && $data['bg_type']  == 'video')): ?>
            <div class="hero__video<?php echo esc_attr($add_video); ?>">
                <video aria-hidden="true" class="video" autoplay="" muted="" loop="" playsinline webkit-playsinline>
                    <source src="<?php echo esc_url($data['video'] ); ?>" type="video/mp4" >
                </video>
            </div>
        <?php endif; ?>
    </div>
</section>
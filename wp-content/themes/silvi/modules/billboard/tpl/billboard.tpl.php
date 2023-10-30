<?php
if (!empty($data['module_id'])) {
    $block_id = $data['module_id'];
} else {
    $block_id = 'block-' . uniqid();
}

$bgImage = $data['bg_image']['url'];
$add_video = "";
if ( $data['bg_type']  == 'video') {
    $add_video .= ' video-container';
}
?>

<section class="billboard" <?php echo !empty($bgImage) ? 'style="background-image:url(' . esc_url($bgImage) . ');"' : ''; ?>>

    <div class="container">
        <div class="billboard__content">
            <?php if (!empty($data['title'])) : ?>
                <h2 class="billboard__title"><?php echo $data['title']; ?></h2>
            <?php endif; ?>

            <?php if (!empty($data['content'])) : ?>
                <div class="billboard__description entry-content">
                    <?php echo $data['content']; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($data['button'])) : ?>
                <div class="billboard__button-holder">
                    <?php $link = $data['button'];
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                    <a class="btn btn--large" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php if (!empty($data['video'] && $data['bg_type']  == 'video')): ?>
        <div class="billboard__video<?php echo esc_attr($add_video); ?>">
            <video aria-hidden="true" class="video" autoplay="" muted="" loop="" playsinline webkit-playsinline>
                <source src="<?php echo esc_url($data['video'] ); ?>" type="video/mp4" >
            </video>
        </div>
    <?php endif; ?>
</section>

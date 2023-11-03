<?php
if (!empty($data['module_id'])) {
    $block_id = $data['module_id'];
} else {
    $block_id = 'block-' . uniqid();
}
$bgImage = $data['image']['url'];

$add_video = "";
if ( $data['bg_type']  == 'video') {
    $add_video .= ' video-container';
}
$title_classes = '';
if ( $data['subtitle_style']  == 'long') {
    $title_classes .= ' hero__subtitle--alt';
}
?>
<section class="hero hero--small" id="<?php echo esc_attr($block_id); ?>">
    <div class="hero__image"
        <?php echo !empty($bgImage) ? 'style="background-image:url(' . esc_url($bgImage) . ');"' : ''; ?>>
        <div class="hero__primary">
            <div class="container">
                <div class="hero__content">
                    <?php if (!empty($data['title'])): ?>
                    <h1 class="hero__title"><?php echo $data['title']; ?></h1>
                    <?php endif; ?>
                    <?php if (!empty($data['subtitle'])): ?>
                    <h2 class="hero__subtitle<?php echo esc_attr($title_classes); ?>"><?php echo $data['subtitle']; ?>
                    </h2>
                    <?php endif; ?>

                    <?php
                    if($data['button_type'] == 'trigger-popup' && !empty($data['button'])) { ?>
                        <a class="btn btn--large hero__fancybox-btn" href="#fancyboxHero" data-fancybox >
                            <?php echo $data['button']['title']; ?>
                        </a>
                   <?php } else {
                            if(!empty($data['button'])):
                        ?>
                        <a class="btn" href="<?php echo esc_url($data['button']['url']); ?>"
                           target="<?php echo esc_attr(!empty($data['button']['target']) ? $data['button']['target'] : '_self'); ?>"><?php echo esc_html($data['button']['title']); ?></a>
                   <?php endif;
                    }  ?>
                </div>
            </div>
        </div>
        <?php if (!empty($data['image'])) : ?>
        <figure>
            <img src="<?php echo esc_url($data['image']['url']); ?>"
                alt="<?php echo esc_attr($data['image']['alt']); ?>">
        </figure>
        <?php endif; ?>

        <?php if (!empty($data['video'] && $data['bg_type']  == 'video')): ?>
        <div class="hero__video<?php echo esc_attr($add_video); ?>">
            <video aria-hidden="true" class="video" autoplay="" muted="" loop="" playsinline webkit-playsinline>
                <source src="<?php echo esc_url($data['video'] ); ?>" type="video/mp4">
            </video>
        </div>
        <?php endif; ?>
        <?php
            if(!empty($data['popup_main_title']) || !empty($data['popup_sub_title']) || !empty($data['gravity_form_shortcode'])):
        ?>
        <div class="hero__fancybox-content" id="fancyboxHero" style="display: none">
            <button type="button" data-fancybox-close="" class="hero__popup-close" title="close">
                <svg class="icon icon-cross">
                    <use xlink:href="#icon-cross"></use>
                </svg>
            </button>
            <?php
            if(!empty($data['popup_main_title']) || !empty($data['popup_sub_title'])):
            ?>
            <div class="hero__popup-heading">
                <?php if(!empty($data['popup_logo_image'])): ?>
                <figure class="hero__popup-media">
                    <img src="<?php echo esc_url($data['popup_logo_image']['url']); ?>"
                        alt="<?php echo esc_attr(!empty($data['popup_logo_image']['alt']) ? $data['popup_logo_image']['alt'] : ''); ?>">
                </figure>
                <?php endif; ?>
                <?php if(!empty($data['popup_main_title'])): ?>
                <h3 class="hero__popup-title"><?php echo $data['popup_main_title']; ?></h3>
                <?php endif; ?>
                <?php if(!empty($data['popup_sub_title'])): ?>
                <h4 class="hero__popup-subtitle"><?php echo $data['popup_sub_title']; ?></h4>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <?php
            if(!empty($data['gravity_form_shortcode'])): ?>
            <div class="hero__popup-form" id="your-form-element">
                <?php echo do_shortcode( $data['gravity_form_shortcode'] ); ?>
             <input type="hidden" id="formSubmissionStatus" name="formSubmissionStatus" value="not-submitted">
        </div>
            <div class="hero__popup-confirmation">
                <button type="button" data-fancybox-close="" class="hero__popup-close" title="close">
                    <svg class="icon icon-cross">
                        <use xlink:href="#icon-cross"></use>
                    </svg>
                </button>
                <div class="hero__popup-confirm">
                    <figure class="hero__popup-media">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/logoSilvi.svg"
                            alt="Description of image">
                    </figure>
                    <h3 class="hero__popup-title">Thanks for reaching out. One of our associates will be in touch soon.
                    </h3>
                </div>
            </div>
            <?php endif; ?>
        </div>
            <?php endif; ?>
    </div>
</section>
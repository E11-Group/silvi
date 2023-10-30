<?php
if (!empty($data['module_id'])) {
    $block_id = $data['module_id'];
} else {
    $block_id = 'block-' . uniqid();
}

$section_classes = "";
$card_classes = "";

if ( $data['title_style']  == 'true') {
    $section_classes .= ' image-boxes__box-title--alt';
    $card_classes .= ' image-boxes__item--alt';
}

?>

<section class="image-boxes" id="<?php echo esc_attr($block_id); ?>">
    <?php if (!empty($data['title'])): ?>
        <div class="image-boxes__header">
            <div class="container">
                <h2 class="image-boxes__title"><?php echo $data['title']; ?></h2>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($data['boxes'])) : ?>
        <div class="image-boxes__wrap">
            <?php $count = 1; ?>
            <?php foreach ($data['boxes'] as $item) :
                $buttontype = $item['button_option'];
                $bgImage = $item['image']['url'];
            ?>
                <div class="image-boxes__item<?php echo esc_attr( $card_classes ); ?>" data-animate-css="fadeInUp" <?php echo !empty($bgImage && 'image' == $item['background_type']) ? 'style="background-image:url(' . esc_url($bgImage) . ');"' : ''; ?>>
                    <?php if (!empty($item['video'] && $item['background_type'] == 'video')): ?>
                        <div class="image-boxes__video video-container">
                            <video aria-hidden="true" class="video" autoplay="" muted="" loop="" playsinline webkit-playsinline>
                                <source src="<?php echo esc_url($item['video'] ); ?>" type="video/mp4" >
                            </video>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($item['icon'])) : ?>
                        <figure class="image-boxes__icon">
                            <img src="<?php echo esc_url($item['icon']['url']); ?>"
                                alt="<?php echo esc_attr($item['logo']['alt']); ?>">
                        </figure>
                    <?php endif; ?>

                    <?php if (!empty($item['title'])): ?>
                        <h3 class="image-boxes__box-title<?php echo esc_attr( $section_classes ); ?>">
                            <?php echo $item['title']; ?>
                        </h3>
                    <?php endif; ?>

                    <?php echo $item['content']; ?>

                    <?php if (!empty($item['logo'] || $item['hovercontent'] || $item['button'] || $item['modal_title'] || $item['modal_content'] || $item['modal_repeater'])): ?>
                        <div class="image-boxes__overlay">
                            <div class="image-boxes__overlay-inner">
                                <?php if (!empty($item['logo'])): ?>
                                    <figure class="image-boxes__logo">
                                        <img src="<?php echo esc_url($item['logo']['url']); ?>" alt="<?php echo esc_attr($item['logo']['alt']); ?>">
                                    </figure>
                                <?php endif; ?>

                                <?php echo $item['hovercontent']; ?>

                                <?php if ('link' === $buttontype): ?>
                                    <?php  $link = $item['button'];
                                        if ($link):
                                            $link_url = $link['url'];
                                            $link_title = $link['title'];
                                            $link_target = $link['target'] ? $link['target'] : '_self';
                                            ?>
                                        <a class="btn btn--large" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if ('modal' === $buttontype): ?>
                                    <?php if (!empty($item['modal_title'] || $item['modal_content'] || $item['modal_repeater'])): ?>
                                        <a class="btn btn--large" data-fancybox href="#section-<?php echo $count; ?>"><?php esc_html_e('Learn More', 'silvi'); ?></a>
                                    <?php endif; ?>
                                <?php endif; ?>

                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <?php $count++; ?>
            <?php endforeach; ?>
        </div>


        <div class="modal-container" style="display: none;" aria-hidden="true">
            <?php $count2 = 1; ?>
            <?php foreach ($data['boxes'] as $item): ?>
                <?php if (!empty($item['modal_title'] || $item['modal_content'] || $item['modal_repeater'])): ?>
                    <div class="modal" id="section-<?php echo $count2; ?>">
                        <?php if (!empty($item['modal_title'])): ?>
                            <header class="modal__header">
                                <h2 class="modal__title"><?php echo $item['modal_title']; ?></h2>
                            </header>
                        <?php endif; ?>
                        <?php if (!empty($item['modal_content'] || $item['modal_repeater'])): ?>
                            <div class="modal__body">

                            <?php if (!empty($item['modal_content'])): ?>
                                <div class="modal__content entry-content">
                                    <?php echo $item['modal_content']; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($item['modal_repeater'])): ?>
                                <ul class="modal__list">
                                    <?php foreach ($item['modal_repeater'] as $item1) : ?>
                                        <li class="modal__item">
                                            <?php if (!empty($item1['title'])): ?>
                                                <h3 class="modal__item-title">
                                                    <?php echo $item1['title']; ?>
                                                </h3>
                                            <?php endif; ?>

                                            <?php if (!empty($item1['button'])): ?>
                                                <div class="modal__item-action">
                                                    <?php $link = $item1['button'];
                                                        $link_url = $link['url'];
                                                        $link_title = $link['title'];
                                                        $link_target = $link['target'] ? $link['target'] : '_self';
                                                        ?>
                                                    <a class="btn-download" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                                                        <span class="btn-download__icon">
                                                            <svg class="icon icon-download">
                                                                <use xlink:href="#icon-download"></use>
                                                            </svg>
                                                        </span>
                                                        <?php echo esc_html($link_title); ?>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                            </div>
                            <?php if($item['modal_adobe_pdf_reader']) : ?>
                            <a href="https://www.adobe.com/acrobat/pdf-reader.html" target="_blank" class="modal-download-pdf-reader"><span class="accessible-text">Download Adobe PDF Reader</span></a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <?php $count2++; ?>
            <?php endforeach; ?>
        </div>

    <?php endif; ?>

</section>

<style>
                    <?php if(!empty($item['image'])) :
                            $overlay_value = $data['image_box_overlay'] ? $data['image_box_overlay'] : '0.5';
                        ?>
                        <?php ?>.image-boxes__item:after {
                            content: "";
                            display: block;
                            opacity: <?php echo $overlay_value; ?>;
                            position: absolute;
                            height: 100%;
                            width: 100%;
                            left: 0;
                            top: 0;
                            background-color: #111E27;
                        }
                    <?php endif; ?>
                </style>

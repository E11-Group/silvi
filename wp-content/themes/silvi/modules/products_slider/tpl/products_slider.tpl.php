<?php
if (!empty($data['module_id'])) {
    $block_id = $data['module_id'];
} else {
    $block_id = 'block-' . uniqid();
}
?>

<section class="product-slider" id="<?php echo esc_attr($block_id); ?>">
    <header class="product-slider__header">
        <div class="container">
            <?php if (!empty($data['title'])) : ?>
                <h2 class="product-slider__title"><?php echo $data['title']; ?></h2>
            <?php endif; ?>

            <?php $link = $data['button'];
            if ($link) :
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                <a class="more-link" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></span></a>
            <?php endif; ?>
        </div>
    </header>
    <?php if (!empty($data['products'])) : ?>
        <div class="product-slider__wrap js-products-showcase-slider">
            <?php foreach ($data['products'] as $item) :
                $bgImage = $item['image']['url'];
                $add_video = "";
                if ( $item['background_type']  == 'video') {
                    $add_video .= ' video-container';
                }
            ?>
                <div class="product-slider__item" <?php echo !empty($bgImage && 'image' == $item['background_type']) ? 'style="background-image:url(' . esc_url($bgImage) . ');"' : ''; ?>>
                        
                    <div class="product-card<?php echo esc_attr($add_video); ?>">
                        <?php if (!empty($item['video'] && $item['background_type']  == 'video')): ?>
                            <div class="product-card__video">
                                <video aria-hidden="true" class=" video" autoplay="" muted="" loop="" playsinline webkit-playsinline>
                                    <source src="<?php echo esc_url($item['video'] ); ?>" type="video/mp4" >
                                </video>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($item['image'] && 'image' == $item['background_type'])) : ?>
                            <figure class="product-card__thumbnail" style="background-image: url('<?php echo esc_url($item['image']['url']); ?>');">
                                <img src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr($item['image']['alt']); ?>">
                            </figure>
                        <?php endif; ?>
                        <h2 class="product-card__title">
                            <?php echo $item['title']; ?>
                        </h2>

                        <div class="product-card__info">
                            <div class="product-card__inner">
                                <figure class="product-card__logo">
                                    <img src="<?php echo esc_url($item['logo']['url']); ?>" alt="<?php echo esc_attr($item['logo']['alt']); ?>">
                                </figure>
                                <div class="product-card__description entry-content">
                                    <?php echo $item['content']; ?>
                                </div>

                                <div class="product-card__button-holder">

                                    <?php $link = $item['link'];
                                            if ($link) :
                                                $link_url = $link['url'];
                                                $link_title = $link['title'];
                                                $link_target = $link['target'] ? $link['target'] : '_self';
                                                ?>
                                        <a class="btn" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    </div>

                    

                </div>


            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>
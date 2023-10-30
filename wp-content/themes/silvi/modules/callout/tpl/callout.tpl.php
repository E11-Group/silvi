<?php
if (!empty($data['module_id'])) {
    $block_id = $data['module_id'];
} else {
    $block_id = 'block-' . uniqid();
}
?>

<section class="callout" id="<?php echo esc_attr($block_id); ?>">
    <?php if (!empty($data['title'] || $data['content'] || $data['button'])) :




        $add_video = "";
        if ($data['background_type']  == 'video') {
            $add_video .= ' video-container';
        }

        ?>
        <div class="callout__primary">
            <div class="callout-intro<?php echo esc_attr($add_video); ?>">
                <?php if ($data['background_type']  == 'image' && !empty($data['image'])) : ?>
                    <div class="callout-intro__background" style="background-image: url('<?php echo esc_url($data['image']['url']); ?>');"></div>
                <?php endif;

                    if (!empty($data['video'] && $data['background_type']  == 'video')) : ?>
                    <div class="callout-card__video">
                        <video aria-hidden="true" class="video" autoplay="" muted="" loop="" playsinline webkit-playsinline>
                            <source src="<?php echo esc_url($data['video']); ?>" type="video/mp4">
                        </video>
                    </div>
                <?php endif; ?>
                <div class="callout-intro__body">
                    <?php if (!empty($data['title'])) : ?>
                        <h2 class="callout-intro__title"><?php echo $data['title']; ?></h2>
                    <?php endif; ?>

                    <?php if (!empty($data['title'])) : ?>
                        <div class="callout-intro__description entry-content">
                            <?php echo $data['content']; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($data['button'])) : ?>
                        <div class="callout-intro__button-holder">
                            <?php $link = $data['button'];
                                    $link_url = $link['url'];
                                    $link_title = $link['title'];
                                    $link_target = $link['target'] ? $link['target'] : '_self';
                                    ?>
                            <a class="btn <?php echo $data['background_type'] == "video" ? '' : 'btn--dark'?>" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                        </div>
                    <?php endif; ?>

                </div>


            </div>
        </div>
    <?php endif; ?>


    <?php if (!empty($data['block'])) : ?>
        <div class="callout__secondary">
            <?php foreach ($data['block'] as $item) :
                    $bgImage = $item['image']['url'];
                    $add_video = "";
                    if ($item['background_type']  == 'video') {
                        $add_video .= ' video-container';
                    }
                    ?>
                <div class="callout-card<?php echo esc_attr($add_video); ?>">
                    <?php if (!empty($item['image'] && 'image' == $item['background_type'])) : ?>
                        <figure class="callout-card__thumbnail" <?php echo !empty($bgImage && 'image' == $item['background_type']) ? 'style="background-image:url(' . esc_url($bgImage) . ');"' : ''; ?>>
                            <img src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr($item['image']['alt']); ?>">
                        </figure>
                    <?php endif; ?>

                    <?php if (!empty($item['subtitle'])) : ?>
                        <h3 class="callout-card__subtitle"><?php echo $item['subtitle']; ?></h3>
                    <?php endif; ?>

                    <?php if (!empty($item['title'])) : ?>
                        <h2 class="callout-card__title">
                            <?php if (!empty($item['link'])) : ?>
                                <?php $link = $item['link'];
                                                $link_url = $link['url'];
                                                $link_title = $link['title'];
                                                $link_target = $link['target'] ? $link['target'] : '_self';
                                                ?>
                                <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo $item['title']; ?></a>
                            <?php else : ?>
                                <?php echo $item['title']; ?>
                            <?php endif; ?>
                        </h2>
                    <?php endif; ?>

                    <?php if (!empty($item['video'] && $item['background_type']  == 'video')) : ?>
                        <div class="callout-card__video">
                            <video aria-hidden="true" class=" video" autoplay="" muted="" loop="" playsinline webkit-playsinline>
                                <source src="<?php echo esc_url($item['video']); ?>" type="video/mp4">
                            </video>
                        </div>
                    <?php endif; ?>

                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</section> <!-- .callout ends -->
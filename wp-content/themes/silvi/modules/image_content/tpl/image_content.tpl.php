<?php
if (!empty($data['module_id'])) {
    $block_id = $data['module_id'];
} else {
    $block_id = 'block-' . uniqid();
}

?>

<section class="columns" id="<?php echo esc_attr($block_id); ?>">
    <?php if (!empty($data['columns'])): ?>
        <div class="columns__wrap">
            <?php foreach ($data['columns'] as $item):
                $section_classes = "";
                $type = $item['content_type'];
                if ('dark' === $item['bg_color']) {
                    $section_classes .= ' columns__column--dark';
                }

                if ('content' === $type) {
                    $section_classes .= ' columns__column--content';
                } elseif ('image' === $type) {
                    $section_classes .= ' columns__column--image';
                }
                if ('large' === $item['content_size']) {
                    $section_classes .= ' columns__column--large';
                }


                if ($item['hide_media_on_mobile']) {
                    $section_classes .= ' columns__column--hide-xs';
                }
                if (empty($item['image']) && empty($item['video'])) {
                    $addClass = 'has-no-image';
                }

                ?>
                <div class="columns__column<?php echo esc_attr($section_classes); ?>  <?php echo esc_attr($addClass); ?>">
                    <?php if ('content' === $type):
                        ?>
                        <?php if (!empty($item['title'] || $item['content'])): ?>
                            <div class="columns__inner">
                                <?php if (!empty($item['title'])): ?>
                                    <h2 class="columns__title"><?php echo $item['title']; ?></h2>
                                <?php endif; ?>
                                <?php if (!empty($item['content'])): ?>
                                    <div class="columns__description entry-content">
                                        <?php echo $item['content']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if ('image' === $type): ?>
                        <?php if (!empty($item['image']) && 'image' === $type && 'image' == $item['background_type']): ?>
                            <?php foreach ($item['image'] as $item1): ?>
                                <div class="columns__column--large-inner">
                                    <figure class="columns__media" style="background-image: url('<?php echo esc_url($item1['url']); ?>')">
                                        <img src="<?php echo esc_url($item1['url']); ?>" alt="<?php echo esc_attr($item1['alt']); ?>">
                                    </figure>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php if (!empty($item['video'] && $item['background_type'] == 'video')): ?>
                            <div class="columns__video video-container">
                                <video aria-hidden="true" class="video" autoplay="" muted="" loop="" playsinline webkit-playsinline>
                                    <source src="<?php echo esc_url($item['video']); ?>" type="video/mp4">
                                </video>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>
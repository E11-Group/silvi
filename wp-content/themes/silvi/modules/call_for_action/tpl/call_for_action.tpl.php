<?php
if (!empty($data['module_id'])) {
    $block_id = $data['module_id'];
} else {
    $block_id = 'block-' . uniqid();
}
?>
<section class="call-for-action" id="<?php echo esc_attr($block_id); ?>">
    <?php if (!empty($data['box'])) : ?>
        <div class="call-for-action__row">
            <?php foreach ($data['box'] as $item) :
                    $columnClass = '';
                    $bgImage = $item['image']['url'];

                    if (!empty($bgImage) && 'image' == $item['style'])  {
                        $columnClass = ' call-for-action__column--image';
                    }
                    ?>
                <div class="call-for-action__column<?php echo $columnClass; ?>" <?php echo !empty($bgImage && 'image' == $item['style']) ? 'style="background-image:url(' . esc_url($item['image']['url']) . ');"' : ''; ?>>
                    <?php if (!empty($bgImage && 'image' == $item['style'])) : ?>
                        <span class="call-for-action__overlay"></span>
                    <?php endif; ?>
                    <div class="call-for-action__inner">
                        <?php if (!empty($item['title'])) : ?>
                            <h2 class="call-for-action__title">
                                <?php echo $item['title']; ?>
                            </h2>
                        <?php endif; ?>

                        <div class="call-for-action__description">
                            <?php echo $item['content']; ?>
                        </div>
                        <div class="call-for-action__btn-holder">
                            <?php $link = $item['button'];
                                    if ($link) :
                                        $link_url = $link['url'];
                                        $link_title = $link['title'];
                                        $link_target = $link['target'] ? $link['target'] : '_self';
                                        ?>
                                <a class="btn<?php echo !empty($bgImage && 'image' == $item['style']) ? '' : ' btn--dark'; ?>" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>
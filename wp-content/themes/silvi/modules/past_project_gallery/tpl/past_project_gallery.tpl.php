<?php
if (!empty($data['module_id'])) {
    $block_id = $data['module_id'];
} else {
    $block_id = 'block-' . uniqid();
}
?>

<section class="grid-popup" id="<?php echo esc_attr($block_id); ?>">
    <?php if (!empty($data['title'])): ?>
        <div class="container">
            <h2 class="grid-popup__title">
                <?php echo $data['title']; ?>
            </h2>
        </div>
    <?php endif; ?>
    <?php
    $total = count($data['gallery_item']);
    $result = $total % 2 == 0 ? $total / 2  : ceil($total / 2);
    ?>
    <div class="grid-popup__grid" style="--item-col: <?php echo $result; ?>">
        <?php
        $count = 1;

        foreach ($data['gallery_item'] as $item):
            $item_title = $item['title'];
            $item_main_thumb = $item['image'];
            $item_gallery = $item['gallery_image'];
            $thumb = !empty($item_main_thumb) ? $item_main_thumb['url'] : $item_gallery[0]['url'];
            ?>
            <div class="grid-popup__item"
                 style="background-image: url('<?php echo esc_url($thumb); ?>')">
                <a class="cover-link" data-fancybox="image-gallery<?php echo $block_id . '-' . $count; ?>"
                   href="<?php echo esc_url($item_gallery[0]['url']); ?>"
                   data-caption="<?php echo esc_url($item_gallery[0]['caption']); ?>">
                </a>

                <?php if (!empty($item_title)): ?>
                    <h3 class="grid-popup__item-title"><?php echo $item_title; ?></h3>
                <?php endif; ?>
                <?php
                $item = 1;
                if(!empty($item_gallery)):
                foreach ($item_gallery as $gallery):
                    if ($item > 1):
                        ?>
                        <a href="<?php echo esc_url($gallery['url']); ?>"
                           data-fancybox="image-gallery<?php echo $block_id . '-' . $count; ?>"
                           data-caption="<?php echo $gallery['caption']; ?>" style="display: none;">
                        </a>
                    <?php
                    endif;
                    $item++;
                endforeach;
                endif;
                ?>
            </div>
            <?php
            $count++;
        endforeach; ?>
    </div>
</section>
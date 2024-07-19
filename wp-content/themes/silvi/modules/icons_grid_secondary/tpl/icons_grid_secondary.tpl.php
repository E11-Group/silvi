<?php
if (!empty($data['module_id'])) {
    $block_id = $data['module_id'];
} else {
    $block_id = 'block-' . uniqid();
}
?>

<section class="icon-list" id="<?php echo esc_attr($block_id); ?>">
    <div class="icon-list__wrap">
        <?php if (!empty($data['title'])): ?>
            <h2 class="icon-list__title"><?php echo $data['title']; ?></h2>
        <?php endif; ?>
        <?php if (!empty($data['grid'])):
            $gridClass = ' items'.count($data['grid']);
            ?>
            <div class="icon-list__grid<?php echo esc_attr($gridClass); ?>">
                <?php foreach ($data['grid'] as $item):
                    $icon = $item['icon'];
                    $item_title = $item['title'];
                    $item_link = $item['link_detail'];
                    ?>
                    <div class="icon-list__item<?php if(!empty($item_link)) { echo ' icon-list__item-has-link'; } ?>">
                        <?php if (!empty($icon)): ?>
                            <figure class="icon-list__media">
                                <img src="<?php echo esc_url($icon['url']); ?>"
                                     alt="<?php echo esc_attr(!empty($icon['alt']) ? $icon['alt'] : ''); ?>">
                            </figure>
                        <?php endif; ?>
                        <?php if (!empty($item_title)): ?>
                            <h3 class="icon-list__item-title">
                                <?php echo $item_title; ?>
                            </h3>
                        <?php endif; ?>
                        <?php if (!empty($item_link)): ?>
                            <a href="<?php echo esc_url($item_link['url']); ?>"
                               target="<?php echo esc_attr(!empty($item_link['target']) ? $item_link['target'] : '_self'); ?>"
                               class="cover-link">
                                <?php echo !empty($item_link['title']) ? $item_link['title'] : 'View Detail'; ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php
                endforeach; ?>
            </div>

        <?php endif; ?>
    </div>
</section>
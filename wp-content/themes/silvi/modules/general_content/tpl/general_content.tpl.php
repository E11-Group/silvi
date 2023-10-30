<?php
if (!empty($data['module_id'])) {
    $block_id = $data['module_id'];
} else {
    $block_id = 'block-' . uniqid();
}
?>
<section class="general-content" id="<?php echo esc_attr($block_id); ?>">
    <div class="container">
        <?php if (!empty($data['title'])): ?>
            <h2 class="general-content__title"><?php echo $data['title']; ?></h2>
        <?php endif; ?>
        <?php if (!empty($data['content'])): ?>
            <div class="general-content__content entry-content">
                <?php echo $data['content']; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
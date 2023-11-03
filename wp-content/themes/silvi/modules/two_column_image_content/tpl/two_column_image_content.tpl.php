<?php
if (!empty($data['module_id'])) {
    $block_id = $data['module_id'];
} else {
    $block_id = 'block-' . uniqid();
}
?>

<section class="two-column" id="<?php echo esc_attr($block_id); ?>">
    <div class="two-column__content-col<?php if (empty($data['column_image'])) {
        echo ' full';
    } ?>">
        <div class="two-column__content-inner">
            <?php if (!empty($data['column_content_title'])): ?>
                <h2 class="two-column__content-title">
                    <?php echo $data['column_content_title']; ?>
                </h2>
            <?php endif; ?>
            <?php if (!empty($data['detail_content'])): ?>
                <div class="entry-content">
                    <?php echo $data['detail_content']; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php if (!empty($data['column_image'])): ?>
        <div class="two-column__image-col">
            <img src="<?php echo esc_url($data['column_image']['url']); ?>"
                 alt="<?php echo esc_attr(!empty($data['column_image']['alt']) ? $data['column_image']['alt'] : ''); ?>">
        </div>
    <?php endif; ?>
</section>
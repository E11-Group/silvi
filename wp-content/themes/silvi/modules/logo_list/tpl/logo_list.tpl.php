<?php
if (!empty($data['module_id'])) {
    $block_id = $data['module_id'];
} else {
    $block_id = 'block-' . uniqid();
}
?>

<section class="logo-list" id="<?php echo esc_attr($block_id); ?>">
    <div class="container">
        <?php if (!empty($data['title'])): ?>
            <h2 class="logo-list__title"><?php echo $data['title']; ?></h2>
        <?php endif; ?>

        <?php if (!empty($data['logos'])): ?>
            <div class="logo-list__wrap">
                <?php foreach ($data['logos'] as $item) : ?>
                    <figure class="logo-list__item">
                        <img src="<?php echo esc_url($item['url']); ?>" alt="<?php echo esc_attr($item['alt']); ?>">
                    </figure>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
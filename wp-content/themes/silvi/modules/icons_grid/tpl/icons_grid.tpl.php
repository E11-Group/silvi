<?php
if (!empty($data['module_id'])) {
    $block_id = $data['module_id'];
} else {
    $block_id = 'block-' . uniqid();
}
?>

<section class="icons-grid" id="<?php echo esc_attr($block_id); ?>">
    <?php if (!empty($data['title'])) : ?>
        <header class="icons-grid__header">
            <div class="container">
                <h2 class="icons-grid__title"><?php echo $data['title']; ?></h2>
                <?php echo $data['content']; ?>
            </div>
        </header>
    <?php endif; ?>

    <?php if (!empty($data['grid'])) : ?>
        <div class="icons-grid__content">

            <div class="container">
                <div class="icons-grid__wrap">
                    <?php
                        foreach ($data['grid'] as $key => $item) : ?>

                        <div class="icons-grid__item" data-animate-css="fadeInUp" data-animate-css-delay="<?php echo $key * 0.100 . 's' ?>">
                            <?php if (!empty($item['icon'])) : ?>
                                <figure class="icons-grid__icon">
                                    <img src="<?php echo esc_url($item['icon']['url']); ?>" alt="<?php echo esc_attr($item['icon']['alt']); ?>">
                                </figure>
                                <?php if (!empty($item['title'])) : ?>
                                    <h3 class="icons-grid__item-title">
                                        <?php echo $item['title']; ?>
                                    </h3>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    <?php
                        endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</section>
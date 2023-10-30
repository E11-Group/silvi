<?php
if (!empty($data['module_id'])) {
    $block_id = $data['module_id'];
} else {
    $block_id = 'block-' . uniqid();
}

?>

<section class="staff" id="<?php echo esc_attr($block_id); ?>">
    <div class="container">
        <?php if (!empty($data['title'])): ?>
            <h2 class="staff__title"><?php echo $data['title']; ?></h2>
        <?php endif; ?>

        <?php if (!empty($data['staff'])): ?>
            <div class="staff__wrap">
                <?php foreach ($data['staff'] as $item): ?>
                    <div class="staff__item">
                        <?php if (!empty($item['image'])): ?>
                            <figure class="staff__thumbnail" style="background-image:url('<?php echo esc_url($item['image']['url']); ?>')">
                                <img src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr($item['image']['alt']); ?>">
                            </figure>
                        <?php endif; ?>
                        <?php if (!empty($item['name'])): ?>
                            <h3 class="staff__name"><?php echo $item['name']; ?></h3>
                        <?php endif; ?>
                        <?php if (!empty($item['email'])): ?>
                            <a class="staff__link" href="mailto:<?php echo $item['email']; ?>"><?php echo $item['email']; ?></a>
                        <?php endif; ?>
                        <?php if (!empty($item['phone_number'])): ?>
                            <a class="staff__link" href="tel:<?php echo preg_replace('/\D+/', '', $item['phone_number']); ?>"><?php echo $item['phone_number']; ?></a>
                        <?php endif; ?>
                        <?php if (!empty($item['position'])): ?>
                            <p class="staff__position"><?php echo $item['position']; ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
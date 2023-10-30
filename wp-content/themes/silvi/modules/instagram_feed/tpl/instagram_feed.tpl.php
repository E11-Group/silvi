<?php
if (!empty($data['module_id'])) {
    $block_id = $data['module_id'];
} else {
    $block_id = 'block-' . uniqid();
}

$shortcode = $data['shortcode'];

?>

<section class="insta-feed" id="<?php echo esc_attr($block_id); ?>">
    <div class="container">
        <?php if (!empty($data['title'])) : ?>
            <h2 class="insta-feed__title">
                <?php echo $data['title']; ?>
            </h2>
        <?php endif; ?>

        <?php if (!empty($shortcode)) : ?>
            <div class="insta-feed__feed">
                <?php  echo do_shortcode('[instagram-feed user="'. $shortcode .'" cols=3 showbutton=false num=6 nummobile=4 followtext="Follow Us" showheader=false followcolor=#FFC815 followtextcolor=#111E27]'); ?>
            </div>
        <?php endif; ?>

    </div>
</section>
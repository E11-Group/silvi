<?php
if (!empty($data['module_id'])) {
    $block_id = $data['module_id'];
} else {
    $block_id = 'block-' . uniqid();
}
?>
<section class="hero-icons " id="<?php echo esc_attr($block_id); ?>" data-animate>
    <?php if (!empty($data['image'])): ?>
        <figure class="hero-icons__bg-image">
            <img src="<?php echo esc_url($data['image']['url']); ?>" alt="<?php echo esc_attr($data['image']['alt']); ?>">
        </figure>
    <?php endif; ?>
    <?php if(!empty($data['vimeo_video_url']) || !empty($data['background_video']['url'])): ?>
        <div class="hero-icons__video-container">
            <?php if(!empty($data['vimeo_video_url'])) {
	            $video_id = get_vimeo_id($data['vimeo_video_url']);
                ?>
                <iframe src="https://player.vimeo.com/video/<?php echo $video_id; ?>?background=1&autoplay=1&muted=1&loop=1&byline=0&title=0" width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
            <?php } else { ?>
                <video aria-hidden="true" class="hero-icons__video video" playsinline autoplay muted loop>
                    <source src="<?php echo esc_url($data['background_video']['url']); ?>" type="video/mp4">
                </video>
           <?php } ?>
        </div>
    <?php endif; ?>
    <div class="container">
        <div class="hero-icons__wrap">
            <div class="hero-icons__primary">
                <?php if (!empty($data['title'])): ?>
                    <h1 class="hero-icons__title"><?php echo $data['title']; ?></h1>
                <?php endif; ?>
                <?php if (!empty($data['icons'])): ?>
                    <div class="hero-icons__secondary">
                        <?php foreach ($data['icons'] as $item): ?>
                            <div class="hero-icons__menu-item">
                                <img src="<?php echo esc_url($item['icon_image']['url']); ?>"
                                    alt="<?php echo esc_attr($item['icon_image']['alt']); ?>">
                                <h2 class="hero-icons__menu-title">
                                    <?php echo $item['item_title']; ?>
                                </h2>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<!-- .hero ends -->
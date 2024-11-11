<?php
if (!empty($data['module_id'])) {
    $block_id = $data['module_id'];
} else {
    $block_id = 'block-' . uniqid();
}

$alignment = $data['alignment'];
$addClass = '';
if ($alignment == 'right') {
    $addClass = 'right-alignment';
}

$hasVideo = '';
if (!empty($data['background_video'])) {
    $hasVideo = 'has-video';
}
?>
<section class="media-intro <?php echo $addClass; ?>" id="<?php echo esc_attr($block_id); ?>" data-animate>
    <div class="media-intro__inner">
        <?php if (!empty($data['image'])): ?>
            <figure class="media-intro__bg-image <?php echo $hasVideo; ?>">
                <img src="<?php echo esc_url($data['image']['url']); ?>"
                    alt="<?php echo esc_attr($data['image']['alt']); ?>">
            </figure>
        <?php endif; ?>
        <?php if (!empty($data['background_video'])): ?>
            <div class="media-content__video-container">
                <video aria-hidden="true" class="media-content__video video" playsinline autoplay muted loop
                    poster="<?php echo esc_url($data['image']['url']); ?>">
                    <source src="<?php echo esc_url($data['background_video']['url']); ?>" type="video/mp4">
                </video>
            </div>
        <?php endif; ?>
        <div class="media-intro__wrap media-intro__wrap--mobile">
            <?php if (!empty($data['title'])): ?>
                <h2 class="media-intro__title"><?php echo $data['title']; ?></h2>
            <?php endif; ?>
            <?php if (!empty($data['content'])): ?>
                <div class="media-intro__description entry-content"><?php echo $data['content']; ?></div>
            <?php endif; ?>
            <?php if (!empty($data['datas'])): ?>
                <div class="media-intro__secondary">
                    <?php foreach ($data['datas'] as $item):
                        if (!empty($item['item_title']) || $item['value']):
                            ?>
                            <div class="media-intro__data-item">
                                <p class="media-intro__menu-title">
                                    <strong><?php echo $item['value']; ?></strong> <br>
                                    <?php echo $item['item_title']; ?>
                                </p>
                            </div>
                            <?php
                        endif;
                    endforeach; ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($data['button'])): ?>
                <a class="btn btn--dark" href="<?php echo $data['button']['url']; ?>"
                    target="<?php echo $data['button']['target']; ?>">
                    <?php echo $data['button']['title']; ?>
                </a>
            <?php endif; ?>
        </div>
        <?php if (!empty($data['title']) || !empty($data['content']) || !empty($data['datas']) || !empty($data['button'])): ?>
            <div class="media-intro__wrap-popup">
                <?php if (!empty($data['title'])): ?>
                    <h2 class="media-intro__title"><?php echo $data['title']; ?></h2>
                <?php endif; ?>
                <?php if (!empty($data['content'])): ?>
                    <div class="media-intro__description entry-content"><?php echo $data['content']; ?></div>
                <?php endif; ?>
                <?php if (!empty($data['datas'])): ?>
                    <div class="media-intro__secondary">
                        <?php foreach ($data['datas'] as $item):
                            if (!empty($item['item_title']) || $item['value']):
                                ?>
                                <div class="media-intro__data-item">
                                    <p class="media-intro__menu-title">
                                        <strong><?php echo $item['value']; ?></strong> <br>
                                        <?php echo $item['item_title']; ?>
                                    </p>
                                </div>
                                <?php
                            endif;
                        endforeach; ?>
                    </div>
                <?php endif; ?>
                <?php if (!empty($data['button'])): ?>
                    <a class="btn" href="<?php echo $data['button']['url']; ?>"
                        target="<?php echo $data['button']['target']; ?>">
                        <?php echo $data['button']['title']; ?>
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<!-- .hero ends -->
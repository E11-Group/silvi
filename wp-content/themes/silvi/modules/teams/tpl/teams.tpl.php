<?php
if (!empty($data['module_id'])) {
    $block_id = $data['module_id'];
} else {
    $block_id = 'block-' . uniqid();
}

?>

<section class="teams" id="<?php echo esc_attr($block_id); ?>">
    <?php if (!empty($data['title'])): ?>
        <div class="teams__header">
            <div class="container">
                <h2 class="teams__title"><?php echo $data['title']; ?></h2>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($data['member'])) : ?>
        <div class="teams__wrap">
            <?php $count = 1; ?>
            <?php foreach ($data['member'] as $item):
            ?>
                <div class="teams__item" style="background-image:url('<?php echo esc_url($item['image']['url']); ?>');">
                    <?php if (!empty($item['image'])): ?>
                        <figure class="teams__thumbnail">
                            <img src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr($item['image']['alt']); ?>">
                        </figure>
                    <?php endif; ?>
                    <div class="teams__item-inner">
                        <?php if (!empty($item['name'])): ?>
                            <h3 class="teams__item-title"><?php echo $item['name']; ?></h3>
                        <?php endif; ?>
                        <?php if (!empty($item['position'])): ?>
                            <h4 class="teams__item-subtitle"><?php echo $item['position']; ?></h4>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($item['content'] || $item['facebook_link'] || $item['instagram_link'] || $item['linkedin_link'])): ?>
                        <a class="teams__link" data-fancybox href="#team-modal-<?php echo $count; ?>"><?php esc_html_e('Learn More', 'silvi'); ?></a>
                    <?php endif; ?>
                </div>
                <?php $count++; ?>
            <?php endforeach; ?>
        </div>

    <div class="modal-container" style="display: none;" aria-hidden="true">
        <?php $count2 = 1; ?>
        <?php foreach ($data['member'] as $item) : ?>
            <?php if (!empty($item['content'] || $item['facebook_link'] || $item['instagram_link'] || $item['linkedin_link'])): ?>
                <div class="modal" id="team-modal-<?php echo $count2; ?>">
                    <div class="modal__body">
                        <div class="modal__row">
                            <div class="modal__primary">
                                <?php if (!empty($item['image'])): ?>
                                    <figure class="modal__image">
                                        <img src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr($item['image']['alt']); ?>">
                                    </figure>
                                <?php endif; ?>

                                <?php if (!empty($item['facebook_link'] || $item['instagram_link'] || $item['linkedin_link'])): ?>
                                    <ul class="modal-social">
                                        <?php if (!empty($item['linkedin_link'])): ?>
                                            <li class="linkedin">
                                                <a href="<?php echo esc_attr($item['linkedin_link']); ?>" target="_blank">
                                                    <svg class="icon icon-linkedin">
                                                        <use xlink:href="#icon-linkedin"></use>
                                                    </svg>
                                                    <span class="accessible-text">linkedin</span>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (!empty($item['facebook_link'])): ?>
                                            <li class="facebook">
                                                <a href="<?php echo esc_attr($item['facebook_link']); ?>" target="_blank">
                                                    <svg class="icon icon-facebook">
                                                        <use xlink:href="#icon-facebook"></use>
                                                    </svg>
                                                    <span class="accessible-text">facebook</span>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (!empty($item['instagram_link'])): ?>
                                            <li class="instagram">
                                                <a href="<?php echo esc_attr($item['instagram_link']); ?>" target="_blank">
                                                    <svg class="icon icon-instagram">
                                                        <use xlink:href="#icon-instagram"></use>
                                                    </svg>
                                                    <span class="accessible-text">instagram</span>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>

                            <div class="modal__bio">
                                <header class="modal__bio-header">
                                    <?php if (!empty($item['name'])): ?>
                                        <h2 class="modal__bio-title"><?php echo $item['name']; ?></h2>
                                    <?php endif; ?>
                                    <?php if (!empty($item['position'])): ?>
                                        <h3 class="modal__bio-subtitle"><?php echo $item['position']; ?></h3>
                                    <?php endif; ?>
                                </header>

                                <?php if (!empty($item['content'])): ?>
                                    <div class="modal__bio-body entry-content">
                                        <?php echo $item['content']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            <?php $count2++; ?>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</section>

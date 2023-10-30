<?php
if (!empty($data['module_id'])) {
    $block_id = $data['module_id'];
} else {
    $block_id = 'block-' . uniqid();
}
?>

<section class="timeline" id="<?php echo esc_attr($block_id); ?>">

    <svg  class="timeline__decor" aria-hidden="true" viewBox="0 0 1412 851" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 425.5 706.003 851 1412 425.5 706.003 0 0 425.5Zm69.537 0L706.003 41.91l636.46 383.59-636.46 383.59L69.537 425.5Z" fill="#FFF" fill-rule="evenodd" opacity=".032" />
    </svg>
    <?php if (!empty($data['title'] || $data['content'])) : ?>
        <div class="container">
            <div class="timeline__header">
                <?php if (!empty($data['title'])) : ?>
                    <h2 class="timeline__title"><?php echo $data['title']; ?></h2>
                <?php endif; ?>
                <?php if (!empty($data['content'])) : ?>
                    <div class="timeline__intro">
                        <?php echo $data['content']; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($data['timeline'])) : ?>
        <div class="timeline__wrap">

            <div class="timeline__slider js-timeline-slider">
                <?php foreach ($data['timeline'] as $item) :
                        ?>
                    <div class="timeline__item">
                        <div class="timeline__inner">

                            <figure class="timeline__media">
                                <img src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr($item['image']['alt']); ?>">
                            </figure>

                            <?php if (!empty($item['year'] || $item['content'])) : ?>
                                <div class="timeline__itemContent">
                                    <?php if (!empty($item['year'])) : ?>
                                        <h3 class="timeline__item-title"><?php echo $item['year']; ?></h3>
                                    <?php endif; ?>
                                    <?php echo $item['content']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="timeline__controls">


                <div class="timeline__progress" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <span class="timeline__progress-label sr-only">
                </div>

                <div class="timeline__arrows">
                    <button class="timeline__arrow timeline__arrow--prev" data-role="none" role="button" aria-label="Previous">
                        <svg class="icon icon-pointed-arrow-right">
                            <use xlink:href="#icon-pointed-arrow-right"></use>
                        </svg>
                    </button>
                    <button class="timeline__arrow timeline__arrow--next" data-role="none" role="button" aria-label="Next">
                        <svg class="icon icon-pointed-arrow-right">
                            <use xlink:href="#icon-pointed-arrow-right"></use>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>
</section>
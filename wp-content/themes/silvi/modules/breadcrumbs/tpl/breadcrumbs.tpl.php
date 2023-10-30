<?php
if (!empty($data['module_id'])) {
    $block_id = $data['module_id'];
} else {
    $block_id = 'block-' . uniqid();
}
?>
<section class="breadcrumbs entry-content" typeof="BreadcrumbList" vocab="https://schema.org/">
    <div class="container">
    <?php if(function_exists('bcn_display'))
    {
        bcn_display();
    }?>
    </div>
</section>
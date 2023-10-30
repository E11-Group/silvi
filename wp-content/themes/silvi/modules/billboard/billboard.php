<?php
/**
 * @param array $args - override the module with custom content (ie: page builder or some other special content)
 * @param bool $use_page_content - pull in defaults from the page ACF fields
 * @param string $get_field_type - either get_field or get_sub_field depending on if this is coming from page builder or not
 * @param string $field_location - either an ID of the page or 'option' if it is an archive page
 * @param bool $prefix - prepended to the get_field for things like archive site options
 * @return bool
 * Usage on page template / $page_id = get_the_ID(); / e11_module_name(array(), true, 'get_field', $page_id);
 */
function e11_billboard( $args = array(), $use_page_content = false, $get_field_type = 'get_field', $field_location = '', $prefix = false ) {

    if (empty($args) && !$use_page_content):
        return false;
    endif;

    if ($use_page_content):
        $defaults = array(
            'module_id'     => $get_field_type( $prefix . 'blbd_module_id', $field_location ),
            'bg_image'      => $get_field_type( $prefix . 'blbd_image', $field_location ),
            'title'         => $get_field_type( $prefix . 'blbd_title', $field_location ),
            'content'       => $get_field_type( $prefix . 'blbd_content', $field_location ),
            'button'        => $get_field_type( $prefix . 'blbd_button', $field_location ),
            'bg_type'       => $get_field_type( $prefix . 'blbd_bg_type', $field_location ),
            'video'         => $get_field_type( $prefix . 'blbd_video', $field_location ),
        );
    else:
        $defaults = array(
            'module_id'        => false,
            'bg_image'         => false,
            'title'            => false,
            'content'          => false,
            'button'           => false,
            'bg_type'          => false,
            'video'            => false,
        );
    endif;

    $data = array_merge($defaults, $args);

    if (!empty($data['bg_image'])):
        include 'tpl/billboard.tpl.php';
    endif;

    return true;
}
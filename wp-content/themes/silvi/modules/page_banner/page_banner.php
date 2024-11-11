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
function e11_page_banner($args = array(), $use_page_content = false, $get_field_type = 'get_field', $field_location = '', $prefix = false)
{

    if (empty($args) && !$use_page_content):
        return false;
    endif;

    if ($use_page_content):
        $defaults = array(
            'image'           => $get_field_type($prefix . 'pb_image', $field_location),
            'title'           => $get_field_type($prefix . 'pb_title', $field_location),
            'subtitle_style'  => $get_field_type($prefix . 'pb_subtitle_style', $field_location),
            'subtitle'        => $get_field_type($prefix . 'pb_subtitle', $field_location),
            'button'          => $get_field_type($prefix . 'pb_button', $field_location),
            'button_type'          => $get_field_type($prefix . 'pb_button_type', $field_location),
            'gravity_form_shortcode'          => $get_field_type($prefix . 'pb_gravity_form_shortcode', $field_location),
            'bg_type'         => $get_field_type($prefix . 'pb_bg_type', $field_location),
            'video'           => $get_field_type($prefix . 'pb_video', $field_location),
            'module_id'       => $get_field_type($prefix . 'pb_module_id', $field_location),
        );
    else:
        $defaults = array(
            'image' => false,
            'title' => false,
            'subtitle' => false,
            'subtitle_style' => false,
            'button' => false,
            'button_type' => false,
            'gravity_form_shortcode' => false,
            'bg_type' => false,
            'video' => false,
            'module_id' => false,
        );
    endif;

    $data = array_merge($defaults, $args);

    if (!empty($data['image'] ||$data['video'])):
        include 'tpl/page_banner.tpl.php';
    endif;

    return true;
}
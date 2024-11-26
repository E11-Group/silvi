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
function e11_media_with_intro($args = array(), $use_page_content = false, $get_field_type = 'get_field', $field_location = '', $prefix = false)
{

    if (empty($args) && !$use_page_content):
        return false;
    endif;

    if ($use_page_content):
        $defaults = array(
            'title'        => $get_field_type($prefix . 'mwi_title', $field_location),
            'content'        => $get_field_type($prefix . 'mwi_content', $field_location),
            'button'        => $get_field_type($prefix . 'mwi_button', $field_location),
            'alignment'        => $get_field_type($prefix . 'mwi_choose_alignment', $field_location),
            'image'        => $get_field_type($prefix . 'mwi_image', $field_location),
            'background_video'        => $get_field_type($prefix . 'mwi_background_video', $field_location),
            'vimeo_video_url'        => $get_field_type($prefix . 'mwi_vimeo_video_url', $field_location),
            'datas'        => $get_field_type($prefix . 'mwi_data_list', $field_location),
            'module_id'     => $get_field_type( $prefix . 'mwi_module_id', $field_location),
            'disable_video_on_mobile'     => $get_field_type( $prefix . 'mwi_disable_video_on_mobile', $field_location),
        );
    else:
        $defaults = array(
            'title'     => false,
            'content'     => false,
            'alignment'     => false,
            'button'     => false,
            'background_video'     => false,
            'vimeo_video_url'     => false,
            'image'     => array(),
            'datas'        => array(),
            'module_id'     => false,
            'disable_video_on_mobile'     => false,
        );
    endif;

    $data = array_merge($defaults, $args);


    include 'tpl/media_with_intro.tpl.php';


    return true;
}

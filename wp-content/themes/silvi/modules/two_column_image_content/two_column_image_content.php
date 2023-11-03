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
function e11_two_column_image_content($args = array(), $use_page_content = false, $get_field_type = 'get_field', $field_location = '', $prefix = false)
{

    if (empty($args) && !$use_page_content):
        return false;
    endif;

    if ($use_page_content):
        $defaults = array(
            'column_content_title' => $get_field_type($prefix . 'tcic_column_content_title', $field_location),
            'detail_content' => $get_field_type($prefix . 'tcic_detail_content', $field_location),
            'column_image' => $get_field_type($prefix . 'tcic_column_image', $field_location),
            'module_id' => $get_field_type($prefix . 'tcic_module_id', $field_location),
        );
    else:
        $defaults = array(
            'column_content_title' => false,
            'detail_content' => false,
            'column_image' => array(),
            'module_id' => false,
        );
    endif;

    $data = array_merge($defaults, $args);

    if (!empty($data['column_content_title']) || !empty($data['detail_content']) || !empty($data['column_image'])):
        include 'tpl/two_column_image_content.tpl.php';
    endif;

    return true;
}
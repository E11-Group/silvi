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
function e11_media_icon_grid($args = array(), $use_page_content = false, $get_field_type = 'get_field', $field_location = '', $prefix = false)
{

    if (empty($args) && !$use_page_content):
        return false;
    endif;

    if ($use_page_content):
        $defaults = array(
            'list_item'        => $get_field_type($prefix . 'mmcl_list', $field_location),
            'module_id'     => $get_field_type( $prefix . 'mmcl_module_id', $field_location),
        );
    else:
        $defaults = array(
            'list_item'        => array(),
            'module_id'     => false,
        );
    endif;

    $data = array_merge($defaults, $args);


    include 'tpl/media_icon_grid.tpl.php';


    return true;
}

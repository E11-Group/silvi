<?php class Mobile_Walker extends Walker_Nav_Menu {
    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
		$id_field = $this->db_fields['id'];
		if ( is_object( $args[0] ) ) {
			$args[0]->has_children = !empty( $children_elements[$element->$id_field] );
		}
		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

    function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) {
        $mobileArrow = '';

        $title = $item->title;
		$permalink = $item->url;
		$target = $item->target;

        if($depth == 0 && is_object($item) && is_array($item->classes) && in_array('menu-item-has-children', $item->classes)) {
            $mobileArrow = '<button class="mobileNavDropdownToggle" data-class="mobile-nav-dropdown-toggle"><svg class="icon-arrow-down icon"><use xlink:href="#icon-arrow-down"></use></svg><span class="accessible-text">Click to toggle dropdown menu.</span></button>';
        }

        $classes = is_object($item) && is_array($item->classes) ? implode(" ", $item->classes) : false;
        $output .= '<li id="menu-item-'. $item->ID . '" class="' .  $classes . '" >';
        $output .= '<a href="' . $permalink . '" target="' . $target . '">';
        $output .= $title;
        $output .= '</a>' . $mobileArrow;
    }
}?>
<?php
function e11_register_menus(){
	// Navigation Menus
	register_nav_menus(
		array(
			'main-navigation'      => 'Main Navigation',
			'secondary-navigation' => 'Secondary Navigation',
			'mobile-navigation' => 'Mobile Navigation',
			'utility-navigation'   => 'Utility Navigation',
			'footer-additional-links'    => 'Footer Additional Links',
			'policy-navigation'    => 'Policy Navigation',

		)
	);
}
add_action('init', 'e11_register_menus');
<?php
function e11_scripts() {
	$api = get_field( 'google_api', 'options' );

	if ( ! is_admin() ) {
		### Core
		// Deregister WordPress jQuery and register Google's
		wp_deregister_script( 'jquery' );
		wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.3.1.min.js', array(), '3.3.1', false );


		if ( ! empty( $api ) ) {
			wp_enqueue_script( 'google-map-js', 'https://maps.googleapis.com/maps/api/js?key=' . $api.'&callback=initMap', array( 'jquery' ), false, [
				'strategy' => 'async',
				'in_footer' => true
			] );
		}

		wp_enqueue_style( 'font-awesome-css', '//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css?ver=4.8', array(), '2.1.0', false );
		wp_enqueue_style( 'google-fonts-css', 'https://fonts.googleapis.com/css2?family=Teko:wght@400;600;700&family=Work+Sans:ital,wght@0,300;0,400;0,500;0,700;1,400;1,600&display=swap', [], null );

		wp_enqueue_style( 'fancybox-css', STYLEDIR . '/css/libs/fancybox.css', false, '1.0' );

		// Main Stylsheet
		wp_enqueue_style( 'css', STYLEDIR . '/style.css', false, '1.0.4' );

		// Main Scripts (this file is concatenated from the files inside of js/development/ )
		wp_enqueue_script( 'scripts', JSDIR . '/scripts.min.js', array( 'jquery' ), '1.0.6', true );
		wp_localize_script( 'scripts', 'localized', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'siteurl' => site_url()
		) );

		// Vimeo Player
		wp_enqueue_script('vimeo-player-api', 'https://player.vimeo.com/api/player.js', array(), null, true);
	}
	wp_dequeue_style( 'wp-block-library' );
}

add_action( 'wp_enqueue_scripts', 'e11_scripts', 100 );

function e11_tinymce_style() {
	wp_enqueue_style( 'silvi-admin-fancybox-css', STYLEDIR . '/css/libs/fancybox.css', false, '1.0' );
	wp_enqueue_script( 'silvi-admin-fancybox', JSDIR . '/libs/fancybox.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'silvi-admin-scripts', JSDIR . '/silvi-admin-scripts.js', array( 'jquery' ), '20190930', true );
	wp_localize_script( 'silvi-admin-scripts', 'localized', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'siteurl' => site_url()
	) );
}

add_action( 'admin_init', 'e11_tinymce_style' );
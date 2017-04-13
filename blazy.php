<?php
/*
  Plugin Name: WP Blazy
  Plugin URI: https://github.com/lukecav/wp-blazy
  Description: WordPress plugin which uses bLazy.js for lazy loading images on a site.
  Author: Luke Cavanagh
  Version: 1.0
  Author URI: https://github.com/lukecav
 */
 
 //Code Stuff Soon

static function add_scripts() {
		wp_enqueue_script( 'blazy',  self::get_url( 'js/blazy.js' ), array( 'blazy' ), self::version, true );
	}

function blazyload_images_add_placeholders( $content ) {
	return BlazyLoad_Images::add_image_placeholders( $content );
}
add_action( 'init', array( 'BlazyLoad_Images', 'init' ) );
endif;

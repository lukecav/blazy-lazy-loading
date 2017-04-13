<?php
/*
  Plugin Name: WP Blazy
  Plugin URI: https://github.com/lukecav/wp-blazy
  Description: WordPress plugin which uses bLazy.js for lazy loading images on a site.
  Author: Luke Cavanagh
  Version: 1.0
  Author URI: https://github.com/lukecav
 */
 
if ( ! class_exists( 'BlazyLoad_Images' ) ) :
class BlazyLoad_Images {
	const version = '1.0';
	protected static $enabled = true;
	static function init() {
		if ( is_admin() )
			return;
		if ( ! apply_filters( 'blazyload_is_enabled', true ) ) {
			self::$enabled = false;
			return;
		}
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'add_scripts' ) );
		add_action( 'wp_head', array( __CLASS__, 'setup_filters' ), 9999 ); // we don't really want to modify anything in <head> since it's mostly all metadata, e.g. OG tags
	}
	static function setup_filters() {
		add_filter( 'the_content', array( __CLASS__, 'add_image_placeholders' ), 99 ); // run this later, so other content filters have run, including image_add_wh on WP.com
		add_filter( 'post_thumbnail_html', array( __CLASS__, 'add_image_placeholders' ), 11 );
		add_filter( 'get_avatar', array( __CLASS__, 'add_image_placeholders' ), 11 );
	}

static function add_scripts() {
		wp_enqueue_script( 'blazy',  self::get_url( 'js/blazy.js' ), array( 'blazy' ), self::version, true );
	}

function blazyload_images_add_placeholders( $content ) {
	return BlazyLoad_Images::add_image_placeholders( $content );
}
add_action( 'init', array( 'BlazyLoad_Images', 'init' ) );
endif;

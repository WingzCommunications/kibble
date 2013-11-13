<?php

/**
 * Add theme options
 *
*/
require( get_template_directory() . '/lib/options.class.php' );

/**
 * Updater class for wp-updates.com
 *
*/

require( get_template_directory() . '/lib/wp-updates-theme.php' );

/**
 * Hook into the updater
 *
*/

new WPUpdatesThemeUpdater( 'http://wp-updates.com/api/1/theme', 378, basename(get_template_directory()) );

/**
 * define our video width and height from theme options panel
 *
*/

DEFINE('AVO_WIDTH', kibble_option('kibble_video_width'));
DEFINE('AVO_HEIGHT', kibble_option('kibble_video_height'));

/**
 * Enable custom oembed codes
 *
*/
require( get_template_directory() . '/lib/oembed.php' );

/**
 * Various theme functions like pagination, post meta, attachment meta
 *
*/
require( get_template_directory() . '/lib/theme-functions.php' );

/**
 * Various image functions (custom html for thumbnails, gallery shortcode)
 *
*/

require( get_template_directory() . '/lib/image-functions.php' );

/**
 * Require a thumbnail before publish
 *
*/

//require( get_template_directory() . '/lib/require-thumbnail.php' );

/**
 * Enable Category images
 *
*/

require( get_template_directory() . '/lib/category-images.php' );


/**
 * Our custom queries for different pages on the site
 *
*/

require( get_template_directory() . '/lib/custom-query.php' );

/**
 * Enable minimal menu without any extra markeup
 *
*/

require( get_template_directory() . '/lib/trimmed-menus.php' );

/**
 * Post Video Embed
 *
*/

require( get_template_directory() . '/lib/video-box.php' );

/**
 * Custom rewrite for media attachments
 *
*/

require( get_template_directory() . '/lib/custom-rewrite.php' );

/**
 * Enqueue styles and javascripts
 *
*/
function gallery_scripts_init() {
	global $wp_styles;

	wp_enqueue_style( 'kibble-style', get_stylesheet_uri() );

	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js');

	if(is_page('channels')) {
		wp_enqueue_script('niche', get_template_directory_uri() . '/js/niche.js');
	}

	if(kibble_option('kibble_lightbox_type') == true) {

		wp_enqueue_script('frescojs', get_template_directory_uri() . '/js/fresco.js', array('jquery'), '1.0');
		wp_enqueue_style('frescocss', get_template_directory_uri() . '/css/fresco.css');

		global $is_IE;
    		if( $is_IE ) {
			wp_enqueue_script( 'css3_media_queries', 'http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js');
		}
	}

	wp_enqueue_script('searchbox_js', get_template_directory_uri() . '/js/searchbox.js');
	wp_enqueue_script('search_js', get_template_directory_uri() . '/js/search.js');
	wp_enqueue_style('search_css', get_template_directory_uri() . '/css/searchbox.css');
}

add_action('wp_enqueue_scripts', 'gallery_scripts_init');

/**
 * Register Menus, and post thumbnail support
 *
*/
function kibble_theme_setup() {
	register_nav_menu( 'primary', __( 'Navigation Menu', 'kibble' ) );
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 164, 204, true );
	add_filter( 'use_default_gallery_style', '__return_false' );
}

add_action( 'after_setup_theme', 'kibble_theme_setup' );

/**
 * Custom function for site title
 *
*/
function kibble_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	$title .= get_bloginfo( 'name' );

	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'kibble' ), max( $paged, $page ) );

	return $title;
}

add_filter( 'wp_title', 'kibble_wp_title', 10, 2 );


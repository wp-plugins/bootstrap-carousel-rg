<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/*
Plugin Name: Bootstrap Carousel RG
Description: Configurable carousel content types that render with the bootstrap carousel
Version: 0.1.0
Author: Reingold
Text Domain: bootstrap-carousel-rg
License: GPLv2 or later
*/

// Define shorthand constants
if (!defined('BOOTSTRAPCAROUSELRG_PLUGIN_NAME')){
    define('BOOTSTRAPCAROUSELRG_PLUGIN_NAME', trim(dirname(plugin_basename(__FILE__)), '/'));
}

if (!defined('BOOTSTRAPCAROUSELRG_PLUGIN_DIR')){
    define('BOOTSTRAPCAROUSELRG_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . BOOTSTRAPCAROUSELRG_PLUGIN_NAME);
}

if (!defined('BOOTSTRAPCAROUSELRG_PLUGIN_URL')){
    define('BOOTSTRAPCAROUSELRG_PLUGIN_URL', plugins_url() . '/' . BOOTSTRAPCAROUSELRG_PLUGIN_NAME);
}

// Set version information
if (!defined('BOOTSTRAPCAROUSELRG_VERSION_KEY')){
    define('BOOTSTRAPCAROUSELRG_VERSION_KEY', 'bootstrapcarouselrg_version');
}

if (!defined('BOOTSTRAPCAROUSELRG_VERSION_NUM')){
    define('BOOTSTRAPCAROUSELRG_VERSION_NUM', '0.1.0');
}
add_option(BOOTSTRAPCAROUSELRG_VERSION_KEY, BOOTSTRAPCAROUSELRG_VERSION_NUM);


// Check to see if updates need to occur
if (get_option(BOOTSTRAPCAROUSELRG_VERSION_KEY) != BOOTSTRAPCAROUSELRG_VERSION_NUM) {
    // If there is any future update code needed it will go here

    // Then update the version value
    update_option(BOOTSTRAPCAROUSELRG_VERSION_KEY, BOOTSTRAPCAROUSELRG_VERSION_NUM);
}


///////// INIT


    require_once(BOOTSTRAPCAROUSELRG_PLUGIN_DIR."/bootstrap-carousel-rg-contentTypes.php");
    require_once(BOOTSTRAPCAROUSELRG_PLUGIN_DIR."/bootstrap-carousel-rg-Render.php");
    //require_once(BOOTSTRAPCAROUSELRG_PLUGIN_DIR."/bootstrap-carousel-rg-Integration.php");




    // General Init

    function bootstrapCarouselRG_init() {
        btcRG_createPostTypes();


    }
    add_action( 'init', 'bootstrapCarouselRG_init' );


function bootstrap_carousel_rg_thumbnail_sizes() {
    add_image_size( 'bootstrapcarouselrgslide', 1920, 700, true );
}
add_action( 'after_setup_theme', 'bootstrap_carousel_rg_thumbnail_sizes' );


function bootstrap_carousel_rg_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'bootstrapcarouselrgslide' => __( 'Carousel Slide' ),
    ) );
}

add_filter( 'image_size_names_choose', 'bootstrap_carousel_rg_custom_sizes' );



    function bootstrapCarouselRG_activate() {
        if ( !is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {
            deactivate_plugins( plugin_basename( __FILE__ ) );
            wp_die(  'Unable to activate. Bootstrap Carousel RG requires the presence of the Advanced Custom Fields <strong>Pro</strong> plugin.');
        }
    }
    register_activation_hook( __FILE__, 'bootstrapCarouselRG_activate' );


    function bootstrapCarouselRG_deactivate(){

    }
    register_deactivation_hook(__FILE__, 'bootstrapCarouselRG_deactivate');







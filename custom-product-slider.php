<?php
/**
 * Plugin Name: Custom Product Slider
 * Description: Simple Product Preview Slider widgets for Elementor.
 * Version:     1.0.0
 * Author:      Elementor Developer
 * Author URI:  https://developers.elementor.com/
 * Text Domain: elementor-addonx
 * Requires Plugins: elementor
 * Elementor tested up to: 3.21.0
 * Elementor Pro tested up to: 3.21.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Register the widget only after Elementor is loaded
function register_image_gallery_widget() {
    if ( did_action( 'elementor/loaded' ) ) {
        require_once( __DIR__ . '/widgets/image-gallery-widget.php' );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Custom_Product_Slider\Widgets\Image_Gallery_Widget() );
    }
}
add_action('elementor/widgets/widgets_registered', 'register_image_gallery_widget');

function cuproslix_plugin_enqueue_scripts() {

    // Enqueue jQuery (WordPress includes jQuery by default)
    wp_enqueue_script('jquery');

    // Enqueue custom styles
    wp_enqueue_style( 'cuproslix-plugin-styles', plugins_url( '/assets/css/main.css', __FILE__ ) );
    // Enqueue the additional stylesheet
    wp_enqueue_style( 'jquerysctipttop', 'https://www.jqueryscript.net/css/jquerysctipttop.css', [], null );

    // Enqueue your version of jQuery
    // wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.3.1.min.js', [], '3.3.1', true);
     
    // Enqueue plugin JS
    wp_enqueue_script( 'previewuihoiuhogiuohg', plugins_url( 'assets/js/zoom-image.js', __FILE__ ),array( 'jquery' ), false, true );
    wp_enqueue_script( 'nextslideImg', plugins_url( 'assets/js/main.js', __FILE__ ),array( 'jquery' ), false, true );
    
}
add_action( 'wp_enqueue_scripts', 'cuproslix_plugin_enqueue_scripts' );
?>
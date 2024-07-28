<?php
namespace Custom_Product_Slider\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class Image_Gallery_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'image_gallery';
    }

    public function get_title() {
        return __( 'Image Gallery', 'elementor-addonx' );
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return [ 'basic' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'elementor-addonx' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'gallery_field',
            [
                'label' => __( 'Gallery Field Name', 'elementor-addonx' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'img_gallery',
            ]
        );

        $this->add_control(
            'post_id',
            [
                'label' => __( 'Post ID', 'elementor-addonx' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
                'description' => __( 'Leave blank to use the current post ID in the loop.', 'elementor-addonx' ),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $gallery_field = $settings['gallery_field'];
        $post_id = $settings['post_id'] ? $settings['post_id'] : get_the_ID();

        if ( function_exists('get_field') ) {
            $gallery = get_field( $gallery_field, $post_id );

            if ( $gallery ) {
                echo '<div class="container">';

                // Display the first image as the main image
                if ( ! empty( $gallery ) ) {
                    $first_image = $gallery[0];
                    echo '<div class="show" href="' . esc_url( $first_image['url'] ) . '">';
                    echo '<img src="' . esc_url( $first_image['url'] ) . '" id="show-img">';
                    echo '</div>';
                }

                echo '<div class="small-img">';
                echo '<img src="' . esc_url( plugins_url( '../assets/images/online_icon_right@2x.png', __FILE__ ) ) . '" class="icon-left" alt="" id="prev-img">';
                echo '<div class="small-container">';
                echo '<div id="small-img-roll">';

                // Display all images as thumbnails
                foreach ( $gallery as $image ) {
                    echo '<img src="' . esc_url( $image['url'] ) . '" class="show-small-img" alt="' . esc_attr( $image['alt'] ) . '">';
                }

                echo '</div>';
                echo '</div>';
                echo '<img src="' . esc_url( plugins_url( '../assets/images/online_icon_right@2x.png', __FILE__ ) ) . '" class="icon-right" alt="" id="next-img">';
                echo '</div>';
                echo '</div>';
            } else {
                echo 'No images found in the gallery field.';
            }
        } else {
            echo 'ACF function get_field() not found.';
        }
    }

    protected function _content_template() {}
}
?>

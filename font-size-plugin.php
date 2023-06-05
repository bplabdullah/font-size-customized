<?php
/**
 * Plugin Name: Font Size Plugin
 * Plugin URI: Your Plugin URI
 * Description: Custom font size plugin for WordPress.
 * Version: 1.0
 * Author: Your Name
 * Author URI: Your Website
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: font-size-plugin
 * Domain Path: /languages
 */

// Enqueue CSS and JavaScript
function font_size_plugin_enqueue_scripts() {
    wp_enqueue_style( 'font-size-plugin-style', plugin_dir_url( __FILE__ ) . 'css/style.css' );
    wp_enqueue_script( 'font-size-plugin-script', plugin_dir_url( __FILE__ ) . 'js/script.js', array( 'jquery' ), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'font_size_plugin_enqueue_scripts' );


// Add font size control in Customizer
function font_size_plugin_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'font_size_plugin_section', array(
        'title'    => __( 'Font Size', 'font-size-plugin' ),
        'priority' => 200,
    ) );

    $wp_customize->add_setting( 'font_size_plugin_setting', array(
        'default'           => '16',
        'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( 'font_size_plugin_control', array(
        'label'    => __( 'Font Size', 'font-size-plugin' ),
        'section'  => 'font_size_plugin_section',
        'settings' => 'font_size_plugin_setting',
        'type'     => 'number',
        'input_attrs' => array(
            'min'  => 1,
            'step' => 1,
        ),
    ) );
}
add_action( 'customize_register', 'font_size_plugin_customize_register' );

// Add dynamic font size to content
function font_size_plugin_dynamic_style() {
    $font_size = get_theme_mod( 'font_size_plugin_setting', '16' );
    ?>
    <style>
        .font-size-content {
            font-size: <?php echo $font_size; ?>px;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'font_size_plugin_dynamic_style' );

// Add a shortcode for font size
function font_size_plugin_shortcode( $atts, $content = null ) {
    ob_start();
    ?>
    <div class="font-size-content"><?php echo $content; ?></div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'font_size', 'font_size_plugin_shortcode' );

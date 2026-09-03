<?php
defined( 'ABSPATH' ) || exit;

/* ═══════════════════════════════════════════════
   THEME SETUP
═══════════════════════════════════════════════ */
function claytara_theme_setup() {
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'custom-logo', [
                'height'      => 120,
                'width'       => 360,
                'flex-height' => true,
                'flex-width'  => true,
        ] );
        add_theme_support( 'html5', [ 'search-form', 'comment-form', 'gallery', 'caption', 'script', 'style' ] );

        register_nav_menus( [
                'primary' => __( 'Primary Menu', 'claytara-master' ),
                'footer'  => __( 'Footer Menu', 'claytara-master' ),
        ] );
}
add_action( 'after_setup_theme', 'claytara_theme_setup' );

/* ═══════════════════════════════════════════════
   ENQUEUE ASSETS
═══════════════════════════════════════════════ */
function claytara_enqueue_assets() {
        wp_enqueue_style(
                'claytara-fonts',
                'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Manrope:wght@500;600;700;800&display=swap',
                [],
                null
        );

        $css_path = get_template_directory() . '/assets/dist/app.css';
        $js_path  = get_template_directory() . '/assets/dist/app.js';

        if ( file_exists( $css_path ) ) {
                wp_enqueue_style(
                        'claytara-style',
                        get_template_directory_uri() . '/assets/dist/app.css',
                        [],
                        filemtime( $css_path )
                );
        }

        if ( file_exists( $js_path ) ) {
                wp_enqueue_script(
                        'claytara-ui',
                        get_template_directory_uri() . '/assets/dist/app.js',
                        [],
                        filemtime( $js_path ),
                        true // load in footer
                );
        }
}
add_action( 'wp_enqueue_scripts', 'claytara_enqueue_assets' );

/* ═══════════════════════════════════════════════
   LEADGEN TRACKING (LeadGen Landing pages only)
═══════════════════════════════════════════════ */
function claytara_enqueue_leadgen_tracking() {
        if ( ! is_page_template( 'template-leadgen-landing.php' ) ) {
                return;
        }

        global $post;
        if ( ! $post ) return;

        $script_path = get_template_directory() . '/assets/js/leadgen-tracking.js';
        if ( ! file_exists( $script_path ) ) return;

        wp_enqueue_script(
                'leadgen-tracking',
                get_template_directory_uri() . '/assets/js/leadgen-tracking.js',
                [],
                filemtime( $script_path ),
                true
        );

        wp_add_inline_script(
                'leadgen-tracking',
                'window.leadgenTracking = ' . wp_json_encode( [
                        'pageId'      => $post->ID,
                        'blueprintId' => get_post_meta( $post->ID, 'leadgen_blueprint_slug', true ) ?: 'manual-' . $post->ID,
                        'endpoint'    => home_url( '/wp-json/leadgen/v1/event' ),
                ] ) . ';',
                'before'
        );
}
add_action( 'wp_enqueue_scripts', 'claytara_enqueue_leadgen_tracking' );

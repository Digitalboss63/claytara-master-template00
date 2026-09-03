<?php
defined( 'ABSPATH' ) || exit;

/* ═══════════════════════════════════════════════
   CASE STUDY CPT
═══════════════════════════════════════════════ */
function claytara_register_case_study_cpt() {
        register_post_type( 'case_study', [
                'labels'      => [
                        'name'          => __( 'Case Studies', 'claytara-master' ),
                        'singular_name' => __( 'Case Study', 'claytara-master' ),
                        'add_new_item'  => __( 'Add New Case Study', 'claytara-master' ),
                        'edit_item'     => __( 'Edit Case Study', 'claytara-master' ),
                ],
                'public'      => true,
                'has_archive' => true,
                'rewrite'     => [ 'slug' => 'work' ],
                'supports'    => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
                'menu_icon'   => 'dashicons-portfolio',
                'show_in_rest' => true,
        ] );
}
add_action( 'init', 'claytara_register_case_study_cpt' );

/* ═══════════════════════════════════════════════
   LEGACY EMAIL PAGE — REMOVE PERSONAL PHOTO
═══════════════════════════════════════════════ */
function claytara_remove_email_page_personal_photo( $content ) {
        if ( is_admin() || ! is_singular( 'page' ) || ! in_the_loop() || ! is_main_query() ) {
                return $content;
        }

        $post_id = get_queried_object_id();
        $title   = (string) get_the_title( $post_id );
        $slug    = (string) get_post_field( 'post_name', $post_id );

        if ( false === stripos( $title, 'Increase Sales With Email' ) && 'increase-sales-with-email' !== $slug ) {
                return $content;
        }

        // Remove the first WordPress image block/figure on this legacy page.
        $updated = preg_replace(
                '#<figure\b[^>]*wp-block-image[^>]*>.*?</figure>#is',
                '',
                $content,
                1
        );

        if ( $updated !== $content ) {
                return $updated;
        }

        // Fallback for a standalone image element inserted outside a block wrapper.
        return preg_replace( '#<img\b[^>]*>#is', '', $content, 1 );
}
add_filter( 'the_content', 'claytara_remove_email_page_personal_photo', 99 );

/* ═══════════════════════════════════════════════
   CUSTOMIZER SETTINGS
═══════════════════════════════════════════════ */
function claytara_customizer_settings( WP_Customize_Manager $wp_customize ) {
        $wp_customize->add_section( 'claytara_contact', [
                'title'    => __( 'Contact Info', 'claytara-master' ),
                'priority' => 30,
        ] );

        $wp_customize->add_setting( 'claytara_contact_email', [
                'default'           => 'hello@claytaradigital.com',
                'sanitize_callback' => 'sanitize_email',
                'transport'         => 'postMessage',
        ] );
        $wp_customize->add_control( 'claytara_contact_email', [
                'label'   => __( 'Contact Email', 'claytara-master' ),
                'section' => 'claytara_contact',
                'type'    => 'email',
        ] );

        $wp_customize->add_setting( 'claytara_contact_phone', [
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage',
        ] );
        $wp_customize->add_control( 'claytara_contact_phone', [
                'label'       => __( 'Contact Phone', 'claytara-master' ),
                'description' => __( 'Leave blank to hide phone CTA.', 'claytara-master' ),
                'section'     => 'claytara_contact',
                'type'        => 'text',
        ] );
}
add_action( 'customize_register', 'claytara_customizer_settings' );

/* ═══════════════════════════════════════════════
   SECURITY: HIDE WP VERSION
═══════════════════════════════════════════════ */
add_filter( 'the_generator', '__return_empty_string' );

/* ═══════════════════════════════════════════════
   DISABLE XML-RPC (not needed for this site)
═══════════════════════════════════════════════ */
add_filter( 'xmlrpc_enabled', '__return_false' );

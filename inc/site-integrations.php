<?php
defined( 'ABSPATH' ) || exit;

const CLAYTARA_INTEGRATIONS_OPTION = 'claytara_site_integrations';

function claytara_default_integrations() {
        return [
                'accessibility' => '',
                'analytics'     => '',
                'verification'  => '',
                'head'          => '',
                'body'          => '',
                'footer'        => '',
        ];
}

function claytara_get_integrations() {
        $saved = get_option( CLAYTARA_INTEGRATIONS_OPTION, [] );
        $saved = is_array( $saved ) ? $saved : [];
        $data  = wp_parse_args( $saved, claytara_default_integrations() );

        // One-way compatibility with the legacy Customizer field.
        if ( empty( $data['accessibility'] ) ) {
                $legacy = get_theme_mod( 'claytara_ada_embed', '' );
                if ( is_string( $legacy ) && '' !== trim( $legacy ) ) {
                        $data['accessibility'] = $legacy;
                }
        }

        return $data;
}

function claytara_sanitize_integrations( $value ) {
        $clean = claytara_default_integrations();

        if ( ! current_user_can( 'unfiltered_html' ) || ! is_array( $value ) ) {
                return $clean;
        }

        foreach ( array_keys( $clean ) as $key ) {
                if ( isset( $value[ $key ] ) && is_string( $value[ $key ] ) ) {
                        $clean[ $key ] = trim( wp_unslash( $value[ $key ] ) );
                }
        }

        return $clean;
}

function claytara_register_integration_settings() {
        register_setting(
                'claytara_site_integrations_group',
                CLAYTARA_INTEGRATIONS_OPTION,
                [
                        'type'              => 'array',
                        'sanitize_callback' => 'claytara_sanitize_integrations',
                        'default'           => claytara_default_integrations(),
                ]
        );
}
add_action( 'admin_init', 'claytara_register_integration_settings' );

function claytara_add_integrations_page() {
        add_theme_page(
                __( 'Site Integrations', 'claytara-master' ),
                __( 'Site Integrations', 'claytara-master' ),
                'manage_options',
                'claytara-site-integrations',
                'claytara_render_integrations_page'
        );
}
add_action( 'admin_menu', 'claytara_add_integrations_page' );

function claytara_integration_field( $key, $label, $description, $rows = 7 ) {
        $values = claytara_get_integrations();
        $id     = 'claytara-integration-' . sanitize_html_class( $key );
        ?>
        <tr>
                <th scope="row"><label for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $label ); ?></label></th>
                <td>
                        <textarea id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( CLAYTARA_INTEGRATIONS_OPTION ); ?>[<?php echo esc_attr( $key ); ?>]" rows="<?php echo esc_attr( $rows ); ?>" class="large-text code"><?php echo esc_textarea( $values[ $key ] ); ?></textarea>
                        <p class="description"><?php echo esc_html( $description ); ?></p>
                </td>
        </tr>
        <?php
}

function claytara_render_integrations_page() {
        if ( ! current_user_can( 'manage_options' ) ) {
                return;
        }
        ?>
        <div class="wrap">
                <h1><?php esc_html_e( 'Claytara Site Integrations', 'claytara-master' ); ?></h1>
                <p><?php esc_html_e( 'Authoritative location for approved third-party site code. Do not duplicate these snippets in theme files or the Customizer.', 'claytara-master' ); ?></p>
                <form method="post" action="options.php">
                        <?php settings_fields( 'claytara_site_integrations_group' ); ?>
                        <table class="form-table" role="presentation">
                                <?php
                                claytara_integration_field( 'accessibility', __( 'Accessibility / ADA Embed', 'claytara-master' ), __( 'Paste the complete accessibility widget embed supplied by the provider. Outputs once near the end of the page.', 'claytara-master' ) );
                                claytara_integration_field( 'analytics', __( 'Analytics Code', 'claytara-master' ), __( 'Analytics or tag-manager code that belongs in the document head.', 'claytara-master' ) );
                                claytara_integration_field( 'verification', __( 'Site Verification', 'claytara-master' ), __( 'Verification meta tags or other approved verification markup for the document head.', 'claytara-master' ), 4 );
                                claytara_integration_field( 'head', __( 'Additional Head Code', 'claytara-master' ), __( 'Approved code that must load in the document head.', 'claytara-master' ) );
                                claytara_integration_field( 'body', __( 'Body-Open Code', 'claytara-master' ), __( 'Approved code that must load immediately after the opening body tag.', 'claytara-master' ) );
                                claytara_integration_field( 'footer', __( 'Footer Code', 'claytara-master' ), __( 'Approved code that should load near the end of the page before the closing body tag.', 'claytara-master' ) );
                                ?>
                        </table>
                        <?php submit_button(); ?>
                </form>
        </div>
        <?php
}

function claytara_output_integration_code( $key ) {
        $values = claytara_get_integrations();
        if ( empty( $values[ $key ] ) ) {
                return;
        }

        echo "\n" . $values[ $key ] . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- owner-managed integration code.
}

function claytara_output_head_integrations() {
        claytara_output_integration_code( 'verification' );
        claytara_output_integration_code( 'analytics' );
        claytara_output_integration_code( 'head' );
}
add_action( 'wp_head', 'claytara_output_head_integrations', 99 );

function claytara_output_body_integrations() {
        claytara_output_integration_code( 'body' );
}
add_action( 'wp_body_open', 'claytara_output_body_integrations', 99 );

function claytara_output_footer_integrations() {
        claytara_output_integration_code( 'footer' );
        claytara_output_integration_code( 'accessibility' );
}
add_action( 'wp_footer', 'claytara_output_footer_integrations', 99 );

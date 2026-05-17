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

/* ═══════════════════════════════════════════════
   CAPABILITY + DB TABLES (LeadGen)
═══════════════════════════════════════════════ */
function leadgen_register_capability() {
	if ( ! function_exists( 'get_role' ) ) return;
	$admin = get_role( 'administrator' );
	if ( $admin && ! $admin->has_cap( 'manage_leadgen' ) ) {
		$admin->add_cap( 'manage_leadgen' );
	}
}
add_action( 'init', 'leadgen_register_capability' );

function leadgen_maybe_create_tables() {
	global $wpdb;

	if ( ! function_exists( 'dbDelta' ) ) {
		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	}

	$charset = $wpdb->get_charset_collate();

	$jobs_sql = "CREATE TABLE {$wpdb->prefix}leadgen_jobs (
		id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		job_id varchar(36) NOT NULL,
		job_type varchar(32) NOT NULL,
		slug varchar(191) NOT NULL,
		status varchar(20) NOT NULL,
		payload longtext NULL,
		command longtext NULL,
		stdout longtext NULL,
		stderr longtext NULL,
		exit_code int NULL,
		created_at datetime NOT NULL,
		started_at datetime NULL,
		finished_at datetime NULL,
		actor_id bigint(20) unsigned NULL,
		actor_name varchar(191) NULL,
		page_id bigint(20) unsigned NULL,
		brief_path text NULL,
		blueprint_path text NULL,
		target_post_id bigint(20) unsigned NULL,
		retry_count smallint unsigned NOT NULL DEFAULT 0,
		PRIMARY KEY  (id),
		UNIQUE KEY job_id (job_id),
		KEY slug (slug),
		KEY status (status)
	) $charset;";

	$events_sql = "CREATE TABLE {$wpdb->prefix}leadgen_events (
		id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		blueprint_id varchar(191) NOT NULL,
		page_id bigint(20) unsigned NULL,
		event_name varchar(64) NOT NULL,
		payload longtext NULL,
		event_time datetime NOT NULL,
		created_at datetime NOT NULL,
		referrer varchar(191) NULL,
		source varchar(191) NULL,
		PRIMARY KEY  (id),
		KEY blueprint_id (blueprint_id),
		KEY event_time (event_time)
	) $charset;";

	dbDelta( $jobs_sql );
	dbDelta( $events_sql );
}
add_action( 'after_setup_theme', 'leadgen_maybe_create_tables' );

/* ═══════════════════════════════════════════════
   REST API: LEADGEN EVENT LOGGING
═══════════════════════════════════════════════ */
function leadgen_register_event_route() {
	register_rest_route( 'leadgen/v1', '/event', [
		'methods'             => 'POST',
		'callback'            => 'leadgen_handle_event',
		'permission_callback' => '__return_true',
		'args'                => [
			'event'        => [ 'type' => 'string',  'required' => true ],
			'page_id'      => [ 'type' => 'integer', 'required' => true ],
			'blueprint_id' => [ 'type' => 'string',  'required' => true ],
			'timestamp'    => [ 'type' => 'string',  'required' => false ],
			'anchor'       => [ 'type' => 'string',  'required' => false ],
			'label'        => [ 'type' => 'string',  'required' => false ],
			'source'       => [ 'type' => 'string',  'required' => false ],
			'form_id'      => [ 'type' => 'string',  'required' => false ],
			'href'         => [ 'type' => 'string',  'required' => false ],
			'referrer'     => [ 'type' => 'string',  'required' => false ],
			'utm'          => [ 'type' => 'array',   'required' => false ],
		],
	] );
}
add_action( 'rest_api_init', 'leadgen_register_event_route' );

function leadgen_handle_event( WP_REST_Request $request ) {
	$allowed = [ 'leadgen_cta_click', 'leadgen_form_start', 'leadgen_form_submit' ];
	$event   = sanitize_key( $request->get_param( 'event' ) );

	if ( ! in_array( $event, $allowed, true ) ) {
		return new WP_Error( 'leadgen_invalid_event', 'Unsupported event type', [ 'status' => 400 ] );
	}

	$page_id      = absint( $request->get_param( 'page_id' ) );
	$blueprint_id = sanitize_text_field( $request->get_param( 'blueprint_id' ) );

	if ( ! $page_id || ! $blueprint_id ) {
		return new WP_Error( 'leadgen_invalid_payload', 'Missing identifiers', [ 'status' => 400 ] );
	}

	$utm_params = $request->get_param( 'utm' );
	$utm_data   = is_array( $utm_params ) ? array_map( 'sanitize_text_field', $utm_params ) : null;

	leadgen_log_event( [
		'event'        => $event,
		'page_id'      => $page_id,
		'blueprint_id' => $blueprint_id,
		'timestamp'    => sanitize_text_field( (string) ( $request->get_param( 'timestamp' ) ?: current_time( 'c' ) ) ),
		'context'      => array_filter( [
			'anchor'   => sanitize_text_field( (string) $request->get_param( 'anchor' ) ),
			'label'    => sanitize_text_field( (string) $request->get_param( 'label' ) ),
			'source'   => sanitize_text_field( (string) $request->get_param( 'source' ) ),
			'form_id'  => sanitize_text_field( (string) $request->get_param( 'form_id' ) ),
			'href'     => esc_url_raw( (string) $request->get_param( 'href' ) ),
			'referrer' => esc_url_raw( (string) $request->get_param( 'referrer' ) ),
			'utm'      => $utm_data,
		] ),
	] );

	return rest_ensure_response( [ 'ok' => true ] );
}

function leadgen_log_event( array $entry ) {
	$upload_dir = wp_upload_dir();
	$log_path   = trailingslashit( $upload_dir['basedir'] ) . 'leadgen-events.log';

	if ( ! file_exists( $upload_dir['basedir'] ) ) {
		wp_mkdir_p( $upload_dir['basedir'] );
	}

	file_put_contents( $log_path, wp_json_encode( $entry ) . PHP_EOL, FILE_APPEND | LOCK_EX );
}

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
   CUSTOMIZER SETTINGS
═══════════════════════════════════════════════ */
function claytara_customizer_settings( WP_Customize_Manager $wp_customize ) {
	// ── Contact Info ──
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

	// ── ADA embed ──
	$wp_customize->add_section( 'claytara_advanced', [
		'title'    => __( 'Advanced', 'claytara-master' ),
		'priority' => 90,
	] );

	$wp_customize->add_setting( 'claytara_ada_embed', [
		'default'           => '',
		'sanitize_callback' => 'wp_kses_post',
	] );
	$wp_customize->add_control( 'claytara_ada_embed', [
		'label'       => __( 'ADA Accessibility Embed', 'claytara-master' ),
		'description' => __( 'Paste embed code (e.g. UserWay) here. Outputs before </body>.', 'claytara-master' ),
		'section'     => 'claytara_advanced',
		'type'        => 'textarea',
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

/* ═══════════════════════════════════════════════
   LEADGEN WIZARD (admin UI)
═══════════════════════════════════════════════ */
require_once get_template_directory() . '/inc/leadgen-wizard.php';

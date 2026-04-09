<?php
/**
 * LeadGen Wizard admin screen.
 */

defined( 'ABSPATH' ) || exit;

add_action( 'admin_menu', 'leadgen_register_wizard_page' );

function leadgen_register_wizard_page() {
	add_management_page(
		'LeadGen Wizard',
		'LeadGen Wizard',
		'manage_leadgen',
		'leadgen-wizard',
		'leadgen_render_wizard_page'
	);
}

function leadgen_render_wizard_page() {
	if ( ! current_user_can( 'manage_leadgen' ) ) {
		wp_die( esc_html__( 'You do not have permission to access the LeadGen Wizard.', 'claytara' ) );
	}

	$messages = [];
	$state    = leadgen_get_wizard_state();

	if ( 'POST' === $_SERVER['REQUEST_METHOD'] ) {
		check_admin_referer( 'leadgen_wizard' );
		list( $state, $messages ) = leadgen_handle_wizard_post( $state );
	}

	$form = wp_parse_args( $state['form'] ?? [], leadgen_default_form_values() );
	$generator_job = leadgen_get_job( $state['generator_job_id'] ?? '' );
	$builder_job   = leadgen_get_job( $state['builder_job_id'] ?? '' );
	$recent_jobs   = leadgen_get_recent_jobs();
	$audit_log     = leadgen_get_audit_log();
	$job_poll_nonce = wp_create_nonce( 'leadgen_job_poll' );
	$jobs_to_poll   = array_values( array_filter( [ $state['generator_job_id'] ?? '', $state['builder_job_id'] ?? '' ] ) );
	$job_roles      = [];
	if ( ! empty( $state['generator_job_id'] ) ) {
		$job_roles[ $state['generator_job_id'] ] = 'generator';
	}
	if ( ! empty( $state['builder_job_id'] ) ) {
		$job_roles[ $state['builder_job_id'] ] = 'builder';
	}
	?>
	<div class="wrap leadgen-wizard">
		<h1>LeadGen Wizard</h1>

		<?php foreach ( $messages as $message ) : ?>
			<div class="notice notice-<?php echo esc_attr( $message['type'] ); ?>"><p><?php echo esc_html( $message['text'] ); ?></p></div>
		<?php endforeach; ?>

		<form method="post" class="leadgen-wizard__form">
			<?php wp_nonce_field( 'leadgen_wizard' ); ?>
			<input type="hidden" name="leadgen_action" value="save_brief" />

			<h2>1. Business Basics</h2>
			<table class="form-table">
				<tr>
					<th scope="row"><label for="leadgen-company">Company</label></th>
					<td><input name="company" id="leadgen-company" type="text" class="regular-text" value="<?php echo esc_attr( $form['company'] ); ?>" required /></td>
				</tr>
				<tr>
					<th scope="row"><label for="leadgen-service">Primary Service</label></th>
					<td><input name="service" id="leadgen-service" type="text" class="regular-text" value="<?php echo esc_attr( $form['service'] ); ?>" required /></td>
				</tr>
				<tr>
					<th scope="row"><label for="leadgen-city">City / Territory</label></th>
					<td><input name="city" id="leadgen-city" type="text" class="regular-text" value="<?php echo esc_attr( $form['city'] ); ?>" required /></td>
				</tr>
				<tr>
					<th scope="row"><label for="leadgen-tone">Tone</label></th>
					<td><input name="tone" id="leadgen-tone" type="text" class="regular-text" value="<?php echo esc_attr( $form['tone'] ); ?>" placeholder="confident, direct, reassuring" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="leadgen-contact-email">Contact Email</label></th>
					<td><input name="contact_email" id="leadgen-contact-email" type="email" class="regular-text" value="<?php echo esc_attr( $form['contact_email'] ); ?>" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="leadgen-contact-phone">Contact Phone / SMS</label></th>
					<td><input name="contact_phone" id="leadgen-contact-phone" type="text" class="regular-text" value="<?php echo esc_attr( $form['contact_phone'] ); ?>" /></td>
				</tr>
			</table>

			<h2>2. Service & Proof</h2>
			<table class="form-table">
				<tr>
					<th scope="row"><label for="leadgen-offer-details">Offer Highlights</label></th>
					<td>
						<textarea name="offer_details" id="leadgen-offer-details" class="large-text" rows="4" placeholder="One bullet per line"><?php echo esc_textarea( $form['offer_details'] ); ?></textarea>
						<p class="description">One bullet per line.</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="leadgen-testimonial-quote">Testimonial Quote</label></th>
					<td><textarea name="testimonial_quote" id="leadgen-testimonial-quote" class="large-text" rows="2"><?php echo esc_textarea( $form['testimonial_quote'] ); ?></textarea></td>
				</tr>
				<tr>
					<th scope="row"><label for="leadgen-testimonial-author">Testimonial Author</label></th>
					<td><input name="testimonial_author" id="leadgen-testimonial-author" type="text" class="regular-text" value="<?php echo esc_attr( $form['testimonial_author'] ); ?>" /></td>
				</tr>
			</table>

			<h2>3. Launch Settings</h2>
			<table class="form-table">
				<tr>
					<th scope="row"><label for="leadgen-target-post">Target Page ID (optional)</label></th>
					<td><input name="target_post_id" id="leadgen-target-post" type="number" class="regular-text" value="<?php echo esc_attr( $form['target_post_id'] ); ?>" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="leadgen-form-shortcode">Form Shortcode</label></th>
					<td><input name="form_shortcode" id="leadgen-form-shortcode" type="text" class="regular-text" value="<?php echo esc_attr( $form['form_shortcode'] ); ?>" placeholder='[contact-form-7 id="123" title="Lead Capture"]' /></td>
				</tr>
				<tr>
					<th scope="row"><label for="leadgen-form-note">Form Note</label></th>
					<td><input name="form_note" id="leadgen-form-note" type="text" class="regular-text" value="<?php echo esc_attr( $form['form_note'] ); ?>" /></td>
				</tr>
				<tr>
					<th scope="row">Dry Run</th>
					<td>
						<label><input type="checkbox" name="dry_run" value="1" <?php checked( ! empty( $form['dry_run'] ) ); ?> /> Use offline generator (no API call)</label>
					</td>
				</tr>
			</table>

			<p class="submit"><button type="submit" class="button button-primary">Save Brief</button></p>
		</form>

		<?php if ( ! empty( $state['brief_path'] ) ) : ?>
			<h2>Generator</h2>
			<form method="post">
				<?php wp_nonce_field( 'leadgen_wizard' ); ?>
				<input type="hidden" name="leadgen_action" value="generate_preview" />
				<p class="submit">
					<button type="submit" class="button button-secondary">Generate Preview</button>
					<span class="description">Job ID: <span id="leadgen-generator-job-id"><?php echo esc_html( $state['generator_job_id'] ?? '—' ); ?></span></span>
				</p>
			</form>

			<div class="leadgen-job-card">
				<p>Status: <span id="leadgen-generator-status" data-job-id="<?php echo esc_attr( $state['generator_job_id'] ?? '' ); ?>"><?php echo esc_html( leadgen_pretty_status( $generator_job ) ); ?></span></p>
				<?php if ( $generator_job ) : ?>
					<p>Last update: <span id="leadgen-generator-updated"><?php echo esc_html( $generator_job['finished_at'] ?? $generator_job['started_at'] ?? $generator_job['created_at'] ); ?></span></p>
					<details id="leadgen-generator-log-wrapper" open>
						<summary>Latest log</summary>
						<pre id="leadgen-generator-log"><?php echo esc_html( leadgen_format_job_log( $generator_job ) ); ?></pre>
					</details>
				<?php else : ?>
					<p id="leadgen-generator-log" class="description">No generation jobs have been run yet.</p>
				<?php endif; ?>
			</div>

			<?php if ( ! empty( $state['blueprint_preview'] ) ) : ?>
				<table class="widefat">
					<thead>
						<tr>
							<th>Hero</th>
							<th>Offer</th>
							<th>CTA</th>
							<th>Form Shortcode</th>
							<th>Form Note</th>
							<th>Generated</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td id="leadgen-preview-hero"><?php echo esc_html( $state['blueprint_preview']['title'] ?? '' ); ?></td>
							<td id="leadgen-preview-offer"><?php echo esc_html( $state['blueprint_preview']['offer'] ?? '' ); ?></td>
							<td id="leadgen-preview-cta"><?php echo esc_html( $state['blueprint_preview']['cta'] ?? '' ); ?></td>
							<td id="leadgen-preview-shortcode"><?php echo esc_html( $state['blueprint_preview']['form_shortcode'] ?? '' ); ?></td>
							<td id="leadgen-preview-note"><?php echo esc_html( $state['blueprint_preview']['form_note'] ?? '' ); ?></td>
							<td id="leadgen-preview-generated"><?php echo esc_html( $state['blueprint_preview']['created'] ?? '' ); ?></td>
						</tr>
					</tbody>
				</table>
			<?php endif; ?>
		<?php endif; ?>

		<?php if ( ! empty( $state['blueprint_path'] ) ) : ?>
			<h2>Build Landing Page</h2>
			<form method="post">
				<?php wp_nonce_field( 'leadgen_wizard' ); ?>
				<input type="hidden" name="leadgen_action" value="build_page" />
				<p class="submit">
					<button type="submit" class="button button-primary">Build / Publish Landing Page</button>
					<span class="description">Job ID: <span id="leadgen-builder-job-id"><?php echo esc_html( $state['builder_job_id'] ?? '—' ); ?></span></span>
				</p>
			</form>

			<div class="leadgen-job-card">
				<p>Status: <span id="leadgen-builder-status" data-job-id="<?php echo esc_attr( $state['builder_job_id'] ?? '' ); ?>"><?php echo esc_html( leadgen_pretty_status( $builder_job ) ); ?></span></p>
				<?php if ( $builder_job ) : ?>
					<p>Last update: <span id="leadgen-builder-updated"><?php echo esc_html( $builder_job['finished_at'] ?? $builder_job['started_at'] ?? $builder_job['created_at'] ); ?></span></p>
					<details id="leadgen-builder-log-wrapper" open>
						<summary>Latest log</summary>
						<pre id="leadgen-builder-log"><?php echo esc_html( leadgen_format_job_log( $builder_job ) ); ?></pre>
					</details>
				<?php else : ?>
					<p id="leadgen-builder-log" class="description">No build jobs have been run yet.</p>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php $last_event = ! empty( $state['brief_slug'] ) ? leadgen_get_last_event_timestamp( $state['brief_slug'] ) : ''; ?>
		<h2>Recent Status</h2>
		<table class="widefat striped">
			<thead>
				<tr>
					<th>Brief Slug</th>
					<th>Brief Saved</th>
					<th>Generator</th>
					<th>Builder</th>
					<th>Target Page</th>
					<th>Last Event</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php echo esc_html( $state['brief_slug'] ?? '—' ); ?></td>
					<td><?php echo esc_html( $state['brief_saved_at'] ?? '—' ); ?></td>
					<td><?php echo esc_html( $state['generator_status'] ?? 'pending' ); ?></td>
					<td><?php echo esc_html( $state['builder_status'] ?? 'pending' ); ?></td>
					<td><span id="leadgen-last-page"><?php echo esc_html( $state['last_page_id'] ?? '—' ); ?></span></td>
					<td><?php echo esc_html( $last_event ?: '—' ); ?></td>
				</tr>
			</tbody>
		</table>

		<?php if ( $recent_jobs ) : ?>
			<h2>Recent Jobs</h2>
			<table class="widefat striped">
				<thead>
					<tr>
						<th>Type</th>
						<th>Slug</th>
						<th>Status</th>
						<th>Operator</th>
						<th>Created</th>
						<th>Finished</th>
						<th>Page ID</th>
					</tr>
				</thead>
				<tbody id="leadgen-recent-jobs">
					<?php foreach ( $recent_jobs as $job ) : ?>
						<tr>
							<td><?php echo esc_html( ucfirst( $job['job_type'] ) ); ?></td>
							<td><?php echo esc_html( $job['slug'] ?: '—' ); ?></td>
							<td><?php echo esc_html( leadgen_pretty_status( $job ) ); ?></td>
							<td><?php echo esc_html( $job['actor_name'] ?: '—' ); ?></td>
							<td><?php echo esc_html( $job['created_at'] ); ?></td>
							<td><?php echo esc_html( $job['finished_at'] ?? '—' ); ?></td>
							<td><?php echo esc_html( $job['page_id'] ?? '—' ); ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		<?php endif; ?>

		<?php if ( $audit_log ) : ?>
			<h2>Recent Actions</h2>
			<table class="widefat striped">
				<thead>
					<tr>
						<th>When</th>
						<th>User</th>
						<th>Action</th>
						<th>Slug</th>
						<th>Status</th>
						<th>Job ID</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ( $audit_log as $entry ) : ?>
						<tr>
							<td><?php echo esc_html( $entry['timestamp'] ); ?></td>
							<td><?php echo esc_html( $entry['user'] ?: $entry['user_id'] ); ?></td>
							<td><?php echo esc_html( ucfirst( $entry['action'] ) ); ?></td>
							<td><?php echo esc_html( $entry['slug'] ?: '—' ); ?></td>
							<td><?php echo esc_html( $entry['status'] ); ?></td>
							<td><?php echo esc_html( $entry['job_id'] ?: '—' ); ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		<?php endif; ?>

		<?php if ( $jobs_to_poll ) : ?>
			<script>
				(function() {
					const config = {
						ajaxUrl: <?php echo wp_json_encode( admin_url( 'admin-ajax.php' ) ); ?>,
						nonce: '<?php echo esc_js( $job_poll_nonce ); ?>',
						jobs: <?php echo wp_json_encode( array_values( $jobs_to_poll ) ); ?>,
						roles: <?php echo wp_json_encode( $job_roles ); ?>
					};

					if ( ! config.jobs.length ) {
						return;
					}

					const statusEls = {
						generator: {
							status: document.getElementById( 'leadgen-generator-status' ),
							log: document.getElementById( 'leadgen-generator-log' ),
							updated: document.getElementById( 'leadgen-generator-updated' ),
							jobId: document.getElementById( 'leadgen-generator-job-id' )
						},
						builder: {
							status: document.getElementById( 'leadgen-builder-status' ),
							log: document.getElementById( 'leadgen-builder-log' ),
							updated: document.getElementById( 'leadgen-builder-updated' ),
							jobId: document.getElementById( 'leadgen-builder-job-id' )
						}
					};

					const previewEls = {
						hero: document.getElementById( 'leadgen-preview-hero' ),
						offer: document.getElementById( 'leadgen-preview-offer' ),
						ecta: document.getElementById( 'leadgen-preview-cta' ),
						shortcode: document.getElementById( 'leadgen-preview-shortcode' ),
						note: document.getElementById( 'leadgen-preview-note' ),
						generated: document.getElementById( 'leadgen-preview-generated' ),
						page: document.getElementById( 'leadgen-last-page' )
					};

					const recentJobsBody = document.getElementById( 'leadgen-recent-jobs' );

					const statusLabels = {
						queued: 'Queued',
						running: 'Running',
						succeeded: 'Succeeded',
						failed: 'Failed'
					};

					function updateJobRole( role, job ) {
						const els = statusEls[ role ];
						if ( ! els || ! job ) {
							return;
						}
						if ( els.status ) {
							els.status.textContent = statusLabels[ job.status ] || ( job.status ? job.status.charAt(0).toUpperCase() + job.status.slice(1) : 'pending' );
						}
						if ( els.log && job.formatted_log ) {
							els.log.textContent = job.formatted_log;
						}
						if ( els.updated ) {
							els.updated.textContent = job.finished_at || job.started_at || job.created_at || '';
						}
						if ( els.jobId ) {
							els.jobId.textContent = job.job_id || '—';
						}
					}

					function updatePreview( preview ) {
						if ( ! preview ) {
							return;
						}
						if ( previewEls.hero ) previewEls.hero.textContent = preview.title || '';
						if ( previewEls.offer ) previewEls.offer.textContent = preview.offer || '';
						if ( previewEls.cta ) previewEls.cta.textContent = preview.cta || '';
						if ( previewEls.shortcode ) previewEls.shortcode.textContent = preview.form_shortcode || '';
						if ( previewEls.note ) previewEls.note.textContent = preview.form_note || '';
						if ( previewEls.generated ) previewEls.generated.textContent = preview.created || '';
					}

					function updateRecentJobs( rows ) {
						if ( ! recentJobsBody || ! Array.isArray( rows ) ) {
							return;
						}
						recentJobsBody.innerHTML = '';
						rows.forEach( function( job ) {
							const tr = document.createElement( 'tr' );
							const cells = [
								job.job_type ? job.job_type.charAt(0).toUpperCase() + job.job_type.slice(1) : '—',
								job.slug || '—',
								statusLabels[ job.status ] || ( job.status ? job.status : '—' ),
								job.actor_name || '—',
								job.created_at || '—',
								job.finished_at || '—',
								job.page_id || '—'
							];
							cells.forEach( function( value ) {
								const td = document.createElement( 'td' );
								td.textContent = value;
								tr.appendChild( td );
							} );
							recentJobsBody.appendChild( tr );
						} );
					}

					function pollJobs() {
						const body = new URLSearchParams();
						body.append( 'action', 'leadgen_job_status' );
						body.append( 'nonce', config.nonce );
						config.jobs.forEach( function( id ) {
							body.append( 'job_ids[]', id );
						} );

						fetch( config.ajaxUrl, {
							method: 'POST',
							credentials: 'same-origin',
							body
						} )
							.then( function( response ) { return response.json(); } )
							.then( function( payload ) {
								if ( ! payload || ! payload.success || ! payload.data ) {
									return;
								}
								const data = payload.data;
								if ( data.jobs ) {
									Object.keys( data.jobs ).forEach( function( jobId ) {
										const role = config.roles[ jobId ];
										if ( role ) {
											updateJobRole( role, data.jobs[ jobId ] );
										}
									} );
								}
								if ( data.preview ) {
									updatePreview( data.preview );
								}
								if ( data.last_page_id && previewEls.page ) {
									previewEls.page.textContent = data.last_page_id;
								}
								if ( data.recent_jobs ) {
									updateRecentJobs( data.recent_jobs );
								}
							} )
							.catch( function() {} );
					}

					pollJobs();
					setInterval( pollJobs, 5000 );
				})();
			</script>
		<?php endif; ?>
	</div>
	<?php
}

function leadgen_handle_wizard_post( array $state ) {
	if ( ! current_user_can( 'manage_leadgen' ) ) {
		return [ $state, [ [ 'type' => 'error', 'text' => 'You are not allowed to perform this action.' ] ] ];
	}

	$action   = sanitize_text_field( wp_unslash( $_POST['leadgen_action'] ?? '' ) );
	$messages = [];

	switch ( $action ) {
		case 'save_brief':
			list( $state, $message ) = leadgen_wizard_save_brief( $state );
			$messages[]              = $message;
			break;
		case 'generate_preview':
			list( $state, $message ) = leadgen_wizard_generate_preview( $state );
			$messages[]              = $message;
			break;
		case 'build_page':
			list( $state, $message ) = leadgen_wizard_build_page( $state );
			$messages[]              = $message;
			break;
		default:
			$messages[] = [ 'type' => 'error', 'text' => 'Unknown action' ];
	}

	leadgen_update_wizard_state( $state );

	return [ $state, array_filter( $messages ) ];
}

function leadgen_wizard_save_brief( array $state ) {
	$form = leadgen_collect_form_data();
	$required = [ 'company', 'service', 'city' ];
	foreach ( $required as $field ) {
		if ( empty( $form[ $field ] ) ) {
			return [ $state, [ 'type' => 'error', 'text' => 'Company, service, and city are required.' ] ];
		}
	}

	$slug      = leadgen_generate_slug( $form['service'] . '-' . $form['city'] );
	$brief_dir = leadgen_get_workspace_root() . '/leadgen-foundry/briefs';
	wp_mkdir_p( $brief_dir );
	$brief_path = trailingslashit( $brief_dir ) . $slug . '.yml';

	$proof_assets = [];
	if ( ! empty( $form['testimonial_quote'] ) ) {
		$proof_assets[] = array_filter(
			[
				'quote'  => $form['testimonial_quote'],
				'author' => $form['testimonial_author'],
			]
		);
	}

	$form_block = array_filter(
		[
			'shortcode' => $form['form_shortcode'],
			'note'      => $form['form_note'],
		]
	);

	$brief_data = [
		'company'         => $form['company'],
		'service'         => $form['service'],
		'city'            => $form['city'],
		'tone'            => $form['tone'],
		'proof_assets'    => $proof_assets,
		'offer_details'   => leadgen_split_lines( $form['offer_details'] ),
		'contact_routing' => array_filter(
			[
				'email' => $form['contact_email'],
				'phone' => $form['contact_phone'],
			]
		),
	];

	if ( $form_block ) {
		$brief_data['form'] = $form_block;
	}

	leadgen_write_yaml( $brief_path, $brief_data );

	$state['form']            = $form;
	$state['brief_path']      = $brief_path;
	$state['brief_slug']      = $slug;
	$state['brief_saved_at']  = current_time( 'mysql' );
	$state['generator_status'] = 'pending';
	$state['builder_status']   = 'pending';
	$state['generator_log']     = '';
	$state['builder_log']       = '';
	$state['blueprint_path']    = '';
	$state['blueprint_preview'] = [];
	$state['last_page_id']      = '';

	leadgen_append_audit_entry( 'save_brief', $slug, 'succeeded' );

	return [ $state, [ 'type' => 'success', 'text' => 'Brief saved.' ] ];
}

function leadgen_wizard_generate_preview( array $state ) {
	if ( empty( $state['brief_path'] ) || ! file_exists( $state['brief_path'] ) ) {
		return [ $state, [ 'type' => 'error', 'text' => 'Save a brief before generating.' ] ];
	}

	$form = $state['form'] ?? leadgen_default_form_values();

	$job_id = leadgen_enqueue_job(
		'generate',
		[
			'slug'        => $state['brief_slug'],
			'brief_path'  => $state['brief_path'],
			'dry_run'     => ! empty( $form['dry_run'] ),
		]
	);

	if ( is_wp_error( $job_id ) ) {
		return [ $state, [ 'type' => 'error', 'text' => $job_id->get_error_message() ] ];
	}

	$state['generator_job_id'] = $job_id;
	$state['generator_status'] = 'queued';

	leadgen_append_audit_entry( 'generate', $state['brief_slug'], 'queued', $job_id );

	return [ $state, [ 'type' => 'success', 'text' => 'Generation job queued.' ] ];
}

function leadgen_wizard_build_page( array $state ) {
	if ( empty( $state['blueprint_path'] ) || ! file_exists( $state['blueprint_path'] ) ) {
		return [ $state, [ 'type' => 'error', 'text' => 'Generate a preview before building.' ] ];
	}

	$form    = $state['form'] ?? leadgen_default_form_values();
	$post_id = absint( $form['target_post_id'] ?? 0 );

	$job_id = leadgen_enqueue_job(
		'build',
		[
			'slug'            => $state['brief_slug'],
			'blueprint_path'  => $state['blueprint_path'],
			'target_post_id'  => $post_id,
		]
	);

	if ( is_wp_error( $job_id ) ) {
		return [ $state, [ 'type' => 'error', 'text' => $job_id->get_error_message() ] ];
	}

	$state['builder_job_id'] = $job_id;
	$state['builder_status'] = 'queued';

	leadgen_append_audit_entry( 'build', $state['brief_slug'], 'queued', $job_id );

	return [ $state, [ 'type' => 'success', 'text' => 'Build job queued.' ] ];
}

function leadgen_collect_form_data() {
	$data                     = [];
	$data['company']          = sanitize_text_field( wp_unslash( $_POST['company'] ?? '' ) );
	$data['service']          = sanitize_text_field( wp_unslash( $_POST['service'] ?? '' ) );
	$data['city']             = sanitize_text_field( wp_unslash( $_POST['city'] ?? '' ) );
	$data['tone']             = sanitize_text_field( wp_unslash( $_POST['tone'] ?? '' ) );
	$data['offer_details']    = isset( $_POST['offer_details'] ) ? (string) wp_unslash( $_POST['offer_details'] ) : '';
	$data['testimonial_quote']  = sanitize_textarea_field( wp_unslash( $_POST['testimonial_quote'] ?? '' ) );
	$data['testimonial_author'] = sanitize_text_field( wp_unslash( $_POST['testimonial_author'] ?? '' ) );
	$data['contact_email']      = sanitize_email( wp_unslash( $_POST['contact_email'] ?? '' ) );
	$data['contact_phone']      = sanitize_text_field( wp_unslash( $_POST['contact_phone'] ?? '' ) );
	$data['target_post_id']     = sanitize_text_field( wp_unslash( $_POST['target_post_id'] ?? '' ) );
	$data['form_shortcode']     = sanitize_text_field( wp_unslash( $_POST['form_shortcode'] ?? '' ) );
	$data['form_note']          = sanitize_text_field( wp_unslash( $_POST['form_note'] ?? '' ) );
	$data['dry_run']            = ! empty( $_POST['dry_run'] );

	return $data;
}

function leadgen_default_form_values() {
	return [
		'company'            => '',
		'service'            => '',
		'city'               => '',
		'tone'               => 'confident',
		'offer_details'      => '',
		'testimonial_quote'  => '',
		'testimonial_author' => '',
		'contact_email'      => '',
		'contact_phone'      => '',
		'target_post_id'     => '',
		'form_shortcode'     => '',
		'form_note'          => '',
		'dry_run'            => false,
	];
}

function leadgen_get_wizard_state() {
	$state = get_option( 'leadgen_wizard_state', [] );
	return is_array( $state ) ? $state : [];
}

function leadgen_update_wizard_state( array $state ) {
	update_option( 'leadgen_wizard_state', $state );
}

function leadgen_generate_slug( $value ) {
	return trim( preg_replace( '/[^a-z0-9]+/', '-', strtolower( $value ) ), '-' );
}

function leadgen_split_lines( $value ) {
	$lines = array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) $value ) ) );
	return array_values( $lines );
}

function leadgen_write_yaml( $path, array $data ) {
	$yaml = leadgen_yaml_from_array( $data );
	file_put_contents( $path, $yaml );
}

function leadgen_yaml_from_array( $data, $indent = 0 ) {
	$yaml = '';
	foreach ( $data as $key => $value ) {
		if ( is_array( $value ) ) {
			$is_assoc = leadgen_is_assoc( $value );
			$yaml    .= str_repeat( '  ', $indent ) . $key . ":\n";
			if ( $is_assoc ) {
				$yaml .= leadgen_yaml_from_array( $value, $indent + 1 );
			} else {
				foreach ( $value as $item ) {
					if ( is_array( $item ) ) {
						$yaml .= str_repeat( '  ', $indent + 1 ) . "-\n" . leadgen_yaml_from_array( $item, $indent + 2 );
					} else {
						$yaml .= str_repeat( '  ', $indent + 1 ) . '- ' . leadgen_yaml_escape( $item ) . "\n";
					}
				}
			}
		} elseif ( '' !== $value && null !== $value ) {
			$yaml .= str_repeat( '  ', $indent ) . $key . ': ' . leadgen_yaml_escape( $value ) . "\n";
		}
	}

	return $yaml;
}

function leadgen_yaml_escape( $value ) {
	$value = str_replace( '\\', '\\\\', (string) $value );
	$value = str_replace( '"', '\"', $value );

	return '"' . $value . '"';
}

function leadgen_is_assoc( array $array ) {
	return array_keys( $array ) !== range( 0, count( $array ) - 1 );
}

function leadgen_build_command( $binary, array $args = [] ) {
	$parts = [ escapeshellcmd( $binary ) ];
	foreach ( $args as $arg ) {
		if ( null === $arg ) {
			continue;
		}
		$parts[] = escapeshellarg( $arg );
	}

	return implode( ' ', $parts );
}

function leadgen_run_process( $command ) {
	$descriptor = [
		0 => [ 'pipe', 'r' ],
		1 => [ 'pipe', 'w' ],
		2 => [ 'pipe', 'w' ],
	];

	$process = proc_open( $command, $descriptor, $pipes, leadgen_get_workspace_root() );
	if ( ! is_resource( $process ) ) {
		return [ 'command' => $command, 'stdout' => '', 'stderr' => 'Unable to start process', 'exit_code' => 1 ];
	}

	fclose( $pipes[0] );
	$stdout = stream_get_contents( $pipes[1] );
	$stderr = stream_get_contents( $pipes[2] );
	fclose( $pipes[1] );
	fclose( $pipes[2] );
	$exit_code = proc_close( $process );

	return compact( 'command', 'stdout', 'stderr', 'exit_code' );
}

function leadgen_format_process_log( array $result ) {
	return sprintf(
		"$ %s\nExit: %d\n--- STDOUT ---\n%s\n--- STDERR ---\n%s",
		$result['command'],
		$result['exit_code'],
		trim( $result['stdout'] ),
		trim( $result['stderr'] )
	);
}

function leadgen_load_blueprint_summary( $path ) {
	$data = json_decode( file_get_contents( $path ), true );
	if ( ! is_array( $data ) ) {
		return [];
	}

	return [
		'title'         => $data['blocks']['hero']['title'] ?? '',
		'offer'         => $data['blocks']['offer']['title'] ?? '',
		'cta'           => $data['blocks']['cta']['title'] ?? '',
		'form_shortcode' => $data['blocks']['form']['shortcode'] ?? '',
		'form_note'      => $data['blocks']['form']['note'] ?? '',
		'created'       => current_time( 'mysql' ),
	];
}

function leadgen_extract_post_id( $stdout ) {
	if ( preg_match( '/post (\d+)/i', $stdout, $matches ) ) {
		return absint( $matches[1] );
	}
	return '';
}

function leadgen_get_workspace_root() {
	static $root = null;
	if ( null === $root ) {
		$root = dirname( get_template_directory(), 3 );
	}
	return $root;
}

function leadgen_get_last_event_timestamp( $slug ) {
	if ( empty( $slug ) ) {
		return '';
	}

	$upload_dir = wp_upload_dir();
	$log_path   = trailingslashit( $upload_dir['basedir'] ) . 'leadgen-events.log';
	if ( ! file_exists( $log_path ) ) {
		return '';
	}

	$lines = @file( $log_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );
	if ( ! $lines ) {
		return '';
	}

	for ( $i = count( $lines ) - 1; $i >= 0; $i-- ) {
		$line  = trim( $lines[ $i ] );
		$entry = json_decode( $line, true );
		if ( ! is_array( $entry ) ) {
			continue;
		}
		if ( ( $entry['blueprint_id'] ?? '' ) === $slug ) {
			return $entry['timestamp'] ?? '';
		}
	}

	return '';
}


function leadgen_enqueue_job( string $type, array $payload ) {
    global $wpdb;

    $table   = $wpdb->prefix . 'leadgen_jobs';
    $job_id  = wp_generate_uuid4();
    $actor   = wp_get_current_user();
    $slug    = $payload['slug'] ?? ( $payload['brief_path'] ?? '' );
    $slug    = $slug ? leadgen_generate_slug( $slug ) : '';
    $insert  = [
        'job_id'         => $job_id,
        'job_type'       => $type,
        'slug'           => $slug,
        'status'         => 'queued',
        'payload'        => wp_json_encode( $payload ),
        'created_at'     => current_time( 'mysql' ),
        'actor_id'       => get_current_user_id(),
        'actor_name'     => $actor ? $actor->display_name : '',
        'brief_path'     => $payload['brief_path'] ?? '',
        'blueprint_path' => $payload['blueprint_path'] ?? '',
        'target_post_id' => $payload['target_post_id'] ?? null,
    ];

    $inserted = $wpdb->insert( $table, $insert );

    if ( false === $inserted ) {
        return new WP_Error( 'leadgen_job_insert_failed', __( 'Unable to queue job. Check logs for details.', 'claytara' ) );
    }

    leadgen_schedule_worker();

    return $job_id;
}

function leadgen_get_job( $job_id ) {
    if ( ! $job_id ) {
        return null;
    }
    global $wpdb;
    $table = $wpdb->prefix . 'leadgen_jobs';
    return $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table WHERE job_id = %s", $job_id ), ARRAY_A );
}

function leadgen_get_recent_jobs( $limit = 10 ) {
    global $wpdb;
    $table = $wpdb->prefix . 'leadgen_jobs';
    return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table ORDER BY created_at DESC LIMIT %d", $limit ), ARRAY_A );
}

function leadgen_schedule_worker() {
    if ( ! wp_next_scheduled( 'leadgen_process_jobs' ) ) {
        wp_schedule_single_event( time(), 'leadgen_process_jobs' );
    }
}

add_action( 'leadgen_process_jobs', 'leadgen_process_job_queue' );

function leadgen_process_job_queue() {
    if ( get_transient( 'leadgen_job_lock' ) ) {
        return;
    }

    set_transient( 'leadgen_job_lock', 1, 60 );

    while ( $job = leadgen_claim_next_job() ) {
        leadgen_run_job( $job );
    }

    delete_transient( 'leadgen_job_lock' );
    leadgen_prune_old_jobs();
}

function leadgen_claim_next_job() {
    global $wpdb;
    $table = $wpdb->prefix . 'leadgen_jobs';

    $job = $wpdb->get_row( "SELECT * FROM $table WHERE status = 'queued' ORDER BY created_at ASC LIMIT 1", ARRAY_A );
    if ( ! $job ) {
        return null;
    }

    $updated = $wpdb->update(
        $table,
        [
            'status'     => 'running',
            'started_at' => current_time( 'mysql' ),
        ],
        [ 'id' => $job['id'], 'status' => 'queued' ]
    );

    if ( ! $updated ) {
        return leadgen_claim_next_job();
    }

    $job['status']     = 'running';
    $job['started_at'] = current_time( 'mysql' );

    return $job;
}

function leadgen_run_job( array $job ) {
    global $wpdb;
    $table   = $wpdb->prefix . 'leadgen_jobs';
    $payload = json_decode( $job['payload'], true ) ?: [];
    $command = leadgen_prepare_job_command( $job['job_type'], $payload );

    if ( is_wp_error( $command ) ) {
        $wpdb->update( $table, [
            'status'      => 'failed',
            'finished_at' => current_time( 'mysql' ),
            'stderr'      => $command->get_error_message(),
        ], [ 'id' => $job['id'] ] );
        leadgen_sync_state_with_job( $job['job_id'] );
        return;
    }

    $result = leadgen_run_process( $command['command'] );

    $data = [
        'status'      => 0 === $result['exit_code'] ? 'succeeded' : 'failed',
        'finished_at' => current_time( 'mysql' ),
        'command'     => $command['display'],
        'stdout'      => $result['stdout'],
        'stderr'      => $result['stderr'],
        'exit_code'   => $result['exit_code'],
    ];

    if ( ! empty( $payload['blueprint_path'] ) ) {
        $data['blueprint_path'] = $payload['blueprint_path'];
    }

    if ( 'build' === $job['job_type'] ) {
        $data['page_id'] = leadgen_extract_post_id( $result['stdout'] );
    }

    $wpdb->update( $table, $data, [ 'id' => $job['id'] ] );

    leadgen_sync_state_with_job( $job['job_id'] );
}

function leadgen_prepare_job_command( $type, array $payload ) {
    $root = leadgen_get_workspace_root();

    switch ( $type ) {
        case 'generate':
            if ( empty( $payload['brief_path'] ) ) {
                return new WP_Error( 'leadgen_missing_brief', __( 'Brief path missing.', 'claytara' ) );
            }
            $args = [ 'ts-node', 'scripts/generate-leadgen.ts', '--brief', $payload['brief_path'] ];
            if ( ! empty( $payload['dry_run'] ) ) {
                $args[] = '--offline';
            }
            return [
                'command' => leadgen_build_command( 'npx', $args ),
                'display' => 'npx ' . implode( ' ', $args ),
            ];
        case 'build':
            if ( empty( $payload['blueprint_path'] ) ) {
                return new WP_Error( 'leadgen_missing_blueprint', __( 'Blueprint path missing.', 'claytara' ) );
            }
            $args = [ 'scripts/build-leadgen.mjs', '--blueprint', $payload['blueprint_path'] ];
            if ( ! empty( $payload['target_post_id'] ) ) {
                $args[] = '--post';
                $args[] = (string) $payload['target_post_id'];
            }
            return [
                'command' => leadgen_build_command( 'node', $args ),
                'display' => 'node ' . implode( ' ', $args ),
            ];
    }

    return new WP_Error( 'leadgen_job_type', __( 'Unsupported job type.', 'claytara' ) );
}

function leadgen_sync_state_with_job( $job_id ) {
    $job = leadgen_get_job( $job_id );
    if ( ! $job ) {
        return;
    }

    $state = leadgen_get_wizard_state();

    if ( 'generate' === $job['job_type'] ) {
        $state['generator_status'] = $job['status'];
        $state['generator_job_id'] = $job['job_id'];
        if ( 'succeeded' === $job['status'] ) {
            $slug           = $job['slug'];
            $blueprint_path = leadgen_get_workspace_root() . '/leadgen-foundry/patterns/output/' . $slug . '.json';
            if ( file_exists( $blueprint_path ) ) {
                $state['blueprint_path']   = $blueprint_path;
                $state['blueprint_preview'] = leadgen_load_blueprint_summary( $blueprint_path );
            }
        }
    }

    if ( 'build' === $job['job_type'] ) {
        $state['builder_status'] = $job['status'];
        $state['builder_job_id'] = $job['job_id'];
        if ( ! empty( $job['page_id'] ) ) {
            $state['last_page_id'] = $job['page_id'];
        }
    }

    leadgen_update_wizard_state( $state );
}

function leadgen_prune_old_jobs() {
    global $wpdb;
    $table = $wpdb->prefix . 'leadgen_jobs';
    $wpdb->query( $wpdb->prepare( "DELETE FROM $table WHERE finished_at IS NOT NULL AND finished_at < %s", gmdate( 'Y-m-d H:i:s', strtotime( '-30 days' ) ) ) );
}

function leadgen_format_job_log( $job ) {
    if ( empty( $job ) ) {
        return '';
    }

function leadgen_pretty_status( $job ) {
	$status = $job['status'] ?? '';
	if ( ! $status ) {
		return 'pending';
	}

	$map = [
		'queued'    => 'Queued',
		'running'   => 'Running',
		'succeeded' => 'Succeeded',
		'failed'    => 'Failed',
	];

	return $map[ $status ] ?? ucfirst( $status );
}

    return sprintf(
        "$ %s
Exit: %s
--- STDOUT ---
%s
--- STDERR ---
%s",
        $job['command'] ?? '',
        $job['exit_code'] ?? '�',
        trim( (string) ( $job['stdout'] ?? '' ) ),
        trim( (string) ( $job['stderr'] ?? '' ) )
    );
}

function leadgen_append_audit_entry( $action, $slug, $status, $job_id = null ) {
    $log   = get_option( 'leadgen_audit_log', [] );
    $entry = [
        'timestamp' => current_time( 'mysql' ),
        'user_id'   => get_current_user_id(),
        'user'      => wp_get_current_user() ? wp_get_current_user()->display_name : '',
        'action'    => $action,
        'slug'      => $slug,
        'status'    => $status,
        'job_id'    => $job_id,
    ];

    array_unshift( $log, $entry );
    $log = array_slice( $log, 0, 25 );
    update_option( 'leadgen_audit_log', $log, false );
}

function leadgen_get_audit_log( $limit = 20 ) {
    $log = get_option( 'leadgen_audit_log', [] );
    return array_slice( $log, 0, $limit );
}

add_action( 'wp_ajax_leadgen_job_status', 'leadgen_job_status_ajax' );

function leadgen_job_status_ajax() {
    if ( ! current_user_can( 'manage_leadgen' ) ) {
        wp_send_json_error( [ 'message' => __( 'Unauthorized', 'claytara' ) ], 403 );
    }

    check_ajax_referer( 'leadgen_job_poll', 'nonce' );

    $job_ids = isset( $_POST['job_ids'] ) ? (array) $_POST['job_ids'] : [];
    $jobs    = [];
    foreach ( $job_ids as $job_id ) {
        $job_id = sanitize_text_field( wp_unslash( $job_id ) );
        $job    = leadgen_get_job( $job_id );
        if ( $job ) {
            $job['pretty_status'] = leadgen_pretty_status( $job );
            $job['formatted_log'] = leadgen_format_job_log( $job );
            $jobs[ $job_id ] = $job;
        }
    }

    $state  = leadgen_get_wizard_state();
    $recent = array_map(
        function( $job ) {
            $job['pretty_status'] = leadgen_pretty_status( $job );
            return $job;
        },
        leadgen_get_recent_jobs( 5 )
    );

    wp_send_json_success(
        [
            'jobs'            => $jobs,
            'preview'         => $state['blueprint_preview'] ?? [],
            'last_page_id'    => $state['last_page_id'] ?? '',
            'generator_status'=> $state['generator_status'] ?? '',
            'builder_status'  => $state['builder_status'] ?? '',
            'recent_jobs'     => $recent,
        ]
    );
}

<?php
/**
 * LeadGen Form block.
 *
 * @package Claytara
 */

defined( 'ABSPATH' ) || exit;

$title     = $args['title'] ?? '';
$copy      = $args['copy'] ?? '';
$note      = $args['note'] ?? '';
$shortcode = $args['shortcode'] ?? '';
?>
<section id="leadgen-form" class="leadgen__form" data-leadgen-block="form">
	<div class="ct-container leadgen__form-grid">
		<div>
			<?php if ( $title ) : ?>
				<h2><?php echo esc_html( $title ); ?></h2>
			<?php endif; ?>
			<?php if ( $copy ) : ?>
				<p><?php echo esc_html( $copy ); ?></p>
			<?php endif; ?>
			<?php if ( $note ) : ?>
				<p class="leadgen__form-note"><?php echo esc_html( $note ); ?></p>
			<?php endif; ?>
		</div>
		<div class="leadgen__form-card">
			<?php
			if ( $shortcode ) {
				echo do_shortcode( $shortcode ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
			?>
		</div>
	</div>
</section>

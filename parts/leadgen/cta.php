<?php
/**
 * LeadGen CTA block.
 *
 * @package Claytara
 */

defined( 'ABSPATH' ) || exit;

$title        = $args['title'] ?? '';
$copy         = $args['copy'] ?? '';
$button_label = $args['button_label'] ?? 'Send Me the Plan';
$button_anchor = $args['button_anchor'] ?? '#leadgen-form';
?>
<section class="leadgen__cta" data-leadgen-block="cta">
	<div class="ct-container leadgen__cta-card">
		<div>
			<?php if ( $title ) : ?>
				<h2><?php echo esc_html( $title ); ?></h2>
			<?php endif; ?>
			<?php if ( $copy ) : ?>
				<p><?php echo esc_html( $copy ); ?></p>
			<?php endif; ?>
		</div>
		<a class="ct-btn ct-btn-primary" href="<?php echo esc_url( $button_anchor ); ?>" data-leadgen-cta="cta">
			<?php echo esc_html( $button_label ); ?>
		</a>
	</div>
</section>

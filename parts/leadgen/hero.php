<?php
/**
 * LeadGen Hero block.
 *
 * @package Claytara
 */

defined( 'ABSPATH' ) || exit;

$eyebrow      = $args['eyebrow'] ?? 'LeadGen Foundry';
$title        = $args['title'] ?? '';
$intro        = $args['intro'] ?? '';
$button_label = $args['button_label'] ?? 'Book My Build Call';
$cta_anchor   = $args['cta_anchor'] ?? '#leadgen-form';
$badges       = array_filter( (array) ( $args['badges'] ?? [] ) );
$testimonial  = $args['testimonial'] ?? [];
$quote        = $testimonial['quote'] ?? '“We went from quiet phones to booked-out weeks. The process was painless.”';
$author       = $testimonial['author'] ?? '— Local HVAC Owner';
?>
<section class="leadgen__hero" data-leadgen-block="hero">
	<div class="ct-container leadgen__hero-grid">
		<div>
			<p class="leadgen__eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
			<?php if ( $title ) : ?>
				<h1><?php echo esc_html( $title ); ?></h1>
			<?php endif; ?>
			<?php if ( $intro ) : ?>
				<p class="leadgen__intro"><?php echo esc_html( $intro ); ?></p>
			<?php endif; ?>
			<div class="leadgen__cta-row">
				<a class="ct-btn ct-btn-primary" href="<?php echo esc_url( $cta_anchor ); ?>" data-leadgen-cta="hero">
					<?php echo esc_html( $button_label ); ?>
				</a>
			</div>
			<?php if ( $badges ) : ?>
				<ul class="leadgen__badge-row">
					<?php foreach ( $badges as $badge ) : ?>
						<li><?php echo esc_html( $badge ); ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
		<div class="leadgen__hero-card">
			<p><?php echo esc_html( $quote ); ?></p>
			<span><?php echo esc_html( $author ); ?></span>
		</div>
	</div>
</section>

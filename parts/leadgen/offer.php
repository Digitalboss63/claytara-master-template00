<?php
/**
 * LeadGen Offer block.
 *
 * @package Claytara
 */

defined( 'ABSPATH' ) || exit;

$title = $args['title'] ?? '';
$copy  = $args['copy'] ?? '';
$items = array_filter( (array) ( $args['items'] ?? [] ) );
?>
<section class="leadgen__offer" data-leadgen-block="offer">
	<div class="ct-container">
		<div class="leadgen__offer-card">
			<?php if ( $title ) : ?>
				<h2><?php echo esc_html( $title ); ?></h2>
			<?php endif; ?>
			<?php if ( $copy ) : ?>
				<p><?php echo esc_html( $copy ); ?></p>
			<?php endif; ?>
			<?php if ( $items ) : ?>
				<ul>
					<?php foreach ( $items as $item ) : ?>
						<li><?php echo esc_html( $item ); ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
	</div>
</section>

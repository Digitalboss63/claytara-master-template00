<?php
/**
 * LeadGen Benefits block.
 *
 * @package Claytara
 */

defined( 'ABSPATH' ) || exit;

$heading = $args['heading'] ?? 'Why it works';
$items   = array_filter( (array) ( $args['items'] ?? [] ) );
?>
<section class="leadgen__benefits" data-leadgen-block="benefits">
	<div class="ct-container">
		<?php if ( $heading ) : ?>
			<h2><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>
		<?php if ( $items ) : ?>
			<div class="leadgen__benefits-grid">
				<?php foreach ( $items as $benefit ) : ?>
					<div class="leadgen__benefit">
						<p><?php echo esc_html( $benefit ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>

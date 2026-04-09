<?php
/*
Template Name: LeadGen Landing Page
*/

defined( 'ABSPATH' ) || exit;

get_header();

function leadgen_parse_lines( $value, $fallback = [] ) {
	if ( empty( $value ) ) {
		return $fallback;
	}

	$pieces = array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) $value ) ) );

	return $pieces ?: $fallback;
}
?>

<main id="primary" class="leadgen">
	<?php
	while ( have_posts() ) :
		the_post();

		$post_id      = get_the_ID();
		$blueprint    = json_decode( (string) get_post_meta( $post_id, 'leadgen_blueprint_json', true ), true );
		$blocks       = $blueprint['blocks'] ?? [];

		$hero_badges  = leadgen_parse_lines( get_post_meta( $post_id, 'leadgen_hero_badges', true ), [ 'Plumbing', 'Roofing', 'HVAC', 'Home Services' ] );
		$benefits     = leadgen_parse_lines( get_post_meta( $post_id, 'leadgen_benefits', true ), [
			'Neighborhood targeting for urgent “need-it-now” searches.',
			'Call-first layouts with click-to-call + SMS above the fold.',
			'Automation safety net so hot leads get instant follow-ups.',
			'Proof blocks that highlight guarantees, reviews, and services.',
		] );
		$offer_items  = leadgen_parse_lines( get_post_meta( $post_id, 'leadgen_offer_items', true ), [
			'Hyper-local copywriting',
			'Tap-to-call & SMS prompts',
			'Lead routing + follow-ups',
		] );

		$block_data = [
			'hero'     => wp_parse_args(
				$blocks['hero'] ?? [],
				[
					'eyebrow'      => 'LeadGen Foundry',
					'title'        => get_post_meta( $post_id, 'leadgen_hero_title', true ) ?: 'More Local Service Calls in 72 Hours',
					'intro'        => get_post_meta( $post_id, 'leadgen_hero_intro', true ) ?: 'We build friction-free landing pages that turn plumbing, roofing, and HVAC clicks into booked jobs.',
					'button_label' => get_post_meta( $post_id, 'leadgen_hero_button', true ) ?: 'Book My Build Call',
					'cta_anchor'   => '#leadgen-form',
					'badges'       => $hero_badges,
					'testimonial'  => [
						'quote'  => '“We went from quiet phones to booked-out weeks. The process was painless.”',
						'author' => '— Local HVAC Owner',
					],
				]
			),
			'benefits' => wp_parse_args(
				$blocks['benefits'] ?? [],
				[
					'heading' => 'Why it works',
					'items'   => $benefits,
				]
			),
			'offer'    => wp_parse_args(
				$blocks['offer'] ?? [],
				[
					'title' => get_post_meta( $post_id, 'leadgen_offer_title', true ) ?: 'Launch Package',
					'copy'  => get_post_meta( $post_id, 'leadgen_offer_copy', true ) ?: 'One tailored landing page, call tracking, and automated follow-ups live within 3 business days.',
					'items' => $offer_items,
				]
			),
			'cta'      => wp_parse_args(
				$blocks['cta'] ?? [],
				[
					'title'        => get_post_meta( $post_id, 'leadgen_cta_title', true ) ?: 'Ready to fill tomorrow’s schedule?',
					'copy'         => get_post_meta( $post_id, 'leadgen_cta_copy', true ) ?: 'Tell us your top service and city—get a Loom walkthrough with next steps.',
					'button_label' => get_post_meta( $post_id, 'leadgen_cta_button', true ) ?: 'Send Me the Plan',
					'button_anchor' => '#leadgen-form',
				]
			),
			'form'     => wp_parse_args(
				$blocks['form'] ?? [],
				[
					'title'     => get_post_meta( $post_id, 'leadgen_form_title', true ) ?: 'Get Your LeadGen Plan',
					'copy'      => get_post_meta( $post_id, 'leadgen_form_copy', true ) ?: 'Share who you serve and the best way to reach you. We reply within one business day with the build outline and go-live date.',
					'note'      => get_post_meta( $post_id, 'leadgen_form_note', true ) ?: 'We’ll never share your info. This is only to deliver your plan and updates.',
					'shortcode' => get_post_meta( $post_id, 'leadgen_form_shortcode', true ) ?: '[contact-form-7 id="123" title="Lead Capture"]',
				]
			),
		];

		get_template_part( 'parts/leadgen/hero', null, $block_data['hero'] );
		get_template_part( 'parts/leadgen/benefits', null, $block_data['benefits'] );
		get_template_part( 'parts/leadgen/offer', null, $block_data['offer'] );
		get_template_part( 'parts/leadgen/cta', null, $block_data['cta'] );
		get_template_part( 'parts/leadgen/form', null, $block_data['form'] );
	endwhile;
	?>
</main>

<?php
get_footer();

<?php
get_header();

$theme_uri = get_template_directory_uri();
$page_content = '';
if ( have_posts() ) {
  while ( have_posts() ) {
    the_post();
    $page_content = trim( apply_filters( 'the_content', get_the_content() ) );
  }
}
?>
<main id="main" class="ct-main" data-testid="page-home">
<?php
$home_parts = [
  'hero',
  'context',
  'systems',
  'engagements',
  'proof-process',
  'final-cta',
];
foreach ( $home_parts as $home_part ) {
  require get_template_directory() . '/parts/home/' . $home_part . '.php';
}
?>
</main>
<?php get_footer(); ?>

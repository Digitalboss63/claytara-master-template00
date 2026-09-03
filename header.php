<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() . '/assets/dist/media-fixes.css?v=1.3.1' ); ?>">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="ct-skip" href="#main">Skip to content</a>
<header class="ct-header" role="banner">
  <div class="ct-container ct-header-inner">
    <div class="ct-logo">
      <?php if ( has_custom_logo() ) : ?>
        <?php the_custom_logo(); ?>
      <?php else : ?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="ct-site-title" aria-label="<?php bloginfo( 'name' ); ?> home"><?php bloginfo( 'name' ); ?></a>
      <?php endif; ?>
    </div>
    <nav class="ct-nav" aria-label="<?php esc_attr_e( 'Primary Navigation', 'claytara-master' ); ?>">
      <?php
      if ( has_nav_menu( 'primary' ) ) {
        wp_nav_menu( [
          'theme_location' => 'primary',
          'menu_id'        => 'primary-menu',
          'container'      => false,
          'menu_class'     => 'ct-menu',
          'fallback_cb'    => false,
        ] );
      } else {
        ?>
        <ul class="ct-menu" id="primary-menu">
          <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
          <li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Systems</a></li>
          <li><a href="<?php echo esc_url( home_url( '/process/' ) ); ?>">Process</a></li>
          <li><a href="<?php echo esc_url( home_url( '/work/' ) ); ?>">Work</a></li>
          <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About</a></li>
          <li><a href="<?php echo esc_url( home_url( '/resources/' ) ); ?>">Insights</a></li>
          <li><a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>">FAQ</a></li>
          <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a></li>
        </ul>
        <?php
      }
      ?>
    </nav>
    <div class="ct-header-actions">
      <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="ct-nav-cta ct-btn ct-btn-primary" data-testid="link-book-strategy-call-header">Book a Strategy Call</a>
      <button class="ct-burger" aria-label="<?php esc_attr_e( 'Toggle navigation menu', 'claytara-master' ); ?>" aria-expanded="false" aria-controls="ct-mobile-menu" data-testid="button-open-menu">
        <span class="ct-burger-bar"></span>
        <span class="ct-burger-bar"></span>
        <span class="ct-burger-bar"></span>
      </button>
    </div>
  </div>
  <nav id="ct-mobile-menu" class="ct-mobile-menu" aria-label="<?php esc_attr_e( 'Mobile Navigation', 'claytara-master' ); ?>" hidden>
    <div class="ct-container">
      <ul class="ct-mobile-links">
        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
        <li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Systems</a></li>
        <li><a href="<?php echo esc_url( home_url( '/process/' ) ); ?>">Process</a></li>
        <li><a href="<?php echo esc_url( home_url( '/work/' ) ); ?>">Work</a></li>
        <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About</a></li>
        <li><a href="<?php echo esc_url( home_url( '/resources/' ) ); ?>">Insights</a></li>
        <li><a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>">FAQ</a></li>
        <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a></li>
        <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="ct-mobile-cta" data-testid="link-book-strategy-call-mobile">Book a Strategy Call</a></li>
      </ul>
    </div>
  </nav>
</header>

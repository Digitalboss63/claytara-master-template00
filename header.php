<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="ct-header">
  <div class="ct-container ct-header-inner">

    <div class="ct-logo">
      <?php if (has_custom_logo()) : ?>
        <?php the_custom_logo(); ?>
      <?php else : ?>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="ct-site-title">
          <?php bloginfo('name'); ?>
        </a>
      <?php endif; ?>
    </div>

    <nav class="ct-nav" aria-label="Primary Navigation">
      <?php
      wp_nav_menu([
        'theme_location' => 'primary',
        'menu_id'        => 'primary-menu',
        'container'      => false,
        'menu_class'     => 'ct-menu',
        'fallback_cb'    => 'wp_page_menu',
      ]);
      ?>
    </nav>

  </div>
</header>
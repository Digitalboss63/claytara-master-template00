<?php

function claytara_theme_setup() {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('custom-logo');

  register_nav_menus([
    'primary' => 'Primary Menu',
  ]);
}
add_action('after_setup_theme', 'claytara_theme_setup');

function claytara_enqueue_assets() {
  wp_enqueue_style(
    'claytara-style',
    get_template_directory_uri() . '/assets/dist/app.css',
    [],
    file_exists(get_template_directory() . '/assets/dist/app.css')
      ? filemtime(get_template_directory() . '/assets/dist/app.css')
      : null
  );
}
add_action('wp_enqueue_scripts', 'claytara_enqueue_assets');
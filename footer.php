<footer class="ct-footer">
  <div class="ct-container">
    <p>&copy; <?php echo esc_html(date('Y')); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
  </div>
</footer>

<?php
$claytara_ada_embed = get_theme_mod('claytara_ada_embed', '');
if (!empty($claytara_ada_embed)) {
	echo $claytara_ada_embed;
}
?>

<?php wp_footer(); ?>
</body>
</html>
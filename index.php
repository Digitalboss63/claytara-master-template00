<?php get_header(); ?>

<main class="ct-page">
	<div class="ct-container ct-section">
		<h1>Blog</h1>

		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<article class="ct-post-card">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<div><?php the_excerpt(); ?></div>
				</article>
			<?php endwhile; ?>
		<?php else : ?>
			<p>No posts found.</p>
		<?php endif; ?>
	</div>
</main>

<?php get_footer(); ?>
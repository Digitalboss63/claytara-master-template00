<?php
/**
 * Default single post template
 */
get_header();
?>

<main class="ct-page">
  <section class="ct-section">
    <div class="ct-container">
      <?php while (have_posts()) : the_post(); ?>

        <header class="ct-section-head">
          <div>
            <div class="ct-kicker">INSIGHTS</div>
            <h1 class="ct-h2" style="font-size:36px;"><?php the_title(); ?></h1>
          </div>
          <p class="ct-muted">
            <?php echo esc_html(get_the_date('F j, Y')); ?>
          </p>
        </header>

        <?php if (has_post_thumbnail()) : ?>
          <div class="ct-card" style="padding:0; overflow:hidden; margin-bottom:18px;">
            <?php the_post_thumbnail('large', ['style' => 'width:100%;height:auto;display:block;']); ?>
          </div>
        <?php endif; ?>

        <article class="ct-card ct-prose">
          <?php the_content(); ?>
        </article>

        <div class="ct-section-foot" style="margin-top:24px;">
          <div class="ct-note">Want help implementing this on your site?</div>
          <a class="ct-btn ct-btn-primary" href="<?php echo esc_url(home_url('/contact/')); ?>">Start project</a>
        </div>

      <?php endwhile; ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>
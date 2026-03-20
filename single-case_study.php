<?php
/**
 * Single template: Case Study
 * URL: /work/{slug}/
 */
get_header();
?>

<main class="ct-page">
  <section class="ct-section">
    <div class="ct-container">

      <?php while (have_posts()) : the_post(); ?>

        <header class="ct-section-head">
          <div>
            <div class="ct-kicker">CASE STUDY</div>
            <h1 class="ct-h2" style="font-size:36px;"><?php the_title(); ?></h1>
          </div>
          <p class="ct-muted">
            <?php echo esc_html(get_the_excerpt() ?: 'Overview, approach, and outcome.'); ?>
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

        <section class="ct-cta">
          <div class="ct-container ct-cta-inner">
            <div>
              <div class="ct-kicker">NEXT</div>
              <h2 class="ct-h2">Want results like this?</h2>
              <p class="ct-muted">Send your URL and goal. We’ll reply with a simple plan.</p>
            </div>
            <div class="ct-cta-actions">
              <a class="ct-btn ct-btn-primary" href="<?php echo esc_url(home_url('/contact/')); ?>">Start project</a>
              <a class="ct-btn ct-btn-ghost" href="<?php echo esc_url(home_url('/work/')); ?>">Back to work</a>
            </div>
          </div>
        </section>

      <?php endwhile; ?>

    </div>
  </section>
</main>

<?php get_footer(); ?>
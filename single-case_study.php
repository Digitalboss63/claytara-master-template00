<?php
/**
 * Single template: Case Study
 * URL: /work/{slug}/
 */
get_header();
?>

<main class="ct-page" id="main" role="main">
  <section class="ct-section ct-section-alt" aria-label="Case Study">
    <div class="ct-container">

      <?php while ( have_posts() ) : the_post(); ?>

        <header class="ct-section-head">
          <div>
            <div class="ct-kicker">Case Study</div>
            <h1 class="ct-h2"><?php the_title(); ?></h1>
          </div>
          <p class="ct-muted">
            <?php echo esc_html( get_the_excerpt() ?: 'Overview, approach, and outcome.' ); ?>
          </p>
        </header>

        <?php if ( has_post_thumbnail() ) : ?>
          <div style="border-radius:14px;overflow:hidden;margin-bottom:24px;border:1px solid var(--ct-border);">
            <?php the_post_thumbnail( 'large', [ 'style' => 'width:100%;height:auto;display:block;', 'loading' => 'eager' ] ); ?>
          </div>
        <?php endif; ?>

        <article class="ct-card ct-prose">
          <?php the_content(); ?>
        </article>

        <div class="ct-section-foot" style="margin-top:24px;">
          <div class="ct-note">Want results like this for your business?</div>
          <a class="ct-btn ct-btn-primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
            Start a Project
          </a>
        </div>

      <?php endwhile; ?>

    </div>
  </section>

  <section class="ct-cta" aria-label="Project CTA">
    <div class="ct-container ct-cta-inner">
      <div>
        <div class="ct-kicker">Next</div>
        <h2 class="ct-h2">Want results like this?</h2>
        <p class="ct-muted">Send your service focus and goal. We&rsquo;ll reply with a build plan.</p>
      </div>
      <div class="ct-cta-actions">
        <a class="ct-btn ct-btn-primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Start a Project</a>
        <a class="ct-btn ct-btn-ghost" href="<?php echo esc_url( home_url( '/work/' ) ); ?>">Back to Work</a>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>

<?php
/**
 * Archive template: Case Studies
 * URL: /work/
 */
get_header();
?>

<main class="ct-page">
  <section class="ct-section ct-section-alt">
    <div class="ct-container">
      <header class="ct-section-head">
        <div>
          <div class="ct-kicker">WORK</div>
          <h1 class="ct-h2" style="font-size:36px;">Case studies</h1>
        </div>
        <p class="ct-muted">
          Real builds, clear outcomes, and conversion-focused structure.
        </p>
      </header>

      <div class="ct-work-grid">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <a class="ct-work" href="<?php the_permalink(); ?>">
            <div class="ct-work-thumb" style="overflow:hidden;">
              <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('large', ['style' => 'width:100%;height:100%;object-fit:cover;display:block;']); ?>
              <?php endif; ?>
            </div>
            <div class="ct-work-title"><?php the_title(); ?></div>
            <div class="ct-work-sub">
              <?php echo esc_html(get_the_excerpt() ?: 'Click to view details.'); ?>
            </div>
          </a>
        <?php endwhile; else: ?>
          <div class="ct-card">
            <h3 class="ct-h3">No case studies yet</h3>
            <p class="ct-muted">Add your first one: WP Admin → Case Studies → Add New.</p>
          </div>
        <?php endif; ?>
      </div>

      <div class="ct-section-foot" style="margin-top:30px;">
        <div class="ct-note">
          Want something like this for your business? Send your goal and timeline.
        </div>
        <a class="ct-btn ct-btn-primary" href="<?php echo esc_url(home_url('/contact/')); ?>">Start project</a>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
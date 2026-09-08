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

      <div class="ct-card" style="margin-bottom:30px;">
        <div class="ct-scale-grid">
          <div>
            <div class="ct-kicker" style="color:var(--ct-blue);">FEATURED PRODUCT</div>
            <h2 class="ct-h2" style="font-size:28px;">Find Home First</h2>
            <p class="ct-muted" style="margin-top:12px;">
              Claytara Digital's flagship B2B SaaS platform for Housing Acquisition &amp; Placement Operations.
              It brings market intelligence, property discovery, landlord outreach, referrals, resident placement,
              and next-action workflow into one operating system.
            </p>
            <div class="ct-pills" style="margin-top:18px;" aria-label="Find Home First product areas">
              <span class="ct-pill">B2B SaaS</span>
              <span class="ct-pill">Housing Operations</span>
              <span class="ct-pill">Market Intelligence</span>
              <span class="ct-pill">Workflow Automation</span>
            </div>
          </div>
          <div>
            <h3 class="ct-h3">Why it matters</h3>
            <p class="ct-muted">
              Find Home First is built around a problem we call the Housing Placement Gap: the fragmented process
              between identifying housing need and actually finding, securing, coordinating, and completing a placement.
            </p>
            <div class="ct-note" style="margin-top:16px;">
              <strong>Product promise:</strong> Find. Secure. Place. One project, one status, one clear next action.
            </div>
            <div style="margin-top:20px;">
              <a class="ct-btn ct-btn-primary" href="https://www.findhomefirst.com" target="_blank" rel="noopener noreferrer">Visit Find Home First</a>
            </div>
          </div>
        </div>
      </div>

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
            <h3 class="ct-h3">More case studies coming</h3>
            <p class="ct-muted">Claytara is documenting additional automation, software, and product work as the studio portfolio grows.</p>
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
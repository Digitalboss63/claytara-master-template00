<?php
/**
 * Template Name: Process
 */
get_header();
?>

<main class="ct-page">
  <section class="ct-section ct-section-alt">
    <div class="ct-container">
      <header class="ct-section-head">
        <div>
          <div class="ct-kicker">PROCESS</div>
          <h1 class="ct-h2" style="font-size:36px;">How we build (fast and clean).</h1>
        </div>
        <p class="ct-muted">
          A simple process that avoids endless revisions and gets you to launch-ready quickly.
        </p>
      </header>

      <div class="ct-grid-3">
        <div class="ct-card">
          <h3 class="ct-h3">1) Define</h3>
          <p class="ct-muted">
            We lock the offer, target customer, and the single action your site needs to drive.
          </p>
          <ul class="ct-list">
            <li>Goal + audience</li>
            <li>Page map</li>
            <li>CTA decision</li>
          </ul>
        </div>

        <div class="ct-card">
          <h3 class="ct-h3">2) Design</h3>
          <p class="ct-muted">
            We build the layout system and section flow so it reads clearly on mobile first.
          </p>
          <ul class="ct-list">
            <li>Hero + proof</li>
            <li>Services + benefits</li>
            <li>CTA placement</li>
          </ul>
        </div>

        <div class="ct-card">
          <h3 class="ct-h3">3) Ship</h3>
          <p class="ct-muted">
            We finalize performance, responsiveness, and foundational SEO structure, then launch.
          </p>
          <ul class="ct-list">
            <li>Speed baseline</li>
            <li>Polish + QA</li>
            <li>Launch-ready handoff</li>
          </ul>
        </div>
      </div>

      <div class="ct-section" style="padding:70px 0 0;">
        <div class="ct-card">
          <h2 class="ct-h2" style="font-size:26px;">What you’ll have at the end</h2>
          <div class="ct-divider"></div>

          <div class="ct-grid-3">
            <div>
              <h3 class="ct-h3">A clean homepage</h3>
              <p class="ct-muted">Modern layout, strong hierarchy, and clear CTAs.</p>
            </div>
            <div>
              <h3 class="ct-h3">Support pages</h3>
              <p class="ct-muted">Services, Work, About, Contact — structured and consistent.</p>
            </div>
            <div>
              <h3 class="ct-h3">Solid foundation</h3>
              <p class="ct-muted">Performance-minded CSS + SEO-friendly structure.</p>
            </div>
          </div>

        </div>
      </div>

    </div>
  </section>

  <section class="ct-cta">
    <div class="ct-container ct-cta-inner">
      <div>
        <div class="ct-kicker">START</div>
        <h2 class="ct-h2">Want us to run the process for you?</h2>
        <p class="ct-muted">Tell us the goal and deadline — we’ll map the fastest path.</p>
      </div>
      <div class="ct-cta-actions">
        <a class="ct-btn ct-btn-primary" href="<?php echo esc_url(home_url('/contact/')); ?>">Start project</a>
        <a class="ct-btn ct-btn-ghost" href="<?php echo esc_url(home_url('/services/')); ?>">View services</a>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
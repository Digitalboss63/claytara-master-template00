<?php
/**
 * Template Name: About
 */
get_header();
?>

<main class="ct-page">
  <section class="ct-section">
    <div class="ct-container">
      <header class="ct-section-head">
        <div>
          <div class="ct-kicker">ABOUT</div>
          <h1 class="ct-h2" style="font-size:36px;">Built for clarity, speed, and conversion.</h1>
        </div>
        <p class="ct-muted">
          Claytara Creatives helps service businesses and creators turn attention into action with clean design,
          performance-minded builds, and simple funnels.
        </p>
      </header>

      <div class="ct-grid-3">
        <div class="ct-card">
          <h3 class="ct-h3">What we believe</h3>
          <p class="ct-muted">
            A website isn’t a brochure — it’s a guided decision path. Every section should reduce confusion and
            make the next step obvious.
          </p>
        </div>
        <div class="ct-card">
          <h3 class="ct-h3">Who we help</h3>
          <p class="ct-muted">
            Local service businesses, creators, and small brands that need a modern site that looks premium and
            performs on mobile.
          </p>
        </div>
        <div class="ct-card">
          <h3 class="ct-h3">What we deliver</h3>
          <p class="ct-muted">
            Launch-ready pages with strong hierarchy, fast load times, and an SEO-friendly structure that holds up
            over time.
          </p>
        </div>
      </div>

      <div class="ct-section" style="padding:70px 0 0;">
        <div class="ct-card">
          <h2 class="ct-h2" style="font-size:26px;">Our approach</h2>
          <div class="ct-divider"></div>

          <div class="ct-grid-3">
            <div>
              <h3 class="ct-h3">Strategy-first</h3>
              <p class="ct-muted">We map the goal and the audience before touching layout.</p>
            </div>
            <div>
              <h3 class="ct-h3">Less friction</h3>
              <p class="ct-muted">Shorter paths, clearer CTAs, and fewer distractions.</p>
            </div>
            <div>
              <h3 class="ct-h3">Built to last</h3>
              <p class="ct-muted">Clean sections, reusable components, and easy edits later.</p>
            </div>
          </div>

          <div class="ct-divider"></div>

          <div class="ct-note">
            <strong>Bottom line:</strong> You should be able to explain what you do in 5 seconds — and the site should do the same.
          </div>
        </div>
      </div>

    </div>
  </section>

  <section class="ct-cta">
    <div class="ct-container ct-cta-inner">
      <div>
        <div class="ct-kicker">NEXT</div>
        <h2 class="ct-h2">Want a clean conversion rebuild?</h2>
        <p class="ct-muted">Send your URL and goal. We’ll reply with a simple plan and timeline.</p>
      </div>
      <div class="ct-cta-actions">
        <a class="ct-btn ct-btn-primary" href="<?php echo esc_url(home_url('/contact/')); ?>">Start project</a>
        <a class="ct-btn ct-btn-ghost" href="<?php echo esc_url(home_url('/work/')); ?>">See work</a>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
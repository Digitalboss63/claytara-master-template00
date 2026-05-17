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
          <h1 class="ct-h2" style="font-size:36px;">Black-owned. Infrastructure-focused. Built to last.</h1>
        </div>
        <p class="ct-muted">
          Claytara Digital is a Black-owned technology company building AI and automation infrastructure
          for growing businesses. We design the operational systems that help businesses streamline,
          scale, and compete - without adding unnecessary complexity.
        </p>
      </header>

      <div style="border-radius:14px;overflow:hidden;margin-bottom:40px;max-height:440px;">
        <img src="https://images.unsplash.com/photo-1573496799515-eebbb63814f2?auto=format&fit=crop&w=1200&q=80"
             alt="Diverse professional team in a strategy session"
             style="width:100%;height:440px;object-fit:cover;display:block;"
             loading="lazy">
      </div>

      <div class="ct-grid-3">
        <div class="ct-card">
          <h3 class="ct-h3">What we believe</h3>
          <p class="ct-muted">
            Technology should be an asset, not a burden. We build systems that work for your business -
            not systems that require a full-time engineer just to maintain.
          </p>
        </div>
        <div class="ct-card">
          <h3 class="ct-h3">Who we help</h3>
          <p class="ct-muted">
            Growing businesses at the inflection point - where the next phase of growth requires
            better systems, not just more effort. Operators, founders, and executive teams.
          </p>
        </div>
        <div class="ct-card">
          <h3 class="ct-h3">What we deliver</h3>
          <p class="ct-muted">
            Workflow automation, AI integration, custom SaaS, and business intelligence systems -
            built clean, documented, and handed off so your team owns it.
          </p>
        </div>
      </div>

      <div class="ct-section" style="padding:70px 0 0;">
        <div class="ct-card">
          <h2 class="ct-h2" style="font-size:26px;">How we approach every engagement</h2>
          <div class="ct-divider"></div>

          <div class="ct-grid-3">
            <div>
              <h3 class="ct-h3">Discovery first</h3>
              <p class="ct-muted">We map your workflows, constraints, and growth objective before writing a single line of code.</p>
            </div>
            <div>
              <h3 class="ct-h3">Minimal complexity</h3>
              <p class="ct-muted">We build only what solves the problem - no feature bloat, no unnecessary dependencies.</p>
            </div>
            <div>
              <h3 class="ct-h3">Built to hand off</h3>
              <p class="ct-muted">Clean architecture, full documentation, and training so your team can own and maintain what we build.</p>
            </div>
          </div>

          <div class="ct-divider"></div>

          <div class="ct-note">
            <strong>Our promise:</strong> Every system we build is designed to be understood, maintained, and grown by your team — not held hostage by a vendor relationship.
          </div>
        </div>
      </div>

    </div>
  </section>

  <section class="ct-cta">
    <div class="ct-container ct-cta-inner">
      <div>
        <div class="ct-kicker">NEXT</div>
        <h2 class="ct-h2">Ready to build your operational foundation?</h2>
        <p class="ct-muted">Tell us where your business is today and where it needs to go. We&rsquo;ll map a clear path.</p>
      </div>
      <div class="ct-cta-actions">
        <a class="ct-btn ct-btn-primary" href="<?php echo esc_url(home_url('/contact/')); ?>">Book a Strategy Call</a>
        <a class="ct-btn ct-btn-ghost" href="<?php echo esc_url(home_url('/work/')); ?>">View Our Work</a>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
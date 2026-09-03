<?php defined( 'ABSPATH' ) || exit; ?>
  <section class="ct-hero">
    <div class="ct-container">
      <div class="ct-hero-shell">
        <div class="ct-hero-grid">
          <div class="ct-stack-lg">
            <div>
              <div class="ct-kicker">Decision Intelligence Company</div>
              <h1 class="ct-h1" data-testid="text-home-hero-title">Turn Business Complexity Into Intelligent Software.</h1>
              <p class="ct-lead" data-testid="text-home-hero-description">Claytara Digital builds AI-powered systems, SaaS platforms, and guided workflows that help businesses make better decisions, move faster, and scale without chaos.</p>
            </div>
            <div class="ct-badge-row" aria-label="Core positioning labels">
              <span class="ct-badge">Guided Action Systems</span>
              <span class="ct-badge">AI Workflow Automation</span>
              <span class="ct-badge">SaaS Product Development</span>
              <span class="ct-badge">Operator Dashboards</span>
            </div>
            <div class="ct-cta-row">
              <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="ct-btn ct-btn-primary" data-testid="link-home-book-call">Book a Strategy Call</a>
              <a href="#systems" class="ct-btn ct-btn-secondary" data-testid="link-home-explore-systems">Explore Our Systems</a>
            </div>
            <p class="ct-hero-note">Less manual work. Better decisions. Faster execution.</p>
          </div>
          <div class="ct-hero-panel">
            <div class="ct-visual-frame ct-visual-frame-lg ct-visual-frame-interface">
              <img src="<?php echo esc_url( $theme_uri . '/assets/images/hero-intelligence-system.avif' ); ?>" alt="Abstract intelligence system interface showing connected decision workflows" loading="eager" fetchpriority="high" decoding="async" width="1100" height="600" data-testid="img-home-hero-visual">
            </div>
            <div class="ct-hero-metrics">
              <div class="ct-metric-card">
                <span class="ct-metric-value">01</span>
                <span class="ct-metric-label">Diagnose the drag</span>
              </div>
              <div class="ct-metric-card">
                <span class="ct-metric-value">02</span>
                <span class="ct-metric-label">Map the decision flow</span>
              </div>
              <div class="ct-metric-card">
                <span class="ct-metric-value">03</span>
                <span class="ct-metric-label">Build the guided system</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

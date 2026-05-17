<?php
/**
 * Homepage template — Claytara Digital
 * Positioning: AI & Automation Infrastructure Built For Growing Businesses
 */
get_header();
?>

<main class="ct-page" id="main" role="main">

  <!-- ═══ HERO ═══ -->
  <section class="ct-hero" aria-labelledby="ct-hero-headline">
    <div class="ct-container">
      <div class="ct-hero-grid">

        <div class="ct-hero-content">
          <div class="ct-kicker">Claytara Digital</div>
          <h1 class="ct-h1" id="ct-hero-headline">
            AI &amp; Automation Infrastructure Built For Growing Businesses
          </h1>
          <p class="ct-hero-copy">
            Claytara Digital designs scalable operational systems that help businesses streamline workflows,
            improve efficiency, and build a stronger foundation for long-term growth.
          </p>

          <div class="ct-pills" style="margin-bottom:28px;" aria-label="Core capabilities">
            <span class="ct-pill">Operational Systems</span>
            <span class="ct-pill">Workflow Automation</span>
            <span class="ct-pill">AI Integration</span>
            <span class="ct-pill">Custom SaaS</span>
            <span class="ct-pill">Business Intelligence</span>
          </div>

          <div class="ct-cta-row">
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="ct-btn ct-btn-primary">
              Book a Strategy Call
            </a>
            <a href="#solutions" class="ct-btn ct-btn-ghost">
              Explore Solutions
            </a>
          </div>
        </div>

        <div class="ct-hero-right" aria-hidden="true">
          <img src="https://images.unsplash.com/photo-1573496799515-eebbb63814f2?auto=format&fit=crop&w=900&q=80"
               alt=""
               width="900" height="600"
               loading="eager">
        </div>

      </div>
    </div>
  </section>

  <!-- ═══ OPERATIONAL CHALLENGES WE SOLVE ═══ -->
  <section id="solutions" class="ct-section ct-section-alt" aria-labelledby="ct-challenges-heading">
    <div class="ct-container">
      <div class="ct-section-head">
        <div>
          <div class="ct-kicker">Operational Challenges We Solve</div>
          <h2 class="ct-h2" id="ct-challenges-heading">Where Growing Businesses Get Stuck</h2>
        </div>
        <p class="ct-muted">
          Most businesses outgrow their tools before they outgrow their market.
          We build the infrastructure that keeps up with your momentum.
        </p>
      </div>

      <div class="ct-grid-3">
        <div class="ct-card">
          <h3 class="ct-h3">Disconnected Workflows</h3>
          <p class="ct-muted">Teams operating in silos, manual handoffs, and data scattered across tools that don't talk to each other.</p>
        </div>
        <div class="ct-card">
          <h3 class="ct-h3">No Operational Visibility</h3>
          <p class="ct-muted">Leadership making decisions without real-time data, clear reporting, or a unified view of business performance.</p>
        </div>
        <div class="ct-card">
          <h3 class="ct-h3">Scaling Without Systems</h3>
          <p class="ct-muted">Revenue growing but operations stretched thin — no automation backbone to absorb the growth without adding headcount.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ═══ WHAT WE BUILD ═══ -->
  <section class="ct-section" aria-labelledby="ct-builds-heading">
    <div class="ct-container">
      <div class="ct-section-head">
        <div>
          <div class="ct-kicker">What We Build</div>
          <h2 class="ct-h2" id="ct-builds-heading">Operational Infrastructure That Works</h2>
        </div>
        <p class="ct-muted">
          Not templates. Not generic software. Purpose-built systems designed around your workflows,
          your team, and your growth objectives.
        </p>
      </div>

      <div class="ct-services-grid">
        <article class="ct-service">
          <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=900&q=80"
               alt="Tech professionals collaborating on workflow automation systems" width="900" height="500" loading="lazy">
          <h3>Workflow Automation</h3>
          <p>End-to-end process automation that eliminates manual work and reduces operational friction.</p>
        </article>
        <article class="ct-service">
          <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&w=900&q=80"
               alt="Professional reviewing AI integration strategy" width="900" height="500" loading="lazy">
          <h3>AI Integration</h3>
          <p>Practical AI embedded into your existing systems — not experimental features, but production-ready tools.</p>
        </article>
        <article class="ct-service">
          <img src="https://images.unsplash.com/photo-1560472355-536de3962603?auto=format&fit=crop&w=900&q=80"
               alt="Business team reviewing custom SaaS product strategy" width="900" height="500" loading="lazy">
          <h3>Custom SaaS Products</h3>
          <p>Proprietary platforms and tools built specifically for your business model and customer workflows.</p>
        </article>
        <article class="ct-service">
          <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=900&q=80"
               alt="Analytics dashboard showing business intelligence metrics" width="900" height="500" loading="lazy">
          <h3>Business Intelligence</h3>
          <p>Dashboards and reporting systems that give leadership real-time visibility into what matters.</p>
        </article>
      </div>
    </div>
  </section>

  <!-- ═══ HOW WE WORK ═══ -->
  <section class="ct-section ct-section-alt" aria-labelledby="ct-process-heading">
    <div class="ct-container">
      <div class="ct-section-head">
        <div>
          <div class="ct-kicker">How We Work</div>
          <h2 class="ct-h2" id="ct-process-heading">A Structured Engagement Model</h2>
        </div>
        <p class="ct-muted">
          No ambiguity. No scope creep. A clear process from discovery to delivery.
        </p>
      </div>

      <div class="ct-grid-3">
        <div class="ct-card">
          <div class="ct-step-num" aria-hidden="true">01</div>
          <h3 class="ct-h3">Discovery &amp; Scoping</h3>
          <p class="ct-muted">We map your current workflows, identify constraints, and define the operational outcome you need to achieve.</p>
        </div>
        <div class="ct-card">
          <div class="ct-step-num" aria-hidden="true">02</div>
          <h3 class="ct-h3">Architecture &amp; Build</h3>
          <p class="ct-muted">We design the system architecture, build in sprints, and keep you informed with milestone reviews throughout.</p>
        </div>
        <div class="ct-card">
          <div class="ct-step-num" aria-hidden="true">03</div>
          <h3 class="ct-h3">Deploy &amp; Stabilize</h3>
          <p class="ct-muted">We go live, monitor for stability, and provide a structured handoff with documentation and training.</p>
        </div>
      </div>

      <div style="margin-top:32px;text-align:center;">
        <a href="<?php echo esc_url( home_url( '/process/' ) ); ?>" class="ct-btn ct-btn-ghost-dark">
          See the Full Process
        </a>
      </div>
    </div>
  </section>

  <!-- ═══ BUILT FOR BUSINESSES PREPARING TO SCALE ═══ -->
  <section class="ct-section" aria-labelledby="ct-scale-heading">
    <div class="ct-container">
      <div class="ct-card ct-scale-card">
        <div class="ct-scale-grid">
          <div>
            <div class="ct-kicker" style="color:var(--ct-blue);">Built For Businesses Preparing To Scale</div>
            <h2 class="ct-h2" id="ct-scale-heading">
              Infrastructure That Grows With You
            </h2>
            <p class="ct-muted" style="margin-top:12px;">
              We work with businesses at the inflection point — where the next phase of growth requires
              more than effort. It requires systems. We build the operational foundation that makes
              scaling sustainable, efficient, and defensible.
            </p>
            <ul class="ct-check-list" style="margin-top:20px;">
              <li>Systems designed for 3x growth, not just today's volume</li>
              <li>Built with clean architecture — maintainable, auditable, extendable</li>
              <li>Documented handoffs so your team owns what we build</li>
              <li>No vendor lock-in — your infrastructure, your control</li>
            </ul>
          </div>
          <div class="ct-scale-stats" aria-label="Key metrics">
            <div class="ct-stat">
              <span class="ct-stat-num">72hrs</span>
              <span class="ct-stat-label">Avg time to first working prototype</span>
            </div>
            <div class="ct-stat">
              <span class="ct-stat-num">100%</span>
              <span class="ct-stat-label">Custom builds — no templates, no filler</span>
            </div>
            <div class="ct-stat">
              <span class="ct-stat-num">7–14d</span>
              <span class="ct-stat-label">Typical sprint to launch-ready delivery</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ═══ FINAL CTA ═══ -->
  <section class="ct-cta" aria-labelledby="ct-final-cta-heading">
    <div class="ct-container ct-cta-inner">
      <div>
        <div class="ct-kicker">Ready to Build?</div>
        <h2 class="ct-h2" id="ct-final-cta-heading">
          Let&rsquo;s Talk About Your Operational Foundation
        </h2>
        <p class="ct-muted">
          Tell us where your business is today and where it needs to go.
          We&rsquo;ll map a clear path to get there.
        </p>
      </div>
      <div class="ct-cta-actions">
        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="ct-btn ct-btn-primary">
          Book a Strategy Call
        </a>
        <a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="ct-btn ct-btn-ghost">
          Explore Services
        </a>
      </div>
    </div>
  </section>

</main>

<?php get_footer(); ?>

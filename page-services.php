<?php
/**
 * Template Name: Services
 */
get_header();
?>

<main class="ct-page leadgen-services">
  <section class="ct-hero" style="background:linear-gradient(135deg, #0f2648 0%, #173a6a 100%);color:#fff;padding:80px 0;">
    <div class="ct-container">
      <div class="ct-kicker">SERVICES</div>
      <h1 class="ct-h2" style="font-size:44px;max-width:760px;">Done-for-you landing pages, funnels, and automations built for local service leads.</h1>
      <p class="ct-muted" style="color:rgba(255,255,255,.85);max-width:620px;">
        We plan, write, and ship the assets that keep your phones ringing—without adding more software noise to your week.
      </p>
      <div class="ct-cta-row">
        <a class="ct-btn ct-btn-primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Book a build call</a>
        <a class="ct-btn ct-btn-ghost" href="<?php echo esc_url( home_url( '/work/' ) ); ?>">See recent work</a>
      </div>
    </div>
  </section>

  <section class="ct-section">
    <div class="ct-container">
      <h2 class="ct-section-title" style="font-size:40px;">Core offers</h2>
      <div class="ct-grid">
        <article class="ct-card">
          <h3 class="ct-h3">LeadGen Landing Sprint</h3>
          <p class="ct-muted">One hero landing page tuned for plumbing, roofing, HVAC, or other local services—copy, layout, compliance, and follow-ups included.</p>
          <ul class="ct-list">
            <li>Research + positioning session</li>
            <li>Custom hero + proof blocks</li>
            <li>Tap-to-call + SMS prompts</li>
            <li>Launch-ready within 5–7 days</li>
          </ul>
        </article>
        <article class="ct-card">
          <h3 class="ct-h3">Website Conversion Rebuild</h3>
          <p class="ct-muted">Full multi-page sites (Home, Services, About, FAQ, Contact) rebuilt with Grandma Easy UX so visitors know exactly what to do.</p>
          <ul class="ct-list">
            <li>Architecture + copy rewrites</li>
            <li>Performance-focused build</li>
            <li>On-page SEO foundations</li>
            <li>Content handoff docs</li>
          </ul>
        </article>
        <article class="ct-card">
          <h3 class="ct-h3">Automation + Nurture</h3>
          <p class="ct-muted">Lead routing, follow-up texts, and simple CRM automations that stop hot prospects from going cold overnight.</p>
          <ul class="ct-list">
            <li>CRM/Zapier mapping</li>
            <li>Instant SMS + email replies</li>
            <li>Pipeline dashboards</li>
            <li>Quarterly tuning (optional)</li>
          </ul>
        </article>
      </div>
    </div>
  </section>

  <section class="ct-section ct-section-alt">
    <div class="ct-container">
      <div class="ct-section-head">
        <div>
          <div class="ct-kicker">PROCESS</div>
          <h2 class="ct-h2" style="font-size:34px;">How each build runs</h2>
        </div>
        <p class="ct-muted">Simple three-step sprints keep work moving without stealing your calendar.</p>
      </div>
      <div class="ct-grid-3">
        <div class="ct-card">
          <h3 class="ct-h3">1 / Strategy</h3>
          <p class="ct-muted">Clarify the service, service area, and urgent offer. Gather assets, testimonials, and access.</p>
        </div>
        <div class="ct-card">
          <h3 class="ct-h3">2 / Build</h3>
          <p class="ct-muted">Write copy, design sections, wire automations. Share a Loom walkthrough for review.</p>
        </div>
        <div class="ct-card">
          <h3 class="ct-h3">3 / Launch</h3>
          <p class="ct-muted">QA, performance checks, DNS/hosting coordination, and post-launch tweaks.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="ct-section">
    <div class="ct-container">
      <div class="ct-card">
        <h2 class="ct-h2" style="font-size:30px;">Every engagement includes</h2>
        <div class="ct-grid-3">
          <div>
            <h3 class="ct-h3">Messaging & copy</h3>
            <p class="ct-muted">Positioning, headlines, FAQs, and offers tuned for home-service buyers.</p>
          </div>
          <div>
            <h3 class="ct-h3">Technical setup</h3>
            <p class="ct-muted">Hosting/DNS guidance, site speed passes, analytics, and form notifications.</p>
          </div>
          <div>
            <h3 class="ct-h3">Documentation</h3>
            <p class="ct-muted">Editable templates, Loom handoff, and 14-day support buffer.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ct-cta">
    <div class="ct-container ct-cta-inner">
      <div>
        <div class="ct-kicker">NEXT</div>
        <h2 class="ct-h2">Need a lead-ready site?</h2>
        <p class="ct-muted">Send your URL, service focus, and goal. We’ll reply with a build plan.</p>
      </div>
      <div class="ct-cta-actions">
        <a class="ct-btn ct-btn-primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Start a project</a>
        <a class="ct-btn ct-btn-ghost" href="<?php echo esc_url( home_url( '/work/' ) ); ?>">View work</a>
      </div>
    </div>
  </section>
</main>

<?php get_footer();

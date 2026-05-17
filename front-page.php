<?php get_header(); ?>

<main class="ct-page">

  <!-- Hero -->
  <section class="ct-hero">
    <div class="ct-container">
      <div class="ct-hero-grid">
        <div>
          <div class="ct-kicker">Claytara Digital</div>
          <h1 class="ct-h1">Get a website that actually brings you customers</h1>
          <p class="ct-hero-copy">We design and build high-converting websites and funnels that turn visitors into real leads and paying clients.</p>

          <div class="ct-pills" style="margin-bottom:24px;">
            <span class="ct-pill">Built for real businesses</span>
            <span class="ct-pill">Focused on measurable results</span>
            <span class="ct-pill">No fluff &mdash; just performance</span>
          </div>

          <div class="ct-cta-row">
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="ct-btn ct-btn-primary">Get a Quote</a>
            <a href="#services" class="ct-btn ct-btn-ghost">View Services</a>
          </div>
        </div>

        <div class="ct-hero-right">
          <img src="https://images.unsplash.com/photo-1573497491765-cf4147cb7b99?auto=format&fit=crop&w=900&q=80"
               alt="Professional website design meeting"
               style="max-height:420px; object-fit:cover;">
        </div>
      </div>
    </div>
  </section>

  <!-- Services -->
  <section id="services" class="ct-section">
    <div class="ct-container">
      <div class="ct-kicker" style="color:var(--ct-blue);">What We Do</div>
      <h2 class="ct-section-title">Services</h2>

      <div class="ct-services-grid">
        <article class="ct-service">
          <img src="https://images.unsplash.com/photo-1516321165247-4aa89a48be28?auto=format&fit=crop&w=900&q=80"
               alt="Professionals reviewing website design on a laptop">
          <h3>Website Development</h3>
          <p>Custom-built websites designed to turn visitors into paying customers.</p>
        </article>

        <article class="ct-service">
          <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=900&q=80"
               alt="Team mapping out funnel strategy">
          <h3>Funnel Design</h3>
          <p>Strategic funnels that guide users step by step toward action.</p>
        </article>

        <article class="ct-service">
          <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&w=900&q=80"
               alt="Business professionals discussing lead generation strategy">
          <h3>Lead Generation</h3>
          <p>Systems that consistently attract and capture qualified leads.</p>
        </article>

        <article class="ct-service">
          <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=900&q=80"
               alt="Digital team collaborating on workflow automation">
          <h3>Automation</h3>
          <p>Automations that streamline your workflow and help your business scale.</p>
        </article>
      </div>
    </div>
  </section>

  <!-- Why section -->
  <section class="ct-section ct-section-alt">
    <div class="ct-container">
      <div class="ct-section-head">
        <div>
          <div class="ct-kicker">The Difference</div>
          <h2 class="ct-h2">Most websites don&rsquo;t bring in business. Yours should.</h2>
        </div>
        <p class="ct-muted">We build with one goal: more leads. Every section is intentional, every CTA is tested, and every page is built to perform.</p>
      </div>

      <div class="ct-grid-3">
        <div class="ct-card">
          <h3 class="ct-h3">Clear messaging</h3>
          <p class="ct-muted">Visitors know who you are, what you offer, and what to do next within 5 seconds.</p>
        </div>
        <div class="ct-card">
          <h3 class="ct-h3">Mobile-first builds</h3>
          <p class="ct-muted">Most of your leads are on a phone. We design for that reality, not as an afterthought.</p>
        </div>
        <div class="ct-card">
          <h3 class="ct-h3">Performance & speed</h3>
          <p class="ct-muted">Slow sites lose leads. We build lean and fast, with clean code that Google respects.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Social proof / process teaser -->
  <section class="ct-section">
    <div class="ct-container">
      <div class="ct-section-head">
        <div>
          <div class="ct-kicker">How It Works</div>
          <h2 class="ct-h2">Launch-ready in 7&ndash;14 days</h2>
        </div>
        <p class="ct-muted">A simple three-step process that keeps things moving without back-and-forth delays.</p>
      </div>

      <div class="ct-grid-3">
        <div class="ct-card">
          <h3 class="ct-h3">1. Strategy</h3>
          <p class="ct-muted">We clarify your offer, target customer, and the one action your site needs to drive.</p>
        </div>
        <div class="ct-card">
          <h3 class="ct-h3">2. Build</h3>
          <p class="ct-muted">We write the copy, design the layout, and wire up automations. You get a Loom walkthrough to review.</p>
        </div>
        <div class="ct-card">
          <h3 class="ct-h3">3. Launch</h3>
          <p class="ct-muted">QA, speed checks, DNS setup, and 14-day post-launch support. Done.</p>
        </div>
      </div>

      <div style="margin-top:32px; text-align:center;">
        <a href="<?php echo esc_url( home_url( '/process/' ) ); ?>" class="ct-btn ct-btn-ghost-dark">See the full process</a>
      </div>
    </div>
  </section>

  <!-- CTA Strip -->
  <section class="ct-cta">
    <div class="ct-container ct-cta-inner">
      <div>
        <div class="ct-kicker">Ready?</div>
        <h2 class="ct-h2">Let&rsquo;s build something that works.</h2>
        <p class="ct-muted">Send your URL and goal &mdash; we&rsquo;ll reply with a simple plan and timeline.</p>
      </div>
      <div class="ct-cta-actions">
        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="ct-btn ct-btn-primary">Get a Quote</a>
        <a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="ct-btn ct-btn-ghost">View Services</a>
      </div>
    </div>
  </section>

</main>

<?php get_footer(); ?>

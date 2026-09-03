<?php defined( 'ABSPATH' ) || exit; ?>
  <?php if ( $page_content ) : ?>
    <section class="ct-section ct-section-compact">
      <div class="ct-container">
        <div class="ct-editor-card ct-slider-zone">
          <?php echo apply_filters( 'the_content', $page_content ); ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <section class="ct-section ct-section-soft">
    <div class="ct-container">
      <div class="ct-trust-strip" data-testid="text-home-trust-strip">
        <span>Decision Intelligence</span>
        <span>Guided Action Systems</span>
        <span>SaaS Product Development</span>
        <span>AI Workflow Automation</span>
        <span>Complexity Reduction Platforms</span>
      </div>
    </div>
  </section>

  <section class="ct-section">
    <div class="ct-container">
      <div class="ct-section-head">
        <div>
          <div class="ct-kicker">The problem</div>
          <h2 class="ct-h2">Most businesses don&rsquo;t need more tools. They need smarter systems.</h2>
        </div>
        <p class="ct-muted">Businesses get buried under disconnected apps, manual processes, scattered knowledge, and inconsistent execution. Claytara turns those broken workflows into guided software systems that operators can actually use.</p>
      </div>
      <div class="ct-grid-3">
        <article class="ct-card">
          <div class="ct-icon">01</div>
          <h3 class="ct-h3">Disconnected operations</h3>
          <p class="ct-muted">Critical work lives across email, spreadsheets, CRMs, chat threads, and tribal knowledge. Execution slows because no one sees the whole system.</p>
        </article>
        <article class="ct-card">
          <div class="ct-icon">02</div>
          <h3 class="ct-h3">Manual decision bottlenecks</h3>
          <p class="ct-muted">High-value decisions depend on a few people carrying context in their heads. That creates delay, inconsistency, and fragile scaling.</p>
        </article>
        <article class="ct-card">
          <div class="ct-icon">03</div>
          <h3 class="ct-h3">Growth without control</h3>
          <p class="ct-muted">Revenue can rise while clarity falls. We build systems that protect quality, reduce drag, and create operator confidence as volume increases.</p>
        </article>
      </div>
    </div>
  </section>

<?php
/**
 * Template Name: FAQ
 */
get_header();
?>

<main class="ct-page">
  <section class="ct-section">
    <div class="ct-container">
      <header class="ct-section-head">
        <div>
          <div class="ct-kicker">FAQ</div>
          <h1 class="ct-h2" style="font-size:36px;">Answers before you even ask.</h1>
        </div>
        <p class="ct-muted">
          Clear expectations = faster builds. Here are the common questions.
        </p>
      </header>

      <div class="ct-card">
        <div class="ct-faq">

          <details class="ct-faq-item" open>
            <summary>How fast can you launch?</summary>
            <div class="ct-faq-body">
              Typical turnaround is <strong>7–14 days</strong> depending on scope, approvals, and content readiness.
            </div>
          </details>

          <details class="ct-faq-item">
            <summary>Do you write the copy?</summary>
            <div class="ct-faq-body">
              Yes — we can write or refine your messaging so it’s clear, conversion-focused, and easy to scan.
            </div>
          </details>

          <details class="ct-faq-item">
            <summary>Can you redesign an existing site?</summary>
            <div class="ct-faq-body">
              Yes. If the current site is slow, confusing, or outdated, we’ll rebuild the layout and tighten the CTA flow.
            </div>
          </details>

          <details class="ct-faq-item">
            <summary>What do you need from me?</summary>
            <div class="ct-faq-body">
              The goal, your offer, who you sell to, and any examples of sites you like. If you have a current URL, include it.
            </div>
          </details>

          <details class="ct-faq-item">
            <summary>Do you offer ongoing support?</summary>
            <div class="ct-faq-body">
              Yes — we can provide ongoing updates, landing pages, SEO improvements, and content support as needed.
            </div>
          </details>

        </div>
      </div>

    </div>
  </section>

  <section class="ct-cta">
    <div class="ct-container ct-cta-inner">
      <div>
        <div class="ct-kicker">READY</div>
        <h2 class="ct-h2">Still have a question?</h2>
        <p class="ct-muted">Send it. We’ll answer fast and keep it simple.</p>
      </div>
      <div class="ct-cta-actions">
        <a class="ct-btn ct-btn-primary" href="<?php echo esc_url(home_url('/contact/')); ?>">Contact</a>
        <a class="ct-btn ct-btn-ghost" href="<?php echo esc_url(home_url('/services/')); ?>">Services</a>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
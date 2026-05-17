<?php
/**
 * Template Name: Contact
 */
get_header();
?>

<main class="ct-page leadgen-contact">
  <section class="ct-hero" style="background:#111;color:#fff;padding:72px 0;">
    <div class="ct-container">
      <div class="ct-kicker">CONTACT</div>
      <h1 class="ct-h2" style="font-size:42px;max-width:720px;">Tell us your service, city, and goal—we’ll reply with a launch plan.</h1>
      <p class="ct-muted" style="color:rgba(255,255,255,.8);max-width:560px;">
        Typical response time: under one business day. Use the form or email/text if that’s faster.
      </p>
      <div class="ct-cta-row">
        <a class="ct-btn ct-btn-primary" href="#contact-form">Send project brief</a>
        <?php
        $phone_cta = get_theme_mod( 'claytara_contact_phone', '' );
        $phone_raw = preg_replace( '/[^0-9+]/', '', $phone_cta );
        if ( $phone_cta ) {
          echo '<a class="ct-btn ct-btn-ghost" href="tel:' . esc_attr( $phone_raw ) . '">Call ' . esc_html( $phone_cta ) . '</a>';
        }
        ?>
      </div>
    </div>
  </section>

  <section class="ct-section">
    <div class="ct-container">
      <div class="ct-grid-3">
        <div class="ct-card">
          <h3 class="ct-h3">Email</h3>
          <p class="ct-muted"><a href="mailto:<?php echo esc_attr( get_theme_mod( 'claytara_contact_email', 'hello@claytara.com' ) ); ?>"><?php echo esc_html( get_theme_mod( 'claytara_contact_email', 'hello@claytara.com' ) ); ?></a></p>
        </div>
        <div class="ct-card">
          <h3 class="ct-h3">Phone/Text</h3>
          <p class="ct-muted">
            <?php
            $phone     = get_theme_mod( 'claytara_contact_phone', '' );
            $phone_raw = preg_replace( '/[^0-9+]/', '', $phone );
            if ( $phone ) {
              echo '<a href="tel:' . esc_attr( $phone_raw ) . '">' . esc_html( $phone ) . '</a>';
            } else {
              echo 'Available on request.';
            }
            ?>
          </p>
        </div>
        <div class="ct-card">
          <h3 class="ct-h3">Hours</h3>
          <p class="ct-muted">Mon–Fri, 9a–6p ET<br>Emergency launch support on call.</p>
        </div>
      </div>
    </div>
  </section>

  <section id="contact-form" class="ct-section ct-section-alt">
    <div class="ct-container">
      <div class="ct-card" style="padding:40px;">
        <div class="ct-section-head">
          <div>
            <div class="ct-kicker">START</div>
            <h2 class="ct-h2" style="font-size:32px;">Project intake form</h2>
          </div>
          <p class="ct-muted">Share a few details so we can scope your launch sprint. Expect a Loom walkthrough + next steps.</p>
        </div>
        <div class="leadgen-contact__form">
          <?php
          $contact_form_shortcode = get_post_meta( get_the_ID(), 'contact_form_shortcode', true );
          $contact_form_shortcode = $contact_form_shortcode ?: '[contact-form-7 id="123" title="Contact"]';

          echo do_shortcode( $contact_form_shortcode ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
          ?>
        </div>
        <p class="ct-muted" style="margin-top:18px;">We never share your info. Everything you send is used only for the project discussion.</p>
      </div>
    </div>
  </section>

  <section class="ct-cta">
    <div class="ct-container ct-cta-inner">
      <div>
        <div class="ct-kicker">NEED IT FAST?</div>
        <h2 class="ct-h2">Launch in 7–14 days.</h2>
        <p class="ct-muted">If you’re on a deadline, mention it in the form and we’ll prioritize your slot.</p>
      </div>
      <div class="ct-cta-actions">
        <a class="ct-btn ct-btn-primary" href="#contact-form">Send details</a>
        <a class="ct-btn ct-btn-ghost" href="mailto:<?php echo esc_attr( get_theme_mod( 'claytara_contact_email', 'hello@claytara.com' ) ); ?>">Email us</a>
      </div>
    </div>
  </section>
</main>

<?php get_footer();

<?php
$claytara_email = get_theme_mod( 'claytara_contact_email', 'hello@claytaradigital.com' );
$claytara_phone = get_theme_mod( 'claytara_contact_phone', '' );
$claytara_phone_raw = preg_replace( '/[^0-9+]/', '', $claytara_phone );
?>
<footer class="ct-footer">
  <div class="ct-container">
    <div class="ct-footer-top">
      <div class="ct-footer-brand">
        <div class="ct-kicker">Claytara Digital</div>
        <h2 class="ct-footer-title">Decision intelligence systems for operators who need clarity, speed, and scale.</h2>
        <p class="ct-footer-copy">We turn operational drag into guided execution through SaaS products, AI workflow automation, internal tools, and complexity reduction platforms.</p>
      </div>
      <a class="ct-btn ct-btn-primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" data-testid="link-book-strategy-call-footer">Book a Strategy Call</a>
    </div>
    <div class="ct-footer-grid">
      <div>
        <h3 class="ct-footer-heading">What we build</h3>
        <ul class="ct-footer-list">
          <li>Guided action systems</li>
          <li>AI workflow automation</li>
          <li>Operator dashboards</li>
          <li>Productized software systems</li>
        </ul>
      </div>
      <div>
        <h3 class="ct-footer-heading">Explore</h3>
        <?php
        if ( has_nav_menu( 'footer' ) ) {
          wp_nav_menu( [
            'theme_location' => 'footer',
            'container'      => false,
            'menu_class'     => 'ct-footer-list',
            'fallback_cb'    => false,
          ] );
        } else {
          ?>
          <ul class="ct-footer-list">
            <li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Systems</a></li>
            <li><a href="<?php echo esc_url( home_url( '/process/' ) ); ?>">Process</a></li>
            <li><a href="<?php echo esc_url( home_url( '/work/' ) ); ?>">Work</a></li>
            <li><a href="<?php echo esc_url( home_url( '/resources/' ) ); ?>">Insights</a></li>
          </ul>
          <?php
        }
        ?>
      </div>
      <div>
        <h3 class="ct-footer-heading">Contact</h3>
        <ul class="ct-footer-list">
          <li><a href="mailto:<?php echo esc_attr( $claytara_email ); ?>" data-testid="link-email-footer"><?php echo esc_html( $claytara_email ); ?></a></li>
          <?php if ( $claytara_phone ) : ?>
            <li><a href="tel:<?php echo esc_attr( $claytara_phone_raw ); ?>" data-testid="link-phone-footer"><?php echo esc_html( $claytara_phone ); ?></a></li>
          <?php endif; ?>
          <li><span>Structured engagements</span></li>
          <li><span>Operator-first delivery</span></li>
        </ul>
      </div>
    </div>
    <div class="ct-footer-meta">
      <p data-testid="text-footer-copyright">&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</p>
      <p>Built for a premium WordPress theme experience with clean structure, strong CTAs, and flexible content areas.</p>
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>

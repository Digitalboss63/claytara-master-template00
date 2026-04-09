<?php
/*
Template Name: OpenClaw Landing
*/

get_header();
?>

<main id="primary" class="site-main">

    <!-- HERO -->
    <section class="oc-hero">
        <div class="ct-container">
            <h1>Dominate Your Local Market</h1>
            <p>AI-powered websites that generate leads on autopilot.</p>
            <a href="#oc-form" class="oc-btn">Get More Leads</a>
        </div>
    </section>

    <!-- BENEFITS -->
    <section class="oc-benefits">
        <div class="ct-container">
            <h2>Why OpenClaw Works</h2>

            <div class="oc-grid">
                <div class="oc-card">
                    <h3>More Calls</h3>
                    <p>Optimized layouts that convert visitors into real leads.</p>
                </div>

                <div class="oc-card">
                    <h3>Fast Setup</h3>
                    <p>Launch in days, not months.</p>
                </div>

                <div class="oc-card">
                    <h3>AI Powered</h3>
                    <p>Content, SEO, and structure handled automatically.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="oc-cta">
        <div class="ct-container">
            <h2>Ready to Grow?</h2>
            <a href="#oc-form" class="oc-btn">Start Now</a>
        </div>
    </section>

    <!-- FORM -->
    <section id="oc-form" class="oc-form">
        <div class="ct-container">

            <h2>Get Your Free Lead Plan</h2>

            <?php
            $form_shortcode = get_post_meta(get_the_ID(), 'openclaw_form_shortcode', true);

            if ($form_shortcode) {
                echo do_shortcode($form_shortcode);
            } else {
                echo do_shortcode('[contact-form-7 id="123" title="OpenClaw Form"]');
            }
            ?>

        </div>
    </section>

</main>

<?php
get_footer();
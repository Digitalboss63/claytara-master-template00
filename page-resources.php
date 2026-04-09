<?php
/**
 * Template Name: Resources
 */
get_header();

$paged = max(1, get_query_var('paged'));
$q = new WP_Query([
  'post_type'      => 'post',
  'post_status'    => 'publish',
  'posts_per_page' => 9,
  'paged'          => $paged,
]);
?>

<main class="ct-page">
  <section class="ct-section ct-section-alt">
    <div class="ct-container">
      <header class="ct-section-head">
        <div>
          <div class="ct-kicker">RESOURCES</div>
          <h1 class="ct-h2" style="font-size:36px;">Insights that help you convert</h1>
        </div>
        <p class="ct-muted">
          Practical breakdowns on websites, funnels, and UX that drives action.
        </p>
      </header>

      <div class="ct-grid-3">
        <?php if ($q->have_posts()) : while ($q->have_posts()) : $q->the_post(); ?>
          <a class="ct-card ct-post-card" href="<?php the_permalink(); ?>" style="text-decoration:none;">
            <?php if (has_post_thumbnail()) : ?>
              <div class="ct-post-thumb">
                <?php the_post_thumbnail('large', ['style' => 'width:100%;height:100%;object-fit:cover;display:block;']); ?>
              </div>
            <?php endif; ?>
            <h3 class="ct-h3" style="margin-top:14px;"><?php the_title(); ?></h3>
            <p class="ct-muted" style="margin:0;">
              <?php echo esc_html(get_the_excerpt() ?: 'Read more.'); ?>
            </p>
          </a>
        <?php endwhile; else: ?>
          <div class="ct-card">
            <h3 class="ct-h3">No posts yet</h3>
            <p class="ct-muted">Add posts in WP Admin → Posts → Add New.</p>
          </div>
        <?php endif; wp_reset_postdata(); ?>
      </div>

      <?php if ($q->max_num_pages > 1) : ?>
        <div class="ct-section-foot" style="margin-top:24px;">
          <div class="ct-note">Page <?php echo (int)$paged; ?> of <?php echo (int)$q->max_num_pages; ?></div>
          <div style="display:flex; gap:10px;">
            <?php
              echo get_previous_posts_link('← Newer', $q->max_num_pages) ? '<span class="ct-btn ct-btn-soft">' . get_previous_posts_link('← Newer', $q->max_num_pages) . '</span>' : '';
              echo get_next_posts_link('Older →', $q->max_num_pages) ? '<span class="ct-btn ct-btn-soft">' . get_next_posts_link('Older →', $q->max_num_pages) . '</span>' : '';
            ?>
          </div>
        </div>
      <?php endif; ?>

    </div>
  </section>
</main>

<?php get_footer(); ?>
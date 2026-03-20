<?php if (!defined('ABSPATH')) exit; ?>

<header class="sticky top-0 z-50 w-full border-b border-border/40 bg-background/80 backdrop-blur-md">
  <div class="container mx-auto px-6 h-16 flex items-center justify-between">
    <div class="flex items-center gap-2 font-semibold text-lg tracking-tight">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-flex items-center">
        <?php if (has_custom_logo()): ?>
          <span class="[&_.custom-logo]:h-10 md:[&_.custom-logo]:h-12 lg:[&_.custom-logo]:h-14 [&_.custom-logo]:w-auto [&_.custom-logo]:object-contain">
            <?php the_custom_logo(); ?>
          </span>
        <?php else: ?>
          <span class="text-foreground font-semibold">Claytara Digital</span>
        <?php endif; ?>
      </a>
    </div>

    <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-muted-foreground">
      <a href="#services" class="hover:text-foreground transition-colors">Services</a>
      <a href="#roi" class="hover:text-foreground transition-colors">ROI Calculator</a>
      <a href="#process" class="hover:text-foreground transition-colors">Process</a>
      <a href="#clients" class="hover:text-foreground transition-colors">Clients</a>
      <a href="<?php echo esc_url(home_url('/funnel')); ?>" class="hover:text-foreground transition-colors">Funnel</a>
    </nav>

    <div class="flex items-center gap-4">
      <a href="<?php echo esc_url(home_url('/funnel')); ?>"
         class="hidden sm:inline-flex rounded-full px-6 h-9 items-center justify-center bg-primary text-primary-foreground shadow-sm hover:shadow-md transition-shadow">
        Book Strategy Call
      </a>
    </div>
  </div>
</header>
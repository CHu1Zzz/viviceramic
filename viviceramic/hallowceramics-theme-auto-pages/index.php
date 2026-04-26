<?php
/** Default fallback template. Assign specific page templates for coded pages. */
get_header();
?>
<main class="page-main">
  <h1><?php esc_html_e('Page not configured', 'hallowceramics-auto-pages-no-router'); ?></h1>
  <p><?php esc_html_e('Create a WordPress page and assign one of the HallowCeramics templates, or set a static homepage.', 'hallowceramics-auto-pages-no-router'); ?></p>
</main>
<?php get_footer(); ?>

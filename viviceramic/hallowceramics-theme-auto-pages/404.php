<?php
/** 404 template. */
global $hallow_body_class, $hallow_body_attrs;
$hallow_body_class = 'hallow-blog-page hallow-404-page';
$hallow_body_attrs = '';
get_header();
?>

<main class="blog-page">
  <section class="blog-empty blog-empty--full">
    <p class="blog-kicker">Lost in the patch</p>
    <h1>This page slipped back into the fog.</h1>
    <p>Return to the shop, the journal, or the craft story to keep exploring HallowCeramics.</p>
    <div class="blog-hero-actions">
      <a class="btn-primary" href="<?php echo esc_url(home_url('/shop/')); ?>">Shop ceramics</a>
      <a class="btn-ghost" href="<?php echo esc_url(home_url('/resources/blog/')); ?>">Read the journal</a>
    </div>
  </section>
</main>

<?php get_footer(); ?>

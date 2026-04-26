<?php
/*
Template Name: Resources Page
*/
global $hallow_body_class, $hallow_body_attrs;
$hallow_body_class = 'hallow-resources-page';
$hallow_body_attrs = '';
get_header();
?>

<main class="page-main">
      <h1>Resources</h1>
      <p>Care guides, shipping FAQs, and wholesale info can be published here.</p>
      <p><a class="product-link" href="<?php echo esc_url( home_url( '/' ) ); ?>">← Back to home</a></p>
    </main>

<?php get_footer(); ?>

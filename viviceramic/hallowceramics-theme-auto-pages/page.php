<?php
/**
 * Default page template — HallowCeramics.
 * Used for WordPress pages without a specific template assignment.
 * Critical for WooCommerce pages (cart, checkout, my-account) which
 * are regular WP pages that rely on shortcodes inside the_content().
 */

defined('ABSPATH') || exit;

global $hallow_body_class, $hallow_body_attrs;

// Detect WooCommerce page context for body class
if (function_exists('is_cart') && is_cart()) {
    $hallow_body_class = 'woocommerce-cart hallow-cart';
} elseif (function_exists('is_checkout') && is_checkout()) {
    $hallow_body_class = 'woocommerce-checkout';
} elseif (function_exists('is_account_page') && is_account_page()) {
    $hallow_body_class = 'woocommerce-account';
} else {
    $hallow_body_class = 'hallow-page';
}
$hallow_body_attrs = '';

get_header();
?>

<main class="page-main">
  <?php while (have_posts()) : the_post(); ?>
    <article <?php post_class(); ?>>
      <?php the_content(); ?>
    </article>
  <?php endwhile; ?>
</main>

<?php get_footer(); ?>

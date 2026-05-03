<?php
/**
 * WooCommerce wrapper template — HallowCeramics.
 * Wraps all WC content (cart, checkout, account, shop) in the theme shell.
 */

defined('ABSPATH') || exit;

global $hallow_body_class;

if (is_cart()) {
    $hallow_body_class = 'woocommerce-cart hallow-cart';
} elseif (is_checkout()) {
    $hallow_body_class = 'woocommerce-checkout hallow-checkout';
} elseif (is_account_page()) {
    $hallow_body_class = 'woocommerce-account hallow-account';
} elseif (is_shop() || is_product_category() || is_product_tag()) {
    $hallow_body_class = 'woocommerce-shop hallow-shop';
} else {
    $hallow_body_class = 'woocommerce hallow-woocommerce';
}

get_header();
?>

<main>
<?php woocommerce_content(); ?>
</main>

<?php
get_footer();

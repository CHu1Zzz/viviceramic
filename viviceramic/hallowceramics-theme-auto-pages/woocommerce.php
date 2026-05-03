<?php
/**
 * WooCommerce wrapper template — HallowCeramics.
 * Provides header/footer for all WooCommerce pages.
 * Sub-templates (cart, single-product, etc.) render content only.
 */

defined('ABSPATH') || exit;

global $hallow_body_class;

// Detect WooCommerce page context for body class
if ( is_cart() ) {
	$hallow_body_class = 'woocommerce-cart hallow-cart';
} elseif ( is_product() ) {
	$hallow_body_class = 'woocommerce single-product hallow-single-product';
} elseif ( is_shop() || is_product_category() || is_product_tag() ) {
	$hallow_body_class = 'woocommerce-shop';
} elseif ( is_checkout() ) {
	$hallow_body_class = 'woocommerce-checkout';
} elseif ( is_account_page() ) {
	$hallow_body_class = 'woocommerce-account';
} else {
	$hallow_body_class = 'woocommerce';
}

get_header();

woocommerce_content();

get_footer();

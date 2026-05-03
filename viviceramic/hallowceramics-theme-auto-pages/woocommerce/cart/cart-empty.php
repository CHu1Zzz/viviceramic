<?php
/**
 * WooCommerce Empty Cart template override — HallowCeramics.
 * Ghost-with-empty-bag illustration, CTAs, and category navigation.
 * This file is loaded by WooCommerce when the cart is empty,
 * INSTEAD of cart/cart.php.
 */

defined('ABSPATH') || exit;

$shop_url     = get_permalink( wc_get_page_id( 'shop' ) ) ?: home_url( '/shop/' );
$pumpkins_url = home_url( '/pumpkins/' );
$others_url   = get_term_link( 'others', 'product_cat' );
if ( is_wp_error( $others_url ) ) {
    $others_url = home_url( '/product-category/others/' );
}
?>

<div class="cart-content">
  <!-- Empty Cart Hero -->
  <div class="empty-cart-hero">
    <div class="empty-cart-inner">

      <!-- Ghost with Empty Bag — CSS Illustration -->
      <div class="empty-cart-illustration">
        <!-- Sparkle stars -->
        <span class="sparkle"><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2l2.4 7.2L22 12l-7.6 2.8L12 22l-2.4-7.2L2 12l7.6-2.8z"/></svg></span>
        <span class="sparkle"><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2l2.4 7.2L22 12l-7.6 2.8L12 22l-2.4-7.2L2 12l7.6-2.8z"/></svg></span>
        <span class="sparkle"><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2l2.4 7.2L22 12l-7.6 2.8L12 22l-2.4-7.2L2 12l7.6-2.8z"/></svg></span>
        <span class="sparkle"><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2l2.4 7.2L22 12l-7.6 2.8L12 22l-2.4-7.2L2 12l7.6-2.8z"/></svg></span>
        <span class="sparkle"><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2l2.4 7.2L22 12l-7.6 2.8L12 22l-2.4-7.2L2 12l7.6-2.8z"/></svg></span>
        <span class="sparkle"><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2l2.4 7.2L22 12l-7.6 2.8L12 22l-2.4-7.2L2 12l7.6-2.8z"/></svg></span>

        <!-- Ghost figure -->
        <div class="ghost">
          <div class="ghost-body">
            <div class="ghost-eyes">
              <div class="ghost-eye"></div>
              <div class="ghost-eye"></div>
            </div>
            <div class="ghost-mouth"></div>
            <div class="ghost-blush left"></div>
            <div class="ghost-blush right"></div>
            <div class="ghost-arm"></div>
            <div class="ghost-wave"></div>
          </div>
        </div>

        <!-- Shopping bag -->
        <div class="ghost-bag">
          <div class="bag-handle left"></div>
          <div class="bag-handle right"></div>
          <div class="bag-body">
            <div class="bag-empty-text">empty</div>
          </div>
        </div>
      </div>

      <p class="empty-cart-eyebrow"><?php esc_html_e( 'Your Cart', 'hallowceramics-auto-pages-no-router' ); ?></p>
      <h1 class="empty-cart-title"><?php esc_html_e( 'Boo — your cart', 'hallowceramics-auto-pages-no-router' ); ?><br/><?php esc_html_e( 'is ghosted.', 'hallowceramics-auto-pages-no-router' ); ?></h1>
      <p class="empty-cart-desc"><?php esc_html_e( 'No treats in your bag yet. Browse our hand-fired ceramics and fill it with something hauntingly beautiful.', 'hallowceramics-auto-pages-no-router' ); ?></p>

      <div class="empty-cart-cta-row">
        <a href="<?php echo esc_url( $shop_url ); ?>" class="btn-primary">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px" aria-hidden="true">
            <circle cx="9" cy="20" r="1.5" fill="currentColor" stroke="none"/>
            <circle cx="18" cy="20" r="1.5" fill="currentColor" stroke="none"/>
            <path d="M6 8h15l-1.5 9H7.5L6 8zm0 0L5 3H2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <?php esc_html_e( 'Shop the Collection', 'hallowceramics-auto-pages-no-router' ); ?>
        </a>
        <a href="javascript:history.back()" class="btn-ghost">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px" aria-hidden="true">
            <path d="M19 12H5m7-7-7 7 7 7" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <?php esc_html_e( 'Continue Browsing', 'hallowceramics-auto-pages-no-router' ); ?>
        </a>
      </div>
    </div>
  </div>

  <!-- Featured Categories -->
  <section class="empty-cart-categories">
    <p class="categories-eyebrow"><?php esc_html_e( 'Where to start', 'hallowceramics-auto-pages-no-router' ); ?></p>
    <div class="categories-grid">

      <a href="<?php echo esc_url( $pumpkins_url ); ?>" class="category-card">
        <div class="category-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
            <circle cx="12" cy="12" r="9"/>
            <path d="M12 3c1.5 3 2 6 0 9s-3.5 6-1 9"/>
          </svg>
        </div>
        <h3 class="category-title"><?php esc_html_e( 'Pumpkins', 'hallowceramics-auto-pages-no-router' ); ?></h3>
        <p class="category-desc"><?php esc_html_e( 'Hyper-real ceramic pumpkins — guests tap them to check if they\'re real.', 'hallowceramics-auto-pages-no-router' ); ?></p>
        <span class="category-link">
          <?php esc_html_e( 'Browse pumpkins', 'hallowceramics-auto-pages-no-router' ); ?>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14m-7-7 7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </span>
      </a>

      <a href="<?php echo esc_url( $others_url ); ?>" class="category-card">
        <div class="category-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
            <path d="M12 2v6l3 3H9l3-3V2z"/>
            <path d="M5 16c2 3 5 5 7 5s5-2 7-5"/>
          </svg>
        </div>
        <h3 class="category-title"><?php esc_html_e( 'Others', 'hallowceramics-auto-pages-no-router' ); ?></h3>
        <p class="category-desc"><?php esc_html_e( 'Candle holders, vases, and beyond — the rest of our hand-fired collection.', 'hallowceramics-auto-pages-no-router' ); ?></p>
        <span class="category-link">
          <?php esc_html_e( 'Browse others', 'hallowceramics-auto-pages-no-router' ); ?>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14m-7-7 7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </span>
      </a>

      <a href="<?php echo esc_url( $shop_url ); ?>" class="category-card">
        <div class="category-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
            <rect x="3" y="8" width="18" height="12" rx="2"/>
            <path d="M8 8V5a4 4 0 0 1 8 0v3"/>
          </svg>
        </div>
        <h3 class="category-title"><?php esc_html_e( 'Shop All', 'hallowceramics-auto-pages-no-router' ); ?></h3>
        <p class="category-desc"><?php esc_html_e( 'See everything in one place — pumpkins, holders, and every piece in between.', 'hallowceramics-auto-pages-no-router' ); ?></p>
        <span class="category-link">
          <?php esc_html_e( 'Browse all products', 'hallowceramics-auto-pages-no-router' ); ?>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14m-7-7 7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </span>
      </a>

    </div>
  </section>
</div>

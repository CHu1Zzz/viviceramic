<?php
/**
 * WooCommerce Cart template override — HallowCeramics.
 * Dark-theme cart with cross-sells, free-shipping hint, cart badge.
 */

defined('ABSPATH') || exit;

$cart           = WC()->cart;
$cart_items     = $cart->get_cart();
$item_count     = $cart->get_cart_contents_count();
$subtotal_raw   = $cart->get_cart_contents_total();
$shipping_raw   = (float) $cart->get_shipping_total();
$total_raw      = $cart->get_total( 'raw' );
$cross_sell_ids = $cart->get_cross_sells();
$free_threshold = apply_filters( 'hallow_free_shipping_threshold', 120 );

// Build products array from cross-sell IDs
$cross_sell_products = [];
if ( ! empty( $cross_sell_ids ) ) {
    $cross_sell_products = wc_get_products( [
        'include' => $cross_sell_ids,
        'limit'   => 4,
    ] );
}

?>

<div class="cart-content">
  <div class="cart-page">
    <div class="cart-page-head">
      <h1><?php esc_html_e( 'Your Cart', 'hallowceramics-auto-pages-no-router' ); ?></h1>
      <p class="cart-item-count" id="cartItemCount"><?php echo esc_html( sprintf( _n( '%s item', '%s items', $item_count, 'hallowceramics-auto-pages-no-router' ), number_format_i18n( $item_count ) ) ); ?></p>
    </div>

    <?php if ( ! empty( $cart_items ) ) : ?>
      <form class="cart-layout" id="cartLayout" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
        <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>

        <!-- LEFT: Cart items -->
        <div class="cart-items" id="cartItems">
          <?php foreach ( $cart_items as $cart_item_key => $cart_item ) :
            $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
            $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
            $product_name = $_product->get_name();
            $thumbnail     = $_product->get_image( 'woocommerce_thumbnail', [ 'loading' => 'lazy' ] );
            $product_price = $cart->get_product_price( $_product );
            $line_total    = $cart->get_product_subtotal( $_product, $cart_item['quantity'] );
            $remove_url    = wc_get_cart_remove_url( $cart_item_key );
            $max_qty       = $_product->get_max_purchase_quantity() > 0 ? $_product->get_max_purchase_quantity() : 99;
            $permalink     = $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '';

            // Build variant description from selected attributes
            $variant_parts = [];
            if ( ! empty( $cart_item['variation_id'] ) ) {
                $variation = wc_get_product( $cart_item['variation_id'] );
                if ( $variation ) {
                    foreach ( $variation->get_variation_attributes() as $attr_name => $attr_value ) {
                        if ( ! empty( $attr_value ) ) {
                            $variant_parts[] = wc_attribute_label( str_replace( 'attribute_', '', $attr_name ) ) . ': ' . $attr_value;
                        }
                    }
                }
            }
            $variant_str = ! empty( $variant_parts ) ? implode( ' · ', $variant_parts ) : '';

            // Material attribute as fallback variant
            if ( empty( $variant_str ) ) {
                $material = $_product->get_attribute( 'material' );
                if ( ! empty( $material ) ) {
                    $variant_str = $material;
                }
            }
          ?>
          <div class="cart-item" data-cart-key="<?php echo esc_attr( $cart_item_key ); ?>" data-price="<?php echo esc_attr( $_product->get_price() ); ?>">
            <?php if ( $permalink ) : ?>
              <a href="<?php echo esc_url( $permalink ); ?>" class="cart-item-img" aria-label="<?php echo esc_attr( $product_name ); ?>">
            <?php else : ?>
              <span class="cart-item-img" aria-hidden="true">
            <?php endif; ?>
              <?php echo $thumbnail; ?>
            <?php if ( $permalink ) : ?>
              </a>
            <?php else : ?>
              </span>
            <?php endif; ?>

            <div class="cart-item-info">
              <?php if ( $permalink ) : ?>
                <a href="<?php echo esc_url( $permalink ); ?>" class="cart-item-name"><?php echo esc_html( $product_name ); ?></a>
              <?php else : ?>
                <span class="cart-item-name"><?php echo esc_html( $product_name ); ?></span>
              <?php endif; ?>
              <?php if ( ! empty( $variant_str ) ) : ?>
                <span class="cart-item-variant"><?php echo esc_html( $variant_str ); ?></span>
              <?php endif; ?>
              <span class="cart-item-price"><?php echo $product_price; ?></span>
            </div>

            <div class="cart-item-actions">
              <span class="cart-item-line-total"><?php echo $line_total; ?></span>
              <div class="cart-qty-row">
                <button type="button" class="cart-qty-btn" data-delta="-1" aria-label="Decrease">−</button>
                <input class="cart-qty-input" type="number"
                       name="cart[<?php echo esc_attr( $cart_item_key ); ?>][qty]"
                       value="<?php echo esc_attr( $cart_item['quantity'] ); ?>"
                       min="1" max="<?php echo esc_attr( $max_qty ); ?>" />
                <button type="button" class="cart-qty-btn" data-delta="1" aria-label="Increase">+</button>
              </div>
              <a href="<?php echo esc_url( $remove_url ); ?>" class="cart-remove-btn" aria-label="<?php echo esc_attr( sprintf( __( 'Remove %s', 'hallowceramics-auto-pages-no-router' ), $product_name ) ); ?>">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                  <polyline points="3,6 5,6 21,6"/>
                  <path d="M19,6l-1,14a2,2,0 0,1-2,2H8a2,2,0 0,1-2-2L5,6"/>
                  <line x1="10" y1="11" x2="10" y2="17"/>
                  <line x1="14" y1="11" x2="14" y2="17"/>
                </svg>
                <?php esc_html_e( 'Remove', 'hallowceramics-auto-pages-no-router' ); ?>
              </a>
            </div>
          </div>
          <?php endforeach; ?>
        </div>

        <!-- RIGHT: Order summary -->
        <aside class="cart-summary" id="cartSummary">
          <h2><?php esc_html_e( 'Order Summary', 'hallowceramics-auto-pages-no-router' ); ?></h2>
          <div class="summary-row">
            <span><?php esc_html_e( 'Subtotal', 'hallowceramics-auto-pages-no-router' ); ?></span>
            <span class="summary-value" id="summarySubtotal"><?php echo wc_price( $subtotal_raw ); ?></span>
          </div>
          <div class="summary-row">
            <span><?php esc_html_e( 'Shipping', 'hallowceramics-auto-pages-no-router' ); ?></span>
            <span class="summary-value" id="summaryShipping"><?php echo $shipping_raw > 0 ? wc_price( $shipping_raw ) : esc_html__( 'FREE', 'hallowceramics-auto-pages-no-router' ); ?></span>
          </div>
          <p class="shipping-hint" id="freeShippingHint">
            <?php if ( $subtotal_raw >= $free_threshold ) : ?>
              <span class="free-highlight"><?php esc_html_e( 'Free shipping unlocked!', 'hallowceramics-auto-pages-no-router' ); ?></span>
            <?php else : ?>
              <?php
              $needed = $free_threshold - $subtotal_raw;
              printf(
                  /* translators: %s: amount needed for free shipping */
                  esc_html__( 'Add %s more for free shipping', 'hallowceramics-auto-pages-no-router' ),
                  '<span class="free-highlight">' . wc_price( $needed ) . '</span>'
              );
              ?>
            <?php endif; ?>
          </p>
          <div class="summary-row total">
            <span><?php esc_html_e( 'Total', 'hallowceramics-auto-pages-no-router' ); ?></span>
            <span class="summary-value" id="summaryTotal"><?php echo wc_price( $total_raw ); ?></span>
          </div>

          <button type="submit" class="checkout-btn" name="checkout" formaction="<?php echo esc_url( wc_get_checkout_url() ); ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
              <rect x="1" y="3" width="15" height="13" rx="1"/>
              <polyline points="16 8 20 8 23 11 23 16 16 16"/>
              <circle cx="5.5" cy="18.5" r="1.5"/>
              <circle cx="18.5" cy="18.5" r="1.5"/>
            </svg>
            <?php esc_html_e( 'Proceed to Checkout', 'hallowceramics-auto-pages-no-router' ); ?>
          </button>

          <button type="submit" class="continue-shopping" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'hallowceramics-auto-pages-no-router' ); ?>" style="display:none;" aria-hidden="true"><?php esc_html_e( 'Update cart', 'hallowceramics-auto-pages-no-router' ); ?></button>

          <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ?: home_url( '/shop/' ) ); ?>" class="continue-shopping">← <?php esc_html_e( 'Continue shopping', 'hallowceramics-auto-pages-no-router' ); ?></a>
        </aside>
      </form>
    <?php endif; ?>
  </div>

  <?php if ( ! empty( $cross_sell_products ) ) : ?>
  <!-- Cross-sells -->
  <section class="cross-sells-section" aria-labelledby="cross-sells-title">
    <h2 id="cross-sells-title"><?php esc_html_e( 'You may also like', 'hallowceramics-auto-pages-no-router' ); ?></h2>
    <div class="cross-sells-scroll">
      <?php foreach ( $cross_sell_products as $cs_product ) :
        $cs_image = $cs_product->get_image( 'woocommerce_thumbnail', [ 'loading' => 'lazy' ] );
        $cs_name  = $cs_product->get_name();
        $cs_price = $cs_product->get_price_html();
        $cs_url   = get_permalink( $cs_product->get_id() );
        $cs_atc   = esc_url( add_query_arg( 'add-to-cart', $cs_product->get_id(), wc_get_cart_url() ) );
      ?>
      <article class="cross-sell-card">
        <a href="<?php echo esc_url( $cs_url ); ?>" class="cross-sell-media" aria-label="<?php echo esc_attr( $cs_name ); ?>">
          <?php echo $cs_image; ?>
        </a>
        <div class="cross-sell-body">
          <h3 class="cross-sell-title"><?php echo esc_html( $cs_name ); ?></h3>
          <p class="cross-sell-price"><?php echo $cs_price; ?></p>
          <a href="<?php echo $cs_atc; ?>" class="cross-sell-add">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
              <path d="M6 8h15l-1.5 9H7.5L6 8zm0 0L5 3H2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <?php esc_html_e( 'Add to Cart', 'hallowceramics-auto-pages-no-router' ); ?>
          </a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </section>
  <?php endif; ?>
</div><!-- .cart-content -->

<?php if ( ! empty( $cart_items ) ) : ?>
<script>
(function(){
  var form = document.querySelector('.cart-layout form') || document.getElementById('cartLayout');
  // Quantity +/- buttons
  document.querySelectorAll('.cart-qty-btn').forEach(function(btn){
    btn.addEventListener('click', function(){
      var row = this.closest('.cart-qty-row');
      var input = row.querySelector('.cart-qty-input');
      var delta = parseInt(this.getAttribute('data-delta') || 0);
      var val = (parseInt(input.value) || 1) + delta;
      if (val < 1) val = 1;
      var max = parseInt(input.getAttribute('max')) || 99;
      if (val > max) val = max;
      input.value = val;
      // Submit the hidden update button to trigger WC cart recalculation
      var updateBtn = document.querySelector('button[name="update_cart"]');
      if (updateBtn) updateBtn.click();
    });
  });
})();
</script>
<?php endif; ?>


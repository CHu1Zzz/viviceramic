<?php
/**
 * WooCommerce Single Product content template — HallowCeramics.
 * Loaded by woocommerce_content() via wc_get_template_part('content','single-product').
 * Dark-theme split layout, custom tabs, related products.
 *
 * @package HallowCeramics
 */

defined('ABSPATH') || exit;

global $product;

if ( ! is_a( $product, 'WC_Product' ) ) {
    $product = wc_get_product( get_the_ID() );
}
if ( ! $product ) {
    return;
}


// ---- Product data ----
$product_id       = $product->get_id();
$product_name     = $product->get_name();
$on_sale          = $product->is_on_sale();
$regular_price    = $product->get_regular_price();
$sale_price       = $product->get_sale_price();
$short_desc       = $product->get_short_description();
$full_desc        = $product->get_description();
$stock_qty        = $product->get_stock_quantity();
$in_stock         = $product->is_in_stock();
$sku              = $product->get_sku();

// ---- Images ----
$main_image_id   = $product->get_image_id();
$main_image_url  = $main_image_id ? wp_get_attachment_url( $main_image_id ) : wc_placeholder_img_src( 'woocommerce_single' );
$main_image_alt  = $main_image_id ? get_post_meta( $main_image_id, '_wp_attachment_image_alt', true ) : $product_name;
$gallery_ids     = $product->get_gallery_image_ids();

// Build all-images array (main + gallery) for JS thumbnail switcher
$all_image_urls = [ $main_image_url ];
foreach ( $gallery_ids as $gid ) {
    $all_image_urls[] = wp_get_attachment_url( $gid );
}

// ---- Category ----
$cat_list = wc_get_product_category_list( $product_id, ', ', '<span class="product-category">', '</span>' );
$cat_plain = strip_tags( wc_get_product_category_list( $product_id, ', ' ) );

// ---- Attributes (Material, Finish, Care, Use) ----
$material = $product->get_attribute( 'material' );
$finish   = $product->get_attribute( 'finish' );
$care     = $product->get_attribute( 'care' );
$use_note = $product->get_attribute( 'use' );

// ---- Dimensions & Weight ----
$length = $product->get_length();
$width  = $product->get_width();
$height = $product->get_height();
$weight = $product->get_weight();
$has_dims = ( $length && $width && $height );

// ---- Stock max for quantity input ----
$max_qty = ( $stock_qty && $stock_qty > 0 ) ? $stock_qty : 99;

// ---- Add-to-cart URL ----
$add_cart_url = $product->add_to_cart_url();
$buy_now_url  = function_exists( 'wc_get_checkout_url' )
    ? wc_get_checkout_url() . '?add-to-cart=' . $product_id
    : home_url( '/checkout/?add-to-cart=' . $product_id );

// ---- Related products ----
$related_ids   = wc_get_related_products( $product_id, 4 );
$related_items = [];
foreach ( $related_ids as $rid ) {
    $rp = wc_get_product( $rid );
    if ( ! $rp ) continue;
    $rimg_id  = $rp->get_image_id();
    $rimg_url = $rimg_id ? wp_get_attachment_url( $rimg_id ) : wc_placeholder_img_src( 'woocommerce_thumbnail' );
    $related_items[] = [
        'name'  => $rp->get_name(),
        'price' => $rp->get_price_html(),
        'url'   => get_permalink( $rid ),
        'img'   => $rimg_url,
    ];
}
?>

<main>
  <div class="product-detail">

    <!-- ===== LEFT: Gallery ===== -->
    <div class="product-gallery">
      <div class="main-image-wrap" id="mainImageWrap" role="button" tabindex="0"
           aria-label="<?php esc_attr_e( 'Enlarge product image', 'hallowceramics-auto-pages' ); ?>">
        <?php if ( $on_sale ) : ?>
          <span class="main-image-badge"><?php esc_html_e( 'Sale', 'hallowceramics-auto-pages' ); ?></span>
        <?php endif; ?>
        <img id="mainImage"
             src="<?php echo esc_url( $main_image_url ); ?>"
             alt="<?php echo esc_attr( $main_image_alt ?: $product_name ); ?>" />
      </div>

      <?php if ( count( $all_image_urls ) > 1 ) : ?>
      <div class="thumbnail-row">
        <?php foreach ( $all_image_urls as $idx => $img_url ) : ?>
        <button class="thumbnail-btn<?php echo $idx === 0 ? ' active' : ''; ?>"
                onclick="hallowSwitchImage(<?php echo (int) $idx; ?>)"
                aria-label="<?php printf( esc_attr__( 'View image %d', 'hallowceramics-auto-pages' ), $idx + 1 ); ?>">
          <img src="<?php echo esc_url( $img_url ); ?>" alt="" loading="lazy" />
        </button>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>

    <!-- ===== RIGHT: Info ===== -->
    <div class="product-info">
      <?php echo $cat_list ?: '<span class="product-category">' . esc_html( $cat_plain ) . '</span>'; ?>

      <h1 class="product-name"><?php echo esc_html( $product_name ); ?></h1>

      <!-- Price -->
      <div class="product-price-row">
        <?php if ( $on_sale && $sale_price ) : ?>
          <span class="product-price"><?php echo wc_price( $sale_price ); ?></span>
          <span class="product-price-was"><?php echo wc_price( $regular_price ); ?></span>
        <?php else : ?>
          <span class="product-price"><?php echo $product->get_price_html(); ?></span>
        <?php endif; ?>
      </div>

      <hr class="divider" />

      <!-- Short description -->
      <?php if ( $short_desc ) : ?>
      <div class="product-short-desc">
        <?php echo wp_kses_post( $short_desc ); ?>
      </div>
      <?php endif; ?>

      <!-- Meta badges -->
      <div class="product-meta-grid">
        <?php if ( $material ) : ?>
        <div class="product-meta-item">
          <div class="product-meta-label"><?php esc_html_e( 'Material', 'hallowceramics-auto-pages' ); ?></div>
          <div class="product-meta-value"><?php echo esc_html( $material ); ?></div>
        </div>
        <?php endif; ?>

        <?php if ( $has_dims ) : ?>
        <div class="product-meta-item">
          <div class="product-meta-label"><?php esc_html_e( 'Size', 'hallowceramics-auto-pages' ); ?></div>
          <div class="product-meta-value">
            ≈ <?php echo esc_html( $length ); ?> × <?php echo esc_html( $width ); ?><?php echo $height ? ' × ' . esc_html( $height ) : ''; ?> cm
          </div>
        </div>
        <?php endif; ?>

        <?php if ( $weight ) : ?>
        <div class="product-meta-item">
          <div class="product-meta-label"><?php esc_html_e( 'Weight', 'hallowceramics-auto-pages' ); ?></div>
          <div class="product-meta-value"><?php echo esc_html( $weight ); ?> kg</div>
        </div>
        <?php endif; ?>
      </div>

      <hr class="divider" />

      <!-- Quantity + Actions -->
      <div class="quantity-row">
        <span class="qty-label"><?php esc_html_e( 'Quantity', 'hallowceramics-auto-pages' ); ?></span>
        <div class="quantity-selector">
          <button class="qty-btn" onclick="hallowChangeQty(-1)" aria-label="<?php esc_attr_e( 'Decrease quantity', 'hallowceramics-auto-pages' ); ?>">−</button>
          <input class="qty-input" type="number" id="qtyInput" value="1" min="1"
                 max="<?php echo (int) $max_qty; ?>" readonly />
          <button class="qty-btn" onclick="hallowChangeQty(1)" aria-label="<?php esc_attr_e( 'Increase quantity', 'hallowceramics-auto-pages' ); ?>">+</button>
        </div>
      </div>

      <div class="product-actions">
        <a href="<?php echo esc_url( $add_cart_url ); ?>?quantity=1"
           class="btn-add-cart" id="addCartBtn"
           aria-label="<?php esc_attr_e( 'Add to cart', 'hallowceramics-auto-pages' ); ?>">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <path d="M6 8h15l-1.5 9H7.5L6 8zm0 0L5 3H2" stroke-linecap="round" stroke-linejoin="round"/>
            <circle cx="9" cy="20" r="1.5" fill="currentColor" stroke="none"/>
            <circle cx="18" cy="20" r="1.5" fill="currentColor" stroke="none"/>
          </svg>
          <?php esc_html_e( 'Add to Cart', 'hallowceramics-auto-pages' ); ?>
        </a>
        <a href="<?php echo esc_url( $buy_now_url ); ?>" class="btn-buy-now" id="buyNowBtn">
          <?php esc_html_e( 'Buy it now', 'hallowceramics-auto-pages' ); ?>
        </a>
      </div>

      <!-- Shipping note -->
      <div class="shipping-note">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
          <rect x="1" y="3" width="15" height="13" rx="1"/>
          <polyline points="16,8 20,8 23,11 23,16 16,16"/>
          <circle cx="5.5" cy="18.5" r="1.5"/>
          <circle cx="18.5" cy="18.5" r="1.5"/>
        </svg>
        <?php esc_html_e( 'Free shipping on orders over $120 · Hand-packed in 2–4 days', 'hallowceramics-auto-pages' ); ?>
      </div>
    </div>
  </div>

  <!-- ===== TABS ===== -->
  <div class="product-tabs-section">
    <div class="product-tabs" role="tablist">
      <button class="product-tab-btn active" role="tab" onclick="hallowSwitchTab(0)"
              id="tab-btn-0" aria-selected="true">
        <?php esc_html_e( 'Details', 'hallowceramics-auto-pages' ); ?>
      </button>
      <button class="product-tab-btn" role="tab" onclick="hallowSwitchTab(1)"
              id="tab-btn-1" aria-selected="false">
        <?php esc_html_e( 'Shipping', 'hallowceramics-auto-pages' ); ?>
      </button>
    </div>

    <!-- Details panel -->
    <div class="product-tab-panel active" role="tabpanel" id="tab-panel-0">
      <div class="tab-body">
        <?php if ( $full_desc ) : ?>
          <h3><?php esc_html_e( 'About this piece', 'hallowceramics-auto-pages' ); ?></h3>
          <?php echo wp_kses_post( apply_filters( 'the_content', $full_desc ) ); ?>
        <?php endif; ?>

        <h3><?php esc_html_e( 'Specifications', 'hallowceramics-auto-pages' ); ?></h3>
        <table class="spec-table">
          <?php if ( $material ) : ?>
          <tr><td><?php esc_html_e( 'Material', 'hallowceramics-auto-pages' ); ?></td><td><?php echo esc_html( $material ); ?></td></tr>
          <?php endif; ?>
          <?php if ( $finish ) : ?>
          <tr><td><?php esc_html_e( 'Finish', 'hallowceramics-auto-pages' ); ?></td><td><?php echo esc_html( $finish ); ?></td></tr>
          <?php endif; ?>
          <?php if ( $has_dims ) : ?>
          <tr><td><?php esc_html_e( 'Dimensions', 'hallowceramics-auto-pages' ); ?></td><td>Approx. <?php echo esc_html( $length . ' cm × ' . $width . ' cm' . ( $height ? ' × ' . $height . ' cm' : '' ) ); ?></td></tr>
          <?php endif; ?>
          <?php if ( $weight ) : ?>
          <tr><td><?php esc_html_e( 'Weight', 'hallowceramics-auto-pages' ); ?></td><td><?php echo esc_html( $weight ); ?> kg</td></tr>
          <?php endif; ?>
          <?php if ( $care ) : ?>
          <tr><td><?php esc_html_e( 'Care', 'hallowceramics-auto-pages' ); ?></td><td><?php echo esc_html( $care ); ?></td></tr>
          <?php endif; ?>
          <?php if ( $use_note ) : ?>
          <tr><td><?php esc_html_e( 'Use', 'hallowceramics-auto-pages' ); ?></td><td><?php echo esc_html( $use_note ); ?></td></tr>
          <?php endif; ?>
          <?php if ( $sku ) : ?>
          <tr><td>SKU</td><td><?php echo esc_html( $sku ); ?></td></tr>
          <?php endif; ?>
        </table>
      </div>
    </div>

    <!-- Shipping panel -->
    <div class="product-tab-panel" role="tabpanel" id="tab-panel-1">
      <div class="tab-body">
        <h3><?php esc_html_e( 'Shipping', 'hallowceramics-auto-pages' ); ?></h3>
        <p><?php esc_html_e( 'Every piece is packed by hand with custom foam inserts before it leaves our studio. Orders ship within 2–4 business days.', 'hallowceramics-auto-pages' ); ?></p>
        <table class="spec-table">
          <tr><td><?php esc_html_e( 'Domestic (US)', 'hallowceramics-auto-pages' ); ?></td><td>$8 flat rate · Free over $120</td></tr>
          <tr><td>Canada</td><td>$18 flat rate</td></tr>
          <tr><td><?php esc_html_e( 'International', 'hallowceramics-auto-pages' ); ?></td><td><?php esc_html_e( 'Calculated at checkout', 'hallowceramics-auto-pages' ); ?></td></tr>
        </table>

        <h3><?php esc_html_e( 'Returns', 'hallowceramics-auto-pages' ); ?></h3>
        <p><?php esc_html_e( 'If your piece arrives damaged or doesn\'t meet your expectations, you have 14 days from delivery to request a return. We\'ll send a prepaid label — no restocking fee. We want you to love the object, not settle for it.', 'hallowceramics-auto-pages' ); ?></p>
      </div>
    </div>
  </div>

  <!-- ===== Related Products ===== -->
  <?php if ( count( $related_items ) > 0 ) : ?>
  <section class="related-section" aria-labelledby="related-title">
    <h2 id="related-title"><?php esc_html_e( 'You may also like', 'hallowceramics-auto-pages' ); ?></h2>
    <div class="related-scroll">
      <?php foreach ( $related_items as $item ) : ?>
      <article class="related-card">
        <a href="<?php echo esc_url( $item['url'] ); ?>" class="related-card-media"
           aria-label="<?php echo esc_attr( $item['name'] ); ?>">
          <img src="<?php echo esc_url( $item['img'] ); ?>" alt="" loading="lazy" />
        </a>
        <div class="related-card-body">
          <h3 class="related-card-title"><?php echo esc_html( $item['name'] ); ?></h3>
          <p class="related-card-price"><?php echo wp_kses_post( $item['price'] ); ?></p>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </section>
  <?php endif; ?>
</main>

<!-- Pass gallery images to JS -->
<script>
  window.__hallowProductImages = <?php echo wp_json_encode( $all_image_urls ); ?>;
  window.__hallowProductMaxQty = <?php echo (int) $max_qty; ?>;
</script>

<?php
/*
Template Name: Products Others Page
*/
global $hallow_body_class, $hallow_body_attrs;
$hallow_body_class = 'catalog-body';
$hallow_body_attrs = ' data-catalog="others"';
get_header();

$others = wc_get_products([
  'status'   => 'publish',
  'limit'    => -1,
  'category' => ['others'],
]);
?>

<main class="pl-page" id="pl-catalog">
      <div class="pl-page-head">
        <h1 data-i18n="catalogTitleOthers">Others</h1>
        <p data-i18n="catalogSub">Hand-fired ceramics — limited autumn runs.</p>
      </div>

      <nav class="pl-subnav" aria-label="Collections">
        <a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" data-i18n="catalogNavAll">All</a>
        <a href="<?php echo esc_url( home_url( '/pumpkins/' ) ); ?>" data-i18n="catalogNavPumpkins">Pumpkins</a>
        <a href="<?php echo esc_url( home_url( '/others/' ) ); ?>" class="is-active" data-i18n="catalogNavOthers">Others</a>
      </nav>

      <div class="pl-toolbar">
        <div class="pl-toolbar-left">
          <label>
            <span data-i18n="catalogAvailability">Availability</span>
            <select aria-label="Filter by availability">
              <option>All</option>
              <option>In stock</option>
            </select>
          </label>
          <label>
            <span data-i18n="catalogPrice">Price</span>
            <select aria-label="Filter by price">
              <option>Any</option>
              <option>Under $100</option>
              <option>$100 – $200</option>
              <option>$200+</option>
            </select>
          </label>
        </div>
        <div class="pl-toolbar-right">
          <label>
            <span data-i18n="catalogSort">Sort by</span>
            <select aria-label="Sort products">
              <option data-i18n="catalogSortFeatured">Featured</option>
              <option>Price, low to high</option>
              <option>Price, high to low</option>
              <option>Newest</option>
            </select>
          </label>
          <span id="pl-count" class="pl-toolbar-count"><?php echo esc_html( count( $others ) . ' products' ); ?></span>
        </div>
      </div>

      <section class="pl-section" aria-labelledby="sec-others">
        <h2 id="sec-others" class="visually-hidden" data-i18n="catalogOthersSection">Others</h2>
        <div class="pl-grid">
        <?php foreach ( $others as $product ) : ?>
          <article class="pl-card">
            <a class="pl-card-visual" href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>">
              <?php if ( $product->is_on_sale() ) : ?>
                <span class="pl-card-badge" data-i18n="catalogSale">Sale</span>
              <?php endif; ?>
              <?php echo $product->get_image( 'medium', ['loading' => 'lazy', 'decoding' => 'async'] ); ?>
            </a>
            <div class="pl-card-body">
              <h3 class="pl-card-title"><?php echo esc_html( $product->get_name() ); ?></h3>
              <p class="pl-card-price"><?php echo $product->get_price_html(); ?></p>
              <div class="pl-card-actions">
                <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="pl-btn pl-btn--primary" data-i18n="catalogAddCart">Add to cart</a>
                <a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>" class="pl-btn pl-btn--secondary" data-i18n="catalogLearn">Learn more</a>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
        <?php if ( empty( $others ) ) : ?>
          <p class="pl-empty"><?php esc_html_e( 'No other products yet — add products in the Others category.', 'hallowceramics-auto-pages' ); ?></p>
        <?php endif; ?>
        </div>
      </section>

    </main>

<?php get_footer(); ?>

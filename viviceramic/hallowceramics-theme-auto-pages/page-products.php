<?php
/*
Template Name: Products Catalog Page
*/
global $hallow_body_class, $hallow_body_attrs;
$hallow_body_class = 'catalog-body';
$hallow_body_attrs = '';
get_header();

// Query pumpkins products
$pumpkins = wc_get_products([
  'status'   => 'publish',
  'limit'    => -1,
  'category' => ['pumpkins'],
]);

// Query others products
$others = wc_get_products([
  'status'   => 'publish',
  'limit'    => -1,
  'category' => ['others'],
]);

$total = count($pumpkins) + count($others);
?>

<main class="pl-page" id="pl-catalog">
      <div class="pl-page-head">
        <h1 data-i18n="catalogTitleAll">All products</h1>
        <p data-i18n="catalogSub">Hand-fired ceramics — limited autumn runs.</p>
      </div>

      <nav class="pl-subnav" aria-label="Collections">
        <a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="is-active" data-i18n="catalogNavAll">All</a>
        <a href="<?php echo esc_url( home_url( '/pumpkins/' ) ); ?>" data-i18n="catalogNavPumpkins">Pumpkins</a>
        <a href="<?php echo esc_url( home_url( '/others/' ) ); ?>" data-i18n="catalogNavOthers">Others</a>
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
          <span id="pl-count" class="pl-toolbar-count"><?php echo esc_html( $total . ' products' ); ?></span>
        </div>
      </div>

      <section class="pl-section" aria-labelledby="sec-pumpkins">
        <h2 id="sec-pumpkins" class="pl-section-title" data-i18n="catalogPumpkinsSection">Pumpkins</h2>
        <div class="pl-grid">
        <?php foreach ( $pumpkins as $product ) : ?>
          <article class="pl-card">
            <div class="pl-card-visual">
              <?php if ( $product->is_on_sale() ) : ?>
                <span class="pl-card-badge" data-i18n="catalogSale">Sale</span>
              <?php endif; ?>
              <?php echo $product->get_image( 'medium', ['loading' => 'lazy', 'decoding' => 'async'] ); ?>
            </div>
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
        <?php if ( empty( $pumpkins ) ) : ?>
          <p class="pl-empty"><?php esc_html_e( 'No pumpkins yet — add products in the Pumpkins category.', 'hallowceramics-auto-pages' ); ?></p>
        <?php endif; ?>
        </div>
      </section>

      <section class="pl-section" aria-labelledby="sec-others">
        <h2 id="sec-others" class="pl-section-title" data-i18n="catalogOthersSection">Others</h2>
        <div class="pl-grid">
        <?php foreach ( $others as $product ) : ?>
          <article class="pl-card">
            <div class="pl-card-visual">
              <?php if ( $product->is_on_sale() ) : ?>
                <span class="pl-card-badge" data-i18n="catalogSale">Sale</span>
              <?php endif; ?>
              <?php echo $product->get_image( 'medium', ['loading' => 'lazy', 'decoding' => 'async'] ); ?>
            </div>
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

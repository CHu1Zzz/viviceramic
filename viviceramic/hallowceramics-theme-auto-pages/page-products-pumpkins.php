<?php
/*
Template Name: Products Pumpkins Page
*/
global $hallow_body_class, $hallow_body_attrs;
$hallow_body_class = 'catalog-body';
$hallow_body_attrs = ' data-catalog="pumpkins"';
get_header();
?>

<main class="pl-page" id="pl-catalog">
      <div class="pl-page-head">
        <h1 data-i18n="catalogTitlePumpkins">Pumpkins</h1>
        <p data-i18n="catalogSub">Hand-fired ceramics — limited autumn runs.</p>
      </div>

      <nav class="pl-subnav" aria-label="Collections">
        <a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" data-i18n="catalogNavAll">All</a>
        <a href="<?php echo esc_url( home_url( '/pumpkins/' ) ); ?>" class="is-active" data-i18n="catalogNavPumpkins">Pumpkins</a>
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
          <span id="pl-count" class="pl-toolbar-count" data-i18n="catalogCount10">10 products</span>
        </div>
      </div>

      <section class="pl-section" aria-labelledby="sec-pumpkins">
        <h2 id="sec-pumpkins" class="visually-hidden" data-i18n="catalogPumpkinsSection">Pumpkins</h2>
        <div class="pl-grid" id="pl-mount-pumpkins"></div>
      </section>

    </main>

<?php get_footer(); ?>

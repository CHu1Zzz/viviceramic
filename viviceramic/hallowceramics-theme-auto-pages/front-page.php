<?php
/** Front page template for HallowCeramics. */
global $hallow_body_class;
$hallow_body_class = 'hallow-front-page';
get_header();
?>


<main>
      <section class="hero" id="top">
        <div class="hero-bg-layer" aria-hidden="true"></div>
        <div class="hero-video-frame" aria-hidden="true">
          <video
            class="hero-gif-video"
            src="<?php echo esc_url( get_template_directory_uri() . '/assets/media/pumpkin_alpha.webm' ); ?>"
            width="800"
            height="800"
            autoplay
            loop
            muted
            playsinline
            aria-hidden="true"
          ></video>
        </div>
        <div class="hero-fog" aria-hidden="true"></div>
        <div class="hero-moon" aria-hidden="true"></div>
        <div class="hero-content">
          <div class="hero-copy">
            <p class="hero-eyebrow" data-i18n="heroEyebrow">Hand-fired ceramics · Limited Halloween drops</p>
            <h1 class="hero-title">
              <span data-i18n="heroTitleBefore">Ceramic pumpkins </span><span class="hero-title-accent" data-i18n="heroTitleAccent">for elevated Halloween&nbsp;decorations.</span>
            </h1>
            <p class="hero-slogan" data-i18n="heroSlogan">
              Hand-finished ceramics for mantels, consoles, and the Halloween vignette guests notice first. Limited autumn batches only.
            </p>
            <div class="hero-cta-row">
              <a class="btn-primary" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" data-i18n="heroShop">Shop the drop</a>
              <a class="btn-ghost" href="<?php echo esc_url( home_url( '/about/' ) ); ?>" data-i18n="heroStory">Our craft</a>
            </div>
          </div>
        </div>
        <div class="scroll-hint">
          <div class="scroll-hint-inner">
            <span data-i18n="scrollHint">Descend</span>
            <span class="scroll-hint-line" aria-hidden="true"></span>
          </div>
        </div>
      </section>

      <section class="section-bestsellers" aria-labelledby="bs-heading">
        <div class="bs-inner">
          <h2 id="bs-heading" class="bs-title" data-i18n="bsTitle">Get our best sellers</h2>
          <p class="bs-sub" data-i18n="bsSub">Hand-finished picks collectors grab first—limited autumn runs.</p>
          <div class="bs-viewport">
            <button type="button" class="bs-nav bs-nav--prev" id="bs-prev" aria-label="Scroll products left">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path d="M15 6l-6 6 6 6" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </button>
            <div class="bs-window">
              <div class="bs-track" id="bs-track">
                <div class="bs-item">
                  <article class="bs-product-card">
                    <a class="bs-img-link" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>">
                      <div class="bs-img-wrap">
                        <img
                          src="https://images.unsplash.com/photo-1509557965877-b88c97052f0e?auto=format&amp;w=600&amp;h=600&amp;fit=crop&amp;q=80"
                          alt=""
                          width="600"
                          height="600"
                          loading="lazy"
                          decoding="async"
                        />
                      </div>
                    </a>
                    <h3 class="bs-product-name" data-i18n="bs1Name">Hyper-real Classic Pumpkin</h3>
                    <p class="bs-price"><span data-i18n="bsFrom">From</span> <span class="bs-price-num">$189</span> <span class="bs-currency" data-i18n="bsCurrency">USD</span></p>
                    <div class="bs-actions">
                      <a class="bs-btn-cart" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" data-i18n="bsAddCart">Add to cart</a>
                      <a class="bs-btn-learn" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" data-i18n="bsLearn">Learn more</a>
                    </div>
                  </article>
                </div>
                <div class="bs-item">
                  <article class="bs-product-card">
                    <a class="bs-img-link" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>">
                      <div class="bs-img-wrap">
                        <img
                          src="https://images.unsplash.com/photo-1606312619070-d48b4c652a48?auto=format&amp;w=600&amp;h=600&amp;fit=crop&amp;q=80"
                          alt=""
                          width="600"
                          height="600"
                          loading="lazy"
                          decoding="async"
                        />
                      </div>
                    </a>
                    <h3 class="bs-product-name" data-i18n="bs2Name">Petite Pumpkin Trio</h3>
                    <p class="bs-price"><span data-i18n="bsFrom">From</span> <span class="bs-price-num">$129</span> <span class="bs-currency" data-i18n="bsCurrency">USD</span></p>
                    <div class="bs-actions">
                      <a class="bs-btn-cart" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" data-i18n="bsAddCart">Add to cart</a>
                      <a class="bs-btn-learn" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" data-i18n="bsLearn">Learn more</a>
                    </div>
                  </article>
                </div>
                <div class="bs-item">
                  <article class="bs-product-card">
                    <a class="bs-img-link" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>">
                      <div class="bs-img-wrap">
                        <img
                          src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?auto=format&amp;w=600&amp;h=600&amp;fit=crop&amp;q=80"
                          alt=""
                          width="600"
                          height="600"
                          loading="lazy"
                          decoding="async"
                        />
                      </div>
                    </a>
                    <h3 class="bs-product-name" data-i18n="bs3Name">Taper Throne Candle Cup</h3>
                    <p class="bs-price"><span data-i18n="bsFrom">From</span> <span class="bs-price-num">$89</span> <span class="bs-currency" data-i18n="bsCurrency">USD</span></p>
                    <div class="bs-actions">
                      <a class="bs-btn-cart" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" data-i18n="bsAddCart">Add to cart</a>
                      <a class="bs-btn-learn" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" data-i18n="bsLearn">Learn more</a>
                    </div>
                  </article>
                </div>
                <div class="bs-item">
                  <article class="bs-product-card">
                    <a class="bs-img-link" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>">
                      <div class="bs-img-wrap">
                        <img
                          src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?auto=format&amp;w=600&amp;h=600&amp;fit=crop&amp;q=80"
                          alt=""
                          width="600"
                          height="600"
                          loading="lazy"
                          decoding="async"
                        />
                      </div>
                    </a>
                    <h3 class="bs-product-name" data-i18n="bs4Name">Heritage Stem Sculpt</h3>
                    <p class="bs-price"><span data-i18n="bsFrom">From</span> <span class="bs-price-num">$249</span> <span class="bs-currency" data-i18n="bsCurrency">USD</span></p>
                    <div class="bs-actions">
                      <a class="bs-btn-cart" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" data-i18n="bsAddCart">Add to cart</a>
                      <a class="bs-btn-learn" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" data-i18n="bsLearn">Learn more</a>
                    </div>
                  </article>
                </div>
                <div class="bs-item">
                  <article class="bs-product-card">
                    <a class="bs-img-link" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>">
                      <div class="bs-img-wrap">
                        <img
                          src="https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?auto=format&amp;w=600&amp;h=600&amp;fit=crop&amp;q=80"
                          alt=""
                          width="600"
                          height="600"
                          loading="lazy"
                          decoding="async"
                        />
                      </div>
                    </a>
                    <h3 class="bs-product-name" data-i18n="bs5Name">Ember Glaze Limited Run</h3>
                    <p class="bs-price"><span data-i18n="bsFrom">From</span> <span class="bs-price-num">$219</span> <span class="bs-currency" data-i18n="bsCurrency">USD</span></p>
                    <div class="bs-actions">
                      <a class="bs-btn-cart" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" data-i18n="bsAddCart">Add to cart</a>
                      <a class="bs-btn-learn" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" data-i18n="bsLearn">Learn more</a>
                    </div>
                  </article>
                </div>
                <div class="bs-item">
                  <article class="bs-product-card">
                    <a class="bs-img-link" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>">
                      <div class="bs-img-wrap">
                        <img
                          src="https://images.unsplash.com/photo-1556228578-0d85b1a4d564?auto=format&amp;w=600&amp;h=600&amp;fit=crop&amp;q=80"
                          alt=""
                          width="600"
                          height="600"
                          loading="lazy"
                          decoding="async"
                        />
                      </div>
                    </a>
                    <h3 class="bs-product-name" data-i18n="bs6Name">Patch Stems &amp; Minis Set</h3>
                    <p class="bs-price"><span data-i18n="bsFrom">From</span> <span class="bs-price-num">$159</span> <span class="bs-currency" data-i18n="bsCurrency">USD</span></p>
                    <div class="bs-actions">
                      <a class="bs-btn-cart" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" data-i18n="bsAddCart">Add to cart</a>
                      <a class="bs-btn-learn" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" data-i18n="bsLearn">Learn more</a>
                    </div>
                  </article>
                </div>
              </div>
            </div>
            <button type="button" class="bs-nav bs-nav--next" id="bs-next" aria-label="Scroll products right">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path d="M9 6l6 6-6 6" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </button>
          </div>
        </div>
      </section>

      <section class="section-products" aria-labelledby="products-heading">
        <h2 id="products-heading" class="visually-hidden" data-i18n="productsHeading">Main ceramics types</h2>
        <article class="product-card" data-reveal-delay="0">
          <div class="product-visual">
            <span class="product-badge" data-i18n="p1Badge">Hyper-real</span>
            <img
              class="product-placeholder"
              src="https://images.unsplash.com/photo-1565193566173-7a0ee3dbe261?w=800&amp;q=75&amp;auto=format"
              alt="Craftsperson refining ceramic pumpkin details by hand"
              width="800"
              height="600"
              loading="lazy"
              decoding="async"
            />
          </div>
          <div class="product-body">
            <h3 data-i18n="p1Title">Sculpted to read real—from across the room to a curious tap.</h3>
            <p data-i18n="p1Body">
              Ribs, stem, and silhouette are finished by hand so each piece carries the small irregularities that read as life—not mold-perfect plastic. Fired for depth and glazed soft, they’re the pumpkins guests mistake for the real thing, then pick up and believe.
            </p>
            <a class="product-link" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" data-i18n="p1Link">View collection →</a>
          </div>
        </article>

        <article class="product-card product-card--reverse" data-reveal-delay="120">
          <div class="product-visual">
            <span class="product-badge" data-i18n="p2Badge">Set piece</span>
            <img
              class="product-placeholder"
              src="https://images.unsplash.com/photo-1606312619070-d48b4c652a48?w=640&amp;q=75&amp;auto=format"
              alt="Cozy candlelight and seasonal table setting"
              width="800"
              height="600"
              loading="lazy"
              decoding="async"
            />
          </div>
          <div class="product-body">
            <h3 data-i18n="p2Title">A trio of minis—or a candle throne—for the vignette.</h3>
            <p data-i18n="p2Body">
              Three petite pumpkins nest together like a whispered spell, or choose the taper holder: a low, moody pedestal that catches wax drips like ritual evidence.
            </p>
            <a class="product-link" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" data-i18n="p2Link">Explore sets →</a>
          </div>
        </article>
      </section>

      <section class="section-reviews" aria-labelledby="reviews-title">
        <div class="reviews-inner">
          <h2 id="reviews-title" class="section-title" data-i18n="reviewsTitle">Whispers from the patch</h2>
          <p class="section-sub" data-i18n="reviewsSub">Real rooms. Real light. Unreal ceramics.</p>
          <div class="review-grid">
            <article class="review-card" data-reveal-delay="0">
              <button type="button" class="review-photo" data-lightbox data-full="https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&amp;w=1400&amp;h=933&amp;fit=crop&amp;q=85" aria-label="Enlarge customer photo 1">
                <img
                  src="https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&amp;w=900&amp;h=600&amp;fit=crop&amp;q=80"
                  alt="Warm minimalist living room interior"
                  width="900"
                  height="600"
                  loading="lazy"
                  decoding="async"
                />
              </button>
              <div class="review-head">
                <img class="review-avatar" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=120&q=80" alt="" width="44" height="44" />
                <div class="review-meta">
                  <strong>Elena</strong>
                  <span>Barcelona</span>
                </div>
              </div>
              <p class="review-text" data-i18n="r1">
                “The weight, the glaze, the stem—I actually tapped it expecting hollow plastic. It’s the most convincing piece I own.”
              </p>
            </article>
            <article class="review-card" data-reveal-delay="100">
              <button type="button" class="review-photo" data-lightbox data-full="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=1400&q=85" aria-label="Enlarge customer photo 2">
                <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=900&q=80" alt="Living room with curated furniture" width="900" height="600" loading="lazy" />
              </button>
              <div class="review-head">
                <img class="review-avatar" src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=120&q=80" alt="" width="44" height="44" />
                <div class="review-meta">
                  <strong>Marcus</strong>
                  <span>Chicago</span>
                </div>
              </div>
              <p class="review-text" data-i18n="r2">
                “Reads premium in person. My living room went from ‘decorated’ to ‘curated’ in one object.”
              </p>
            </article>
            <article class="review-card" data-reveal-delay="200">
              <button type="button" class="review-photo" data-lightbox data-full="https://images.unsplash.com/photo-1556228453-efd6c1ff04f6?w=1400&q=85" aria-label="Enlarge customer photo 3">
                <img src="https://images.unsplash.com/photo-1556228453-efd6c1ff04f6?w=900&q=80" alt="Soft lamp light in a cozy interior" width="900" height="600" loading="lazy" />
              </button>
              <div class="review-head">
                <img class="review-avatar" src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=120&q=80" alt="" width="44" height="44" />
                <div class="review-meta">
                  <strong>Priya</strong>
                  <span>Singapore</span>
                </div>
              </div>
              <p class="review-text" data-i18n="r3">
                “Subtle spooky, not cartoon. It photographs like sculpture and still feels cozy when the lights go low.”
              </p>
            </article>
          </div>
        </div>
      </section>

      <section class="section-cta" aria-labelledby="cta-title">
        <div class="cta-panel">
          <h2 id="cta-title" data-i18n="ctaTitle">Your Halloween decoration edit—in ceramics.</h2>
          <p data-i18n="ctaSub">Save pieces you love, track orders, and get early access to limited autumn drops—before the patch sells through.</p>
          <a class="btn-primary" href="<?php echo esc_url( hallow_account_url() ); ?>" data-i18n="ctaBtn">Sign in to your account</a>
        </div>
      </section>
    </main>

<?php get_footer(); ?>

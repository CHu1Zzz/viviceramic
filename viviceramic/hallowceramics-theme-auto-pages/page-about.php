<?php
/*
Template Name: About Page
*/
global $hallow_body_class, $hallow_body_attrs;
$hallow_body_class = 'about-body';
$hallow_body_attrs = '';
get_header();
?>

<main class="about-page">
      <!-- EDJY-style: full-bleed landscape hero image only (no side padding on image) -->
      <section class="about-hero-wide" aria-label="HallowCeramics story hero image">
        <figure class="about-hero-figure">
          <img
            class="about-hero-wide-img"
            src="https://images.unsplash.com/photo-1509557965877-b88c97052f0e?w=2400&q=85&auto=format"
            alt="Autumn pumpkins and ceramics — HallowCeramics"
            width="2400"
            height="1200"
            fetchpriority="high"
            decoding="async"
          />
        </figure>
      </section>

      <!-- Editorial band: kicker + H1 + story (dark, matches site) -->
      <section class="about-strip about-strip--dark" aria-labelledby="about-genesis-title">
        <div class="about-strip-inner">
          <p class="about-kicker" data-i18n="aboutHeroKicker">Our story</p>
          <h1 id="about-genesis-title" class="about-genesis-title" data-i18n="aboutHeroTitle">
            Ceramics for Halloween decorations that feel honest.
          </h1>

          <p class="about-kicker about-kicker--spaced" data-i18n="aboutS1Kicker">The problem we kept seeing</p>
          <h2 class="about-section-title" data-i18n="aboutS1Title">
            Halloween decorations that looked fine in photos—and cheap in person.
          </h2>
          <div class="about-prose">
            <p data-i18n="aboutS1P1">
              We love October. We love a moody table and a candle that flickers just right. But year after year, the same thing happened: we’d buy Halloween decorations that looked exciting online, then unpack something light, hollow, and a little too shiny.
            </p>
            <p data-i18n="aboutS1P2">
              Nothing wrong with fun plastic props for a party. But we wanted pieces that could sit on a mantel in daylight and still feel intentional—something closer to art than a prop.
            </p>
            <p data-i18n="aboutS1P3">
              So we built our own path. HallowCeramics is centered on a team-owned factory—ceramics for Halloween decorations you’re proud to leave out when the lights come on.
            </p>
          </div>
        </div>
      </section>

      <!-- Split: image left, copy right (EDJY “Starting from scratch” pattern) -->
      <section class="about-split-wrap" aria-labelledby="about-s2-title">
        <div class="about-split">
          <div class="about-split-visual">
            <img
              src="https://images.unsplash.com/photo-1493106641515-6b5631de4933?w=900&q=80&auto=format"
              alt="Artisan at the bench hand-carving and refining ceramic pumpkins"
              width="900"
              height="675"
              loading="lazy"
              decoding="async"
            />
          </div>
          <div class="about-split-panel">
            <p class="about-kicker" data-i18n="aboutS2Kicker">At the bench</p>
            <h2 id="about-s2-title" class="about-section-title" data-i18n="aboutS2Title">The hands that earn the double take.</h2>
            <div class="about-prose">
              <p data-i18n="aboutS2P">
                Hyper-real isn’t a factory preset—it’s someone leaning over the clay, carving ribs and stem until the silhouette reads true in daylight, then checking again after the fire so the glaze still feels soft and alive. We treat each pumpkin like a small commission: it doesn’t ship until we’d be proud to set it on our own mantel. That stubborn care—more than any single tool—is what turns ceramic into a piece people lean in to study, not just glance at.
              </p>
            </div>
          </div>
        </div>
      </section>

      <section class="about-strip about-strip--dark about-strip--bordered" aria-labelledby="about-s3-title">
        <div class="about-strip-inner">
          <p class="about-kicker" data-i18n="aboutS3Kicker">What we believe</p>
          <h2 id="about-s3-title" class="about-section-title" data-i18n="aboutS3Title">
            Quiet spooky. Real weight. Real glaze.
          </h2>
          <div class="about-prose">
            <p data-i18n="aboutS3P1">
              Our product idea is simple: Halloween decorations should feel grounded. We use stoneware ceramics so the piece has weight when you pick it up. We keep shapes believable and finishes soft—more harvest moon than neon scream.
            </p>
            <p data-i18n="aboutS3P2">
              We’re not trying to fill a warehouse. We release in limited autumn runs because that’s how we can keep quality where we want it. If you’re building a vignette—entryway, shelf, or table—our hope is that one of our pieces becomes the object people lean in to look at.
            </p>
          </div>
        </div>
      </section>

      <section class="about-cta" aria-labelledby="about-cta-title">
        <p class="about-kicker about-kicker--on-dark" data-i18n="aboutCtaKicker">Ready to dress the room?</p>
        <h2 id="about-cta-title" class="about-cta-title" data-i18n="aboutCtaTitle">See this season’s ceramics.</h2>
        <p class="about-cta-text" data-i18n="aboutCtaText">
          Browse pumpkins and accents, pick what fits your space, and bring home Halloween decorations that still look right when the party ends.
        </p>
        <a class="btn-primary about-cta-btn" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" data-i18n="aboutCtaBtn">Shop all products</a>
      </section>
    </main>

<?php get_footer(); ?>

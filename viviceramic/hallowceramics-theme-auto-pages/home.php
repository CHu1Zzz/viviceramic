<?php
/** Blog index template. */
global $hallow_body_class, $hallow_body_attrs, $wp_query;
$hallow_body_class = 'hallow-blog-page';
$hallow_body_attrs = '';
get_header();

$featured_rendered = false;
?>

<main class="blog-page">
  <section class="blog-hero blog-hero--journal-index" aria-labelledby="blog-title">
    <div class="blog-orb blog-orb--moon" aria-hidden="true"></div>
    <div class="blog-orb blog-orb--ember" aria-hidden="true"></div>
    <div class="blog-hero-inner">
      <p class="blog-kicker">The Hallow Journal</p>
      <h1 id="blog-title">Ceramic styling notes for the darker season.</h1>
      <p>
        Ideas for Halloween mantels, ceramic pumpkin styling, slow-made craft, and seasonal rooms
        that feel considered after the candles go out.
      </p>
      <div class="blog-hero-actions">
        <a class="btn-primary" href="<?php echo esc_url(home_url('/pumpkins/')); ?>">Shop pumpkins</a>
        <a class="btn-ghost" href="<?php echo esc_url(home_url('/about-us/')); ?>">Read our craft story</a>
      </div>
      <nav class="blog-category-row" aria-label="Journal categories">
        <a href="<?php echo esc_url(home_url('/category/styling-guides/')); ?>">Styling Guides</a>
        <a href="<?php echo esc_url(home_url('/category/craft-notes/')); ?>">Craft Notes</a>
        <a href="<?php echo esc_url(home_url('/category/care-storage/')); ?>">Care & Storage</a>
        <a href="<?php echo esc_url(home_url('/category/buying-guides/')); ?>">Buying Guides</a>
      </nav>
    </div>
  </section>

  <section class="blog-shell" aria-label="Journal posts">
    <?php if (have_posts()) : ?>
      <?php $post_index = 0; ?>
      <?php if (! is_paged()) : ?>
        <section class="blog-section" aria-labelledby="featured-articles-title">
          <div class="blog-section-head">
            <p class="blog-kicker">Featured articles</p>
            <h2 id="featured-articles-title">Start with the notes people read first.</h2>
          </div>
          <div class="blog-feature-grid">
      <?php else : ?>
        <section class="blog-section" aria-labelledby="recent-articles-title">
          <div class="blog-section-head">
            <p class="blog-kicker">Recent articles</p>
            <h2 id="recent-articles-title">More from the journal.</h2>
          </div>
          <div class="blog-grid blog-grid--archive" aria-label="Journal posts">
      <?php endif; ?>
      <?php while (have_posts()) : the_post(); ?>
        <?php if (! is_paged() && $post_index === 3) : ?>
          </div>
        </section>
        <section class="blog-section" aria-labelledby="recent-articles-title">
          <div class="blog-section-head blog-section-head--split">
            <div>
              <p class="blog-kicker">Recent articles</p>
              <h2 id="recent-articles-title">Fresh ideas from the patch.</h2>
            </div>
            <a class="blog-read-link" href="<?php echo esc_url(home_url('/resources/blog/page/2/')); ?>">See all articles →</a>
          </div>
          <div class="blog-grid" aria-label="Recent journal posts">
        <?php endif; ?>
        <?php if (! $featured_rendered && $wp_query->current_post === 0 && ! is_paged()) : ?>
          <?php $featured_rendered = true; ?>
          <article <?php post_class('blog-featured-card blog-featured-card--lead'); ?>>
            <a class="blog-featured-media" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr(get_the_title()); ?>">
              <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('large', ['loading' => 'eager']); ?>
              <?php else : ?>
                <span class="blog-image-fallback" aria-hidden="true"></span>
              <?php endif; ?>
            </a>
            <div class="blog-featured-copy">
              <p class="blog-kicker">Featured note</p>
              <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
              <div class="blog-meta">
                <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date()); ?></time>
                <?php if (has_category()) : ?>
                  <span aria-hidden="true">·</span>
                  <span><?php the_category(', '); ?></span>
                <?php endif; ?>
              </div>
              <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 34)); ?></p>
              <a class="blog-read-link" href="<?php the_permalink(); ?>">Read the note →</a>
            </div>
          </article>
        <?php else : ?>
          <article <?php post_class(! is_paged() && $post_index < 3 ? 'blog-card blog-card--featured-small' : 'blog-card'); ?>>
            <a class="blog-card-media" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr(get_the_title()); ?>">
              <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('medium_large', ['loading' => 'lazy']); ?>
              <?php else : ?>
                <span class="blog-image-fallback" aria-hidden="true"></span>
              <?php endif; ?>
            </a>
            <div class="blog-card-copy">
              <div class="blog-meta">
                <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date()); ?></time>
                <?php if (has_category()) : ?>
                  <span aria-hidden="true">·</span>
                  <span><?php the_category(', '); ?></span>
                <?php endif; ?>
              </div>
              <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
              <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 24)); ?></p>
              <a class="blog-read-link" href="<?php the_permalink(); ?>">Open journal →</a>
            </div>
          </article>
        <?php endif; ?>
        <?php $post_index++; ?>
      <?php endwhile; ?>
          </div>
        </section>

      <nav class="blog-pagination" aria-label="Posts pagination">
        <?php
        the_posts_pagination([
            'mid_size' => 1,
            'prev_text' => '← Newer notes',
            'next_text' => 'Older notes →',
        ]);
        ?>
      </nav>
    <?php else : ?>
      <section class="blog-empty">
        <p class="blog-kicker">Journal opening soon</p>
        <h2>Fresh notes are still in the kiln.</h2>
        <p>Publish your first WordPress post and it will appear here automatically.</p>
        <a class="btn-primary" href="<?php echo esc_url(home_url('/shop/')); ?>">Explore the collection</a>
      </section>
    <?php endif; ?>
  </section>

  <section class="journal-shop-cta journal-shop-cta--index" aria-label="Shop the look">
    <p class="blog-kicker">Extract the mood</p>
    <h2>Turn the journal into a Halloween room.</h2>
    <p>Move from ideas to objects with ceramic pumpkins, candle pieces, and seasonal accents designed for the same dark, warm palette.</p>
    <div class="blog-hero-actions">
      <a class="btn-primary" href="<?php echo esc_url(home_url('/shop/')); ?>">Shop the collection</a>
      <a class="btn-ghost" href="<?php echo esc_url(home_url('/contact/')); ?>">Ask about styling</a>
    </div>
  </section>
</main>

<?php get_footer(); ?>

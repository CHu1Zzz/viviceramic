<?php
/** Search results template. */
global $hallow_body_class, $hallow_body_attrs;
$hallow_body_class = 'hallow-blog-page hallow-search-page';
$hallow_body_attrs = '';
get_header();
?>

<main class="blog-page">
  <section class="blog-hero blog-hero--compact" aria-labelledby="search-title">
    <div class="blog-orb blog-orb--ember" aria-hidden="true"></div>
    <div class="blog-hero-inner">
      <p class="blog-kicker">Search the journal</p>
      <h1 id="search-title">
        <?php printf(esc_html__('Results for “%s”', 'hallowceramics-auto-pages'), esc_html(get_search_query())); ?>
      </h1>
      <form class="blog-search-form" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
        <label class="visually-hidden" for="journal-search">Search</label>
        <input id="journal-search" type="search" name="s" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="Search styling, pumpkins, craft..." />
        <button class="btn-primary" type="submit">Search</button>
      </form>
    </div>
  </section>

  <section class="blog-shell" aria-label="Search results">
    <?php if (have_posts()) : ?>
      <div class="blog-grid blog-grid--archive">
        <?php while (have_posts()) : the_post(); ?>
          <article <?php post_class('blog-card'); ?>>
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
              </div>
              <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
              <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 24)); ?></p>
              <a class="blog-read-link" href="<?php the_permalink(); ?>">Read result →</a>
            </div>
          </article>
        <?php endwhile; ?>
      </div>
    <?php else : ?>
      <section class="blog-empty">
        <p class="blog-kicker">No matches</p>
        <h2>Nothing surfaced from the fog.</h2>
        <p>Try a broader phrase like “pumpkin”, “mantel”, or “ceramic care”.</p>
        <a class="btn-primary" href="<?php echo esc_url(home_url('/resources/blog/')); ?>">Back to journal</a>
      </section>
    <?php endif; ?>
  </section>
</main>

<?php get_footer(); ?>

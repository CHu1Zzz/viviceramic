<?php
/** Archive template for categories, tags, and dates. */
global $hallow_body_class, $hallow_body_attrs;
$hallow_body_class = 'hallow-blog-page hallow-archive-page';
$hallow_body_attrs = '';
get_header();
?>

<main class="blog-page">
  <section class="blog-hero blog-hero--compact" aria-labelledby="archive-title">
    <div class="blog-orb blog-orb--moon" aria-hidden="true"></div>
    <div class="blog-hero-inner">
      <p class="blog-kicker">Journal archive</p>
      <h1 id="archive-title"><?php the_archive_title(); ?></h1>
      <?php if (get_the_archive_description()) : ?>
        <div class="archive-description"><?php the_archive_description(); ?></div>
      <?php else : ?>
        <p>Collected notes from the HallowCeramics journal.</p>
      <?php endif; ?>
    </div>
  </section>

  <section class="blog-shell" aria-label="Archive posts">
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
              <a class="blog-read-link" href="<?php the_permalink(); ?>">Read note →</a>
            </div>
          </article>
        <?php endwhile; ?>
      </div>

      <nav class="blog-pagination" aria-label="Archive pagination">
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
        <p class="blog-kicker">No notes yet</p>
        <h2>This archive is waiting for its first story.</h2>
        <a class="btn-primary" href="<?php echo esc_url(home_url('/blog/')); ?>">Back to journal</a>
      </section>
    <?php endif; ?>
  </section>
</main>

<?php get_footer(); ?>

<?php
/** Single post template. */
global $hallow_body_class, $hallow_body_attrs;
$hallow_body_class = 'hallow-blog-page hallow-single-post';
$hallow_body_attrs = '';
get_header();
$posts_page_id = (int) get_option('page_for_posts');
$journal_url = $posts_page_id > 0 ? get_permalink($posts_page_id) : home_url('/resources/blog/');
?>

<main class="single-journal">
  <?php while (have_posts()) : the_post(); ?>
    <article <?php post_class('single-journal-article'); ?>>
      <header class="single-journal-hero">
        <div class="single-journal-hero-copy">
          <p class="blog-kicker">Journal note</p>
          <h1><?php the_title(); ?></h1>
          <div class="blog-meta">
            <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date()); ?></time>
            <?php if (has_category()) : ?>
              <span aria-hidden="true">·</span>
              <span><?php the_category(', '); ?></span>
            <?php endif; ?>
          </div>
        </div>
        <div class="single-journal-media">
          <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('large', ['loading' => 'eager']); ?>
          <?php else : ?>
            <span class="blog-image-fallback" aria-hidden="true"></span>
          <?php endif; ?>
        </div>
      </header>

      <div class="single-journal-layout">
        <aside class="single-journal-aside" aria-label="Article actions">
          <a class="blog-read-link" href="<?php echo esc_url($journal_url); ?>">← Back to journal</a>
          <?php if (has_tag()) : ?>
            <div class="single-tags">
              <p>Filed under</p>
              <?php the_tags('', '', ''); ?>
            </div>
          <?php endif; ?>
        </aside>

        <div class="single-journal-content">
          <?php the_content(); ?>
          <?php
          wp_link_pages([
              'before' => '<nav class="blog-pagination single-page-links" aria-label="Post pages">',
              'after' => '</nav>',
          ]);
          ?>
        </div>
      </div>

      <section class="journal-shop-cta" aria-label="Shop the look">
        <p class="blog-kicker">Bring the look home</p>
        <h2>Build the vignette with ceramic pumpkins that hold the room.</h2>
        <p>Pair your journal inspiration with hand-finished pumpkins, moody accents, and small-batch seasonal pieces.</p>
        <div class="blog-hero-actions">
          <a class="btn-primary" href="<?php echo esc_url(home_url('/pumpkins/')); ?>">Shop pumpkins</a>
          <a class="btn-ghost" href="<?php echo esc_url(home_url('/shop/')); ?>">View all products</a>
        </div>
      </section>

      <nav class="single-post-nav" aria-label="Adjacent posts">
        <div><?php previous_post_link('%link', '← %title'); ?></div>
        <div><?php next_post_link('%link', '%title →'); ?></div>
      </nav>
    </article>
  <?php endwhile; ?>
</main>

<?php get_footer(); ?>

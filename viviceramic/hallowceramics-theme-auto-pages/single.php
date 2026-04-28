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
    <?php
    $raw_content = apply_filters('the_content', get_the_content());
    $toc_items = [];
    $slug_counter = [];

    $content_with_ids = preg_replace_callback('/<h([23])([^>]*)>(.*?)<\/h\1>/is', function (array $matches) use (&$toc_items, &$slug_counter): string {
        $level = (int) $matches[1];
        $attrs = (string) $matches[2];
        $inner_html = (string) $matches[3];
        $text = trim((string) wp_strip_all_tags($inner_html));

        if ($text === '') {
            return $matches[0];
        }

        $id = '';
        if (preg_match('/\sid=(["\'])(.*?)\1/i', $attrs, $id_match)) {
            $id = sanitize_title($id_match[2]);
        }

        if ($id === '') {
            $base = sanitize_title($text);
            if ($base === '') {
                $base = 'section';
            }
            $slug_counter[$base] = ($slug_counter[$base] ?? 0) + 1;
            $id = $slug_counter[$base] > 1 ? $base . '-' . $slug_counter[$base] : $base;
            $attrs .= ' id="' . esc_attr($id) . '"';
        }

        if ($level === 2) {
            $toc_items[] = [
                'id' => $id,
                'text' => $text,
            ];
        }

        return '<h' . $level . $attrs . '>' . $inner_html . '</h' . $level . '>';
    }, $raw_content);

    $intro_html = '';
    $body_html = trim((string) $content_with_ids);

    if (preg_match('/<h[23]\b/i', (string) $content_with_ids, $match, PREG_OFFSET_CAPTURE)) {
        $split_pos = (int) $match[0][1];
        $intro_html = trim(substr((string) $content_with_ids, 0, $split_pos));
        $body_html = trim(substr((string) $content_with_ids, $split_pos));
    } elseif (preg_match_all('/<p\b[^>]*>.*?<\/p>/is', (string) $content_with_ids, $paragraphs, PREG_OFFSET_CAPTURE)) {
        $first_blocks = min(2, count($paragraphs[0]));
        if ($first_blocks > 0) {
            $last_block = $paragraphs[0][$first_blocks - 1];
            $split_pos = (int) $last_block[1] + strlen($last_block[0]);
            $intro_html = trim(substr((string) $content_with_ids, 0, $split_pos));
            $body_html = trim(substr((string) $content_with_ids, $split_pos));
        }
    }

    if ($body_html === '') {
        $body_html = trim((string) $content_with_ids);
    }

    $read_minutes = max(1, (int) ceil(str_word_count((string) wp_strip_all_tags(get_post_field('post_content', get_the_ID()))) / 220));
    $intro_cta_url = hallow_get_seo_meta((int) get_the_ID(), '_hallow_intro_cta_url');
    $end_cta_url = hallow_get_seo_meta((int) get_the_ID(), '_hallow_end_cta_url');
    $intro_cta_url = $intro_cta_url !== '' ? $intro_cta_url : home_url('/pumpkins/');
    $end_cta_url = $end_cta_url !== '' ? $end_cta_url : home_url('/shop/');

    $manual_links_raw = hallow_get_seo_meta((int) get_the_ID(), '_hallow_learn_more_links');
    $learn_more_links = [];
    if ($manual_links_raw !== '') {
        $lines = preg_split('/\r\n|\r|\n/', $manual_links_raw);
        foreach ($lines as $line) {
            $line = trim((string) $line);
            if ($line === '') {
                continue;
            }

            $label = '';
            $url = '';
            if (strpos($line, '|') !== false) {
                [$label, $url] = array_map('trim', explode('|', $line, 2));
            } elseif (preg_match('#^https?://#i', $line)) {
                $url = $line;
                $label = preg_replace('#^https?://#i', '', $line);
            }

            if ($url !== '' && filter_var($url, FILTER_VALIDATE_URL)) {
                $learn_more_links[] = [
                    'label' => $label !== '' ? $label : $url,
                    'url' => $url,
                ];
            }
        }
    }

    if (count($learn_more_links) === 0) {
        $related_query = new WP_Query([
            'post_type' => 'post',
            'posts_per_page' => 4,
            'post__not_in' => [get_the_ID()],
            'ignore_sticky_posts' => true,
        ]);
        while ($related_query->have_posts()) {
            $related_query->the_post();
            $learn_more_links[] = [
                'label' => get_the_title(),
                'url' => get_permalink(),
            ];
        }
        wp_reset_postdata();
    }
    ?>
    <article <?php post_class('single-journal-article single-journal-article--thunder'); ?>>
      <header class="single-journal-head">
        <a class="blog-read-link single-back-link" href="<?php echo esc_url($journal_url); ?>">← Back to journal</a>
        <h1><?php the_title(); ?></h1>
        <p class="single-updated">Last updated on <?php echo esc_html(get_the_date('F j, Y')); ?></p>
        <div class="single-author-line">
          <span class="single-author"><?php echo get_avatar(get_the_author_meta('ID'), 32); ?> by <?php the_author(); ?></span>
          <span aria-hidden="true">·</span>
          <span><?php echo esc_html($read_minutes); ?> min read</span>
        </div>
        <div class="single-journal-cover">
          <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('large', ['loading' => 'eager']); ?>
          <?php else : ?>
            <span class="blog-image-fallback" aria-hidden="true"></span>
          <?php endif; ?>
        </div>
      </header>

      <div class="single-journal-layout single-journal-layout--toc">
        <div class="single-journal-main">
          <?php if ($intro_html !== '') : ?>
            <div class="single-journal-intro">
              <?php echo wp_kses_post($intro_html); ?>
            </div>
          <?php endif; ?>

          <section class="journal-inline-cta journal-inline-cta--intro" aria-label="Intro shop callout">
            <div class="journal-inline-cta-illustration" aria-hidden="true">
              <span>🎃</span>
            </div>
            <div class="journal-inline-cta-copy">
              <h3>Build your Halloween setup in 2 clicks.</h3>
              <p>Shop hand-carved ceramic pumpkins and style accents in one curated collection.</p>
              <a class="btn-primary" href="<?php echo esc_url($intro_cta_url); ?>">Shop the Pumpkin Edit</a>
            </div>
          </section>

          <div class="single-journal-content">
            <?php echo wp_kses_post($body_html); ?>
            <?php
            wp_link_pages([
                'before' => '<nav class="blog-pagination single-page-links" aria-label="Post pages">',
                'after' => '</nav>',
            ]);
            ?>
          </div>

          <section class="journal-inline-cta journal-inline-cta--end" aria-label="End shop callout">
            <div class="journal-inline-cta-copy">
              <h3>Try HallowCeramics for Signature Pumpkin Decor</h3>
            </div>
            <div class="journal-inline-cta-actions">
              <a class="btn-primary journal-shop-btn" href="<?php echo esc_url($end_cta_url); ?>">Go to Shop</a>
            </div>
          </section>

          <section class="single-learn-more" aria-label="Learn more">
            <h3>Learn More</h3>
            <ul>
              <?php foreach ($learn_more_links as $item) : ?>
                <li><a href="<?php echo esc_url($item['url']); ?>"><?php echo esc_html($item['label']); ?></a></li>
              <?php endforeach; ?>
            </ul>
          </section>

          <nav class="single-post-nav" aria-label="Adjacent posts">
            <div><?php previous_post_link('%link', '← %title'); ?></div>
            <div><?php next_post_link('%link', '%title →'); ?></div>
          </nav>
        </div>

        <aside class="single-journal-toc" aria-label="Table of contents">
          <div class="single-journal-toc-card">
            <p>Table of Contents</p>
            <?php if (count($toc_items) > 0) : ?>
              <ul>
                <?php foreach ($toc_items as $item) : ?>
                  <li><a href="#<?php echo esc_attr($item['id']); ?>"><?php echo esc_html($item['text']); ?></a></li>
                <?php endforeach; ?>
              </ul>
            <?php else : ?>
              <ul><li><span>Publish headings (H2/H3) to generate the article outline.</span></li></ul>
            <?php endif; ?>
          </div>
        </aside>
      </div>
    </article>
  <?php endwhile; ?>
</main>

<?php get_footer(); ?>

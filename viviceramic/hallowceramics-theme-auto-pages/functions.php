<?php
/**
 * HallowCeramics standalone theme functions (no code router version).
 */

if (! defined('ABSPATH')) {
    exit;
}

const HALLOW_AUTO_PAGES_VERSION = '1.3.1';

function hallow_asset_version(string $relative_path): string
{
    $file = get_template_directory() . $relative_path;
    return file_exists($file) ? (string) filemtime($file) : '1.0.0';
}

function hallow_cart_url(): string
{
    if (function_exists('wc_get_cart_url')) {
        return wc_get_cart_url();
    }

    return home_url('/cart/');
}

function hallow_account_url(): string
{
    if (function_exists('wc_get_page_permalink')) {
        return wc_get_page_permalink('myaccount');
    }

    return home_url('/my-account/');
}

function hallow_is_catalog_context(): bool
{
    return is_page_template('page-products.php')
        || is_page_template('page-products-pumpkins.php')
        || is_page_template('page-products-others.php');
}

add_action('wp_enqueue_scripts', function (): void {
    wp_enqueue_style(
        'hallow-fonts',
        get_template_directory_uri() . '/assets/css/fonts.css',
        [],
        hallow_asset_version('/assets/css/fonts.css')
    );

    wp_enqueue_style(
        'hallow-frontend',
        get_template_directory_uri() . '/assets/css/styles.css',
        ['hallow-fonts'],
        hallow_asset_version('/assets/css/styles.css')
    );

    wp_enqueue_script(
        'hallow-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        hallow_asset_version('/assets/js/main.js'),
        true
    );

    // catalog-page.js removed — product cards now rendered server-side via WooCommerce

    if (is_home() || is_single() || is_archive() || is_search()) {
        wp_enqueue_script(
            'hallow-blog-anim',
            get_template_directory_uri() . '/assets/js/blog-anim.js',
            ['hallow-main'],
            hallow_asset_version('/assets/js/blog-anim.js'),
            true
        );
    }

    if (is_product()) {
        wp_enqueue_script(
            'hallow-product-detail',
            get_template_directory_uri() . '/assets/js/product-detail.js',
            ['hallow-main'],
            hallow_asset_version('/assets/js/product-detail.js'),
            true
        );
    }
});

add_action('after_setup_theme', function (): void {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('woocommerce');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', ['search-form', 'gallery', 'caption', 'style', 'script']);
    add_post_type_support('post', 'excerpt');
});


function hallow_find_or_create_page(string $title, string $slug, string $template = '', int $parent_id = 0): int
{
    $page = get_page_by_path($slug, OBJECT, 'page');
    $page_slug = basename($slug);

    if (! ($page instanceof WP_Post) && $parent_id > 0) {
        $page = get_page_by_path($page_slug, OBJECT, 'page');
    }

    if ($page instanceof WP_Post) {
        $page_id = (int) $page->ID;
    } else {
        $page_id = wp_insert_post([
            'post_title' => $title,
            'post_name' => $page_slug,
            'post_type' => 'page',
            'post_status' => 'publish',
            'post_content' => '',
            'post_parent' => $parent_id,
            'comment_status' => 'closed',
            'ping_status' => 'closed',
        ]);

        if (is_wp_error($page_id)) {
            return 0;
        }

        $page_id = (int) $page_id;
    }

    if ($template !== '') {
        update_post_meta($page_id, '_wp_page_template', $template);
    }

    if ($parent_id > 0 && (int) wp_get_post_parent_id($page_id) !== $parent_id) {
        wp_update_post([
            'ID' => $page_id,
            'post_parent' => $parent_id,
        ]);
    }

    return $page_id;
}

function hallow_setup_default_pages(): void
{
    $home_id = hallow_find_or_create_page('Home', 'home');
    $resources_id = hallow_find_or_create_page('Resources', 'resources', 'page-resources.php');
    $blog_id = hallow_find_or_create_page('Blog', 'resources/blog', '', $resources_id);
    hallow_find_or_create_page('About Us', 'about-us', 'page-about.php');
    hallow_find_or_create_page('Contact', 'contact', 'page-contact.php');
    hallow_find_or_create_page('Shop', 'shop', 'page-products.php');
    hallow_find_or_create_page('Pumpkins', 'pumpkins', 'page-products-pumpkins.php');
    hallow_find_or_create_page('Others', 'others', 'page-products-others.php');

    if ($home_id > 0) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $home_id);
    }

    if ($blog_id > 0) {
        update_option('page_for_posts', $blog_id);
    }

    // Ensure WooCommerce pages exist (cart, checkout, my-account, shop)
    if (class_exists('WooCommerce')) {
        $wc_pages = [
            'cart'     => ['title' => 'Cart',     'content' => '[woocommerce_cart]'],
            'checkout' => ['title' => 'Checkout', 'content' => '[woocommerce_checkout]'],
            'myaccount'=> ['title' => 'My account','content' => '[woocommerce_my_account]'],
        ];
        foreach ($wc_pages as $slug => $data) {
            $existing_id = get_option('woocommerce_' . $slug . '_page_id');
            if (! $existing_id || ! get_post($existing_id)) {
                $page_id = wp_insert_post([
                    'post_title'     => $data['title'],
                    'post_name'      => $slug,
                    'post_content'   => $data['content'],
                    'post_type'      => 'page',
                    'post_status'    => 'publish',
                    'comment_status' => 'closed',
                    'ping_status'    => 'closed',
                ]);
                if ($page_id && ! is_wp_error($page_id)) {
                    update_option('woocommerce_' . $slug . '_page_id', $page_id);
                }
            }
        }
    }

    // Create WooCommerce product categories if they don't exist
    if (taxonomy_exists('product_cat')) {
        $categories = ['pumpkins' => 'Pumpkins', 'others' => 'Others'];
        foreach ($categories as $slug => $name) {
            if (! term_exists($name, 'product_cat')) {
                wp_insert_term($name, 'product_cat', ['slug' => $slug]);
            }
        }
    }

    // Register WooCommerce product attributes used by single-product template
    if (function_exists('wc_create_attribute')) {
        $attributes = [
            'material' => 'Material',
            'finish'   => 'Finish',
            'care'     => 'Care',
            'use'      => 'Use',
        ];
        foreach ($attributes as $slug => $name) {
            if (! wc_attribute_taxonomy_id_by_name($slug)) {
                wc_create_attribute([
                    'name'         => $name,
                    'slug'         => $slug,
                    'type'         => 'select',
                    'order_by'     => 'menu_order',
                    'has_archives' => false,
                ]);
            }
        }
    }

    update_option('hallow_auto_pages_created', time());
    update_option('hallow_auto_pages_version', HALLOW_AUTO_PAGES_VERSION);
    flush_rewrite_rules(false);
}

add_action('after_switch_theme', 'hallow_setup_default_pages');

add_action('admin_init', function (): void {
    if (get_option('hallow_auto_pages_version') !== HALLOW_AUTO_PAGES_VERSION) {
        hallow_setup_default_pages();
    }
});

function hallow_get_seo_meta(int $post_id, string $key): string
{
    return trim((string) get_post_meta($post_id, $key, true));
}

add_action('add_meta_boxes', function (): void {
    add_meta_box(
        'hallow-seo-meta',
        'Hallow SEO Meta',
        'hallow_render_seo_meta_box',
        'post',
        'normal',
        'high'
    );
});

function hallow_render_seo_meta_box(WP_Post $post): void
{
    wp_nonce_field('hallow_save_seo_meta', 'hallow_seo_meta_nonce');

    $meta_title = hallow_get_seo_meta((int) $post->ID, '_hallow_meta_title');
    $meta_description = hallow_get_seo_meta((int) $post->ID, '_hallow_meta_description');
    $canonical_url = hallow_get_seo_meta((int) $post->ID, '_hallow_canonical_url');
    $intro_cta_url = hallow_get_seo_meta((int) $post->ID, '_hallow_intro_cta_url');
    $end_cta_url = hallow_get_seo_meta((int) $post->ID, '_hallow_end_cta_url');
    $learn_more_links = hallow_get_seo_meta((int) $post->ID, '_hallow_learn_more_links');
    ?>
    <p>
        <label for="hallow_meta_title"><strong>Meta title</strong></label><br />
        <input
            type="text"
            id="hallow_meta_title"
            name="hallow_meta_title"
            value="<?php echo esc_attr($meta_title); ?>"
            style="width:100%;max-width:760px;"
            maxlength="70"
            placeholder="<?php echo esc_attr(get_the_title($post)); ?>"
        />
        <br /><span class="description">Recommended: around 50-60 characters. If empty, WordPress uses the post title.</span>
    </p>
    <p>
        <label for="hallow_meta_description"><strong>Meta description</strong></label><br />
        <textarea
            id="hallow_meta_description"
            name="hallow_meta_description"
            rows="4"
            style="width:100%;max-width:760px;"
            maxlength="180"
            placeholder="Short search result description for this journal article."
        ><?php echo esc_textarea($meta_description); ?></textarea>
        <br /><span class="description">Recommended: around 140-160 characters. If empty, the excerpt is used.</span>
    </p>
    <p>
        <label for="hallow_canonical_url"><strong>Canonical URL</strong></label><br />
        <input
            type="url"
            id="hallow_canonical_url"
            name="hallow_canonical_url"
            value="<?php echo esc_attr($canonical_url); ?>"
            style="width:100%;max-width:760px;"
            placeholder="<?php echo esc_url(get_permalink($post)); ?>"
        />
        <br /><span class="description">Optional. Leave empty unless this post should point search engines to another canonical URL.</span>
    </p>
    <hr />
    <p>
        <label for="hallow_intro_cta_url"><strong>Intro CTA URL</strong></label><br />
        <input
            type="url"
            id="hallow_intro_cta_url"
            name="hallow_intro_cta_url"
            value="<?php echo esc_attr($intro_cta_url); ?>"
            style="width:100%;max-width:760px;"
            placeholder="<?php echo esc_url(home_url('/pumpkins/')); ?>"
        />
        <br /><span class="description">Optional. Button target for the top inline CTA card.</span>
    </p>
    <p>
        <label for="hallow_end_cta_url"><strong>End CTA URL</strong></label><br />
        <input
            type="url"
            id="hallow_end_cta_url"
            name="hallow_end_cta_url"
            value="<?php echo esc_attr($end_cta_url); ?>"
            style="width:100%;max-width:760px;"
            placeholder="<?php echo esc_url(home_url('/shop/')); ?>"
        />
        <br /><span class="description">Optional. Button target for the bottom inline CTA card.</span>
    </p>
    <p>
        <label for="hallow_learn_more_links"><strong>Learn more links</strong></label><br />
        <textarea
            id="hallow_learn_more_links"
            name="hallow_learn_more_links"
            rows="5"
            style="width:100%;max-width:760px;"
            placeholder="Article Label | https://example.com/article&#10;Second Link | https://example.com/second"
        ><?php echo esc_textarea($learn_more_links); ?></textarea>
        <br /><span class="description">Optional. One link per line using: Title | URL. Leave empty to auto-show recent posts.</span>
    </p>
    <?php
}

add_action('save_post_post', function (int $post_id): void {
    if (! isset($_POST['hallow_seo_meta_nonce']) || ! wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['hallow_seo_meta_nonce'])), 'hallow_save_seo_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (! current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = [
        '_hallow_meta_title' => 'hallow_meta_title',
        '_hallow_meta_description' => 'hallow_meta_description',
        '_hallow_canonical_url' => 'hallow_canonical_url',
        '_hallow_intro_cta_url' => 'hallow_intro_cta_url',
        '_hallow_end_cta_url' => 'hallow_end_cta_url',
        '_hallow_learn_more_links' => 'hallow_learn_more_links',
    ];

    foreach ($fields as $meta_key => $field_name) {
        $value = isset($_POST[$field_name]) ? trim((string) wp_unslash($_POST[$field_name])) : '';

        if ($meta_key === '_hallow_canonical_url' || $meta_key === '_hallow_intro_cta_url' || $meta_key === '_hallow_end_cta_url') {
            $value = esc_url_raw($value);
        } elseif ($meta_key === '_hallow_learn_more_links') {
            $value = sanitize_textarea_field($value);
        } else {
            $value = sanitize_text_field($value);
        }

        if ($value === '') {
            delete_post_meta($post_id, $meta_key);
        } else {
            update_post_meta($post_id, $meta_key, $value);
        }
    }
});

add_filter('pre_get_document_title', function (string $title): string {
    if (! is_singular('post')) {
        return $title;
    }

    $meta_title = hallow_get_seo_meta((int) get_queried_object_id(), '_hallow_meta_title');
    return $meta_title !== '' ? $meta_title : $title;
});

add_action('wp', function (): void {
    if (is_singular('post')) {
        remove_action('wp_head', 'rel_canonical');
    }
});

add_action('wp_head', function (): void {
    if (! is_singular('post')) {
        return;
    }

    $post_id = (int) get_queried_object_id();
    $meta_title = hallow_get_seo_meta($post_id, '_hallow_meta_title');
    $meta_description = hallow_get_seo_meta($post_id, '_hallow_meta_description');
    $canonical_url = hallow_get_seo_meta($post_id, '_hallow_canonical_url');

    if ($meta_description === '') {
        $meta_description = get_the_excerpt($post_id);
    }

    if ($canonical_url === '') {
        $canonical_url = get_permalink($post_id);
    }

    $display_title = $meta_title !== '' ? $meta_title : get_the_title($post_id);

    if ($meta_description !== '') {
        echo '<meta name="description" content="' . esc_attr(wp_strip_all_tags($meta_description)) . '">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr(wp_strip_all_tags($meta_description)) . '">' . "\n";
    }

    echo '<meta property="og:title" content="' . esc_attr($display_title) . '">' . "\n";
    echo '<meta property="og:type" content="article">' . "\n";
    echo '<link rel="canonical" href="' . esc_url($canonical_url) . '">' . "\n";
}, 1);

<?php
/**
 * HallowCeramics standalone theme functions (no code router version).
 */

if (! defined('ABSPATH')) {
    exit;
}

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
        'hallow-google-fonts',
        'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;1,500&family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&display=swap',
        [],
        null
    );

    wp_enqueue_style(
        'hallow-frontend',
        get_template_directory_uri() . '/assets/css/styles.css',
        ['hallow-google-fonts'],
        hallow_asset_version('/assets/css/styles.css')
    );

    wp_enqueue_script(
        'hallow-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        hallow_asset_version('/assets/js/main.js'),
        true
    );

    if (hallow_is_catalog_context()) {
        wp_enqueue_script(
            'hallow-catalog',
            get_template_directory_uri() . '/assets/js/catalog-page.js',
            ['hallow-main'],
            hallow_asset_version('/assets/js/catalog-page.js'),
            true
        );
    }
});

add_action('after_setup_theme', function (): void {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('woocommerce');
});


function hallow_find_or_create_page(string $title, string $slug, string $template = ''): int
{
    $page = get_page_by_path($slug, OBJECT, 'page');

    if ($page instanceof WP_Post) {
        $page_id = (int) $page->ID;
    } else {
        $page_id = wp_insert_post([
            'post_title' => $title,
            'post_name' => $slug,
            'post_type' => 'page',
            'post_status' => 'publish',
            'post_content' => '',
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

    return $page_id;
}

function hallow_setup_default_pages(): void
{
    $home_id = hallow_find_or_create_page('Home', 'home');
    hallow_find_or_create_page('About Us', 'about-us', 'page-about.php');
    hallow_find_or_create_page('Contact', 'contact', 'page-contact.php');
    hallow_find_or_create_page('Resources', 'resources', 'page-resources.php');
    hallow_find_or_create_page('Shop', 'shop', 'page-products.php');
    hallow_find_or_create_page('Pumpkins', 'pumpkins', 'page-products-pumpkins.php');
    hallow_find_or_create_page('Others', 'others', 'page-products-others.php');

    if ($home_id > 0) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $home_id);
    }

    update_option('hallow_auto_pages_created', time());
    flush_rewrite_rules(false);
}

add_action('after_switch_theme', 'hallow_setup_default_pages');

add_action('admin_init', function (): void {
    if (! get_option('hallow_auto_pages_created')) {
        hallow_setup_default_pages();
    }
});

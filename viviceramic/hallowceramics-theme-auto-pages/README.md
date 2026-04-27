# HallowCeramics Auto Pages Theme

This is a standalone WordPress parent theme generated from the coded HallowCeramics frontend. It does **not** depend on Blocksy and does **not** use custom code routing.

## What This Version Does

When the theme is activated, it automatically creates these WordPress pages if they do not already exist, assigns the correct template, and sets Home as the static homepage:

| Page title | Slug | Template |
| --- | --- | --- |
| Home | `home` | Rendered by `front-page.php` after being set as static homepage |
| About Us | `about-us` | `page-about.php` |
| Contact | `contact` | `page-contact.php` |
| Resources | `resources` | Redirects to `/resources/blog/` |
| Blog | `resources/blog` | Rendered by WordPress posts page using `home.php` |
| Shop | `shop` | `page-products.php` |
| Pumpkins | `pumpkins` | `page-products-pumpkins.php` |
| Others | `others` | `page-products-others.php` |

## Upload

Upload `hallowceramics-theme-auto-pages.zip` in WordPress:

```text
Appearance -> Themes -> Add New Theme -> Upload Theme
```

Then activate **HallowCeramics Auto Pages**.

## If Pages Do Not Show Immediately

Go to:

```text
Settings -> Permalinks -> Save Changes
```

This refreshes WordPress URL rules.

## Blog Notes

The theme creates a child `Blog` page under `Resources` and sets it as the WordPress posts page. The public blog URL is:

```text
/resources/blog/
```

Publish articles from:

```text
Posts -> Add New
```

Featured images become the journal card and article hero images. Categories and tags automatically use the matching archive template.

## Blog SEO Meta

When editing a WordPress post, use the **Hallow SEO Meta** box to set:

- Meta title
- Meta description
- Canonical URL

The theme outputs these values on single post pages. If a meta description is empty, the post excerpt is used instead.

## If You Delete Pages Later

Normal updates to CSS, JS, templates, images, or WooCommerce products do not affect these pages. Only if you manually delete a core page like About Us or Shop will you need to restore it manually or reset the `hallow_auto_pages_created` option and reactivate the theme.

## Assets

The theme includes:

- `assets/css/styles.css`
- `assets/js/main.js`
- `assets/js/catalog-page.js`
- `assets/media/pumpkin_alpha.webm`

## WooCommerce Notes

Cart/account icons use WooCommerce URLs when WooCommerce is active. Product list pages currently use the static `catalog-page.js` product data and can later be swapped to WooCommerce product data.

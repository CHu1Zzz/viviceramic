<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php wp_head(); ?>
  </head>
  <?php
  global $hallow_body_class, $hallow_body_attrs;
  $hallow_body_class = isset($hallow_body_class) ? $hallow_body_class : '';
  $hallow_body_attrs = isset($hallow_body_attrs) ? $hallow_body_attrs : '';
  ?>
  <body <?php body_class($hallow_body_class); ?><?php echo $hallow_body_attrs; ?>>
    <?php wp_body_open(); ?>
    <header class="site-header">
      <div class="header-inner">
        <a class="logo-link" href="<?php echo esc_url(home_url('/')); ?>" aria-label="HallowCeramics home">
          <span class="logo-mark" aria-hidden="true"></span>
          HallowCeramics
        </a>
        <nav class="nav-main" aria-label="Primary">
          <a href="<?php echo esc_url(home_url('/shop/')); ?>" <?php echo is_page(array('shop', 'products', 'pumpkins', 'others')) ? 'class="is-active"' : ''; ?> data-i18n="navProducts">All Product</a>
          <a href="<?php echo esc_url(home_url('/resources/')); ?>" <?php echo is_page('resources') ? 'class="is-active"' : ''; ?> data-i18n="navResources">Resources</a>
          <a href="<?php echo esc_url(home_url('/about-us/')); ?>" <?php echo is_page(array('about', 'about-us')) ? 'class="is-active"' : ''; ?> data-i18n="navAbout">About us</a>
          <a href="<?php echo esc_url(home_url('/contact/')); ?>" <?php echo is_page('contact') ? 'class="is-active"' : ''; ?> data-i18n="navContact">Contact</a>
        </nav>
        <div class="header-actions">
          <button type="button" class="icon-btn lang-btn" id="lang-toggle" aria-label="Switch language">EN</button>
          <a href="<?php echo esc_url(hallow_cart_url()); ?>" class="icon-btn" aria-label="Cart">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
              <path d="M6 8h15l-1.5 9H7.5L6 8zm0 0L5 3H2" stroke-linecap="round" stroke-linejoin="round" />
              <circle cx="9" cy="20" r="1.5" fill="currentColor" stroke="none" />
              <circle cx="18" cy="20" r="1.5" fill="currentColor" stroke="none" />
            </svg>
          </a>
          <a href="<?php echo esc_url(hallow_account_url()); ?>" class="icon-btn" aria-label="Account">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
              <circle cx="12" cy="8" r="3.5" />
              <path d="M5 20v-1c0-3 2.5-5.5 7-5.5s7 2.5 7 5.5v1" stroke-linecap="round" />
            </svg>
          </a>
        </div>
      </div>
    </header>

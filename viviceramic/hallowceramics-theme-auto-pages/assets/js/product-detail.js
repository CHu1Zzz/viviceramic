/**
 * HallowCeramics — Product Detail interactions.
 * Thumbnail switcher, quantity selector, lightbox, tabs.
 * Reuses footer.php #lightbox for image zoom.
 */
(function () {
  'use strict';

  var images = window.__hallowProductImages || [];
  var maxQty = window.__hallowProductMaxQty || 99;
  var currentIdx = 0;

  /* ===== Image Switcher ===== */
  window.hallowSwitchImage = function (idx) {
    if (idx < 0 || idx >= images.length) return;
    currentIdx = idx;
    var main = document.getElementById('mainImage');
    if (main) main.src = images[idx];
    document.querySelectorAll('.thumbnail-btn').forEach(function (btn, i) {
      btn.classList.toggle('active', i === idx);
    });
  };

  /* ===== Quantity Selector ===== */
  window.hallowChangeQty = function (delta) {
    var input = document.getElementById('qtyInput');
    if (!input) return;
    var val = parseInt(input.value, 10) + delta;
    if (isNaN(val)) val = 1;
    if (val < 1) val = 1;
    if (val > maxQty) val = maxQty;
    input.value = val;
    hallowUpdateActionUrls(val);
  };

  function hallowUpdateActionUrls(qty) {
    var addBtn = document.getElementById('addCartBtn');
    var buyBtn = document.getElementById('buyNowBtn');
    if (addBtn) {
      var href = addBtn.getAttribute('href');
      href = href.replace(/([?&])quantity=\d+/, '$1quantity=' + qty);
      if (href.indexOf('quantity=') === -1) {
        href += (href.indexOf('?') === -1 ? '?' : '&') + 'quantity=' + qty;
      }
      addBtn.setAttribute('href', href);
    }
    if (buyBtn) {
      var bhref = buyBtn.getAttribute('href');
      bhref = bhref.replace(/([?&])quantity=\d+/, '$1quantity=' + qty);
      if (bhref.indexOf('quantity=') === -1) {
        bhref += (bhref.indexOf('?') === -1 ? '?' : '&') + 'quantity=' + qty;
      }
      buyBtn.setAttribute('href', bhref);
    }
  }

  /* ===== Lightbox (reuses footer.php #lightbox) ===== */
  var mainImageWrap = document.getElementById('mainImageWrap');
  if (mainImageWrap) {
    mainImageWrap.addEventListener('click', hallowOpenLightbox);
    mainImageWrap.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        hallowOpenLightbox();
      }
    });
  }

  function hallowOpenLightbox() {
    var lb = document.getElementById('lightbox');
    var lbImg = document.getElementById('lightbox-img');
    if (!lb || !lbImg) return;
    lbImg.src = images[currentIdx] || '';
    lb.classList.add('is-open');
    document.body.style.overflow = 'hidden';
  }

  // Close via button or overlay click is handled by main.js initLightbox()
  // We add Escape handling as a safety net
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      var lb = document.getElementById('lightbox');
      if (lb && lb.classList.contains('is-open')) {
        lb.classList.remove('is-open');
        document.body.style.overflow = '';
      }
    }
  });

  /* ===== Tab Switcher ===== */
  window.hallowSwitchTab = function (idx) {
    document.querySelectorAll('.product-tab-btn').forEach(function (btn, i) {
      btn.classList.toggle('active', i === idx);
      btn.setAttribute('aria-selected', i === idx ? 'true' : 'false');
    });
    document.querySelectorAll('.product-tab-panel').forEach(function (panel, i) {
      panel.classList.toggle('active', i === idx);
    });
  };

  /* ===== AJAX Add to Cart ===== */
  var addCartBtn = document.getElementById('addCartBtn');
  var buyNowBtn = document.getElementById('buyNowBtn');
  var productId = window.__hallowProductId || 0;
  var ajaxUrl = window.__ajaxUrl || '/wp-admin/admin-ajax.php';
  var nonce = window.__addToCartNonce || '';

  function showToast(message, type) {
    var toast = document.getElementById('hallow-toast') || createToast();
    toast.querySelector('.toast-message').textContent = message;
    toast.querySelector('.toast-icon').innerHTML = type === 'success'
      ? '<polyline points="20,6 9,17 4,12" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>'
      : '<circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/><line x1="15" y1="9" x2="9" y2="15" stroke="currentColor" stroke-width="2"/><line x1="9" y1="9" x2="15" y2="15" stroke="currentColor" stroke-width="2"/>';
    toast.className = 'hallow-toast is-visible ' + (type || 'success');
    clearTimeout(toast._timeout);
    toast._timeout = setTimeout(function() {
      toast.classList.remove('is-visible');
    }, 3000);
  }

  function createToast() {
    var toast = document.createElement('div');
    toast.id = 'hallow-toast';
    toast.className = 'hallow-toast';
    toast.innerHTML = '<div class="toast-icon"></div><span class="toast-message"></span>';
    document.body.appendChild(toast);
    return toast;
  }

  function ajaxAddToCart(productId, quantity, successUrl) {
    var btn = addCartBtn;
    var originalText = btn.querySelector('span') ? btn.querySelector('span').textContent : btn.textContent;
    var originalHtml = btn.innerHTML;

    // Show loading state
    btn.disabled = true;
    btn.innerHTML = '<svg class="spin" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18"><circle cx="12" cy="12" r="10" opacity="0.25"/><path d="M12 2a10 10 0 0 1 10 10" stroke-linecap="round"/></svg><span>Adding...</span>';

    var xhr = new XMLHttpRequest();
    xhr.open('POST', ajaxUrl, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
      btn.disabled = false;
      btn.innerHTML = originalHtml;

      if (xhr.status === 200) {
        try {
          var response = JSON.parse(xhr.responseText);
          if (response.success) {
            showToast(response.data.message || 'Added to cart!', 'success');
            updateCartBadge(response.data.cart_count);
            // Refresh cart fragment if available
            document.dispatchEvent(new CustomEvent('hallow_cart_updated', { detail: response.data }));
          } else {
            showToast(response.data.message || 'Could not add to cart.', 'error');
          }
        } catch (e) {
          // Fallback: redirect to cart
          if (successUrl) window.location.href = successUrl;
        }
      } else {
        showToast('Something went wrong. Please try again.', 'error');
      }
    };
    xhr.onerror = function() {
      btn.disabled = false;
      btn.innerHTML = originalHtml;
      // Fallback: redirect to cart
      if (successUrl) window.location.href = successUrl;
    };
    xhr.send('action=hallow_ajax_add_to_cart&security=' + nonce + '&product_id=' + productId + '&quantity=' + quantity);
  }

  function updateCartBadge(count) {
    var badge = document.querySelector('.cart-badge');
    if (badge) {
      badge.textContent = count;
      badge.style.display = count > 0 ? 'flex' : 'none';
    }
  }

  if (addCartBtn) {
    addCartBtn.addEventListener('click', function(e) {
      e.preventDefault();
      var qtyInput = document.getElementById('qtyInput');
      var quantity = qtyInput ? parseInt(qtyInput.value) || 1 : 1;
      var href = addCartBtn.getAttribute('href');
      var cartUrl = href ? href.split('?')[0] : '';
      ajaxAddToCart(productId, quantity, cartUrl);
    });
  }

  if (buyNowBtn) {
    buyNowBtn.addEventListener('click', function(e) {
      e.preventDefault();
      var qtyInput = document.getElementById('qtyInput');
      var quantity = qtyInput ? parseInt(qtyInput.value) || 1 : 1;
      var href = buyNowBtn.getAttribute('href');
      var checkoutUrl = href ? href.split('?')[0] : '';
      ajaxAddToCart(productId, quantity, checkoutUrl);
    });
  }

})();

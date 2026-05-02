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

})();

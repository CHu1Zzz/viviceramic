(function () {
  "use strict";

  var PUMPKINS = [
    { name: "Heritage Stem Classic", from: 189, sale: false, img: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3Crect fill='%23c45c1a' width='1' height='1'/%3E%3C/svg%3E" },
    { name: "Ember Glaze Medium", from: 219, sale: true, was: 249, img: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3Crect fill='%23c45c1a' width='1' height='1'/%3E%3C/svg%3E" },
    { name: "Petite Patch Triad", from: 129, sale: false, img: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3Crect fill='%23c45c1a' width='1' height='1'/%3E%3C/svg%3E" },
    { name: "Taper Throne Base", from: 89, sale: false, img: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3Crect fill='%23c45c1a' width='1' height='1'/%3E%3C/svg%3E" },
    { name: "Moonlit Satin Gourd", from: 159, sale: false, img: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3Crect fill='%23c45c1a' width='1' height='1'/%3E%3C/svg%3E" },
    { name: "Cobweb Mini Duo", from: 99, sale: true, was: 119, img: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3Crect fill='%23c45c1a' width='1' height='1'/%3E%3C/svg%3E" },
    { name: "Harvest Rim Large", from: 249, sale: false, img: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3Crect fill='%23c45c1a' width='1' height='1'/%3E%3C/svg%3E" },
    { name: "Cobalt Stem Sculpt", from: 199, sale: false, img: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3Crect fill='%23c45c1a' width='1' height='1'/%3E%3C/svg%3E" },
    { name: "Witching Hour Small", from: 79, sale: false, img: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3Crect fill='%23c45c1a' width='1' height='1'/%3E%3C/svg%3E" },
    { name: "Hollow King XL", from: 289, sale: false, img: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3Crect fill='%23c45c1a' width='1' height='1'/%3E%3C/svg%3E" },
  ];

  var OTHERS = [
    { name: "Candle Crown Holder", from: 69, sale: false, img: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3Crect fill='%236b2d8a' width='1' height='1'/%3E%3C/svg%3E" },
    { name: "Phantom Pedestal Set", from: 119, sale: false, img: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3Crect fill='%236b2d8a' width='1' height='1'/%3E%3C/svg%3E" },
    { name: "Ritual Bowl Duo", from: 95, sale: true, was: 115, img: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3Crect fill='%236b2d8a' width='1' height='1'/%3E%3C/svg%3E" },
    { name: "Ash Glaze Vase", from: 149, sale: false, img: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3Crect fill='%236b2d8a' width='1' height='1'/%3E%3C/svg%3E" },
    { name: "Spine Taper Stand", from: 59, sale: false, img: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3Crect fill='%236b2d8a' width='1' height='1'/%3E%3C/svg%3E" },
    { name: "Midnight Pillar Tray", from: 85, sale: false, img: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3Crect fill='%236b2d8a' width='1' height='1'/%3E%3C/svg%3E" },
    { name: "Copper Footed Cup", from: 45, sale: false, img: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3Crect fill='%236b2d8a' width='1' height='1'/%3E%3C/svg%3E" },
    { name: "Obsidian Stone Jar", from: 175, sale: false, img: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3Crect fill='%236b2d8a' width='1' height='1'/%3E%3C/svg%3E" },
    { name: "Bramble Relief Plate", from: 65, sale: true, was: 79, img: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3Crect fill='%236b2d8a' width='1' height='1'/%3E%3C/svg%3E" },
    { name: "Ember Wick Snuffer", from: 39, sale: false, img: "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3Crect fill='%236b2d8a' width='1' height='1'/%3E%3C/svg%3E" },
  ];

  function esc(s) {
    var d = document.createElement("div");
    d.textContent = s;
    return d.innerHTML;
  }

  function cardHtml(p) {
    var saleBadge = p.sale ? '<span class="pl-card-badge" data-i18n="catalogSale">Sale</span>' : "";
    var priceLine;
    if (p.sale && p.was) {
      priceLine =
        '<p class="pl-card-price">' +
        '<span class="pl-price-was">$' +
        p.was +
        ' USD</span> <span class="pl-price-now">From $' +
        p.from +
        " USD</span></p>";
    } else {
      priceLine = '<p class="pl-card-price">From $' + p.from + " USD</p>";
    }
    return (
      '<article class="pl-card">' +
      '<a class="pl-card-visual" href="../product-detail-reference.html">' +
      saleBadge +
      '<img src="' +
      esc(p.img) +
      '" alt="" width="600" height="600" loading="lazy" decoding="async" />' +
      '</a>' +
      '<div class="pl-card-body">' +
      '<h3 class="pl-card-title">' +
      esc(p.name) +
      '</h3>' +
      priceLine +
      '<div class="pl-card-actions">' +
      '<button type="button" class="pl-btn pl-btn--primary" data-i18n="catalogAddCart">Add to cart</button>' +
      '<a class="pl-btn pl-btn--secondary" href="../product-detail-reference.html" data-i18n="catalogLearn">Learn more</a>' +
      "</div>" +
      "</div>" +
      "</article>"
    );
  }

  function mount(selector, list) {
    var el = document.querySelector(selector);
    if (!el) return;
    el.innerHTML = list.map(cardHtml).join("");
  }

  document.addEventListener("DOMContentLoaded", function () {
    var page = document.body.getAttribute("data-catalog");

    if (page === "all") {
      mount("#pl-mount-pumpkins", PUMPKINS);
      mount("#pl-mount-others", OTHERS);
    } else if (page === "pumpkins") {
      mount("#pl-mount-pumpkins", PUMPKINS);
    } else if (page === "others") {
      mount("#pl-mount-others", OTHERS);
    }

    if (typeof window.__viviApplyI18n === "function") {
      window.__viviApplyI18n();
    }
  });
})();

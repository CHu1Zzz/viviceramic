(function () {
  "use strict";

  var PUMPKINS = [
    { name: "Heritage Stem Classic", from: 189, sale: false, img: "https://images.unsplash.com/photo-1509557965877-b88c97052f0e?w=640&q=80&auto=format" },
    { name: "Ember Glaze Medium", from: 219, sale: true, was: 249, img: "https://images.unsplash.com/photo-1606312619070-d48b4c652a48?w=640&q=80&auto=format" },
    { name: "Petite Patch Triad", from: 129, sale: false, img: "https://images.unsplash.com/photo-1470104240373-bc1812eddc9f?w=640&q=80&auto=format" },
    { name: "Taper Throne Base", from: 89, sale: false, img: "https://images.unsplash.com/photo-1513506003901-1e6a229e2d15?w=640&q=80&auto=format" },
    { name: "Moonlit Satin Gourd", from: 159, sale: false, img: "https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=640&q=80&auto=format" },
    { name: "Cobweb Mini Duo", from: 99, sale: true, was: 119, img: "https://images.unsplash.com/photo-1508936794310-2efd7b0ebf18?w=640&q=80&auto=format" },
    { name: "Harvest Rim Large", from: 249, sale: false, img: "https://images.unsplash.com/photo-1519689680058-324335c77eba?w=640&q=80&auto=format" },
    { name: "Cobalt Stem Sculpt", from: 199, sale: false, img: "https://images.unsplash.com/photo-1606041017872-22bb8b6b2b4b?w=640&q=80&auto=format" },
    { name: "Witching Hour Small", from: 79, sale: false, img: "https://images.unsplash.com/photo-1470104240373-bc1812eddc9f?w=640&q=80&auto=format&sat=-30" },
    { name: "Hollow King XL", from: 289, sale: false, img: "https://images.unsplash.com/photo-1606312619070-d48b4c652a48?w=640&q=80&auto=format" },
  ];

  var OTHERS = [
    { name: "Candle Crown Holder", from: 69, sale: false, img: "https://images.unsplash.com/photo-1602874801007-bd458e9f8148?w=640&q=80&auto=format" },
    { name: "Phantom Pedestal Set", from: 119, sale: false, img: "https://images.unsplash.com/photo-1612198188060-c7c2a3d66d1a?w=640&q=80&auto=format" },
    { name: "Ritual Bowl Duo", from: 95, sale: true, was: 115, img: "https://images.unsplash.com/photo-1578749556568-bc2b40b68d28?w=640&q=80&auto=format" },
    { name: "Ash Glaze Vase", from: 149, sale: false, img: "https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=640&q=80&auto=format" },
    { name: "Spine Taper Stand", from: 59, sale: false, img: "https://images.unsplash.com/photo-1513506003901-1e6a229e2d15?w=640&q=80&auto=format" },
    { name: "Midnight Pillar Tray", from: 85, sale: false, img: "https://images.unsplash.com/photo-1603199506016-b9a594b593c0?w=640&q=80&auto=format" },
    { name: "Copper Footed Cup", from: 45, sale: false, img: "https://images.unsplash.com/photo-1610701596007-115028617624?w=640&q=80&auto=format" },
    { name: "Obsidian Stone Jar", from: 175, sale: false, img: "https://images.unsplash.com/photo-1567225591450-0600957edf89?w=640&q=80&auto=format" },
    { name: "Bramble Relief Plate", from: 65, sale: true, was: 79, img: "https://images.unsplash.com/photo-1610701596067-2ccc33e4e2b5?w=640&q=80&auto=format" },
    { name: "Ember Wick Snuffer", from: 39, sale: false, img: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=640&q=80&auto=format" },
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
      '<div class="pl-card-visual">' +
      saleBadge +
      '<img src="' +
      esc(p.img) +
      '" alt="" width="600" height="600" loading="lazy" decoding="async" />' +
      "</div>" +
      '<div class="pl-card-body">' +
      '<h3 class="pl-card-title">' +
      esc(p.name) +
      "</h3>" +
      priceLine +
      '<div class="pl-card-actions">' +
      '<button type="button" class="pl-btn pl-btn--primary" data-i18n="catalogAddCart">Add to cart</button>' +
      '<a class="pl-btn pl-btn--secondary" href="../index.html#top" data-i18n="catalogLearn">Learn more</a>' +
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

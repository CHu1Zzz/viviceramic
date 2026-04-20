(function () {
  "use strict";

  const I18N = {
    en: {
      navProducts: "All Product",
      navResources: "Resources",
      navAbout: "About us",
      heroEyebrow: "Hand-fired · Limited autumn runs",
      heroTitleBefore: "Ceramic pumpkins, ",
      heroTitleAccent: "uncannily real.",
      heroSlogan:
        "Hand-finished stoneware pumpkins that read like harvest—until the light catches the glaze and the room goes quiet.",
      heroShop: "Shop the drop",
      heroStory: "Our craft",
      scrollHint: "Descend",
      p1Badge: "Signature",
      p1Title: "The pumpkin everyone mistakes for the real thing.",
      p1Body:
        "Sculpted in small batches and fired for depth, each piece carries uneven ribs, a believable stem, and a satin-matte skin that feels almost warm to the touch. Place one on the mantle and watch guests lean in closer.",
      p1Link: "View collection →",
      p2Badge: "Set piece",
      p2Title: "A trio of minis—or a candle throne—for the vignette.",
      p2Body:
        "Three petite pumpkins nest together like a whispered spell, or choose the taper holder: a low, moody pedestal that catches wax drips like ritual evidence. Designed to pair with taller stems and the slow flicker of flame.",
      p2Link: "Explore sets →",
      reviewsTitle: "Whispers from the patch",
      reviewsSub: "Real rooms. Real light. Unreal ceramics.",
      r1: "“The weight, the glaze, the stem—I actually tapped it expecting hollow plastic. It’s the most convincing piece I own.”",
      r2: "“Reads premium in person. My living room went from ‘decorated’ to ‘curated’ in one object.”",
      r3: "“Subtle spooky, not cartoon. It photographs like sculpture and still feels cozy when the lights go low.”",
      ctaTitle: "Your collection, remembered.",
      ctaSub:
        "Save pieces you love, track orders, and unlock early access to limited autumn drops.",
      ctaBtn: "Sign in to your account",
      footer: "© ViviCeramics. All hallows reserved.",
    },
    zh: {
      navProducts: "全部产品",
      navResources: "资源",
      navAbout: "关于我们",
      heroEyebrow: "手工烧制 · 秋季限量",
      heroTitleBefore: "陶瓷南瓜，",
      heroTitleAccent: "逼真得不像话。",
      heroSlogan:
        "手工精修的炻器南瓜，远看像刚从田里摘下——直到光线掠过釉面，整个房间都会静下来。",
      heroShop: "选购系列",
      heroStory: "工艺故事",
      scrollHint: "向下滑动",
      p1Badge: "代表作",
      p1Title: "让人忍不住伸手确认「是不是真南瓜」的那一只。",
      p1Body:
        "小批量塑形与烧制，肋纹自然、瓜蒂可信，哑光釉面触感近乎温热。摆在壁炉上，客人会不自觉凑近多看一眼。",
      p1Link: "查看系列 →",
      p2Badge: "搭配",
      p2Title: "三只迷你南瓜，或一盏烛台——完成你的角落叙事。",
      p2Body:
        "迷你南瓜三人组像一句低声咒语；烛台款则承接蜡泪，氛围更暗、更仪式。与高挑茎秆与摇曳烛光天生一对。",
      p2Link: "浏览套装 →",
      reviewsTitle: "来自「南瓜地」的回声",
      reviewsSub: "真实空间、真实光线、超乎想象的陶瓷。",
      r1: "「分量、釉面、瓜蒂——我下意识敲了敲，还以为是空塑料。这是我家里最『像真』的一件。」",
      r2: "「实物非常显质感。客厅从『布置过』变成『被策展过』，就因为这一只。」",
      r3: "「是含蓄的万圣节气质，不是卡通。拍照像雕塑，关灯后又很居家。」",
      ctaTitle: "你的收藏，被记住。",
      ctaSub: "保存心仪款式、追踪订单，并优先获得秋季限量上新。",
      ctaBtn: "登录账户",
      footer: "© ViviCeramics. 万圣保留所有氛围。",
    },
  };

  let lang = localStorage.getItem("viviceramics-lang") || "en";

  function applyI18n() {
    const t = I18N[lang];
    document.querySelectorAll("[data-i18n]").forEach((el) => {
      const key = el.getAttribute("data-i18n");
      if (t[key]) el.textContent = t[key];
    });
    const langBtn = document.getElementById("lang-toggle");
    if (langBtn) langBtn.textContent = lang === "en" ? "EN" : "中文";
    document.documentElement.lang = lang === "en" ? "en" : "zh-Hans";
  }

  function toggleLang() {
    lang = lang === "en" ? "zh" : "en";
    localStorage.setItem("viviceramics-lang", lang);
    applyI18n();
  }

  /* —— Intro —— */
  function initIntro() {
    const screen = document.getElementById("intro-screen");
    const skip = document.getElementById("intro-skip");
    if (!screen) return;

    const done = () => {
      screen.classList.add("is-done");
      document.body.classList.remove("intro-active");
    };

    skip?.addEventListener("click", done);
    // Intro disabled - uncomment below to re-enable
    // window.setTimeout(done, 3200);
    done(); // Skip intro immediately
  }

  /* —— Scroll reveal —— */
  function initReveal() {
    const els = document.querySelectorAll(".product-card, .review-card, .cta-panel");
    if (!els.length) return;

    const io = new IntersectionObserver(
      (entries) => {
        entries.forEach((e) => {
          if (e.isIntersecting) {
            e.target.classList.add("is-visible");
            const delay = e.target.dataset.revealDelay;
            if (delay) e.target.style.transitionDelay = `${delay}ms`;
          }
        });
      },
      { threshold: 0.12, rootMargin: "0px 0px -8% 0px" }
    );

    els.forEach((el) => io.observe(el));
  }

  /* —— Lightbox —— */
  function initLightbox() {
    const lb = document.getElementById("lightbox");
    const lbImg = document.getElementById("lightbox-img");
    const close = document.getElementById("lightbox-close");
    if (!lb || !lbImg) return;

    document.querySelectorAll("[data-lightbox]").forEach((trigger) => {
      trigger.addEventListener("click", () => {
        const src = trigger.getAttribute("data-full") || trigger.querySelector("img")?.src;
        if (!src) return;
        lbImg.src = src;
        lbImg.alt = trigger.querySelector("img")?.alt || "";
        lb.classList.add("is-open");
        document.body.style.overflow = "hidden";
      });
    });

    function shut() {
      lb.classList.remove("is-open");
      document.body.style.overflow = "";
    }

    close?.addEventListener("click", shut);
    lb.addEventListener("click", (e) => {
      if (e.target === lb) shut();
    });
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape") shut();
    });
  }

  document.getElementById("lang-toggle")?.addEventListener("click", toggleLang);

  document.addEventListener("DOMContentLoaded", () => {
    applyI18n();
    initIntro();
    initReveal();
    initLightbox();
  });
})();

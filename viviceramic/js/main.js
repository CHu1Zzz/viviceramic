(function () {
  "use strict";

  const I18N = {
    en: {
      navProducts: "All Product",
      navResources: "Resources",
      navAbout: "About us",
      heroEyebrow: "Hand-fired ceramics · Limited Halloween drops",
      heroTitleBefore: "Ceramic pumpkins ",
      heroTitleAccent: "for elevated Halloween\u00A0decorations.",
      heroSlogan:
        "Hand-finished ceramics for mantels, consoles, and the Halloween vignette guests notice first. Limited autumn batches only.",
      heroShop: "Shop the drop",
      heroStory: "Our craft",
      scrollHint: "Descend",
      bsTitle: "Get our best sellers",
      bsSub: "Hand-finished picks collectors grab first—limited autumn runs.",
      bsFrom: "From",
      bsAddCart: "Add to cart",
      bsLearn: "Learn more",
      bsCurrency: "USD",
      bs1Name: "Hyper-real Classic Pumpkin",
      bs2Name: "Petite Pumpkin Trio",
      bs3Name: "Taper Throne Candle Cup",
      bs4Name: "Heritage Stem Sculpt",
      bs5Name: "Ember Glaze Limited Run",
      bs6Name: "Patch Stems & Minis Set",
      productsHeading: "Main ceramics types",
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
      ctaTitle: "Your Halloween decoration edit—in ceramics.",
      ctaSub:
        "Save pieces you love, track orders, and get early access to limited autumn drops—before the patch sells through.",
      ctaBtn: "Sign in to your account",
      footer: "© ViviCeramics. All hallows reserved.",
      catalogTitleAll: "All products",
      catalogTitlePumpkins: "Pumpkins",
      catalogTitleOthers: "Others",
      catalogNavAll: "All",
      catalogNavPumpkins: "Pumpkins",
      catalogNavOthers: "Others",
      catalogSub: "Hand-fired ceramics — limited autumn runs.",
      catalogAvailability: "Availability",
      catalogPrice: "Price",
      catalogSort: "Sort by",
      catalogSortFeatured: "Featured",
      catalogCount20: "20 products",
      catalogCount10: "10 products",
      catalogPumpkinsSection: "Pumpkins",
      catalogOthersSection: "Others",
      catalogAddCart: "Add to cart",
      catalogLearn: "Learn more",
      catalogSale: "Sale",
      aboutHeroKicker: "Our story",
      aboutHeroTitle: "Ceramics for Halloween decorations that feel honest.",
      aboutS1Kicker: "The problem we kept seeing",
      aboutS1Title: "Halloween decorations that looked fine in photos—and cheap in person.",
      aboutS1P1:
        "We love October. We love a moody table and a candle that flickers just right. But year after year, the same thing happened: we’d buy Halloween decorations that looked exciting online, then unpack something light, hollow, and a little too shiny.",
      aboutS1P2:
        "Nothing wrong with fun plastic props for a party. But we wanted pieces that could sit on a mantel in daylight and still feel intentional—something closer to art than a prop.",
      aboutS1P3:
        "So we built our own path. ViviCeramics is centered on a team-owned factory—ceramics for Halloween decorations you’re proud to leave out when the lights come on.",
      aboutS2Kicker: "Hand-carved pumpkins",
      aboutS2Title: "Every rib and stem—carved by hand.",
      aboutS2P:
        "Our ceramic pumpkins aren’t born from one giant mold press. The ribs, the stem, the silhouette—the carving work is done by hand, piece by piece. We trim and refine in small batches so each pumpkin can sit a little different, like the real thing. After a slow dry, we fire for strength, then glaze for depth. That’s how the ceramics feel warm and believable up close, not thin and plasticky.",
      aboutS3Kicker: "What we believe",
      aboutS3Title: "Quiet spooky. Real weight. Real glaze.",
      aboutS3P1:
        "Our product idea is simple: Halloween decorations should feel grounded. We use stoneware ceramics so the piece has weight when you pick it up. We keep shapes believable and finishes soft—more harvest moon than neon scream.",
      aboutS3P2:
        "We’re not trying to fill a warehouse. We release in limited autumn runs because that’s how we can keep quality where we want it. If you’re building a vignette—entryway, shelf, or table—our hope is that one of our pieces becomes the object people lean in to look at.",
      aboutCtaKicker: "Ready to dress the room?",
      aboutCtaTitle: "See this season’s ceramics.",
      aboutCtaText:
        "Browse pumpkins and accents, pick what fits your space, and bring home Halloween decorations that still look right when the party ends.",
      aboutCtaBtn: "Shop all products",
    },
    zh: {
      navProducts: "全部产品",
      navResources: "资源",
      navAbout: "关于我们",
      heroEyebrow: "手工陶瓷 · 万圣限量上新",
      heroTitleBefore: "陶瓷南瓜 ",
      heroTitleAccent: "为更有质感的万圣装饰而造。",
      heroSlogan:
        "手工陶瓷，点亮壁炉与玄关的万圣角落——客人第一眼会注意到。秋季小批量，售完即止。",
      heroShop: "选购系列",
      heroStory: "工艺故事",
      scrollHint: "向下滑动",
      bsTitle: "当季热销",
      bsSub: "手工精选——限量秋季批次，藏家常先入手。",
      bsFrom: "低至",
      bsAddCart: "加入购物车",
      bsLearn: "了解更多",
      bsCurrency: "美元",
      bs1Name: "超逼真经典南瓜",
      bs2Name: "迷你南瓜三人组",
      bs3Name: "烛台杯 · Taper Throne",
      bs4Name: "典藏茎雕款",
      bs5Name: "余烬釉 · 限量批次",
      bs6Name: "瓜蒂与迷你组合",
      productsHeading: "主要陶瓷品类",
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
      ctaTitle: "你的万圣装饰清单——用陶瓷凑齐。",
      ctaSub: "保存心仪款式、追踪订单，抢先获得限量秋季上新——热门款常在南瓜季结束前售罄。",
      ctaBtn: "登录账户",
      footer: "© ViviCeramics. 万圣保留所有氛围。",
      catalogTitleAll: "全部产品",
      catalogTitlePumpkins: "南瓜系列",
      catalogTitleOthers: "其他器物",
      catalogNavAll: "全部",
      catalogNavPumpkins: "南瓜",
      catalogNavOthers: "其他",
      catalogSub: "手工陶瓷 — 秋季限量批次。",
      catalogAvailability: "库存",
      catalogPrice: "价格",
      catalogSort: "排序",
      catalogSortFeatured: "精选",
      catalogCount20: "共 20 件",
      catalogCount10: "共 10 件",
      catalogPumpkinsSection: "南瓜系列",
      catalogOthersSection: "其他器物",
      catalogAddCart: "加入购物车",
      catalogLearn: "了解更多",
      catalogSale: "促销",
      aboutHeroKicker: "品牌故事",
      aboutHeroTitle: "做「诚实」的万圣装饰陶瓷。",
      aboutS1Kicker: "我们反复看到的问题",
      aboutS1Title: "照片里很万圣，拆开却有点「轻」。",
      aboutS1P1:
        "我们喜欢十月，也喜欢烛光刚好、角落刚刚好的氛围。但很多次：网上下单的万圣装饰，到手却轻飘飘、亮得有点假——像一次性道具，不像能长期摆在架子上的东西。",
      aboutS1P2:
        "派对用的塑料小道具没问题。但我们想要的是：白天放在壁炉上也顺眼、不开灯也像认真挑过的那一种——更像摆件，而不是拍完照就收起来的道具。",
      aboutS1P3:
        "于是我们走自己的路：ViviCeramics 以团队自有工厂为核心，做你愿意开灯后还愿意摆着的万圣装饰陶瓷。",
      aboutS2Kicker: "手工雕刻",
      aboutS2Title: "每一条棱、每一根茎，都是手刻出来的。",
      aboutS2P:
        "陶瓷南瓜不是一大块模具一压就完事。瓜身的棱、瓜蒂、整体轮廓——雕刻部分都是纯手工完成，一件一件修。我们坚持小批量修整，让每只南瓜都能有一点点自己的「脾气」，更像真的。慢干之后烧制定型，再上釉做出层次，所以拿在手里是扎实的陶瓷感，而不是薄薄一层亮壳。",
      aboutS3Kicker: "我们的理念",
      aboutS3Title: "含蓄的万圣气质：有分量、有釉面。",
      aboutS3P1:
        "产品想法很简单：万圣装饰要「站得住」。我们用炻器陶瓷，拿在手里要有分量；造型尽量可信，釉面偏柔——更像秋收月色，而不是荧光尖叫。",
      aboutS3P2:
        "我们不想堆满仓库。秋季限量上新，是因为品质只能按这个节奏守住。无论你是布置玄关、层架还是餐桌一角，我们希望其中一件会成为别人会凑近看的那只。",
      aboutCtaKicker: "准备布置房间了吗？",
      aboutCtaTitle: "看看这一季的陶瓷。",
      aboutCtaText: "浏览南瓜与搭配小物，选适合你的角落——把万圣装饰留到派对结束也还顺眼。",
      aboutCtaBtn: "查看全部产品",
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
    const els = document.querySelectorAll(".product-card, .bs-product-card, .review-card, .cta-panel, .contact-info-card, .contact-form-card");
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

  /* —— Best sellers rail (horizontal scroll + arrows) —— */
  function initBestsellers() {
    const track = document.getElementById("bs-track");
    const prev = document.getElementById("bs-prev");
    const next = document.getElementById("bs-next");
    if (!track || !prev || !next) return;

    const scroller = track.closest(".bs-window");
    if (!scroller) return;

    function stepPx() {
      const first = track.querySelector(".bs-item");
      if (!first) return 284;
      const gap = parseFloat(getComputedStyle(track).gap) || 16;
      return first.offsetWidth + gap;
    }

    prev.addEventListener("click", () => {
      scroller.scrollBy({ left: -stepPx(), behavior: "smooth" });
    });
    next.addEventListener("click", () => {
      scroller.scrollBy({ left: stepPx(), behavior: "smooth" });
    });
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

  /* —— Three.js 3D Product Display —— */
  function initHero3D() {
    const container = document.getElementById("hero-3d");
    if (!container || typeof THREE === "undefined") return;

    const width = container.clientWidth;
    const height = container.clientHeight;
    if (width < 2 || height < 2) return;

    const scene = new THREE.Scene();
    scene.fog = new THREE.FogExp2(0x0a0612, 0.15);

    const camera = new THREE.PerspectiveCamera(45, width / height, 0.1, 100);
    camera.position.set(0, 0, 3.5);

    const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
    renderer.setSize(width, height);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    renderer.outputColorSpace = THREE.SRGBColorSpace;
    renderer.setClearColor(0x000000, 0);
    renderer.domElement.style.cssText = `
      position: absolute;
      right: 0;
      top: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
    `;
    container.appendChild(renderer.domElement);

    // Load product video texture
    const video = document.createElement('video');
    video.src = "images/products/pumpkin-3d-demo.mp4";
    video.loop = true;
    video.muted = true;
    video.playsInline = true;

    video.addEventListener('loadeddata', function() {
      video.play();

      const texture = new THREE.VideoTexture(video);
      texture.minFilter = THREE.LinearFilter;
      texture.magFilter = THREE.LinearFilter;
      texture.colorSpace = THREE.SRGBColorSpace;

      const aspect = video.videoWidth / video.videoHeight;

      // Create product plane with transparent material
      const geometry = new THREE.PlaneGeometry(2.2 * aspect, 2.2, 1, 1);
      const material = new THREE.MeshBasicMaterial({
        map: texture,
        transparent: true,
        opacity: 0.85,
        side: THREE.DoubleSide,
      });

      const product = new THREE.Mesh(geometry, material);
      product.position.x = 0.3;
      product.position.y = 0;
      scene.add(product);

      // Ethereal glow behind product
      const glowGeo = new THREE.PlaneGeometry(3 * aspect, 3);
      const glowMat = new THREE.MeshBasicMaterial({
        color: 0xe8722a,
        transparent: true,
        opacity: 0.15,
        side: THREE.DoubleSide,
      });
      const glow = new THREE.Mesh(glowGeo, glowMat);
      glow.position.z = -0.5;
      glow.position.x = 0.3;
      scene.add(glow);

      // Ambient particles for ethereal effect
      const particleCount = 30;
      const particleGeo = new THREE.BufferGeometry();
      const positions = new Float32Array(particleCount * 3);
      for (let i = 0; i < particleCount; i++) {
        positions[i * 3] = (Math.random() - 0.5) * 4;
        positions[i * 3 + 1] = (Math.random() - 0.5) * 4;
        positions[i * 3 + 2] = (Math.random() - 0.5) * 2;
      }
      particleGeo.setAttribute("position", new THREE.BufferAttribute(positions, 3));
      const particleMat = new THREE.PointsMaterial({
        color: 0xff8833,
        size: 0.03,
        transparent: true,
        opacity: 0.4,
      });
      const particles = new THREE.Points(particleGeo, particleMat);
      scene.add(particles);

      // Soft lighting
      const ambient = new THREE.AmbientLight(0x3a2040, 0.5);
      scene.add(ambient);
      const key = new THREE.DirectionalLight(0xffdd88, 0.6);
      key.position.set(2, 3, 4);
      scene.add(key);

      // Static display - no rotation
      function animate() {
        requestAnimationFrame(animate);

        renderer.render(scene, camera);
      }
      animate();
    });

    video.addEventListener('error', function(err) {
      console.error("Failed to load product video:", err);
    });

    const ro = new ResizeObserver(() => {
      const w = container.clientWidth;
      const h = container.clientHeight;
      camera.aspect = w / h;
      camera.updateProjectionMatrix();
      renderer.setSize(w, h);
    });
    ro.observe(container);
  }

  document.getElementById("lang-toggle")?.addEventListener("click", toggleLang);

  window.__VIVI_I18N = I18N;
  window.__viviApplyI18n = applyI18n;

  document.addEventListener("DOMContentLoaded", () => {
    document.body.classList.add("intro-active");
    applyI18n();
    initIntro();
    initReveal();
    initBestsellers();
    initLightbox();

    if (document.getElementById("hero-3d")) {
      if (window.THREE) {
        initHero3D();
      } else {
        const s = document.createElement("script");
        s.src = "https://cdn.jsdelivr.net/npm/three@0.160.0/build/three.min.js";
        s.onload = () => initHero3D();
        document.head.appendChild(s);
      }
    }
  });
})();

(function () {
  "use strict";

  const cards = document.querySelectorAll(".blog-reveal");
  if (!cards.length) return;

  const prefersReduced = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  if (prefersReduced) {
    cards.forEach((card) => card.classList.add("is-visible"));
    return;
  }

  const io = new IntersectionObserver(
    (entries, observer) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        entry.target.classList.add("is-visible");
        observer.unobserve(entry.target);
      });
    },
    { threshold: 0.14, rootMargin: "0px 0px -10% 0px" }
  );

  cards.forEach((card, index) => {
    card.style.transitionDelay = `${Math.min(index % 3, 2) * 55}ms`;
    io.observe(card);
  });
})();

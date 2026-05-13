(() => {
  // ── Menu toggle ──────────────────────────────────────────────────────────────
  const menuButton = document.querySelector(".menu-toggle");
  const navMenu    = document.getElementById("nav-menu");

  if (menuButton && navMenu) {
    menuButton.addEventListener("click", () => {
      const isExpanded = menuButton.getAttribute("aria-expanded") === "true";
      menuButton.setAttribute("aria-expanded", String(!isExpanded));
      navMenu.classList.toggle("open");
    });

    navMenu.querySelectorAll("a").forEach((link) => {
      link.addEventListener("click", () => {
        menuButton.setAttribute("aria-expanded", "false");
        navMenu.classList.remove("open");
      });
    });
  }

  // ── Copy email ───────────────────────────────────────────────────────────────
  const copyButton = document.querySelector(".copy-button");
  const mailCard   = document.querySelector(".contact-link-mail");

  if (copyButton && mailCard) {
    const copyButtonText = copyButton.querySelector(".copy-button-text");
    const email = mailCard.dataset.email || "";
    let copyResetTimer;

    copyButton.addEventListener("click", async () => {
      try {
        await navigator.clipboard.writeText(email);
        copyButton.classList.add("copied");
        if (copyButtonText) copyButtonText.textContent = "Copiado";
        window.clearTimeout(copyResetTimer);
        copyResetTimer = window.setTimeout(() => {
          copyButton.classList.remove("copied");
          if (copyButtonText) copyButtonText.textContent = "Copiar";
        }, 1800);
      } catch {
        if (copyButtonText) copyButtonText.textContent = "No se pudo copiar";
        window.clearTimeout(copyResetTimer);
        copyResetTimer = window.setTimeout(() => {
          if (copyButtonText) copyButtonText.textContent = "Copiar";
        }, 1800);
      }
    });
  }

  // ── Swiper ───────────────────────────────────────────────────────────────────
  if (typeof Swiper !== "undefined") {
    new Swiper(".tech-swiper", {
      slidesPerView: 1.2,
      spaceBetween: 14,
      loop: true,
      grabCursor: true,
      pagination: {
        el: ".swiper-pagination",
        clickable: true
      },
      autoplay: {
        delay: 2200,
        disableOnInteraction: false
      },
      breakpoints: {
        640: { slidesPerView: 2.2 },
        900: { slidesPerView: 3.2 }
      }
    });
  }

  // ── Typewriter ───────────────────────────────────────────────────────────────
  const twEl      = document.getElementById("typewriter-text");
  const twDataEl  = document.getElementById("tw-phrases");

  if (twEl && twDataEl) {
    let phrases;
    try {
      phrases = JSON.parse(twDataEl.textContent);
    } catch {
      phrases = ["productos digitales rápidos, escalables y mantenibles"];
    }

    let phraseIndex  = 0;
    let charIndex    = 0;
    let isErasing    = false;
    const typeSpeed  = 26;
    const eraseSpeed = 16;
    const pauseType  = 2200;
    const pauseErase = 400;

    function tick() {
      const phrase = phrases[phraseIndex];
      if (!isErasing) {
        charIndex++;
        twEl.textContent = phrase.substring(0, charIndex);
        if (charIndex === phrase.length) {
          isErasing = true;
          setTimeout(tick, pauseType);
          return;
        }
        setTimeout(tick, typeSpeed);
      } else {
        charIndex--;
        twEl.textContent = phrase.substring(0, charIndex);
        if (charIndex === 0) {
          isErasing   = false;
          phraseIndex = (phraseIndex + 1) % phrases.length;
          setTimeout(tick, pauseErase);
          return;
        }
        setTimeout(tick, eraseSpeed);
      }
    }

    tick();
  }

  // ── Project card flip ───────────────────────────────────────────────────────
  const flipButtons = document.querySelectorAll("[data-flip-card]");

  flipButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const card = button.closest(".project-card");
      if (!card) return;

      const isFlipped = card.classList.toggle("is-flipped");
      const frontFace = card.querySelector(".project-face-front");
      const backFace = card.querySelector(".project-face-back");

      if (frontFace && backFace) {
        if (isFlipped) {
          frontFace.setAttribute("inert", "");
          backFace.removeAttribute("inert");

          const backButton = backFace.querySelector("[data-flip-card]");
          if (backButton instanceof HTMLElement) backButton.focus();
        } else {
          backFace.setAttribute("inert", "");
          frontFace.removeAttribute("inert");

          const frontButton = frontFace.querySelector("[data-flip-card]");
          if (frontButton instanceof HTMLElement) frontButton.focus();
        }
      }
    });
  });

  // ── Scroll reveal ─────────────────────────────────────────────────────────────
  const revealEls = document.querySelectorAll("[data-reveal]");

  if (revealEls.length) {
    if ("IntersectionObserver" in window) {
      const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("is-visible");
            observer.unobserve(entry.target);
          }
        });
      }, { threshold: 0.08, rootMargin: "0px 0px -32px 0px" });

      revealEls.forEach((el) => observer.observe(el));
    } else {
      revealEls.forEach((el) => el.classList.add("is-visible"));
    }
  }
})();


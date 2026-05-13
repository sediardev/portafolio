(() => {
  const menuButton = document.querySelector(".menu-toggle");
  const navMenu = document.getElementById("nav-menu");

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

  const copyButton = document.querySelector(".copy-button");
  const mailCard = document.querySelector(".contact-link-mail");

  if (copyButton && mailCard) {
    const copyButtonText = copyButton.querySelector(".copy-button-text");
    const email = mailCard.dataset.email || "";
    let copyResetTimer;

    copyButton.addEventListener("click", async () => {
      try {
        await navigator.clipboard.writeText(email);
        copyButton.classList.add("copied");

        if (copyButtonText) {
          copyButtonText.textContent = "Copiado";
        }

        window.clearTimeout(copyResetTimer);
        copyResetTimer = window.setTimeout(() => {
          copyButton.classList.remove("copied");

          if (copyButtonText) {
            copyButtonText.textContent = "Copiar";
          }
        }, 1800);
      } catch (error) {
        if (copyButtonText) {
          copyButtonText.textContent = "No se pudo copiar";
        }

        window.clearTimeout(copyResetTimer);
        copyResetTimer = window.setTimeout(() => {
          if (copyButtonText) {
            copyButtonText.textContent = "Copiar";
          }
        }, 1800);
      }
    });
  }

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
        640: {
          slidesPerView: 2.2
        },
        900: {
          slidesPerView: 3.2
        }
      }
    });
  }
})();

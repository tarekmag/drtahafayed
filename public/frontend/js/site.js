(() => {
    const header = document.querySelector("[data-header]");
    const toggle = document.querySelector("[data-nav-toggle]");
    const nav = document.querySelector("[data-nav]");

    const onScroll = () => {
        header?.classList.toggle("is-stuck", window.scrollY > 8);
    };

    onScroll();
    window.addEventListener("scroll", onScroll, { passive: true });

    const closeNav = () => {
        nav?.classList.remove("is-open");
        toggle?.setAttribute("aria-expanded", "false");
    };

    toggle?.addEventListener("click", () => {
        const open = nav.classList.toggle("is-open");
        toggle.setAttribute("aria-expanded", String(open));
    });

    nav?.querySelectorAll("a").forEach((link) => {
        link.addEventListener("click", closeNav);
    });

    document.querySelectorAll("[data-drop-toggle]").forEach((button) => {
        button.addEventListener("click", (event) => {
            event.stopPropagation();
            const drop = button.closest(".nav-drop");
            const open = drop.classList.toggle("is-open");
            button.setAttribute("aria-expanded", String(open));
        });
    });

    document.addEventListener("click", (event) => {
        document.querySelectorAll(".nav-drop.is-open").forEach((drop) => {
            if (drop.contains(event.target)) {
                return;
            }
            drop.classList.remove("is-open");
            drop.querySelector("[data-drop-toggle]")?.setAttribute("aria-expanded", "false");
        });
    });

    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape") {
            closeNav();
            document.querySelectorAll(".nav-drop.is-open").forEach((drop) => {
                drop.classList.remove("is-open");
                drop.querySelector("[data-drop-toggle]")?.setAttribute("aria-expanded", "false");
            });
            closeLightbox();
        }
    });

    const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
    const revealNodes = document.querySelectorAll(".reveal");

    if (reduceMotion || !("IntersectionObserver" in window)) {
        revealNodes.forEach((node) => node.classList.add("is-in"));
    } else {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }
                entry.target.classList.add("is-in");
                observer.unobserve(entry.target);
            });
        }, { threshold: 0.14, rootMargin: "0px 0px -8% 0px" });

        revealNodes.forEach((node) => observer.observe(node));
    }

    const lightbox = document.querySelector("[data-lightbox-root]");
    const lightboxImage = lightbox?.querySelector("[data-lightbox-image]");
    const lightboxCaption = lightbox?.querySelector("[data-lightbox-caption]");
    const gallery = () => [...document.querySelectorAll("[data-lightbox]")];
    let lightboxIndex = 0;

    const showLightbox = (nextIndex) => {
        const items = gallery();
        if (!items.length || !lightbox || !lightboxImage) {
            return;
        }

        lightboxIndex = (nextIndex + items.length) % items.length;
        const source = items[lightboxIndex];
        const preview = source.querySelector("img");
        lightboxImage.src = source.dataset.full || preview?.src || "";
        lightboxImage.alt = preview?.alt || "";
        if (lightboxCaption) {
            lightboxCaption.textContent = preview?.alt || "";
        }
        lightbox.hidden = false;
        lightbox.classList.add("is-open");
        document.body.classList.add("lightbox-open");
    };

    const closeLightbox = () => {
        if (!lightbox || lightbox.hidden) {
            return;
        }
        lightbox.hidden = true;
        lightbox.classList.remove("is-open");
        document.body.classList.remove("lightbox-open");
        if (lightboxImage) {
            lightboxImage.src = "";
        }
    };

    gallery().forEach((item, index) => {
        item.addEventListener("click", () => showLightbox(index));
    });

    lightbox?.querySelector("[data-lightbox-prev]")?.addEventListener("click", () => {
        showLightbox(lightboxIndex - 1);
    });

    lightbox?.querySelector("[data-lightbox-next]")?.addEventListener("click", () => {
        showLightbox(lightboxIndex + 1);
    });

    lightbox?.querySelectorAll("[data-lightbox-close]").forEach((button) => {
        button.addEventListener("click", closeLightbox);
    });

    document.addEventListener("keydown", (event) => {
        if (!lightbox || lightbox.hidden) {
            return;
        }
        if (event.key === "ArrowRight" || event.key === "ArrowLeft") {
            const forward = document.documentElement.dir === "rtl" ? "ArrowLeft" : "ArrowRight";
            showLightbox(lightboxIndex + (event.key === forward ? 1 : -1));
        }
    });

    const form = document.querySelector("[data-contact-form]");
    form?.addEventListener("submit", (event) => {
        event.preventDefault();
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }
        const notice = form.querySelector("[data-form-notice]");
        if (notice) {
            notice.hidden = false;
            notice.focus();
        }
    });
})();

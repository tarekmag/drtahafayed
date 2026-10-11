(() => {
    const header = document.querySelector("[data-header]");
    const toggle = document.querySelector("[data-nav-toggle]");
    const nav = document.querySelector("[data-nav]");
    const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

    const onScroll = () => {
        header?.classList.toggle("is-stuck", window.scrollY > 12);
    };

    onScroll();
    window.addEventListener("scroll", onScroll, { passive: true });

    const closeNav = () => {
        nav?.classList.remove("is-open");
        toggle?.setAttribute("aria-expanded", "false");
        document.body.classList.remove("nav-open");
    };

    toggle?.addEventListener("click", () => {
        const open = nav.classList.toggle("is-open");
        toggle.setAttribute("aria-expanded", String(open));
        document.body.classList.toggle("nav-open", open);
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
            if (!drop.contains(event.target)) {
                drop.classList.remove("is-open");
                drop.querySelector("[data-drop-toggle]")?.setAttribute("aria-expanded", "false");
            }
        });
    });

    const revealObserver = ("IntersectionObserver" in window) && !reduceMotion
        ? new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }
                entry.target.classList.add("is-in");
                revealObserver.unobserve(entry.target);
            });
        }, { threshold: 0.12, rootMargin: "0px 0px -6% 0px" })
        : null;

    const watchReveal = () => {
        document.querySelectorAll(".reveal:not(.is-in)").forEach((node) => {
            if (!revealObserver) {
                node.classList.add("is-in");
                return;
            }

            const rect = node.getBoundingClientRect();
            const visible = rect.bottom > 0 && rect.top < window.innerHeight * 0.94;

            if (visible) {
                node.classList.add("is-in");
                return;
            }

            revealObserver.observe(node);
        });
    };

    watchReveal();

    document.querySelectorAll("[data-count]").forEach((node) => {
        const target = Number(node.dataset.count || 0);
        const render = (value) => {
            node.textContent = new Intl.NumberFormat(document.documentElement.lang).format(Math.round(value));
        };

        if (reduceMotion) {
            render(target);
            return;
        }

        const animate = () => {
            const start = performance.now();
            const tick = (now) => {
                const progress = Math.min((now - start) / 1200, 1);
                render(target * (1 - Math.pow(1 - progress, 3)));
                if (progress < 1) {
                    requestAnimationFrame(tick);
                }
            };
            requestAnimationFrame(tick);
        };

        if (!("IntersectionObserver" in window)) {
            animate();
            return;
        }

        const counter = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    animate();
                    counter.unobserve(entry.target);
                }
            });
        }, { threshold: 0.4 });

        counter.observe(node);
    });

    document.querySelectorAll("[data-tabs]").forEach((root) => {
        const tabs = [...root.querySelectorAll('[role="tab"]')];
        const panels = [...root.querySelectorAll('[role="tabpanel"]')];

        const activate = (index) => {
            tabs.forEach((tab, i) => {
                const selected = i === index;
                tab.classList.toggle("is-active", selected);
                tab.setAttribute("aria-selected", String(selected));
                tab.tabIndex = selected ? 0 : -1;
            });
            panels.forEach((panel, i) => panel.classList.toggle("is-active", i === index));
        };

        tabs.forEach((tab, index) => {
            tab.addEventListener("click", () => activate(index));
            tab.addEventListener("keydown", (event) => {
                if (event.key !== "ArrowRight" && event.key !== "ArrowLeft") {
                    return;
                }
                event.preventDefault();
                const dir = event.key === "ArrowRight" ? 1 : -1;
                const next = (index + dir + tabs.length) % tabs.length;
                tabs[next].focus();
                activate(next);
            });
        });
    });

    const initSwipers = () => {
        if (typeof window.Swiper !== "function") {
            return;
        }

        document.querySelectorAll("[data-swiper='reviews']").forEach((el) => {
            const root = el.closest(".reviews-slider");
            new window.Swiper(el, {
                slidesPerView: 1.08,
                spaceBetween: 16,
                watchOverflow: true,
                breakpoints: {
                    760: { slidesPerView: 2.1 },
                    1100: { slidesPerView: 3 },
                },
                navigation: {
                    nextEl: root?.querySelector(".slider-next"),
                    prevEl: root?.querySelector(".slider-prev"),
                },
                pagination: {
                    el: root?.querySelector(".slider-pagination"),
                    clickable: true,
                },
            });
        });
    };

    if (typeof window.Swiper === "function") {
        initSwipers();
    } else {
        window.addEventListener("load", initSwipers);
    }

    const lightbox = document.querySelector("[data-lightbox-root]");
    const lightboxImage = lightbox?.querySelector("[data-lightbox-image]");
    const lightboxEmbed = lightbox?.querySelector("[data-lightbox-embed]");
    const lightboxCaption = lightbox?.querySelector("[data-lightbox-caption]");
    const gallery = () => [...document.querySelectorAll("[data-lightbox]")];
    let lightboxIndex = 0;

    const closeLightbox = () => {
        if (!lightbox || lightbox.hidden) {
            return;
        }
        lightbox.hidden = true;
        document.body.classList.remove("lightbox-open");
        if (lightboxImage) {
            lightboxImage.src = "";
            lightboxImage.hidden = true;
        }
        if (lightboxEmbed) {
            lightboxEmbed.innerHTML = "";
            lightboxEmbed.hidden = true;
        }
    };

    const showLightbox = (nextIndex) => {
        const items = gallery();
        if (!items.length || !lightbox) {
            return;
        }

        lightboxIndex = (nextIndex + items.length) % items.length;
        const source = items[lightboxIndex];
        const caption = source.dataset.caption || source.querySelector("img")?.alt || "";

        if (source.dataset.video && lightboxEmbed) {
            lightboxImage.hidden = true;
            lightboxEmbed.hidden = false;
            const type = source.dataset.videoType || "iframe";
            lightboxEmbed.innerHTML = type === "file"
                ? `<video controls autoplay src="${source.dataset.video}"></video>`
                : `<iframe src="${source.dataset.video}" allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen></iframe>`;
        } else if (lightboxImage) {
            lightboxEmbed.hidden = true;
            lightboxEmbed.innerHTML = "";
            lightboxImage.hidden = false;
            lightboxImage.src = source.dataset.full || source.querySelector("img")?.src || "";
            lightboxImage.alt = caption;
        }

        if (lightboxCaption) {
            lightboxCaption.textContent = caption;
        }

        lightbox.hidden = false;
        document.body.classList.add("lightbox-open");
    };

    document.addEventListener("click", (event) => {
        const item = event.target.closest("[data-lightbox]");
        if (!item || lightbox?.contains(item)) {
            return;
        }
        const index = gallery().indexOf(item);
        if (index === -1) {
            return;
        }
        showLightbox(index);
    });

    lightbox?.querySelector("[data-lightbox-prev]")?.addEventListener("click", () => showLightbox(lightboxIndex - 1));
    lightbox?.querySelector("[data-lightbox-next]")?.addEventListener("click", () => showLightbox(lightboxIndex + 1));
    lightbox?.querySelectorAll("[data-lightbox-close]").forEach((button) => {
        button.addEventListener("click", closeLightbox);
    });

    let touchStartX = 0;
    lightbox?.addEventListener("touchstart", (event) => {
        touchStartX = event.changedTouches[0].screenX;
    }, { passive: true });
    lightbox?.addEventListener("touchend", (event) => {
        const delta = event.changedTouches[0].screenX - touchStartX;
        if (Math.abs(delta) < 50) {
            return;
        }
        showLightbox(lightboxIndex + (delta > 0 ? -1 : 1));
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
        if (lightbox && !lightbox.hidden && (event.key === "ArrowRight" || event.key === "ArrowLeft")) {
            showLightbox(lightboxIndex + (event.key === "ArrowRight" ? 1 : -1));
        }
    });

    const article = document.querySelector("[data-article]");
    const progress = document.querySelector("[data-progress]");

    if (article && progress) {
        progress.hidden = false;
        const bar = progress.querySelector("span");
        const updateProgress = () => {
            const rect = article.getBoundingClientRect();
            const scrolled = Math.min(Math.max(-rect.top / (rect.height - window.innerHeight), 0), 1);
            if (bar) {
                bar.style.width = `${scrolled * 100}%`;
            }
        };
        updateProgress();
        window.addEventListener("scroll", updateProgress, { passive: true });
    }

    document.querySelectorAll("[data-copy-link]").forEach((button) => {
        button.addEventListener("click", async () => {
            try {
                await navigator.clipboard.writeText(window.location.href);
                const original = button.textContent;
                button.textContent = button.dataset.copied || original;
                setTimeout(() => {
                    button.textContent = original;
                }, 1800);
            } catch {
                // ignore
            }
        });
    });

    const hookLivewire = () => {
        if (!window.Livewire || window.__clinicLivewireHooked) {
            return;
        }
        window.__clinicLivewireHooked = true;
        Livewire.hook("morph.added", () => requestAnimationFrame(watchReveal));
        Livewire.hook("morph.updated", () => requestAnimationFrame(watchReveal));
    };

    hookLivewire();
    document.addEventListener("livewire:init", hookLivewire);
})();

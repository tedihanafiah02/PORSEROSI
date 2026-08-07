function debounce(func, wait) {
    let timeout;
    return function (...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), wait);
    };
}

document.addEventListener("DOMContentLoaded", function () {
    // Mobile search toggle
    const mobileSearchButton = document.getElementById("mobile-search-button");
    const mobileSearchForm = document.getElementById("mobile-search-form");
    const mobileSearchInput = document.getElementById("search-navbar-mobile");

    if (mobileSearchButton && mobileSearchForm) {
        mobileSearchButton.addEventListener("click", function (event) {
            event.stopPropagation();
            mobileSearchForm.classList.toggle("open");
            if (mobileSearchForm.classList.contains("open") && mobileSearchInput) {
                setTimeout(() => mobileSearchInput.focus(), 350);
            }
        });
    }

    // Mobile Sidebar Menu Toggle (slide from right)
    const menuToggle = document.getElementById("mobile-menu-toggle");
    const menuClose = document.getElementById("mobile-menu-close");
    const sidebar = document.getElementById("navbar-search");
    const overlay = document.getElementById("mobile-menu-overlay");

    function openMobileMenu() {
        if (sidebar && overlay) {
            sidebar.classList.add("open");
            overlay.classList.add("active");
            document.body.classList.add("mobile-menu-open");
        }
    }

    function closeMobileMenu() {
        if (sidebar && overlay) {
            sidebar.classList.remove("open");
            overlay.classList.remove("active");
            document.body.classList.remove("mobile-menu-open");
        }
    }

    if (menuToggle) {
        menuToggle.addEventListener("click", function (e) {
            e.stopPropagation();
            openMobileMenu();
        });
    }

    if (menuClose) {
        menuClose.addEventListener("click", function () {
            closeMobileMenu();
        });
    }

    if (overlay) {
        overlay.addEventListener("click", function () {
            closeMobileMenu();
        });
    }

    // Close sidebar on ESC key
    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") {
            closeMobileMenu();
        }
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
            const href = this.getAttribute("href");
            if (href !== "#" && document.querySelector(href)) {
                e.preventDefault();
                document.querySelector(href).scrollIntoView({
                    behavior: "smooth",
                });
            }
        });
    });
});

// Desktop Dropdown Hover - Tentang Kami
document.addEventListener("DOMContentLoaded", function () {
    const dropdownContainer = document.querySelector(".dropdown-hover");
    const dropdownMenu = document.getElementById("dropdownNavbar");
    const dropdownIcon = document.getElementById("dropdownIcon");

    if (dropdownContainer && dropdownMenu) {
        dropdownContainer.addEventListener("mouseenter", function () {
            dropdownMenu.classList.remove("opacity-0", "invisible", "translate-y-[-10px]");
            dropdownMenu.classList.add("opacity-100", "visible", "translate-y-0");
            if (dropdownIcon) dropdownIcon.style.transform = "rotate(180deg)";
        });

        dropdownContainer.addEventListener("mouseleave", function () {
            dropdownMenu.classList.add("opacity-0", "invisible", "translate-y-[-10px]");
            dropdownMenu.classList.remove("opacity-100", "visible", "translate-y-0");
            if (dropdownIcon) dropdownIcon.style.transform = "rotate(0deg)";
        });
    }

    // --- Smart Scroll Navbar (Desktop Only) ---
    const desktopNavbar = document.getElementById("main-navbar");
    if (desktopNavbar) {
        let lastScrollTop = 0;
        const threshold = 5; // Reduced threshold for better responsiveness

        window.addEventListener("scroll", function () {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            // Always show at the very top
            if (scrollTop < 100) {
                desktopNavbar.classList.remove("nav-hidden");
                return;
            }

            // Scroll direction detection
            if (Math.abs(lastScrollTop - scrollTop) <= threshold) return;

            if (scrollTop > lastScrollTop && scrollTop > 150) {
                // Scrolling down - Hide
                desktopNavbar.classList.add("nav-hidden");
            } else if (scrollTop < lastScrollTop) {
                // Scrolling up - Show
                desktopNavbar.classList.remove("nav-hidden");
            }

            lastScrollTop = scrollTop;
        }, { passive: true });
    }
});

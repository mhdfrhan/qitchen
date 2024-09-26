document.addEventListener("livewire:navigated", () => {
    const openNavButton = document.getElementById("openNav");
    const closeNavButton = document.getElementById("closeNav");
    const overlayNav = document.getElementById("overlayNav");
    const menuItems = document.querySelectorAll(".navMenu .slide-right");

    if (openNavButton && closeNavButton && overlayNav && menuItems) {
        openNavButton.addEventListener("click", () => {
            overlayNav.style.display = "block";
            document.body.style.overflow = "hidden";

            menuItems.forEach((item, index) => {
                setTimeout(() => {
                    item.classList.add("active");
                }, index * 100);
            });
        });

        closeNavButton.addEventListener("click", () => {
            overlayNav.style.display = "none";
            document.body.style.overflow = "auto";

            menuItems.forEach((item) => {
                item.classList.remove("active");
            });
        });
    }
});


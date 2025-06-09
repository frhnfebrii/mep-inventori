import './bootstrap';
document.addEventListener("DOMContentLoaded", function () {
  const toggleBtn = document.getElementById("toggleBtn");
  const sidebar = document.getElementById("sidebar");
  const hamburgerIcon = document.getElementById("hamburgerIcon");
  const closeIcon = document.getElementById("closeIcon");

  toggleBtn.addEventListener("click", () => {
    sidebar.classList.toggle("w-60");
    sidebar.classList.toggle("w-24");

    document.querySelectorAll(".sidebar-text").forEach(el => {
      el.classList.toggle("hidden");
    });

    hamburgerIcon.toggleAttribute("hidden");
    closeIcon.toggleAttribute("hidden");
  });

  // Dropdown toggle
  const dropdownButton = sidebar.querySelector("button");
  const dropdownList = dropdownButton.nextElementSibling;

  dropdownButton.addEventListener("click", () => {
    dropdownList.classList.toggle("hidden");
  });
});

  document.addEventListener("DOMContentLoaded", function () {
    const toggleButton = document.getElementById("toggleBarang");
    const submenu = document.getElementById("submenuBarang");
    const arrowIcon = document.getElementById("arrowIcon");

    toggleButton.addEventListener("click", () => {
      submenu.classList.toggle("hidden");
      arrowIcon.classList.toggle("rotate-180"); // untuk animasi rotasi panah
    });
  });
  document.addEventListener("DOMContentLoaded", function () {
    const toggleButton = document.getElementById("toggleBarang1");
    const submenu = document.getElementById("submenuBarang1");
    const arrowIcon = document.getElementById("arrowIcon1");

    toggleButton.addEventListener("click", () => {
      submenu.classList.toggle("hidden");
      arrowIcon.classList.toggle("rotate-180"); // untuk animasi rotasi panah
    });
  });

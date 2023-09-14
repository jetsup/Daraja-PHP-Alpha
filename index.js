document.addEventListener("DOMContentLoaded", function () {
  const currentLocation = window.location.pathname;
  const navLinks = document.querySelectorAll(".nav-link");
  navLinks.forEach((link) => {
    if (currentLocation.endsWith(link.getAttribute("href"))) {
      link.classList.add("active");
    }
  });
});

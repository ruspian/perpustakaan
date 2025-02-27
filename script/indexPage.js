const menuToggle = document.getElementById("mobile-menu");
const navLinks = document.querySelector(".nav-links");
menuToggle.addEventListener("click", () => {
  navLinks.classList.toggle("active");
});

document.getElementById("search-button").addEventListener("click", function () {
  const searchForm = document.getElementById("search-form");
  searchForm.classList.toggle("active");
});

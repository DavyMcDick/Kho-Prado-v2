window.addEventListener("DOMContentLoaded", () => {
  const hamburger = document.querySelector("#hamburger");
  const menuList = document.querySelector("#menuList");
  hamburger.addEventListener("click", () => {
    if (menuList.className.includes("show")) {
      menuList.classList.remove("show");
    } else {
      menuList.classList.add("show");
    }
  });
});

window.addEventListener("resize", () => {
  if (window.innerWidth < 993) {
    menuList.classList.remove("show");
  }
});

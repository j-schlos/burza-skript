const header = document.querySelector("header");
const hamburger = document.querySelector("#hamburger");
const hamburger_content = document.querySelector("#hamburger-content");
const main_page_top_container = document.querySelector("#home-page-top-container");

hamburger.addEventListener("click", () => {
      header.classList.toggle("active");
      hamburger.classList.toggle("active");
      hamburger_content.classList.toggle("active");
      main_page_top_container.classList.toggle("active");
})

document.querySelectorAll("header-link").forEach(n => n.addEventListener("click"), () =>{
      header.classList.remove("active");
      hamburger.classList.remove("active");
      hamburger_content.classList.remove("active");
      main_page_top_container.classList.remove("active");
})
const checkbox = document.querySelector(".menu-toggle input")
const navList = document.querySelector("nav ul")

checkbox.addEventListener("click", function() {
    navList.classList.toggle("slide")
})
const fill = document.querySelector(".fill");

console.log(fill);

setInterval(() => {
    fill.classList.add("glowing");
    setTimeout(() => {
        fill.classList.remove("glowing");
    }, 4000);
}, 10000);
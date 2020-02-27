// animation of checked icon on the shield

const fill = document.querySelector(".fill");

setInterval(() => {
    fill.classList.add("glowing");
    setTimeout(() => {
        fill.classList.remove("glowing");
    }, 4000);
}, 10000);
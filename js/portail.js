// click event on the arrow which will activate the growth side nav or shrink it

const arrow = document.querySelector(".arrow");
const p = document.querySelectorAll("#p");
const sideNav = document.querySelector(".side");

arrow.addEventListener("click", ()=>{
    if(arrow.classList.contains("fa-arrow-left"))
    {     
        arrow.classList.remove("fa-arrow-left");
        arrow.classList.add("fa-arrow-right");
        sideNav.classList.add("shrink");
        p.forEach(p => {
            p.classList.add("para");
        });
    }
    else
    {
        arrow.classList.remove("fa-arrow-right");
        arrow.classList.add("fa-arrow-left");
        sideNav.classList.remove("shrink");
        p.forEach(p => {
            p.classList.remove("para");
        });
    }
});

// click event listenner on search Icon which will activate the search bar or desactivate it

const searchIcon = document.querySelector(".fa-search");
const searchBar = document.querySelector(".searchBar");
const container = document.querySelector(".searchContainer");
const icons = document.querySelector(".icons");


searchIcon.addEventListener("click", ()=>{
    if(!icons.classList.contains("iconsGrow"))
    {
        icons.classList.add("iconsGrow");
        container.classList.add("opacitySearch");
        searchBar.classList.add("growUp");
    }
    else
    {
        icons.classList.remove("iconsGrow");
        container.classList.remove("opacitySearch");
        searchBar.classList.remove("growUp");
    }
});
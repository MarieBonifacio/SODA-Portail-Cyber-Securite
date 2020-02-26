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

//file input animation

const realBtn = document.querySelector("#real-file");
const fakeBtn = document.querySelector("#custom-button");
const span = document.querySelector("#custom-text");
const regex = /[\/\\]([\w\d\s\.\-\(\)]+)$/;
/*
regex to analyse: 

/ 
first character : [ matches  "/"  or  "\"  before the name of the file ]
then a character ( [ matches any word characters "\w"  or  "\d" or whitespaces "\s"  or  special characters among  "\." _ "\-" _ "\(" _ "\)" -> between one and unlimited characters "+" ] )
$ -> end of regex 
/   

*/

fakeBtn.addEventListener("click", ()=>{
    realBtn.click();
});

realBtn.addEventListener("change", ()=>{
    if(realBtn.value)
    {
        // match() method get a correlation table between a regular expression (image path -> realBtn.value)  and a rational expression (regex)
        span.innerHTML = realBtn.value.match(regex)[1];
    }
    else
    {
        span.innerHTML = "Aucune image séléctionnée";
    }
})

// clock animation -> hands of clock rotation

let rotateBigHand = -30;
let rotateLittleHand = -120;
const bigHand = document.querySelector("#Vector_106");
const littleHand = document.querySelector("#Vector_107");

setInterval(() => {
    rotateBigHand +=6;
    rotateLittleHand +=0.5;
    bigHand.style.transform = `rotate(${rotateBigHand}deg)`;
    littleHand.style.transform = `rotate(${rotateLittleHand}deg)`;
}, 50);
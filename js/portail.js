// click event on the arrow which will activate the growth side nav or shrink it

const arrow = document.querySelector(".arrow");
const p = document.querySelectorAll("#p");
const sideNav = document.querySelector(".side");
const contenu = document.querySelector(".content");

arrow.addEventListener("click", ()=>{
    if(arrow.classList.contains("fa-arrow-left"))
    {     
        arrow.classList.remove("fa-arrow-left");
        arrow.classList.add("fa-arrow-right");
        sideNav.classList.add("shrink");
        p.forEach(p => {
            p.classList.add("para");
        });
        contenu.style.width = "95%";
    }
    else
    {
        arrow.classList.remove("fa-arrow-right");
        arrow.classList.add("fa-arrow-left");
        sideNav.classList.remove("shrink");
        p.forEach(p => {
            p.classList.remove("para");
        });
        contenu.style.width = "85%";
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

// click event for dropDown list menu
const dropMenus = document.querySelectorAll(".dropMenu");
const arrows = document.querySelectorAll(".fas");

arrows.forEach(arrow => {
    arrow.addEventListener("click", (e)=>{
        // console.log(e.target.dataset.id);
        let id = e.target.dataset.id;
        let menu = document.querySelector(`#${id}`);
        // console.log(menu);
        dropMenus.forEach(dropMenu => {
            if(dropMenu.id == id)
            {
                if(menu.classList.contains("dropMenuAppear"))
                {
                    menu.classList.remove("dropMenuAppear");
                }
                else
                {
                    menu.classList.add("dropMenuAppear");
                }
            }
            else if(dropMenu.id != id)
            {
                dropMenu.classList.remove("dropMenuAppear");
            }
        });
    })
});

window.addEventListener('load', function () {
    var urlNotif = myScript.theme_directory;
    var xmlhttpNotif = new XMLHttpRequest();
    xmlhttpNotif.onreadystatechange = function () {
    if(this.readyState == 4 && this.status == 200)
    {
        var notif = JSON.parse(this.responseText);
        console.log(notif);
    }
    else
    {
        console.log('pas ok')
    }
    };

    // url a trouver
    xmlhttpNotif.open("GET", urlNotif  + '/notification.php', true);
    xmlhttpNotif.send();
});
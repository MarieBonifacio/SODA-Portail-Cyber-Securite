console.log(1);
window.addEventListener('load', function () {
    var urlNotif = myScriptDir.theme_directory;
    var xmlhttpNotif = new XMLHttpRequest();
    xmlhttpNotif.onreadystatechange = function () {
    if(this.readyState == 4 && this.status == 200)
    {
        var notifTable = JSON.parse(this.responseText),
        number = notifTable.nombre,
        articles = notifTable.article,
        modules = notifTable.module,
        quiz = notifTable.quiz;
        const bell = document.querySelector(".fa-bell"),
        nbrNotifs = document.querySelector(".nbr_notifs"),
        notifs = document.querySelector(".notifs");
        notifs.innerHTML='';
        bell.addEventListener("click", ()=>{
            // window.location = urlNotif  + '/notif_checked.php';
            if(notifs.classList.contains("notifsAppear"))
            {   
                notifs.classList.remove("notifsAppear")
                var xmlhttpNotifChecked = new XMLHttpRequest();
                xmlhttpNotifChecked.onreadystatechange = function () {
                    if(this.readyState == 4 && this.status == 200)
                    {
                        // window.location.reload();
                        number = 0;
                        nbrNotifs.innerHTML = number;
                        notifs.innerHTML = "Vous n'avez pas de notifications";
                    }
                    else
                    {
                        // console.log("pas ok")
                    }
                };

                // url a trouver
                xmlhttpNotifChecked.open("GET", urlNotif  + '/notif_checked.php', true);
                xmlhttpNotifChecked.send();
            }
            else
            {
                notifs.classList.add("notifsAppear")
            }
        })
        if(number > 0)
        {
            nbrNotifs.innerHTML = number;
            if(articles.length > 0)
            {
                for (let i = 0; i < articles.length; i++) {
                    notifs.innerHTML += `
                        <p>L'article <a href="${articles[i].guid}}"><span>${articles[i].post_title}</span></a> a été publié(e) le <span>${articles[i].post_date}</span></p>
                    `;
                }
            }
            if(quiz.length > 0)
            {
                for (let j = 0; j < quiz.length; j++) {
                    notifs.innerHTML += `
                        <p>Le quiz <a href="http://localhost/wordpress/menu-quiz/"><span>${quiz[j].name}</span></a> a été créé le <span>${quiz[j].created_at}</span></p>
                    `;
                }
            }
            if(modules.length > 0)
            {
                for (let f = 0; f < modules.length; f++) {
                    notifs.innerHTML += `
                        <p>Le module <a href="http://localhost/wordpress/menu-module/"><span>${modules[f].title}</span></a> a été créé le <span>${modules[f].created_at}</span></p>
                    `;
                }
            }
        }
        else
        {
            nbrNotifs.innerHTML = number;
            notifs.innerHTML = "Vous n'avez pas de notifications";
        }
        
        // // click event listenner on search Icon which will activate the search bar or desactivate it
        
        // const searchIcon = document.querySelector(".fa-search");
        // const searchBar = document.querySelector(".searchBar");
        // const container = document.querySelector(".searchContainer");
        // const icons = document.querySelector(".icons");
        
        
        // searchIcon.addEventListener("click", ()=>{
        //     if(!icons.classList.contains("iconsGrow"))
        //     {
        //         icons.classList.add("iconsGrow");
        //         container.classList.add("opacitySearch");
        //         searchBar.classList.add("growUp");
        //     }
        //     else
        //     {
        //         icons.classList.remove("iconsGrow");
        //         container.classList.remove("opacitySearch");
        //         searchBar.classList.remove("growUp");
        //     }
        // });
        
        // click event for dropDown list menu
        const dropMenus = document.querySelectorAll(".dropMenu");
        const arrows = document.querySelectorAll(".drop");
        
        arrows.forEach(arrow => {
            arrow.addEventListener("click", (e)=>{
                let id = e.target.dataset.id;
                let menu = document.querySelector(`#${id}`);
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
        
        const profil = document.querySelector(".circle"),
        dropMenuProfile = document.querySelector(".dropMenuProfile");
        
        profil.addEventListener("click", ()=>{
            if(dropMenuProfile.classList.contains("dropMenuProfileAppear"))
            {
                dropMenuProfile.classList.remove("dropMenuProfileAppear");
            }
            else
            {
                dropMenuProfile.classList.add("dropMenuProfileAppear");
            }
        })

        // click event on the arrow which will activate the growth side nav or shrink it

        const arrow = document.querySelector(".arrow");
        const p = document.querySelectorAll("#p");
        const sideNav = document.querySelector(".side");
        const contenu = document.querySelector(".content");
        
        if(window.innerWidth>1100)
        {
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
                dropMenus.forEach(menu => {
                    if(menu.classList.contains("dropMenuAppear"))
                    {
                        menu.classList.remove("dropMenuAppear")
                    }
                });
            });
        }
        else
        {   
            arrow.addEventListener("click", ()=>{
                if(arrow.classList.contains("fa-arrow-left"))
                {     
                    arrow.classList.remove("fa-arrow-left");
                    arrow.classList.add("fa-arrow-right");
                    if(window.innerWidth>760)
                    {
                        sideNav.style.left = "-30%";
                    }
                    else
                    {
                        sideNav.style.left = "-60%";
                    }
                    contenu.style.width = "100%";
                }
                else
                {   
                    arrow.classList.remove("fa-arrow-right");
                    arrow.classList.add("fa-arrow-left");
                    sideNav.style.left = "0%";
                    contenu.style.width = "100%";
                }
                dropMenus.forEach(menu => {
                    if(menu.classList.contains("dropMenuAppear"))
                    {
                        menu.classList.remove("dropMenuAppear")
                    }
                });
            });
        } 
    }
    else
    {
        // console.log('pas ok')
    }
    };

    // url a trouver
    xmlhttpNotif.open("GET", urlNotif  + '/notification.php', true);
    xmlhttpNotif.send();
});
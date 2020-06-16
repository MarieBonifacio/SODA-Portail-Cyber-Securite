window.addEventListener('load', function () {
  var urlList = myScriptDir.theme_directory;
  // var home_url = myScript.theme_directory;
  var xmlhttpList = new XMLHttpRequest();
  xmlhttpList.onreadystatechange = function () {
  if(this.readyState == 4 && this.status == 200)
  {
    var myArray = JSON.parse(this.responseText);
    console.log(myArray);
    const ulCamp = document.querySelector('.camps');

    for (let i = 0; i < myArray.length; i++) {
      ulCamp.innerHTML += `
        <li>${myArray[i].Nom}<div><button data-id='${myArray[i].Id}' class="modify">Modifier</button><button data-name='${myArray[i].Nom}' data-id='${myArray[i].Id}' class="erase">Supprimer</button></div></li>
      `
    }

    function request(obj){
      var table = obj;
      dbParamPost = JSON.stringify(table);
      var xmlhttpPost = new XMLHttpRequest();
      xmlhttpPost.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200)
        {
          window.location.reload();
        }
      }
      xmlhttpPost.open("POST", urlList  + '/app/campaign_list.php', true);
      xmlhttpPost.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xmlhttpPost.send(dbParamPost);
    }

    // modifying part
    let id,
        name,
        objet;
    const modifybtns = document.querySelectorAll(".modify"),
          erasebtns = document.querySelectorAll(".erase"),
          nameCamp = document.querySelector(".nameCamp");
    modifybtns.forEach( (btn)=>{
      btn.addEventListener("click", ()=>{
        id = btn.dataset.id;
      })
    } )
    
    // erasing part
    const closeBtn = document.querySelectorAll(".close"),
          yes = document.querySelector(".yes"),
          confirmDiv = document.querySelector(".confirm");
    erasebtns.forEach((btn)=>{
      btn.addEventListener("click", ()=>{
        id = btn.dataset.id;
        name = btn.dataset.name;
        nameCamp.innerHTML = name;
        confirmDiv.classList.remove("hidden");
      })
    })
    yes.addEventListener("click", ()=>{
      objet = {
        "id" : id
      }
      request(objet);
    })
    closeBtn.forEach(btn => {
      btn.addEventListener("click", ()=>{
        confirmDiv.classList.add("hidden");
      });
    });

  }
  };
  // url a trouver
  xmlhttpList.open("GET", urlList  + '/app/campaign_list.php', true);
  xmlhttpList.send();
});
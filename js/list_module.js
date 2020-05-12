window.addEventListener('load', function () {
  var urlListe = myScriptDir.theme_directory;
  var xmlhttpListe = new XMLHttpRequest();
  xmlhttpListe.onreadystatechange = function () {
  if(this.readyState == 4 && this.status == 200)
  {
    var modules = JSON.parse(this.responseText);
    console.log(modules);
    const list = document.querySelector(".list"),
    content = document.querySelector(".modulesL");
    for(i=0; i<modules.length; i++)
    {
      list.innerHTML += `
      <tr>
        <td>
          <span>${modules[i].title}</span>
        </td>
        <td>
        <span>${modules[i].tag_name}</span>
        </td>
        <td>
          <p data-id="${modules[i].id}" class="delete">Supprimer</p>
          <a href="" target="_blank" class="modify">Modifier</a>
        </td>
      </tr>
      `
    }
    const btns = document.querySelectorAll(".delete");
    console.log(btns);
    btns.forEach(btn => {
      btn.addEventListener("click", (e)=>{
        let id =e.target.dataset.id;
        const div = document.createElement("div");
        div.classList.add("popup");
        div.innerHTML = `
          <p>Vous êtes certain de vouloir supprimer ce module ?
          </p>
          <div>
            <span id="yes">Oui</span>
            <span id="no">Non</span>
          </div>
          
        `;
        content.appendChild(div);
        const yes = document.querySelector("#yes"),
        no = document.querySelector("#no");
        yes.addEventListener("click" , ()=>{
          console.log(id);
          var urlModule = urlListe + '/deleteModule.php/?idModule=' + id;
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function () {
            if(this.readyState == 4 && this.status == 200)
            {
              console.log("ok");
              window.location.reload();
            }
            else
            {
              console.log("pas ok")
            }
          }
          xmlhttp.open("GET", urlModule , true);
          xmlhttp.send();
        })
        no.addEventListener("click", ()=>{
          content.removeChild(div);
        })
      })
    });
  }
  else
  {
    console.log('pas ok')
  }
  };

  // url a trouver
  xmlhttpListe.open("GET", urlListe  + '/menu_modules.php', true);
  xmlhttpListe.send();
});
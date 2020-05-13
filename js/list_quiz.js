window.addEventListener('load', function () {
  var urlListe = myScriptDir.theme_directory;
  var home_url = myScriptDir.home_url;
  var xmlhttpListe = new XMLHttpRequest();
  xmlhttpListe.onreadystatechange = function () {
  if(this.readyState == 4 && this.status == 200)
  {
    var quizs = JSON.parse(this.responseText);
    console.log(quizs);
    const list = document.querySelector(".list"),
    content = document.querySelector(".quizs");
    for(i=0; i<quizs.quiz.length; i++)
    {
      list.innerHTML += `
      <tr>
        <td>
          <span>${quizs.quiz[i].name}</span>
        </td>
        <td>
        <span>${quizs.quiz[i].tag_name}</span>
        </td>
        <td>
          <p data-id="${quizs.quiz[i].id}" class="delete">Supprimer</p>
          <a href="${home_url}/" target="_blank" class="modify">Modifier</a>
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
          <p>Vous êtes certain de vouloir supprimer ce quiz ?
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
          var urlQuiz = urlListe + '/deleteQuiz.php/?idQuiz=' + id;
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
          xmlhttp.open("GET", urlQuiz , true);
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
  xmlhttpListe.open("GET", urlListe  + '/menu_quiz.php', true);
  xmlhttpListe.send();
});
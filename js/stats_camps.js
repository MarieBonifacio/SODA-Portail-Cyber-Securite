window.addEventListener("load", ()=>{
  var url = myScript.theme_directory,
      home_url = myScript.home_url;
  let id,
      objet;
  const ulCamp = document.querySelector(".listCamp"),
        campName = document.querySelector(".name_camp"),
        spanCamp = document.querySelectorAll(".camp_name"),
        quizBody = document.querySelector(".bodyQ"),
        modBody = document.querySelector(".bodyM"),
        totalBody = document.querySelector(".total"),
        nbrMod = document.querySelector(".nbrMod"),
        nbrQuiz = document.querySelector(".nbrQuiz"),
        lisCamp = document.querySelectorAll(".liC");
  campName.addEventListener("click", ()=>{
    if(ulCamp.classList.contains("hidden"))
    {
      ulCamp.classList.remove("hidden");
    }
    else
    {
      ulCamp.classList.add("hidden");
    }
  })

  lisCamp.forEach(li => {
    li.addEventListener("click", ()=>{
      id = li.dataset.id;
      ulCamp.classList.add("hidden");
      spanCamp.forEach(span => {
        span.innerHTML =li.textContent;
      });
      objet = {
        "id" : id
      }
      requestPOST(objet);
    })
  });
  function requestPOST(obj){
    var table = obj;
    dbParamPost = JSON.stringify(table);
    var xmlhttpPost = new XMLHttpRequest();
    xmlhttpPost.onreadystatechange = function(){
      if(this.readyState == 4 && this.status == 200)
      {
        var myArray = JSON.parse(this.responseText),
            nbQuiz = myArray.nbQuiz,
            nbMod = myArray.nbModule;
        // console.log(myArray);
        const sites = myArray.sites;
        buildTable(myArray, sites, nbQuiz, nbMod);
      }
    }
    xmlhttpPost.open("POST", url  + '/app/campaign_stats.php', true);
    xmlhttpPost.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttpPost.send(dbParamPost);
  }

  function buildTable(array, sites, nbrquiz, nbrmod){
    quizBody.innerHTML = "";
    modBody.innerHTML = "";
    totalBody.innerHTML = "";
    for (let [key, value] of Object.entries(sites)) {
      quizBody.innerHTML += `
        <tr>
          <td>${key}</td>
          <td>${value.participationQuiz}%</td>
          <td>${parseInt(value.moyenneQuiz)}.pts</td>
          <td>${parseInt(value.tempsQuiz)}.s</td>
        </tr>
      `

      modBody.innerHTML += `
        <tr>
          <td>${key}</td>
          <td>${value.participationModule}%</td>
        </tr>
      `
    }
    totalBody.innerHTML = `
      <tr>
        <td>${array.total.participationQuiz}%</td>
        <td>${array.total.participationQuiz}%</td>
        <td>${parseInt(array.total.moyenneQuiz)}.pts</td>
        <td>${parseInt(array.total.tempsQuiz)}.s</td>
      </tr>
    `;
    nbrMod.innerHTML = nbrmod;
    nbrQuiz.innerHTML = nbrquiz;
  }
})
window.addEventListener('load', function () {
  var url = myScript.theme_directory;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
  if(this.readyState == 4 && this.status == 200)
  {
    var myArray = JSON.parse(this.responseText),
    lastQuiz = myArray.lastQuiz,
    leadTown = myArray.classementUserVille,
    leadGen = myArray.classementUserGeneral,
    top10Gen = leadGen.top10,
    top10Town = leadTown.top10,
    userStat = leadGen.userStat,
    gen = document.querySelector(".gen"),
    lastQ = document.querySelector(".lastQ"),
    town = document.querySelector(".town"),
    actu = document.querySelector(".actu"),
    results = document.querySelector(".results"),
    news = document.querySelector(".news"),
    quiz = document.querySelector(".quiz"),
    tbody = document.querySelector(".tbody"),
    leaderboard = document.querySelector(".leaderboard");
    let tableContent;
    console.log(myArray);
    for (i = 0; i < top10Gen.length; i++) 
      {
        console.log(parseInt(top10Gen[i].user_id) , parseInt(userStat.user_id));
        pos = i + 1;
        if(parseInt(userStat.user_id) == parseInt(top10Gen[i].user_id))
        {
          console.log("ok")
          tbody.innerHTML += `
          <tr class="imp">
            <td>${pos}</td>
            <td>${top10Gen[i].display_name}</td>      
            <td>${top10Gen[i].moyenne}</td>
          </tr>
          `
        }
        else
        {
          tbody.innerHTML += `
          <tr>
            <td>${pos}</td>
            <td>${top10Gen[i].display_name}</td>      
            <td>${top10Gen[i].moyenne}</td>
          </tr>
          `
        }
    }
    gen.addEventListener("click", ()=>{

      tbody.innerHTML ='';
      for (i = 0; i < top10Gen.length; i++) 
      {
        console.log(parseInt(top10Gen[i].user_id) , parseInt(userStat.user_id));
        pos = i + 1;
        if(parseInt(userStat.user_id) == parseInt(top10Gen[i].user_id))
        {
          console.log("ok")
          tbody.innerHTML += `
          <tr class="imp">
            <td>${pos}</td>
            <td>${top10Gen[i].display_name}</td>      
            <td>${top10Gen[i].moyenne}</td>
          </tr>
          `
        }
        else
        {
          tbody.innerHTML += `
          <tr>
            <td>${pos}</td>
            <td>${top10Gen[i].display_name}</td>      
            <td>${top10Gen[i].moyenne}</td>
          </tr>
          `
        }
      }
    })
    town.addEventListener("click", ()=>{
      tbody.innerHTML ='';
      for (i = 0; i < top10Gen.length; i++) 
      {
        console.log(parseInt(top10Gen[i].user_id) , parseInt(userStat.user_id));
        pos = i + 1;
        if(parseInt(userStat.user_id) == parseInt(top10Gen[i].user_id))
        {
          console.log("ok")
          tbody.innerHTML += `
          <tr class="imp">
            <td>${pos}</td>
            <td>${top10Gen[i].display_name}</td>      
            <td>${top10Gen[i].moyenne}</td>
          </tr>
          `
        }
        else
        {
          tbody.innerHTML += `
          <tr>
            <td>${pos}</td>
            <td>${top10Gen[i].display_name}</td>      
            <td>${top10Gen[i].moyenne}</td>
          </tr>
          `
        }
      }
    })
    
    const elementQuiz = document.createElement("div");
    elementQuiz.classList.add("contentQ");
    elementQuiz.innerHTML = `
      <a href="http://localhost/wordpress/menu-quiz/">
      <div class="filter"></div>
      <img src="${ url + `/img/quizs/${lastQuiz.name}/${lastQuiz.img}`}" alt="photo du quiz"/>
      <h2>${lastQuiz.name}</h2>
      <p>${lastQuiz.tag_name}</p>
      </a>
    `;
    lastQ.appendChild(elementQuiz);
  }
  else
  {
    console.log('pas ok')
  }
  };

  // url a trouver
  xmlhttp.open("GET", url  + '/dashboard_back.php', true);
  xmlhttp.send();
});


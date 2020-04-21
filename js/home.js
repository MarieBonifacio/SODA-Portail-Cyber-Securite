window.addEventListener('load', function () {
  var url = myScript.theme_directory;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
  if(this.readyState == 4 && this.status == 200)
  {
    var myArray = JSON.parse(this.responseText),
    lastQuiz = myArray.lastQuiz,
    userResults = myArray.userResults,
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
    if(userStat != null)
    {
      for (i = 0; i < top10Gen.length; i++) 
        {
          pos = i + 1;
          if(parseInt(userStat.user_id) == parseInt(top10Gen[i].user_id))
          {
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
          pos = i + 1;
          if(parseInt(userStat.user_id) == parseInt(top10Gen[i].user_id))
          {
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
          pos = i + 1;
          if(parseInt(userStat.user_id) == parseInt(top10Gen[i].user_id))
          {
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
    }
    else
    {
      for (i = 0; i < top10Gen.length; i++) 
      {
        pos = i + 1;
        tbody.innerHTML += `
        <tr>
          <td>${pos}</td>
          <td>${top10Gen[i].display_name}</td>      
          <td>${top10Gen[i].moyenne}</td>
        </tr>
        `
      }
      gen.addEventListener("click", ()=>{
  
        tbody.innerHTML ='';
        for (i = 0; i < top10Gen.length; i++) 
        {
          pos = i + 1;
          tbody.innerHTML += `
          <tr>
            <td>${pos}</td>
            <td>${top10Gen[i].display_name}</td>      
            <td>${top10Gen[i].moyenne}</td>
          </tr>
          `
        }
      })
      town.addEventListener("click", ()=>{
        tbody.innerHTML ='';
        for (i = 0; i < top10Gen.length; i++) 
        {
          pos = i + 1;
          tbody.innerHTML += `
          <tr>
            <td>${pos}</td>
            <td>${top10Gen[i].display_name}</td>      
            <td>${top10Gen[i].moyenne}</td>
          </tr>
          `
        }
      })
    }
    
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

    let lastResults = userResults.slice(Math.max(userResults.length - 10, 1));
    console.log(lastResults),
    labels = [],
    points = [];

    for ( i = 0; i < lastResults.length; i++) {
      labels.push(lastResults[i].name);
      points.push(parseInt(lastResults[i].score));
    }
    console.log(points);


    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
      type: 'line',
      options: {
        legend: {
          display: false
        },
        animation: {
          easing: 'easeInOutQuad',
          duration: 520
        },
        scales: {
          xAxes: [{
            gridLines: {
              color: 'rgba(200, 200, 200, 0.05)',
              lineWidth: 1
            }
          }],
          yAxes: [{
            gridLines: {
              color: 'rgba(200, 200, 200, 0.08)',
              lineWidth: 1
            }
          }]
        },
        elements: {
          line: {
            tension: 0.4
          }
        },
        point: {
          backgroundColor: 'white'
        },
        tooltips: {
          titleFontFamily: 'Muli',
          backgroundColor: 'rgba(0,0,0,0.3)',
          titleFontColor: 'red',
          caretSize: 5,
          cornerRadius: 2,
          xPadding: 10,
          yPadding: 10
        }
      },
      data: {
        labels : labels,
        datasets: [{
          label: 'score',
          data: points,
          borderWidth: 1,
          borderColor: '#911215',
          pointBackgroundColor: 'white',
          backgroundColor: 'red',
        }]
      }
    })
    
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


window.addEventListener('load', function () {
  var url = myScript.theme_directory;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
  if(this.readyState == 4 && this.status == 200)
  {
    var myArray = JSON.parse(this.responseText);
    var genTown = myArray.classementVilleGeneral,
    genUser = myArray.classementUser,
    genUserBoard = genUser.classement,
    userId = myArray.top10User.userStat.user_id;
    console.log(myArray, genUserBoard);
    const leadBoard = document.querySelector(".leadboard"),
    genUserBtn = document.querySelector(".gen"),
    genTownBtn = document.querySelector(".town");
    
    const table = document.querySelector("table"),
    tbody = document.querySelector("tbody"),
    thead = document.querySelector("thead"),
    spanAbove = document.querySelector(".span_above"),
    spanUnder = document.querySelector(".span_under");
    let pos,
    isAbove = 0,
    isUnder = 0;

    for(i=0; i<genUserBoard.length; i++)
    {
      pos = i + 1;
      thead.innerHTML=`
        <th>Pos</th>
        <th>Joueur</th>
        <th>Ville</th>
        <th>Nbr de quiz</th>
        <th>Temps global (en sec.)</th>
        <th>Score</th>
      `
      if(parseInt(genUserBoard[i].user_id) == parseInt(userId))
      {   
        if(genUserBoard[i].moyenne<50)
        {
          isUnder += 1;
          tbody.innerHTML += `
            <tr class="imp">
            <td>${pos}</td>
            <td>${genUserBoard[i].display_name}</td>
            <td>${genUserBoard[i].meta_value}</td>
            <td>${genUserBoard[i].count}</td>
            <td>${genUserBoard[i].time}</td>
            <td class="red">${genUserBoard[i].moyenne}</td>
            </tr>
          `
        }
        else
        {
          isAbove += 1; 
          tbody.innerHTML += `
          <tr class="imp">
          <td>${pos}</td>
          <td>${genUserBoard[i].display_name}</td>
          <td>${genUserBoard[i].meta_value}</td>
          <td>${genUserBoard[i].count}</td>
          <td>${genUserBoard[i].time}</td>
          <td class="green">${genUserBoard[i].moyenne}</td>
          </tr>
          `
        }
      }
      else
      {
        if(genUserBoard[i].moyenne<50)
        {
          isUnder += 1;
          tbody.innerHTML += `
            <tr>
            <td>${pos}</td>
            <td>${genUserBoard[i].display_name}</td>
            <td>${genUserBoard[i].meta_value}</td>
            <td>${genUserBoard[i].count}</td>
            <td>${genUserBoard[i].time}</td>
            <td class="red">${genUserBoard[i].moyenne}</td>
            </tr>
          `
        }
        else
        {
          isAbove += 1; 
          tbody.innerHTML += `
          <tr>
          <td>${pos}</td>
          <td>${genUserBoard[i].display_name}</td>
          <td>${genUserBoard[i].meta_value}</td>
          <td>${genUserBoard[i].count}</td>
          <td>${genUserBoard[i].time}</td>
          <td class="green">${genUserBoard[i].moyenne}</td>
          </tr>
          `
        }
      }
    }

    genUserBtn.addEventListener("click", ()=>{
      tbody.innerHTML='';
      thead.innerHTML='';
      isAbove = 0;
      isUnder = 0;
      for(i=0; i<genUserBoard.length; i++)
      {
        pos = i + 1;
        thead.innerHTML=`
          <th>Pos</th>
          <th>Joueur</th>
          <th>Ville</th>
          <th>Nbr de quiz</th>
          <th>Temps global (en sec.)</th>
          <th>Score</th>
        `
        if(parseInt(genUserBoard[i].user_id) == parseInt(userId))
        {   
          if(genUserBoard[i].moyenne<50)
          {
            isUnder += 1;
            tbody.innerHTML += `
              <tr class="imp">
              <td>${pos}</td>
              <td>${genUserBoard[i].display_name}</td>
              <td>${genUserBoard[i].meta_value}</td>
              <td>${genUserBoard[i].count}</td>
              <td>${genUserBoard[i].time}</td>
              <td class="red">${genUserBoard[i].moyenne}</td>
              </tr>
            `
          }
          else
          {
            isAbove += 1; 
            tbody.innerHTML += `
            <tr class="imp">
            <td>${pos}</td>
            <td>${genUserBoard[i].display_name}</td>
            <td>${genUserBoard[i].meta_value}</td>
            <td>${genUserBoard[i].count}</td>
            <td>${genUserBoard[i].time}</td>
            <td class="green">${genUserBoard[i].moyenne}</td>
            </tr>
            `
          }
        }
        else
        {
          if(genUserBoard[i].moyenne<50)
          {
            isUnder += 1;
            tbody.innerHTML += `
              <tr>
              <td>${pos}</td>
              <td>${genUserBoard[i].display_name}</td>
              <td>${genUserBoard[i].meta_value}</td>
              <td>${genUserBoard[i].count}</td>
              <td>${genUserBoard[i].time}</td>
              <td class="red">${genUserBoard[i].moyenne}</td>
              </tr>
            `
          }
          else
          {
            isAbove += 1; 
            tbody.innerHTML += `
            <tr>
            <td>${pos}</td>
            <td>${genUserBoard[i].display_name}</td>
            <td>${genUserBoard[i].meta_value}</td>
            <td>${genUserBoard[i].count}</td>
            <td>${genUserBoard[i].time}</td>
            <td class="green">${genUserBoard[i].moyenne}</td>
            </tr>
            `
          }
        }
      }
    })

    genTownBtn.addEventListener("click", ()=>{
      tbody.innerHTML='';
      thead.innerHTML='';
      isAbove = 0;
      isUnder = 0;
      for(i=0; i<genTown.length; i++)
      {
        pos = i + 1;
        thead.innerHTML=`
          <th>Pos</th>
          <th>Ville</th>
          <th>Nbr de quiz</th>
          <th>Temps global (en sec.)</th>
          <th>Score</th>
        `
        if(genTown[i].moyenne<50)
        {
          isUnder += 1;
          tbody.innerHTML += `
            <tr>
            <td>${pos}</td>
            <td>${genTown[i].city}</td>
            <td>${genTown[i].quizCount}</td>
            <td>${genTown[i].time}</td>
            <td class="red">${genTown[i].moyenne}</td>
            </tr>
          `
        }
        else
        {
          isAbove += 1; 
          tbody.innerHTML += `
          <tr>
          <td>${pos}</td>
          <td>${genTown[i].city}</td>
          <td>${genTown[i].quizCount}</td>
          <td>${genTown[i].time}</td>
          <td class="green">${genTown[i].moyenne}</td>
          </tr>
          `
        }
      }
    })

    spanAbove.innerHTML = `Moyenne de score > 50 : ${isAbove}`;
    spanUnder.innerHTML = `Moyenne de score < 50 : ${isUnder}`;
    console.log(isUnder , isAbove)
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
window.addEventListener('load', function () {
  var url = myScript.theme_directory;
  var xmlhttp = new XMLHttpRequest();
  var obj = {
    "type" : "global",
    "filtre" : "general",
    "id" : "null"
  }
  dbParam = JSON.stringify(obj);
  xmlhttp.onreadystatechange = function () {
    if(this.readyState == 4 && this.status == 200)
    {
      // call the same file in GET method in order to take the list of quiz and categories
      var xmlhttp2 = new XMLHttpRequest();
      xmlhttp2.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200)
          {
            var myArray = JSON.parse(this.responseText);
            console.log(myArray);
            const selectQuiz = document.querySelector(".listQuiz"),
                  selectCat = document.querySelector(".listCat"),
                  quizArray = myArray.quizs,
                  catArray = myArray.tags;
            
            for (let i = 0; i < quizArray.length; i++) {
              selectQuiz.innerHTML += `
                <li class="quizLi" data-id="${quizArray[i].id}">${quizArray[i].name}</li>
              `
            }
            for (let i = 0; i < catArray.length; i++) {
              selectCat.innerHTML += `
              <li class="quizLi" data-id="${catArray[i].id}">${catArray[i].name}</li>`;
            }
          }
      }
      xmlhttp2.open("GET", url  + '/app/leaderboard_admin.php', true);
      xmlhttp2.send();
      // ----------------------- 

      var myArray = JSON.parse(this.responseText);
      var classement = myArray.classement
      console.log(classement);
      const globalbtn = document.querySelector(".glob"),
            quizbtn = document.querySelector(".quizz"),
            catbtn = document.querySelector(".cat"),
            genfilter = document.querySelector(".gen"),
            sitesfilter = document.querySelector(".sites"),
            select = document.querySelector(".listQuizCat"),
            selectCat = document.querySelector(".listCat"),
            selectQuiz = document.querySelector(".listQuiz"),
            dropIcon = document.querySelector(".dropIcon"),
            legend = document.querySelector(".square_legend");

      selectCat.style.display = 'none';
      selectQuiz.style.display = 'none';
      globalbtn.style.background = "#e6e6e6";
      quizbtn.style.background = "#EBB94A";
      catbtn.style.background = "#EBB94A";
      genfilter.style.background = "#e6e6e6";
      sitesfilter.style.background = "#EBB94A";

      let filter = "general",
          type = "global",
          quiz_id = "null",
          tag_id = "null";

      function buildTable(array, filter, type)
      {
        const table = document.querySelector("table"),
              tbody = document.querySelector("tbody"),
              thead = document.querySelector("thead"),
              spanAbove = document.querySelector(".span_above"),
              spanUnder = document.querySelector(".span_under");
        let pos,
            isAbove,
            isUnder;
        thead.innerHTML = '';
        tbody.innerHTML = '';
        if(type == 'global')
        {
          if(filter=='general')
          {
            thead.innerHTML=`
              <th>Pos</th>
              <th>Joueur</th>
              <th>Site</th>
              <th>Nbr de quiz</th>
              <th>Temps global (en sec.)</th>
              <th>Score</th>
            `
          }
          else
          {
            thead.innerHTML=`
              <th>Pos</th>
              <th>Site</th>
              <th>Nbr de quiz</th>
              <th>Temps global (en sec.)</th>
              <th>Score</th>
            `
          }
        }
        else if(type== 'quiz')
        {
          if(filter=='general')
          {
            thead.innerHTML=`
              <th>Pos</th>
              <th>Joueur</th>
              <th>Site</th>
              <th>Temps global (en sec.)</th>
              <th>Score</th>
            `
          }
          else
          {
            thead.innerHTML=`
              <th>Pos</th>
              <th>Site</th>
              <th>Nbr de quiz</th>
              <th>Temps global (en sec.)</th>
              <th>Score</th>
            `
          }
        }
        else
        {
          if(filter=='general')
          {
            thead.innerHTML=`
              <th>Pos</th>
              <th>Joueur</th>
              <th>Site</th>
              <th>Nbr de quiz</th>
              <th>Temps global (en sec.)</th>
              <th>Score</th>
            `
          }
          else
          {
            thead.innerHTML=`
              <th>Pos</th>
              <th>Site</th>
              <th>Nbr de quiz</th>
              <th>Temps global (en sec.)</th>
              <th>Score</th>
            `
          }
        }
        for (let i = 0; i < array.length; i++) {
          pos = i + 1;
          if(type == 'quiz')
          {
            if(filter == 'general')
            {
              tbody.innerHTML += `
                <tr>
                <td>${pos}</td>
                <td>${array[i].Joueur}</td>
                <td>${array[i].Site}</td>
                <td>${array[i].Temps}</td>
                <td>${parseInt(array[i].Score)}</td>
                </tr>
              `
            }
            else
            {
              tbody.innerHTML += `
              <tr>
              <td>${pos}</td>
              <td>${array[i].Site}</td>
              <td>${array[i].Nombre}</td>
              <td>${array[i].Temps}</td>
              <td>${parseInt(array[i].Moyenne)}</td>
              </tr>
            `
            }
          }
          else if( type == 'tag')
          {
            if(filter == 'general')
            {
              tbody.innerHTML += `
                <tr>
                <td>${pos}</td>
                <td>${array[i].Joueur}</td>
                <td>${array[i].Site}</td>
                <td>${array[i].Nombre}</td>
                <td>${array[i].Temps}</td>
                <td>${parseInt(array[i].Moyenne)}</td>
                </tr>
              `
            }
            else
            {
              tbody.innerHTML += `
              <tr>
              <td>${pos}</td>
              <td>${array[i].Site}</td>
              <td>${array[i].Nombre}</td>
              <td>${array[i].Temps}</td>
              <td>${parseInt(array[i].Moyenne)}</td>
              </tr>
            `
            }
          }
          else
          {
            if(filter == 'general')
            {
              tbody.innerHTML += `
                <tr>
                <td>${pos}</td>
                <td>${array[i].display_name}</td>
                <td>${array[i].meta_value}</td>
                <td>${array[i].count}</td>
                <td>${array[i].time}</td>
                <td>${parseInt(array[i].moyenne)}</td>
                </tr>
              `
            }
            else
            {
              tbody.innerHTML += `
              <tr>
              <td>${pos}</td>
              <td>${array[i].city}</td>
              <td>${array[i].quizCount}</td>
              <td>${array[i].time}</td>
              <td>${parseInt(array[i].moyenne)}</td>
              </tr>
            `
            }
          }
        }
        
      }
      function request(obj, type, filter){
        var table = obj;
        dbParamPost = JSON.stringify(table);
        var xmlhttpPost = new XMLHttpRequest();
        if(type == 'global' && filter == 'general')
        {
          xmlhttpPost.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200)
            {
              var myArray = JSON.parse(this.responseText);
              console.log(myArray);
              buildTable(myArray.classement, filter, type);
            }
          }
        }
        else
        {
          xmlhttpPost.onreadystatechange = function(){
              if(this.readyState == 4 && this.status == 200)
              {
                var myArray = JSON.parse(this.responseText);
                console.log(myArray);
                buildTable(myArray, filter, type);
              }
          }
        }
        xmlhttpPost.open("POST", url  + '/app/leaderboard_admin.php', true);
        xmlhttpPost.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttpPost.send(dbParamPost);
      }
      globalbtn.addEventListener("click", ()=>{
        type = "global"
        globalbtn.style.background = "#e6e6e6";
        quizbtn.style.background = "#EBB94A";
        catbtn.style.background = "#EBB94A";
        console.log(type);
        console.log(filter);
        obj = {
          "type" : type,
          "filtre" : filter,
          "id" : "null"
        }
        console.log(obj);
        
        selectQuiz.style.display = "none";
        selectCat.style.display = "none";
        request(obj, type, filter);
      })
      quizbtn.addEventListener("click", ()=>{
        type= "quiz"
        globalbtn.style.background = "#EBB94A";
        quizbtn.style.background = "#e6e6e6";
        catbtn.style.background = "#EBB94A";
        console.log(type);
        console.log(filter);
        obj = {
          "type" : type,
          "filtre" : filter,
          "id" : quiz_id
        }
        console.log(obj);
        selectQuiz.style.display = "block";
        selectCat.style.display = "none";
        request(obj, type, filter);
      })
      catbtn.addEventListener("click", ()=>{
        type= "tag"
        globalbtn.style.background = "#EBB94A";
        quizbtn.style.background = "#EBB94A";
        catbtn.style.background = "#e6e6e6";
        console.log(type);
        console.log(filter);
        obj = {
          "type" : type,
          "filtre" : filter,
          "id" : tag_id
        }
        console.log(obj);
        selectQuiz.style.display = "none";
        selectCat.style.display = "block";
        request(obj, type, filter);
      })
      genfilter.addEventListener("click", ()=>{
        filter = "general"
        genfilter.style.background = "#e6e6e6";
        sitesfilter.style.background = "#EBB94A";
        console.log(type);
        console.log(filter);
        if(type == "quiz")
        {
          obj = {
            "type" : type,
            "filtre" : filter,
            "id" : quiz_id
          }
        }
        else if ( type == "tag") 
        {
          obj = {
            "type" : type,
            "filtre" : filter,
            "id" : tag_id
          }
        }
        else
        {
          obj = {
            "type" : type,
            "filtre" : filter,
            "id" : "null"
          }
        }
        console.log(obj);
        request(obj, type, filter);
      })
      sitesfilter.addEventListener("click", ()=>{
        filter = "sites"
        genfilter.style.background = "#EBB94A";
        sitesfilter.style.background = "#e6e6e6";
        console.log(type);
        console.log(filter);
        if(type == "quiz")
        {
          obj = {
            "type" : type,
            "filtre" : filter,
            "id" : quiz_id
          }
        }
        else if ( type == "tag") 
        {
          obj = {
            "type" : type,
            "filtre" : filter,
            "id" : tag_id
          }
        }
        else
        {
          obj = {
            "type" : type,
            "filtre" : filter,
            "id" : "null"
          }
        }
        console.log(obj);
        request(obj, type, filter);
      })

      buildTable(classement, filter, type);
      // drop the legend
      dropIcon.addEventListener("click", ()=>{
        if(legend.classList.contains("dropLegend"))
        {
          legend.classList.remove("dropLegend");
        }
        else
        {
          legend.classList.add("dropLegend");
        }
      });
    }
  }
  xmlhttp.open("POST", url  + '/app/leaderboard_admin.php', true);
  xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xmlhttp.send(dbParam);
});
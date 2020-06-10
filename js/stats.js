window.addEventListener('load', function () {
  var url = myScript.theme_directory;
  var home_url = myScript.home_url;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if(this.readyState == 4 && this.status == 200)
    {
      var myArray = JSON.parse(this.responseText),
      quizs = myArray.quizs,
      modules = myArray.modules,
      labels = [],
      pourcentages = [],
      borderColor= [],
      backgroundColor= [];

      console.log(myArray);

      function buildChart(array, labels, pourcentages, backColor, borderColor){
        labels = [],
        pourcentages = [],
        borderColor= [],
        backColor= [];
        console.log(labels);
        const canva = document.querySelector(".canva");
        console.log(canva);
        for(let i=0; i<array.length; i++)
        {
          labels.push(array[i].titre);
          pourcentages.push(array[i].pourcentage);

          let rgb1 = Math.floor(Math.random()*Math.floor(255)),
          rgb2 = Math.floor(Math.random()*Math.floor(255)),
          rgb3 = Math.floor(Math.random()*Math.floor(255));

          backColor.push(`rgba(${rgb1},${rgb2},${rgb3}, 0.5)`);
          borderColor.push(`rgba(${rgb1},${rgb2},${rgb3}, 1)`)
        }
        console.log(labels);
        let data,
            fontColor,
            options;

        data = {
          labels: labels,
          datasets: [{
            label: '% terminé',
            data: pourcentages,
            backgroundColor: backColor,
            borderColor: borderColor,
            borderWidth: 2
          }]
        };
        options = {
          legend: {
            display: false,
          },
          animation: {
            easing: 'easeInOutQuad',
            duration: 520
          },
          scales: {
            xAxes: [{
              display: false,
              gridLines: {
                color: 'rgba(0,0,0,0)',
              }
            }],
            yAxes: [{
              gridLines: {
                color: 'rgba(0,0,0,0)',
              },
              ticks: {
                beginAtZero: true,
                max: 100
              }
            }]
          },
          elements: {
            line: {
              tension: 0.3
            }
          },
          tooltips: {
            titleFontFamily: 'Muli',
            backgroundColor: 'rgba(0,0,0,0.3)',
            caretSize: 5,
            cornerRadius: 2,
            xPadding: 10,
            yPadding: 10
          },
        };
        canva.remove();
        const newCanva = document.createElement("canvas"),
              canvaDiv = document.querySelector(".canvaDiv");
              newCanva.classList.add("canva");
        canvaDiv.appendChild(newCanva);
        console.log(canvaDiv);

        var myChart = new Chart(newCanva, {
          type: "bar",
          data: data,
          options: options
        });
        Chart.defaults.global.defaultFontColor='white';
      }

      buildChart(quizs, labels, pourcentages, backgroundColor, borderColor);
      let typeName,
          filterName,
          siteName,
          obj = {
            "site" : siteName
          };

      const quiz = document.querySelector(".quizBtn"),
            module = document.querySelector(".moduleBtn"),
            gen = document.querySelector(".genBtn"),
            site = document.querySelector(".siteBtn"),
            ul = document.querySelector(".listSite"),
            divlist = document.querySelector(".listDiv"),
            lis = document.querySelectorAll(".li"),
            labelSIte = document.querySelector(".labelSite");

      function requestPOST(obj){
        console.log(obj);
        var table = obj;
        dbParamPost = JSON.stringify(table);
        var xmlhttpPost = new XMLHttpRequest();
        xmlhttpPost.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200)
          {
            var myArray = JSON.parse(this.responseText);
            console.log(myArray);
            if(typeName == 'Quiz')
            {
              buildChart(myArray.quizs, labels, pourcentages, backgroundColor, borderColor);
            }
            else
            {
              buildChart(myArray.modules, labels, pourcentages, backgroundColor, borderColor);
            }
          }
        }
        xmlhttpPost.open("POST", url  + '/statistics.php', true);
        xmlhttpPost.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttpPost.send(dbParamPost);
      }
      
      function listenerClickBtns(btn1, btn2)
      {   
        btn1.addEventListener("click", ()=>{
          if(!btn1.classList.contains("activated"))
          {
            btn2.classList.remove("activated");
            btn1.classList.add("activated");
          }
          if(site.classList.contains("activated"))
          {
            divlist.classList.remove("hidden")
          }
          else
          {
            divlist.classList.add("hidden")
          }
          if(btn1 == site || btn1 == gen)
          {
            filterName = btn1.textContent;
            console.log(filterName);
            console.log(typeName);
          }
          else
          {
            typeName = btn1.textContent;
            console.log(filterName);
            console.log(typeName);
          }
          if(btn1 == site)
          {
            return
          }
          else
          {
            if(typeName == "Quiz")
            {
              buildChart(quizs, labels, pourcentages, backgroundColor, borderColor);
            }
            else
            {
              buildChart(modules, labels, pourcentages, backgroundColor, borderColor);
            }
          }
        })
      }
      listenerClickBtns(quiz, module);
      listenerClickBtns(module, quiz);
      listenerClickBtns(gen, site);
      listenerClickBtns(site, gen);

      labelSIte.addEventListener("click", ()=>{
        if(ul.classList.contains("hidden"))
        {
          ul.classList.remove("hidden")
        }
        else
        {
          ul.classList.add("hidden")
        }
      })

      lis.forEach(li => {
        li.addEventListener("click", ()=>{
          siteName = li.textContent;
          labelSIte.innerHTML = siteName;
          ul.classList.add("hidden");
          requestPOST(obj);
        })
      });
    }
  }
  xmlhttp.open("GET", url  + '/statistics.php', true);
  xmlhttp.send();
});
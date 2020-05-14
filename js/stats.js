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
      labelsQuiz = [],
      labelsModule = [],
      pourcentagesQuiz = [],
      pourcentagesModule = [],
      borderColorQuiz= [],
      borderColorModule= [],
      backgroundColorQuiz= [],
      backgroundColorModule= [];
      console.log(quizs);
      console.log(modules);

      for (let i = 0; i < quizs.length; i++) {
        labelsQuiz.push(quizs[i].titre);
        pourcentagesQuiz.push(quizs[i].pourcentage);

        let rgb1 = Math.floor(Math.random()*Math.floor(255)),
        rgb2 = Math.floor(Math.random()*Math.floor(255)),
        rgb3 = Math.floor(Math.random()*Math.floor(255));

        backgroundColorQuiz.push(`rgba(${rgb1},${rgb2},${rgb3}, 0.5)`);
        borderColorQuiz.push(`rgba(${rgb1},${rgb2},${rgb3}, 1)`)
      }
      console.log(labelsQuiz, pourcentagesQuiz, backgroundColorQuiz);
      for (let f = 0; f < modules.length; f++) {
        labelsModule.push(modules[f].titre);
        pourcentagesModule.push(modules[f].pourcentage);

        let rgb1 = Math.floor(Math.random()*Math.floor(255)),
        rgb2 = Math.floor(Math.random()*Math.floor(255)),
        rgb3 = Math.floor(Math.random()*Math.floor(255));

        backgroundColorModule.push(`rgba(${rgb1},${rgb2},${rgb3}, 0.7)`);
        borderColorModule.push(`rgba(${rgb1},${rgb2},${rgb3}, 1)`)
      }
      console.log(labelsModule, pourcentagesModule);
      const quizBar = document.querySelector(".quizStatsBar"),
      moduleBar = document.querySelector(".moduleStatsBar"),
      moduleRadar = document.querySelector(".moduleStatsRadar"),
      quizRadar = document.querySelector(".quizStatsRadar"),
      quizBtn = document.querySelector(".quizBtn"),
      moduleBtn = document.querySelector(".moduleBtn"),
      radarBtn = document.querySelector(".radar"),
      barBtn = document.querySelector(".bar");
      let type = "bar",
      data,
      fontColor,
      options;

      data = {
        labels : labelsModule,
        datasets: [{
          label: '% terminé',
          data: pourcentagesModule,
          backgroundColor: backgroundColorModule,
          borderColor: borderColorModule,
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
            gridLines: {
              color: 'rgba(0,0,0,0)',
            }
          }],
          yAxes: [{
            gridLines: {
              color: 'rgba(0,0,0,0)',
            },
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
      var myBarChartModule = new Chart(moduleBar, {
        type: type,
        data: data,
        options: options
      });
      Chart.defaults.global.defaultFontColor='white';

      radarBtn.addEventListener("click", ()=>{
        if(!radarBtn.classList.contains("activated"))
        {
          radarBtn.classList.add("activated");
          barBtn.classList.remove("activated");
        }
        type= "radar";
      })
      barBtn.addEventListener("click", ()=>{
        if(!barBtn.classList.contains("activated"))
        {
          barBtn.classList.add("activated");
          radarBtn.classList.remove("activated");
        }
        type= "bar";
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
              gridLines: {
                color: 'rgba(0,0,0,0)',
              }
            }],
            yAxes: [{
              gridLines: {
                color: 'rgba(0,0,0,0)',
              },
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
        }
        console.log(type);
      })

      moduleBtn.addEventListener("click", ()=>{
        if(!moduleBtn.classList.contains("activated"))
        {
          moduleBtn.classList.add("activated");
          quizBtn.classList.remove("activated");
        }
        if(type == "bar")
        {
          if(!quizBar.classList.contains("hidden"))
          {
            quizBar.classList.add("hidden")
          }
          else if (!quizRadar.classList.contains("hidden"))
          {
            quizRadar.classList.add("hidden")
          }  
          else if (!moduleRadar.classList.contains("hidden"))
          {
            moduleRadar.classList.add("hidden")
          }
          if(moduleBar.classList.contains("hidden"))
          {
            moduleBar.classList.remove("hidden")
          }
          data = {
            labels : labelsModule,
            datasets: [{
              label: '% terminé',
              data: pourcentagesModule,
              backgroundColor: backgroundColorModule,
              borderColor: borderColorModule,
              borderWidth: 2
            }]
          }
          var myBarChartModule = new Chart(moduleBar, {
            type: type,
            data: data,
            options: options
          });
          Chart.defaults.global.defaultFontColor='white';
        }
        else if (type == "radar")
        {
          if(!quizBar.classList.contains("hidden"))
          {
            quizBar.classList.add("hidden")
          }
          else if (!quizRadar.classList.contains("hidden"))
          {
            quizRadar.classList.add("hidden")
          }  
          else if (!moduleBar.classList.contains("hidden"))
          {
            moduleBar.classList.add("hidden")
          }
          if(moduleRadar.classList.contains("hidden"))
          {
            moduleRadar.classList.remove("hidden")
          }
          fontColor = borderColorModule;
          data = {
            labels : labelsModule,
            datasets: [{
              label: '% terminé',
              data: pourcentagesModule,
              backgroundColor:"rgba(235, 185, 74, 0.2)",
              borderColor:"rgb(235, 185, 74)",
              borderWidth: 2,
              pointBackgroundColor: backgroundColorModule,
              pointBorderColor: borderColorModule,
            }]
          }
          options = {
            legend: {
              display: false,
            },
            gridLines: {
              display: false
            },
            scale: {
              angleLines: {
                display: false
              },
              ticks: {
                display: false
              },
              pointLabels:{
                fontSize: 15,
                fontColor: borderColorModule,
              }
            },
          };
          var myBarChartModule = new Chart(moduleRadar, {
            type: type,
            data: data,
            options: options
          });
          console.log();
        }
      })
      quizBtn.addEventListener("click", ()=>{
        if(!quizBtn.classList.contains("activated"))
        {
          quizBtn.classList.add("activated");
          moduleBtn.classList.remove("activated");
        }
        if(type == "bar")
        {
          if(!moduleRadar.classList.contains("hidden"))
          {
            moduleRadar.classList.add("hidden")
          }
          else if (!quizRadar.classList.contains("hidden"))
          {
            quizRadar.classList.add("hidden")
          }  
          else if (!moduleBar.classList.contains("hidden"))
          {
            moduleBar.classList.add("hidden")
          }
          if(quizBar.classList.contains("hidden"))
          {
            quizBar.classList.remove("hidden")
          }
          data = {
            labels : labelsQuiz,
            datasets: [{
              label: '% terminé',
              data: pourcentagesQuiz,
              backgroundColor: backgroundColorQuiz,
              borderColor: borderColorQuiz,
              borderWidth: 2
            }]
          }
          myBarChartQuiz = new Chart(quizBar, {
            type: type,
            data: data,
            options: options
          });
          Chart.defaults.global.defaultFontColor='white';
        }
        else if (type == "radar")
        {
          if(!moduleRadar.classList.contains("hidden"))
          {
            moduleRadar.classList.add("hidden")
          }
          else if (!quizBar.classList.contains("hidden"))
          {
            quizBar.classList.add("hidden")
          }  
          else if (!moduleBar.classList.contains("hidden"))
          {
            moduleBar.classList.add("hidden")
          }
          if(quizRadar.classList.contains("hidden"))
          {
            quizRadar.classList.remove("hidden")
          }
          fontColor = borderColorQuiz;
          data = {
            labels : labelsQuiz,
            datasets: [{
              label: '% terminé',
              data: pourcentagesQuiz,
              backgroundColor:"rgba(235, 185, 74, 0.2)",
              borderColor:"rgb(235, 185, 74)",
              borderWidth: 2,
              pointBackgroundColor: backgroundColorQuiz,
              pointBorderColor: borderColorQuiz,
            }]
          }
          options = {
            legend: {
              display: false,
            },
            gridLines: {
              display: false
            },
            scale: {
              angleLines: {
                display: false
              },
              ticks: {
                display: false
              },
              pointLabels:{
                fontSize: 15,
                fontColor: borderColorQuiz,
              }
            },
          };
          myBarChartQuiz = new Chart(quizRadar, {
            type: type,
            data: data,
            options: options
          });
        }
      })
      Chart.defaults.global.defaultFontFamily='Muli';
    }
  }
  xmlhttp.open("GET", url  + '/statistics.php', true);
  xmlhttp.send();
});
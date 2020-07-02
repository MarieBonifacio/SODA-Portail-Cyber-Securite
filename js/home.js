window.addEventListener('load', function () {
  var admin = myScript.admin;
  var editor = myScript.editor;
  const bp = document.querySelector(".bpas-post-form-wrapper");

  if(admin || editor)
  {
    bp.style.display = "block";
  }
  else
  {
    bp.style.display = "none";
  }
  
  var url = myScript.theme_directory;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
  if(this.readyState == 4 && this.status == 200)
  {
    var myArray = JSON.parse(this.responseText),
    lastQuiz = myArray.lastQuiz,
    userResults = myArray.userResults,
    leadTown = myArray.top30UserVille,
    leadGen = myArray.top30User,
    top30Gen = leadGen.classement,
    top30Town = leadTown.classement,
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
    let tableContent,
    isPresent = false;

    console.log(myArray);
    // condition for user whithout any user stats
    if(userResults.length != 0)
    {
      // loop for leaderboard's making
      for (i = 0; i < top30Gen.length; i++) 
      {
          pos = i + 1;
          // condition in order to know if user is in top 10 or not
          if(parseInt(userStat.user_id) == parseInt(top30Gen[i].user_id))
          {
            isPresent = true;
            tbody.innerHTML += `
            <tr class="imp">
              <td>${pos}</td>
              <td>${top30Gen[i].display_name}</td>  
              <td>${top30Gen[i].meta_value}</td>
              <td>${parseInt(top30Gen[i].moyenne)}</td>
            </tr>
            `
          }
          else if (pos == 1)
          {
            isPresent = true;
            tbody.innerHTML += `
            <tr class="gold">
              <td>${pos}</td>
              <td>${top30Gen[i].display_name}</td>  
              <td>${top30Gen[i].meta_value}</td>
              <td>${parseInt(top30Gen[i].moyenne)}</td>
            </tr>
            `
          }
          else if (pos == 2)
          {
            isPresent = true;
            tbody.innerHTML += `
            <tr class="silver">
              <td>${pos}</td>
              <td>${top30Gen[i].display_name}</td>  
              <td>${top30Gen[i].meta_value}</td>
              <td>${parseInt(top30Gen[i].moyenne)}</td>
            </tr>
            `
          }
          else if (pos == 3)
          {
            isPresent = true;
            tbody.innerHTML += `
            <tr class="bronze">
              <td>${pos}</td>
              <td>${top30Gen[i].display_name}</td>  
              <td>${top30Gen[i].meta_value}</td>
              <td>${parseInt(top30Gen[i].moyenne)}</td>
            </tr>
            `
          }
          else
          {
            tbody.innerHTML += `
            <tr>
              <td>${pos}</td>
              <td>${top30Gen[i].display_name}</td>  
              <td>${top30Gen[i].meta_value}</td>
              <td>${parseInt(top30Gen[i].moyenne)}</td>
            </tr>
            `
          }
      }
      if(isPresent != true)
      {
        tbody.innerHTML += `
        <tr class="imp">
          <td>${leadGen.userPlace}</td>
          <td>${userStat.display_name}</td> 
          <td>${userStat.meta_value}</td>
          <td>${parseInt(userStat.moyenne)}</td>
        </tr>
        `
      }
      gen.addEventListener("click", ()=>{
        town.classList.remove("activated");
        gen.classList.add("activated");
        isPresent= false;
        tbody.innerHTML ='';
        for (i = 0; i < top30Gen.length; i++) 
        {
          pos = i + 1;
          if(parseInt(userStat.user_id) == parseInt(top30Gen[i].user_id))
          {
            isPresent = true;
            tbody.innerHTML += `
            <tr class="imp">
              <td>${pos}</td>
              <td>${top30Gen[i].display_name}</td> 
              <td>${top30Gen[i].meta_value}</td>
              <td>${parseInt(top30Gen[i].moyenne)}</td>
            </tr>
            `
          }
          else if (pos == 1)
          {
            isPresent = true;
            tbody.innerHTML += `
            <tr class="gold">
              <td>${pos}</td>
              <td>${top30Gen[i].display_name}</td>  
              <td>${top30Gen[i].meta_value}</td>
              <td>${parseInt(top30Gen[i].moyenne)}</td>
            </tr>
            `
          }
          else if (pos == 2)
          {
            isPresent = true;
            tbody.innerHTML += `
            <tr class="silver">
              <td>${pos}</td>
              <td>${top30Gen[i].display_name}</td>  
              <td>${top30Gen[i].meta_value}</td>
              <td>${parseInt(top30Gen[i].moyenne)}</td>
            </tr>
            `
          }
          else if (pos == 3)
          {
            isPresent = true;
            tbody.innerHTML += `
            <tr class="bronze">
              <td>${pos}</td>
              <td>${top30Gen[i].display_name}</td>  
              <td>${top30Gen[i].meta_value}</td>
              <td>${parseInt(top30Gen[i].moyenne)}</td>
            </tr>
            `
          }
          else
          {
            tbody.innerHTML += `
            <tr>
              <td>${pos}</td>
              <td>${top30Gen[i].display_name}</td>
              <td>${top30Gen[i].meta_value}</td>
              <td>${parseInt(top30Gen[i].moyenne)}</td>
            </tr>
            `
          }
        }
        if(isPresent != true)
        {
          tbody.innerHTML += `
          <tr class="imp">
            <td>${leadGen.userPlace}</td>
            <td>${userStat.display_name}</td>    
            <td>${userStat.meta_value}</td>
            <td>${parseInt(userStat.moyenne)}</td>
          </tr>
          `
        }
      })
      town.addEventListener("click", ()=>{
        gen.classList.remove("activated");
        town.classList.add("activated");
        tbody.innerHTML ='';
        isPresent = false;
        for (i = 0; i < top30Town.length; i++) 
        {
          pos = i + 1;
          if(parseInt(userStat.user_id) == parseInt(top30Town[i].user_id))
          {
            isPresent = true;
            tbody.innerHTML += `
            <tr class="imp">
              <td>${pos}</td>
              <td>${top30Town[i].display_name}</td> 
              <td>${top30Town[i].meta_value}</td>
              <td>${parseInt(top30Town[i].moyenne)}</td>
            </tr>
            `
          }
          else if (pos == 1)
          {
            isPresent = true;
            tbody.innerHTML += `
            <tr class="gold">
              <td>${pos}</td>
              <td>${top30Town[i].display_name}</td>  
              <td>${top30Town[i].meta_value}</td>
              <td>${parseInt(top30Town[i].moyenne)}</td>
            </tr>
            `
          }
          else if (pos == 2)
          {
            isPresent = true;
            tbody.innerHTML += `
            <tr class="silver">
              <td>${pos}</td>
              <td>${top30Town[i].display_name}</td>  
              <td>${top30Town[i].meta_value}</td>
              <td>${parseInt(top30Town[i].moyenne)}</td>
            </tr>
            `
          }
          else if (pos == 3)
          {
            isPresent = true;
            tbody.innerHTML += `
            <tr class="bronze">
              <td>${pos}</td>
              <td>${top30Town[i].display_name}</td>  
              <td>${top30Town[i].meta_value}</td>
              <td>${parseInt(top30Town[i].moyenne)}</td>
            </tr>
            `
          }
          else
          {
            tbody.innerHTML += `
            <tr>
              <td>${pos}</td>
              <td>${top30Town[i].display_name}</td>  
              <td>${top30Town[i].meta_value}</td>
              <td>${parseInt(top30Town[i].moyenne)}</td>
            </tr>
            `
          }
        }
        if(isPresent != true)
        {
          tbody.innerHTML += `
          <tr class="imp">
            <td>${leadGen.userPlace}</td>
            <td>${userStat.display_name}</td>  
            <td>${userStat.meta_value}</td>
            <td>${parseInt(userStat.moyenne)}</td>
          </tr>
          `
        }
      })
    }
    else
    {
      for (i = 0; i < top30Gen.length; i++) 
      {
        pos = i + 1;
          if (pos == 1)
          {
            isPresent = true;
            tbody.innerHTML += `
            <tr class="gold">
              <td>${pos}</td>
              <td>${top30Gen[i].display_name}</td>  
              <td>${top30Gen[i].meta_value}</td>
              <td>${parseInt(top30Gen[i].moyenne)}</td>
            </tr>
            `
          }
          else if (pos == 2)
          {
            isPresent = true;
            tbody.innerHTML += `
            <tr class="silver">
              <td>${pos}</td>
              <td>${top30Gen[i].display_name}</td>  
              <td>${top30Gen[i].meta_value}</td>
              <td>${parseInt(top30Gen[i].moyenne)}</td>
            </tr>
            `
          }
          else if (pos == 3)
          {
            isPresent = true;
            tbody.innerHTML += `
            <tr class="bronze">
              <td>${pos}</td>
              <td>${top30Gen[i].display_name}</td>  
              <td>${top30Gen[i].meta_value}</td>
              <td>${parseInt(top30Gen[i].moyenne)}</td>
            </tr>
            `
          }
          else
          {
            tbody.innerHTML += `
              <tr>
                <td>${pos}</td>
                <td>${top30Gen[i].display_name}</td>  
                <td>${top30Gen[i].meta_value}</td>
                <td>${parseInt(top30Gen[i].moyenne)}</td>
              </tr>
            `
          }
      }
      gen.addEventListener("click", ()=>{
        town.classList.remove("activated");
        gen.classList.add("activated");
        tbody.innerHTML ='';
        for (i = 0; i < top30Gen.length; i++) 
        {
          pos = i + 1;
          if (pos == 1)
          {
            isPresent = true;
            tbody.innerHTML += `
            <tr class="gold">
              <td>${pos}</td>
              <td>${top30Gen[i].display_name}</td>  
              <td>${top30Gen[i].meta_value}</td>
              <td>${parseInt(top30Gen[i].moyenne)}</td>
            </tr>
            `
          }
          else if (pos == 2)
          {
            isPresent = true;
            tbody.innerHTML += `
            <tr class="silver">
              <td>${pos}</td>
              <td>${top30Gen[i].display_name}</td>  
              <td>${top30Gen[i].meta_value}</td>
              <td>${parseInt(top30Gen[i].moyenne)}</td>
            </tr>
            `
          }
          else if (pos == 3)
          {
            isPresent = true;
            tbody.innerHTML += `
            <tr class="bronze">
              <td>${pos}</td>
              <td>${top30Gen[i].display_name}</td>  
              <td>${top30Gen[i].meta_value}</td>
              <td>${parseInt(top30Gen[i].moyenne)}</td>
            </tr>
            `
          }
          else
          {
            tbody.innerHTML += `
              <tr>
                <td>${pos}</td>
                <td>${top30Gen[i].display_name}</td>  
                <td>${top30Gen[i].meta_value}</td>
                <td>${parseInt(top30Gen[i].moyenne)}</td>
              </tr>
            `
          }
        }
      })
      town.addEventListener("click", ()=>{
        gen.classList.remove("activated");
        town.classList.add("activated");
        tbody.innerHTML ='';
        for (i = 0; i < top30Town.length; i++) 
        {
          pos = i + 1;
          if (pos == 1)
          {
            isPresent = true;
            tbody.innerHTML += `
            <tr class="gold">
              <td>${pos}</td>
              <td>${top30Town[i].display_name}</td>  
              <td>${top30Town[i].meta_value}</td>
              <td>${parseInt(top30Town[i].moyenne)}</td>
            </tr>
            `
          }
          else if (pos == 2)
          {
            isPresent = true;
            tbody.innerHTML += `
            <tr class="silver">
              <td>${pos}</td>
              <td>${top30Town[i].display_name}</td>  
              <td>${top30Town[i].meta_value}</td>
              <td>${parseInt(top30Town[i].moyenne)}</td>
            </tr>
            `
          }
          else if (pos == 3)
          {
            isPresent = true;
            tbody.innerHTML += `
            <tr class="bronze">
              <td>${pos}</td>
              <td>${top30Town[i].display_name}</td>  
              <td>${top30Town[i].meta_value}</td>
              <td>${parseInt(top30Town[i].moyenne)}</td>
            </tr>
            `
          }
          else
          {
            tbody.innerHTML += `
              <tr>
                <td>${pos}</td>
                <td>${top30Town[i].display_name}</td>  
                <td>${top30Town[i].meta_value}</td>
                <td>${parseInt(top30Town[i].moyenne)}</td>
              </tr>
            `
          }
        }
      })
    }
    
    // creation of last quiz ancer
    const elementQuiz = document.createElement("div");
    elementQuiz.classList.add("contentQ");
    elementQuiz.innerHTML = `
      <div>
      <div class="filter"></div>
      <img src="${ url + `/img/quizs/${lastQuiz.img}`}" alt="photo du quiz"/>
      <h2>${lastQuiz.name}</h2>
      <p>${lastQuiz.tag_name}</p>
      </div>
    `;
    lastQ.appendChild(elementQuiz);

    
    elementQuiz.addEventListener("click", (e)=>{
      if(lastQuiz.user_score != null)
      {
        const divMess = document.createElement("p");
        divMess.classList.add("lastQuizMess");
        divMess.innerHTML = "<i class='fas fa-times'></i>Vous avez déjà terminé ce quiz";
        lastQ.appendChild(divMess);

        const crossMess = document.querySelector(".fa-times");
        crossMess.addEventListener("click", ()=>{
          divMess.remove();
        })
      }
      else
      {
        const id = lastQuiz.id;
        var urlScript = url + '/play_quiz.php/?id=' + id;
        var xmlhttpQuiz = new XMLHttpRequest();
        xmlhttpQuiz.onreadystatechange = function () {
          if(this.readyState == 4 && this.status == 200)
          {
            var myQuizz = JSON.parse(this.responseText);
            var previous = myQuizz.previous;
            const divQuizz = document.createElement("div");
            divQuizz.classList.add("quizPlay");
            document.body.appendChild(divQuizz);
            divQuizz.innerHTML = `
            <div class="quiz" id="quiz"></div>
            <div class="btns">
            <button id="next">Prochaine question</button>
            <button id="submit">Terminer le quiz</button>
            </div>
            <div id="results">
            </div>
            <div class="timer">
            <label id="minutes">00</label>:<label id="seconds">00</label>
            </div>
            <div class="progress">
              <div class="progressDone" data-done=""><span class="percentage"></span></div>
            </div>
            `;
  
            let currentSlide = 0;
            let myQuestions = myQuizz.questions;
            let actualpercent = 0;
              const quizContainer = document.getElementById('quiz');
              const resultsContainer = document.getElementById('results');
              const submitButton = document.getElementById('submit');
              const btns = document.querySelector('.btns');
              const progress = document.querySelector('.progressDone');
              const percentage = document.querySelector('.percentage');
              const timer = document.querySelector('.timer');
              var minutesLabel = document.getElementById("minutes");
              var secondsLabel = document.getElementById("seconds");
  
              const divIntro = document.createElement("div");
              divIntro.classList.add("intro");
              if(myQuizz.description != "")
              {
                document.body.appendChild(divIntro);
                divIntro.innerHTML = `
                  <p class="introP">${myQuizz.description}</p>
                  <button class="begin">Commencer</button>
                `
                const btnIntro = document.querySelector(".begin");
                btnIntro.addEventListener("click", ()=>{
                  divIntro.remove();
                  var setInt = setInterval(setTime, 1000);
                })
              }
              else 
              {
                var setInt = setInterval(setTime, 1000);
              }
  
              if(previous.length > 0)
              {
                var totalSeconds = previous[previous.length -1].time;
                divIntro.remove();
                if(myQuizz.description != "")
                {
                  var setInt = setInterval(setTime, 1000);
                }
              }
              else
              {
                var totalSeconds = 0;
              }
  
              function setTime() {
                ++totalSeconds;
                secondsLabel.innerHTML = pad(totalSeconds % 60);
                minutesLabel.innerHTML = pad(parseInt(totalSeconds / 60));
              }
  
              function pad(val) {
                var valString = val + "";
                if (valString.length < 2) {
                  return "0" + valString;
                } else {
                  return valString;
                }
              }
  
              function shuffle(array)
              {
                array.sort(()=> Math.random()-0.5);
              }
  
              shuffle(myQuestions);
              if(previous.length > 0)
              {
                var tableLostQuestions = [];
                for (let i = 0; i < previous.length; i++)
                {
                  for (let f = 0; f < myQuestions.length; f++)
                  {
                    if(myQuestions[f].id == previous[i].id_question)
                    {
                      var idCurrentQuestion = myQuestions.indexOf(myQuestions[f]);
                      if(idCurrentQuestion > -1)
                      {
                        tableLostQuestions.splice(0, 0, myQuestions[f]);
                        myQuestions.splice(idCurrentQuestion, 1);
                      }
                    }
                  }
                }
              }
              let percent = (currentSlide + 1 / myQuestions.length) * 100;
  
              function progressBar()
              {
                actualpercent += parseFloat(percent);
                progress.dataset.done = Math.ceil(actualpercent);
                progress.style.width = progress.getAttribute('data-done')+ '%';
                progress.style.opacity = 1;
                percentage.innerHTML = `${Math.ceil(actualpercent)} %`;
              }
  
              function buildQuiz(){
  
              progressBar();
              // variable to store the HTML output
              const output = [];
  
              let numQuestion = 0;
                // for each question...
                myQuestions.forEach(
                  (currentQuestion, questionNumber) => {
  
                    // variable to store the list of possible answers
                    const currentAnswers = currentQuestion.answers;
  
                    const answers = [];
                    numQuestion += 1;
                    // and for each available answer...
                    shuffle(currentAnswers);
                    for(i = 0; i<currentAnswers.length ; i++){
                      const letters = ['A', 'B' , 'C', 'D'];
                      // ...add an HTML radio button
                      answers.push(
                        `<label>
                          <input id="${currentAnswers[i].id}" class="input${myQuestions.indexOf(currentQuestion)}${[i]}" type="checkbox" name="question${questionNumber}" data-answer="${letters[i]}" value="${currentAnswers[i].is_true}">
                          <p class="answer"><span>${letters[i]}.</span> ${currentAnswers[i].content}</p>
                        </label>`
                      );
                    }
                    // add this question and its answers to the output
                    
                    if(currentQuestion.img_path === null)
                    {
                      if(currentQuestion.url === null)
                      {
                        output.push(
                          `<div class="slide">
                            <span class="span">
                              ${numQuestion}/${myQuestions.length}
                            </span>
                            <div class="question">${numQuestion}. ${currentQuestion.content} </div>
                            <div class="answers">${answers.join('')}</div>
                          </div>`
                        );
                      }else{
                        if( currentQuestion.url.match(/^.*(youtube).*/) == null ){
                          output.push(
                            `<div class="slide">
                              <span class="span">
                                ${numQuestion}/${myQuestions.length}
                              </span>
                              <div class="img">
                                <a href="`+currentQuestion.url+`">Voir la vidéo</a>
                              </div>
                              <div class="question"><span>${numQuestion}.</span> ${currentQuestion.content} </div>
                              <div class="answers">${answers.join('')}</div>
                            </div>`
                          );
                        }
                        let youtubeHash = currentQuestion.url.match(/^.*v=(.*)$/);
                        output.push(
                          `<div class="slide">
                            <span class="span">
                              ${numQuestion}/${myQuestions.length}
                            </span>
                            <div class="img">
                            <iframe src="https://www.youtube.com/embed/`+youtubeHash[1]+`" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <div class="question"><span>${numQuestion}.</span> ${currentQuestion.content} </div>
                            <div class="answers">${answers.join('')}</div>
                          </div>`
                        );
                      }
                    }
                    else
                    {
                      output.push(
                        `<div class="slide">
                          <span class="span">
                            ${numQuestion}/${myQuestions.length}
                          </span>
                          <div class="img">
                            <img src="${ url + `/img/quizs/${currentQuestion.img_path}`}" alt="photo de la question"/>
                          </div>
                          <div class="question"><span>${numQuestion}.</span> ${currentQuestion.content} </div>
                          <div class="answers">${answers.join('')}</div>
                        </div>`
                      );
                    }
                  }
                );
                // finally combine our output list into one string of HTML and put it on the page
                quizContainer.innerHTML = output.join('');
              }
  
              // display quiz right away
              buildQuiz();
  
              const nextButton = document.getElementById("next");
              const slides = document.querySelectorAll(".slide");
  
              function showSlide(n) {
                slides[currentSlide].classList.remove('active-slide');
                slides[n].classList.add('active-slide');
                currentSlide = n;
                if(currentSlide === slides.length-1){
                  nextButton.style.display = 'none';
                  submitButton.style.display = 'inline-block';
                }
                else{
                  nextButton.style.display = 'inline-block';
                  submitButton.style.display = 'none';
                }
              }
  
              var id_question;
              var id_answer;
              var is_True;
  
              function recupIds(){
                id_question = myQuestions[currentSlide].id;
                id_answer = null;
                is_True = "false";
  
                let answerChecked = [];
                for (let i = 0; i < myQuestions[currentSlide].answers.length; i++) {
                  let input = document.querySelector(`.input${currentSlide}${i}`);
                  if(input.checked)
                  {
                    answerChecked.push(parseInt(input.id));
                  }
                }
                return answerChecked;
              }
  
              // Show the first slide
              showSlide(currentSlide);
  
              function showNextSlide(finish) {
                let answerChecked = recupIds();
  
                var obj = {
                  "questions": id_question,
                  "answers": answerChecked,
                  "time": totalSeconds,
                  "id_quiz" : myQuizz.id,
                };
  
  
                dbParam = JSON.stringify(obj);
                xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200) {
                    if (!finish){
                        showSlide(currentSlide + 1);
                        progressBar();
                    }else{
                        getResults();
                    }
                  }
                };
                xmlhttp.open("POST", url + "/quiz_answer_user.php/", true);
                xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xmlhttp.send(dbParam);
              }
  
            function getResults(){
                var obj = {
                  "id_user": myQuizz.player,
                  "id_quiz" : myQuizz.id,
                };
                dbParam = JSON.stringify(obj);
                xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        let result = JSON.parse(this.responseText);
                        showFinish(result);
                    }
                };
                xmlhttp.open("POST", url + "/quiz_result.php/", true);
                xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xmlhttp.send(dbParam);
            }
  
            function showFinish(result){
                // show number of correct answers out of total
                resultsContainer.style.opacity = "1";
                resultsContainer.innerHTML = `
                <p>${result.good} correct(s) sur ${result.questions.length}</p>
                <p>Vous avez obtenu ${result.score}/100pts en ${result.time} secondes!</p>
                <i class="btnBackMenu fas fa-times"></i>
                <div class="recap">
                </div>
                `;
  
                const recap = document.querySelector('.recap');
  
                result.questions.forEach((question, i) => {
                    numQuestion = i+1;
  
                    const questionDiv = document.createElement("div");
                    questionDiv.classList.add("question");
                    recap.appendChild(questionDiv);
  
                    const p = document.createElement("p");
                    p.classList.add(`questionRecap`);
                    questionDiv.appendChild(p);
                    p.innerHTML =`<span>${numQuestion}.</span> ${question.content}`;
  
                    const divAnswer = document.createElement("div");
                    divAnswer.classList.add(`answerRecap${[i]}`, "answerRecap");
                    questionDiv.appendChild(divAnswer);
  
                    question.answers.forEach((answer, j) => {
                        const letters = ['A', 'B' , 'C', 'D'];
  
                        const pAnswerDiv = document.createElement("div");
                        pAnswerDiv.classList.add(`answerTF${[j]}${[i]}`, 'answerTF');
                        divAnswer.appendChild(pAnswerDiv);
                        pAnswerDiv.innerHTML = `<span>${letters[j]}:</span> ${answer.content}`;
                        if(answer.is_true == "1" || answer.is_true == "true"){
                            pAnswerDiv.style.color = "#3AD29F";
                        }else{
                            pAnswerDiv.style.color = "red";
                        }
                    });
                });
  
                const btnBackMenu = document.querySelectorAll(".btnBackMenu");
  
                btnBackMenu.forEach(btn => {
                  btn.addEventListener("click", ()=>{
                    location.reload();
                  })
                });
  
                timer.remove();
                quizContainer.remove();
                btns.remove();
            }
  
              // Event listeners
              nextButton.addEventListener("click", function(){
                  showNextSlide(false);
              });
  
              // on submit, show results
              submitButton.addEventListener('click', function(){
                  showNextSlide(true);
              });
          }
        };
        // url a trouver
        xmlhttpQuiz.open("GET", urlScript , true);
        xmlhttpQuiz.send();
      }
    })

    let lastResults,
    labels = [],
    points = [];
    if(userResults.length > 10)
    {
      lastResults = userResults.slice(Math.max(userResults.length - 10, 1));
    }
    else
    {
      lastResults = userResults;
    }

    for ( i = 0; i < lastResults.length; i++) {
      labels.push(lastResults[i].name);
      points.push(parseInt(lastResults[i].score));
    }


    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels : labels,
        datasets: [{
          label: 'score',
          data: points,
          pointBackgroundColor: '#E2B34A',
          borderWidth: 3,
          borderColor: 'rgba(226, 179, 74, 0.3)',
          backgroundColor: 'rgba(25,34,49,0.5)',
        }]
      },
      options: {
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
      },
    })
    Chart.defaults.global.defaultFontColor='white';
    Chart.defaults.global.defaultFontFamily='Muli';
  }
  else
  {
  }
  };

  // url a trouver
  xmlhttp.open("GET", url  + '/dashboard_back.php', true);
  xmlhttp.send();
});


var url = myScript.theme_directory;
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function () {
if(this.readyState == 4 && this.status == 200)
{
  var myArray = JSON.parse(this.responseText);
  const grid = document.querySelector(".grid");
  for($i = 0; $i<myArray.length; $i ++)
  {
    const gridElement = document.createElement("div");
    gridElement.classList.add(`element-item` , `${myArray[$i].tag_name}`);
    gridElement.setAttribute('category', `${myArray[$i].tag_name}`);
    //---------------------------------------------------------
    let quizContent = `
    <span class="tag">${myArray[$i].tag_name}</span>
    <h3>${myArray[$i].name}</h3>
    <span class="score">`;
    if( myArray[$i].user_score != null){
      quizContent += ``+myArray[$i].user_score+``;
    }else{
      quizContent += `0`;
    }

    quizContent +=` pts</span>
    <div class="imgQ">
      <img src="${ url + '/img/myAvatar.png'}" alt="photo du quiz"/>
      <div class="filter"></div>
      </div>
  `;
  if( myArray[$i].user_score == null){
    quizContent += `<p class="btnQuiz" data-id="${myArray[$i].id}">Jouer</p>`;
  }
  //-----------------------------------------------------------------------------
  gridElement.innerHTML = quizContent;
    grid.appendChild(gridElement);
  }
  let btnQuizs = document.querySelectorAll(".btnQuiz");
  btnQuizs.forEach(btn => {
    btn.addEventListener("click", (e)=>{
      const id = e.target.dataset.id;
      var urlScript = url + '/play_quiz.php/?id=' + id;
      var xmlhttp2 = new XMLHttpRequest();
      xmlhttp2.onreadystatechange = function () {
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
            if(previous.length > 0)
            {
              var totalSeconds = previous[previous.length -1].time;
            }
            else
            {
              var totalSeconds = 0;
            }
            // console.log(totalSeconds);
            var setInt = setInterval(setTime, 1000);

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
              console.log(parseFloat(percent));
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
                  // console.log(currentAnswers);
                  for(i = 0; i<currentAnswers.length ; i++){
                    const letters = ['A', 'B' , 'C', 'D'];
                    // ...add an HTML radio button
                    answers.push(
                      `<label>
                        <input id="${currentAnswers[i].id}" class="input${myQuestions.indexOf(currentQuestion)}${[i]}" type="radio" name="question${questionNumber}" data-answer="${letters[i]}" value="${currentAnswers[i].is_true}">
                        <p class="answer">${letters[i]}. ${currentAnswers[i].content}</p>
                      </label>`
                    );
                  }
                  // add this question and its answers to the output
                  output.push(
                    `<div class="slide">
                      <div class="question">${numQuestion}. ${currentQuestion.content} </div>
                      <div class="answers">${answers.join('')}</div>
                    </div>`
                  );
                }
              );
              // finally combine our output list into one string of HTML and put it on the page
              quizContainer.innerHTML = output.join('');
            }

            function showResults(){
              
              // gather answer containers from our quiz
              const answerContainers = quizContainer.querySelectorAll('.answers');
              // keep track of user's answers
              // let userSelect = [];
              let numCorrect = 0;
              let points = 0;

              // for each question...
              if(previous.length >0)
              {
                for (let i = 0; i < previous.length; i++) 
                {  
                  if(previous[i].is_true === "true")
                  {
                    numCorrect += 1;
                    points += parseFloat(tableLostQuestions[i].points);
                  }
                  // console.log(points);
                  // console.log(numCorrect);
                }
              }
              myQuestions.forEach( 
                (currentQuestion, questionNumber) => {
                  
                // find selected answer
                const answerContainer = answerContainers[questionNumber];
                const selector = `input[name=question${questionNumber}]:checked`;
                let userAnswer = (answerContainer.querySelector(selector) || {}).value;
                
                // if answer is correct
                if(userAnswer === "true"){
                  // add to the number of correct answers
                  numCorrect+= 1;
                  points += parseFloat(currentQuestion.points);
                }
              });
              points = Math.ceil(points);
              clearInterval(setInt);

              if(previous.length >0)
              {
                for (let i = 0; i < tableLostQuestions.length; i++) 
                {
                  myQuestions.splice(0,0, tableLostQuestions[i]);
                }
              }
              
              // show number of correct answers out of total
              resultsContainer.style.opacity = "1";
              resultsContainer.innerHTML = `
              <p>${numCorrect} correct(s) sur ${myQuestions.length}</p>
              <p>Vous avez obtenu ${points}/100pts en ${totalSeconds} secondes!</p>
              <i class="btnBackMenu fas fa-times"></i>
              <div class="recap">
              </div>
              `;

              const recap = document.querySelector('.recap');

                for(i=0; i<myQuestions.length; i++) {
                  const question = document.createElement("div");
                  question.classList.add("question");
                  recap.appendChild(question);
                  const p = document.createElement("p");
                  p.classList.add(`questionRecap`);
                  question.appendChild(p);
                  numQuestion = i+1;
                  p.innerHTML =`${numQuestion}. ${myQuestions[i].content}`;
                  const divAnswer = document.createElement("div");
                  divAnswer.classList.add(`answerRecap${[i]}`, "answerRecap");
                  question.appendChild(divAnswer);

                  const answerRecap = document.querySelector(`.answerRecap${[i]}`);
                  for(f=0; f<myQuestions[i].answers.length; f++)
                  {
                    const letters = ['A', 'B' , 'C', 'D'];
                    const pAnswerDiv = document.createElement("div");
                    pAnswerDiv.classList.add(`answerTF${[f]}${[i]}`, 'answerTF');
                    answerRecap.appendChild(pAnswerDiv);
                    pAnswerDiv.innerHTML = `${letters[f]}: ${myQuestions[i].answers[f].content}`;
                    const pAnswer = document.querySelector(`.answerTF${[f]}${[i]}`);
                    if(myQuestions[i].answers[f].is_true == "true")
                    {
                      pAnswer.style.color = "#3AD29F";
                    }
                    else
                    {
                      pAnswer.style.color = "red";
                    }
                  }
              };

              const btnBackMenu = document.querySelectorAll(".btnBackMenu");

              btnBackMenu.forEach(btn => {
                btn.addEventListener("click", ()=>{
                  location.reload();
                })
              });

              timer.remove();
              quizContainer.remove();
              btns.remove();

              var obj = { 
                "score": points,
                "time": totalSeconds,
                "id_user": myQuizz.player,
                "id_quiz" : myQuizz.id,
              };
              dbParam = JSON.stringify(obj);
              xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  // console.log("ok");
                  // console.log(dbParam);
                  // console.log(this.responseText);
                }
              };
              xmlhttp.open("POST", url + "/quiz_result.php/", true);
              xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
              xmlhttp.send(dbParam);
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
              
              // console.log(myQuestions[currentSlide].answers.length);
              
              for (let i = 0; i < myQuestions[currentSlide].answers.length; i++) {
                let input = document.querySelector(`.input${currentSlide}${i}`);
                if(input.checked)
                {
                  is_True = input.value;
                  id_answer = input.id;
                  return
                }
              }
            }
            
            // Show the first slide
            showSlide(currentSlide);
            
            function showNextSlide() {
              recupIds();

              console.log(currentSlide + 1);
              var obj = { 
                "questions": id_question, 
                "answer": id_answer,
                "time": totalSeconds,
                "id_quiz" : myQuizz.id,
                "is_True" : is_True,
              };
              

              dbParam = JSON.stringify(obj);
              xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  // console.log("ok");
                  // console.log(dbParam);
                  // console.log(this.responseText);
                  showSlide(currentSlide + 1);
                  progressBar();
                }
              };
              xmlhttp.open("POST", url + "/quiz_answer_user.php/", true);
              xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
              xmlhttp.send(dbParam);
            
            }

            // Event listeners
            nextButton.addEventListener("click", showNextSlide);

            // on submit, show results
            submitButton.addEventListener('click', showResults);
        }
      };

      // url a trouver
      xmlhttp2.open("GET", urlScript , true);
      xmlhttp2.send();
    })
  });

  //isotope initialized (with jquery)
  var $grid = $('.grid').isotope({
    itemSelector: '.element-item',
    masonry: {
      columnWidth: 120,
      isFitWidth: true
      }
  });
  // bind filter button click
  $('.filters-button-group').on( 'click', 'button', function() {
    var filterValue = $( this ).attr('data-filter');
    // use filterFn if matches value
    $grid.isotope({ filter: filterValue });
  });
  // change is-checked class on buttons
  $('.button-group').each( function( i, buttonGroup ) {
    var $buttonGroup = $( buttonGroup );
    $buttonGroup.on( 'click', 'button', function() {
      $buttonGroup.find('.is-checked').removeClass('is-checked');
      $( this ).addClass('is-checked');
    });
  });
}
};

// url a trouver
xmlhttp.open("GET", url  + '/menu_quiz.php', true);
xmlhttp.send();
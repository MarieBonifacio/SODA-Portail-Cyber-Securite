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
      gridElement.innerHTML = `
      <span class="tag">${myArray[$i].tag_name}</span>
      <h3>${myArray[$i].name}</h3>
      <span class="score">0pts</span>
      <div class="imgQ">
        <img src="${ url + '/img/myAvatar.png'}" alt="photo du quiz"/>
        <div class="filter"></div>
      </div>
      <p class="btnQuiz" data-id="${myArray[$i].id}">Jouer</p>
    `;
      grid.appendChild(gridElement);
    }
    let btnQuizs = document.querySelectorAll(".btnQuiz");
    btnQuizs.forEach(btn => {
      btn.addEventListener("click", (e)=>{
        const id = e.target.dataset.id;
        var urlScript = url + '/play_quiz.php/?id=' + id;
        console.log(urlScript);
        var xmlhttp2 = new XMLHttpRequest();
        xmlhttp2.onreadystatechange = function () {
          if(this.readyState == 4 && this.status == 200)
          {
            var myQuizz = JSON.parse(this.responseText);
            console.log(myQuizz.questions);
            const divQuizz = document.createElement("div");
            divQuizz.classList.add("quizPlay");
            document.body.appendChild(divQuizz);
            divQuizz.innerHTML = `
              <div class="quiz" id="quiz"></div>
              <div class="btns"> 
                <button id="previous">Previous Question</button>
                <button id="next">Next Question</button>
                <button id="submit">Terminer le quiz</button>
              </div>
              <div id="results"></div>
              <div class="timer">
                <label id="minutes">00</label>:<label id="seconds">00</label>
              </div>
            `;
            
            let myQuestions = myQuizz.questions;
            const quizContainer = document.getElementById('quiz');
            const resultsContainer = document.getElementById('results');
            const submitButton = document.getElementById('submit');
            const btns = document.querySelector('.btns');
                        
            const timer = document.querySelector('.btns');
            var minutesLabel = document.getElementById("minutes");
            var secondsLabel = document.getElementById("seconds");
            var totalSeconds = 0;
            var setInt = setInterval(setTime, 1000);

            function setTime() {
              ++totalSeconds;
              secondsLabel.innerHTML = pad(totalSeconds % 60);
              minutesLabel.innerHTML = pad(parseInt(totalSeconds / 60));
              console.log(totalSeconds);
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
              console.log(array);
            }


            shuffle(myQuestions);

            function buildQuiz(){

                    // variable to store the HTML output
            const output = [];

              // for each question...
              myQuestions.forEach(
                (currentQuestion, questionNumber) => {
                  // variable to store the list of possible answers
                  const currentAnswers = currentQuestion.answers;
                  const answers = [];
                  // and for each available answer...
                  for(i = 0; i<currentAnswers.length ; i++){
                    const letters = ['A', 'B' , 'C', 'D'];
                    // ...add an HTML radio button
                    answers.push(
                      `<label>
                        <input type="radio" name="question${questionNumber}" value="${currentAnswers[i].is_true}">
                        
                        <p class="answer">${letters[i]} : ${currentAnswers[i].content}</p>
                      </label>`
                    );
                  }

                  // add this question and its answers to the output
                  output.push(
                    `<div class="slide">
                      <div class="question"> ${currentQuestion.content} </div>
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
              let numCorrect = 0;
              let points = 0;

              // for each question...
              myQuestions.forEach( 
                (currentQuestion, questionNumber) => {
                // find selected answer
                const answerContainer = answerContainers[questionNumber];
                const selector = `input[name=question${questionNumber}]:checked`;
                const userAnswer = (answerContainer.querySelector(selector) || {}).value;

                // if answer is correct
                if(userAnswer === "true"){
                  // add to the number of correct answers
                  numCorrect+= 1;
                  points += parseInt(currentQuestion.points);
                  console.log(points);
                  // color the answers green
                  // answerContainers[questionNumber].style.color = 'lightgreen';
                }
                // if answer is wrong or blank
                else{
                  // numCorrect -= 1;
                  // color the answers red
                  // answerContainers[questionNumber].style.color = 'red';
                }
              });

              clearInterval(setInt);

              // show number of correct answers out of total
              resultsContainer.style.opacity = "1";
              resultsContainer.innerHTML = `${numCorrect} correct sur ${myQuestions.length}
              Vous avez obtenus ${points} en ${totalSeconds} secondes!
              `;
              quizContainer.remove();
              btns.remove();
              timer.remove();

              var obj = { 
                "score": points,
                "time": totalSeconds
              };
              dbParam = JSON.stringify(obj);
              xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  console.log("ok");
                }
              };
              xmlhttp.open("POST", url + "/quiz_result.php", true);
              // xmlhttp.setRequestHeader("Content-type", "multipart/form-data");
              xmlhttp.send(dbParam);
            }

            // display quiz right away
            buildQuiz();

            const previousButton = document.getElementById("previous");
            const nextButton = document.getElementById("next");
            const slides = document.querySelectorAll(".slide");
            let currentSlide = 0;
            
            function showSlide(n) {
              slides[currentSlide].classList.remove('active-slide');
              slides[n].classList.add('active-slide');
              currentSlide = n;
              if(currentSlide === 0){
                previousButton.style.display = 'none';
              }
              else{
                previousButton.style.display = 'inline-block';
              }
              if(currentSlide === slides.length-1){
                nextButton.style.display = 'none';
                submitButton.style.display = 'inline-block';
              }
              else{
                nextButton.style.display = 'inline-block';
                submitButton.style.display = 'none';
              }
            }

            
            // Show the first slide
            showSlide(currentSlide);

            function showNextSlide() {
              showSlide(currentSlide + 1);
            }
            
            function showPreviousSlide() {
              showSlide(currentSlide - 1);
            }


            // Event listeners
            previousButton.addEventListener("click", showPreviousSlide);
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
      layoutMode: 'fitRows',
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
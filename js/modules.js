window.addEventListener('load', function () {
  var url = myScript.theme_directory;
  var home_url = myScript.home_url;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
  if(this.readyState == 4 && this.status == 200)
  {
    var myArray = JSON.parse(this.responseText);
    const grid = document.querySelector(".grid");
    for (let i = 0; i < myArray.length; i++) {
      
      const gridElement = document.createElement("div");
      gridElement.classList.add(`element-item` , `${myArray[i].tag_name}`);
      gridElement.setAttribute('category', `${myArray[i].tag_name}`);
      //---------------------------------------------------------
      let moduleContent = `
      <span class="tag">${myArray[i].tag_name}</span>
      <h3>${myArray[i].title}</h3>
      <span class="score">`;
      if( myArray[i].user_prog != null){
        moduleContent += ``+myArray[i].user_prog+``;
      }else{
        moduleContent += `0`;
      }

      if(myArray[i].img == null)
      {
        moduleContent +=` %</span>
        <div class="imgQ">
          <img src="${ url + `/img/imgModuleDefault.jpg}`}" alt="photo du module"/>
          <div class="filter"></div>
        </div>
      `;
      }
      else
      {
        moduleContent +=` %</span>
        <div class="imgQ">
          <img src="${ url + `/img/modules/${myArray[i].img}`}" alt="photo du module"/>
          <div class="filter"></div>
        </div>
      `;
      }

      if( myArray[i].user_prog == 0){
        moduleContent += `<p class="btnModule" data-id="${myArray[i].id}">Commencez</p>`;
      }
      else if( myArray[i].user_prog == 100 )
      {
        moduleContent += `<p class="btnModule" data-id="${myArray[i].id}">Relire</p>`;
      }
      else
      {
        moduleContent += `<p class="btnModule" data-id="${myArray[i].id}">Continuez</p>`;
      }

      gridElement.innerHTML = moduleContent;
      grid.appendChild(gridElement);
    }
    let btnModules = document.querySelectorAll(".btnModule");
    btnModules.forEach(btn => {
      btn.addEventListener("click", (e)=>{
        const id = e.target.dataset.id;
        var urlScript = url + '/play_module.php/?id=' + id;
        var xmlhttp2 = new XMLHttpRequest();
        xmlhttp2.onreadystatechange = function () {
          if(this.readyState == 4 && this.status == 200)
          {
            var myModule = JSON.parse(this.responseText);
            var previous = myModule.previous;
            const divModule = document.createElement("div");
            divModule.classList.add("modulePlay");
            document.body.appendChild(divModule);
            divModule.innerHTML = `
            <div class="module" id="module">
            </div>
            <div class="btns"> 
              <button id="previous">Page précédente</button>
              <button id="next">Page suivante</button>
              <button id="submit">Terminer le module</button>
            </div>
            <div class="progress">
              <div class="progressDone" data-done=""><span class="percentage"></span></div>
            </div>
            `;

            let currentSlide = 0,
            myPages = myModule.slides,
            actualpercent = 0;
            const moduleContainer = document.getElementById('module'),
            submitButton = document.getElementById('submit'),
            progress = document.querySelector('.progressDone'),
            percentage = document.querySelector('.percentage');

            if(previous.length > 0)
            {
              var tableLostPages = [];
              for (let i = 0; i < previous.length; i++) 
              {
                for (let f = 0; f < myPages.length; f++) 
                {
                  if(myPages[f].id == previous[i].id_slide)
                  {
                    var idCurrentPage = myPages.indexOf(myPages[f]);
                    if(idCurrentPage > -1)
                    {
                      tableLostPages.splice(0, 0, myPages[f]);
                      myPages.splice(idCurrentPage, 1);
                    }
                  }
                }
              }
            }
            let percent = (currentSlide + 1 / myPages.length) * 100;

            function progressBar()
            {
              progress.dataset.done = Math.ceil(actualpercent);
              progress.style.width = progress.getAttribute('data-done')+ '%';
              progress.style.opacity = 1;
              percentage.innerHTML = `${Math.ceil(actualpercent)} %`;
            }

            function buildModule(){

              actualpercent += parseFloat(percent);

              progressBar();
              // variable to store the HTML output
              const output = [];

              let numPage = 0;
                // for each page...
                myPages.forEach(
                  (currentPage, pageNumber) => {
                    
                    numPage += 1;
                    // add this page and its content to the output
                    if(currentPage.img_path != null)
                    {
                      output.push(
                        `<div class="slide">
                          <span>
                            ${numPage}
                          </span>
                          <div class="content">
                            <div class="medias">
                              <img src="${ url + `/img/modules/${currentPage.img_path}`}" alt="photo de la page"/>
                            </div>
                            <div class="para">
                              <h3>${currentPage.title}</h3>
                              <p>${currentPage.content}</p>
                            </div>
                          </div>
                        </div>`
                      );
                    }else if(currentPage.video !== null){
                      let youtubeHash = currentPage.video.match(/^.*v=(.*)$/);
                      var video = ' <iframe src="https://www.youtube.com/embed/'+youtubeHash[1]+'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> ';
                      if(currentPage.video.match(/^.*(youtube).*/) == null  ){
                        video = ' <a href="'+currentPage.video+'">Voir la vidéo</a> ';
                      }
                      output.push(
                        `<div class="slide">
                          <span>
                            ${numPage}
                          </span>
                          <div class="content">
                            <div class="medias">
                              ${video}
                            </div>
                            <div class="para">
                              <h3>${currentPage.title}</h3>
                              <p>${currentPage.content}</p>
                            </div>
                          </div>
                        </div>`
                      );
                    }
                    else
                    {
                      output.push(
                        `<div class="slide">
                          <span>
                            ${numPage}
                          </span>
                          <div class="content">
                            <div class="para paraFull">
                              <h3>${currentPage.title}</h3>
                              <p>${currentPage.content}</p>
                              <div class="shadow"></div>
                            </div>
                          </div>
                        </div>`
                      );
                    }
                  }
                );
                // finally combine our output list into one string of HTML and put it on the page
                moduleContainer.innerHTML = output.join('');
            }

            function endModule(){
              var obj = { 
                "module_id" : myModule.id,
              };

              dbParam = JSON.stringify(obj);
              xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  const div = document.createElement("div"),
                  divPlay = document.querySelector(".modulePlay");
                  div.classList.add("recapModule");
                  divPlay.appendChild(div);
                  if(myModule.quizs != null)
                  {
                    div.innerHTML =`
                      <i class="fas fa-times"></i>
                      <div class="contentRecap">
                        <p>Bravo, vous venez de terminer le module "${myModule.title}" </br> Vous pouvez désormais suivre un autre module ou faire le(s) quiz(s) associé(s) à ce dernier :</p>
                        <ul class="listQuizMod">
                        </ul>
                      </div>
                    `
                    const liste = document.querySelector(".listQuizMod");
                    for (let i = 0; i < myModule.quizs.length; i++) {
                      liste.innerHTML += `
                        <li>
                          <a href="${home_url + `/menu-quiz/`}">
                            <div class="contentQuiz">
                              <span>${myModule.quizs[i].title}</span>
                              <span class="tag">${myModule.quizs[i].tag}</span>
                              <div class="img">
                                <img src="${ url + `/img/quizs/${myModule.quizs[i].img}`}" alt="photo du quiz"/>
                              </div>
                            </div>
                          </a>
                        </li>
                      `
                    }
                  }
                  else
                  {
                    div.innerHTML =`
                      <i class="fas fa-times"></i>
                      <div class="contentRecap">
                        <p>Bravo, vous venez de terminer le module "${myModule.title}" </br> Il n'y a aucun quiz associé à ce module, vous pouvez donc retourner au menu pour commencer un autre module ou refaire ce dernier.</p>
                      </div>
                    `
                  }
                  const cross = document.querySelector(".fa-times");

                  cross.addEventListener("click", ()=>{
                    window.location.reload();
                  })
                }
              };
              xmlhttp.open("POST", url + "/module_finish.php", true);
              xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
              xmlhttp.send(dbParam);
            }

            buildModule();

            const nextButton = document.getElementById("next");
            const previousButton = document.getElementById("previous");
            const slides = document.querySelectorAll(".slide");

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
            showSlide(currentSlide);

            function showNextSlide() {
              var id_page,
              
              id_page = myPages[currentSlide].id;

              var obj = { 
                "slide_id": id_page,
                "module_id" : myModule.id,
              };
              

              dbParam = JSON.stringify(obj);
              xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  actualpercent += parseFloat(percent);
                  showSlide(currentSlide + 1);
                  progressBar();
                }
              };
              xmlhttp.open("POST", url + "/module_user.php/", true);
              xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
              xmlhttp.send(dbParam);
            }

            function showPreviousSlide() {
              showSlide(currentSlide - 1);
              actualpercent -= parseFloat(percent);
              progressBar();
            }

            nextButton.addEventListener("click", showNextSlide);

            previousButton.addEventListener("click", showPreviousSlide);

            submitButton.addEventListener('click', endModule);
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
  xmlhttp.open("GET", url  + '/menu_modules.php', true);
  xmlhttp.send();
});
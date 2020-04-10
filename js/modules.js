console.log("coucou bite");
var url = myScript.theme_directory;
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

    moduleContent +=` %</span>
    <div class="imgQ">
      <img src="${ url + '/img/myAvatar.png'}" alt="photo du module"/>
      <div class="filter"></div>
      </div>
  `;
    if( myArray[i].user_score == null){
      moduleContent += `<p class="btnModule" data-id="${myArray[i].id}">Commencez</p>`;
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
          console.log(myModule);
          const divModule = document.createElement("div");
          divModule.classList.add("modulePlay");
          document.body.appendChild(divModule);
          divModule.innerHTML = `
          <div class="module" id="module">
          </div>
          <div class="btns"> 
            <button id="next">Prochaine page</button>
            <button id="previous">Précédente page</button>
            <button id="submit">Terminer le module</button>
          </div>
          <div class="progress">
            <div class="progressDone" data-done=""><span class="percentage"></span></div>
          </div>
          `;

          let currentSlide = 0;
          let myPages = myModule.slides,
          actualpercent = 0;
          const moduleContainer = document.getElementById('module'),
          submitButton = document.getElementById('submit'),
          btns = document.querySelector('.btns'),
          progress = document.querySelector('.progressDone'),
          percentage = document.querySelector('.percentage');
          console.log(myPages);

          if(previous.length > 0)
          {
            var tableLostPages = [];
            for (let i = 0; i < previous.length; i++) 
            {
              for (let f = 0; f < myPages.length; f++) 
              {
                if(myPages[f].id == previous[i].id_page)
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
            actualpercent += parseFloat(percent);
            progress.dataset.done = Math.ceil(actualpercent);
            progress.style.width = progress.getAttribute('data-done')+ '%';
            progress.style.opacity = 1;
            console.log(parseFloat(percent));
            percentage.innerHTML = `${Math.ceil(actualpercent)} %`;
          }

          function buildModule(){

            progressBar();
            // variable to store the HTML output
            const output = [];

            let numPage = 0;
              // for each page...
              myPages.forEach(
                (currentPage, pageNumber) => {
                  
                  numPage += 1;
                  // add this page and its content to the output
                  if(myPages.img_path)
                  {
                    output.push(
                      `<div class="slide">
                        <span>
                          ${numPage}
                        </span>
                        <div class="media">
                          <img src="${ url + '/img/myAvatar.png'}" alt="photo de la page"/>
                        </div>
                        <div class="content">
                          ${currentPage.content}
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
                        <div class="content contentFull">
                          ${currentPage.content}
                        </div>
                      </div>`
                    );
                  }
                }
              );
              // finally combine our output list into one string of HTML and put it on the page
              moduleContainer.innerHTML = output.join('');
          }
          
          buildModule();

          const nextButton = document.getElementById("next");
          const previousButton = document.getElementById("previous");
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
          showSlide(currentSlide);

          function showNextSlide() {
            var id_page,
            
            id_page = myPages[currentSlide].id;

            console.log(id_page);
            console.log(myModule.id);

            console.log(currentSlide + 1);
            var obj = { 
              "slide_id": id_page, 
              "module_id" : myModule.id,
            };
            

            dbParam = JSON.stringify(obj);
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                // console.log("ok");
                // console.log(dbParam);
                // console.log(this.responseText);
                showSlide(currentSlide + 1);
                // percent += percent;
                progressBar();
              }
              else
              {
                // console.log("pas ok");
              }
            };
            xmlhttp.open("POST", url + "/module_user.php/", true);
            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlhttp.send(dbParam);
          }

          function showPreviousSlide() {
            showSlide(currentSlide - 1);
          }

          nextButton.addEventListener("click", showNextSlide);

          previousButton.addEventListener("click", showPreviousSlide);

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
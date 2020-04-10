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
      <img src="${ url + '/img/myAvatar.png'}" alt="photo du quiz"/>
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
            <div class="btns"> 
              <button id="next">Prochaine page</button>
              <button id="previous">Précédente page</button>
              <button id="submit">Terminer le module</button>
            </div>
          </div>
          <div class="progress">
            <div class="progressDone" data-done=""><span class="percentage"></span></div>
          </div>
          `;

          let currentSlide = 0;
          let myQuestions = myModule.pages,
          actualpercent = 0;
          const moduleContainer = document.getElementById('module'),
          submitButton = document.getElementById('submit'),
          btns = document.querySelector('.btns'),
          progress = document.querySelector('.progressDone'),
          percentage = document.querySelector('.percentage');
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
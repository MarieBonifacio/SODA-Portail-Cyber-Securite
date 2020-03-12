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
  }
};

// url a trouver
xmlhttp.open("GET", url  + '/menu_quiz.php', true);
xmlhttp.send();
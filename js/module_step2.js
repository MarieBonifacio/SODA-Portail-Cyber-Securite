function inputFile()
{
  const fakeBtn = document.querySelectorAll("#fakebtn");
    
  fakeBtn.forEach(fake => {
    fake.addEventListener("click", (e)=>{
      let id = e.target.dataset.id,
        real = document.querySelector(`#realbtn${id}`),
        span = document.querySelector(`#img_select${id}`);

      real.click();

      real.addEventListener("change", ()=>{
        if(real.value)
        {
          // match() method get a correlation table between a regular expression (image path -> realBtn.value)  and a rational expression (regex)
          span.innerHTML = real.value.replace(/C:\\fakepath\\/, '');
        }
        else
        {
          span.innerHTML = "Aucune image séléctionnée";
        }
      })
    })
  });
}


inputFile();

var id = parseInt(document.querySelector("input[name=nbrPage]").value);
var nbrPages = 1;
let questions = document.querySelectorAll(".questionPage");

nbrPages = questions.length;

const plus = document.querySelector(".plus"),
      form = document.querySelector("form"),
      nbrPagesTotal = document.querySelector("input[name=nbrPage]"),
      total = document.createElement("p");
      total.classList.add("total");
      form.appendChild(total);
      total.innerHTML=`Total de pages: ${nbrPages}`;
      nbrPagesTotal.value = `${nbrPages}`;

plus.addEventListener("click", ()=>{
  if( nbrPages == 25)
  {
    plus.disabled = true;
  }
  else
  {
    id += 1;
    nbrPages += 1;
    nbrPagesTotal.value = `${nbrPages}`;
    total.innerHTML=`Total de pages: ${nbrPages}`;
    var div = document.createElement("div");
    div.classList.add("questionPage");
    div.innerHTML=`
    <div>
    <label>Titre de la page :</label>
    <input type="text" name="content_${id}_title" value="">
  </div>
  <div>
    <label>Contenu de la page :</label>
    <textarea name="content_${id}" value=""></textarea>
  </div>
  <div class="media">
    <div>
      <label>Image :</label>
      <button type="button" disabled><p id="fakebtn" data-id="${id}">Séléctionnez une image</p></button>
      <span id="img_select${id}">Aucune image sélectionnée.</span>
      <input id="realbtn${id}" type="file" name="content_${id}_img" hidden>
    </div>
  </div>
  <i class="trash${id} trash fas fa-trash" data-id="${id}"></i>`;
    form.appendChild(div);
  
    var trash = document.querySelector(`.trash${id}`);
    

    trash.addEventListener("click", (e)=>{
      if(e.target.dataset.id == nbrPages)
      {
        e.target.parentNode.remove();
        nbrPages -= 1;
        id -= 1;
        total.innerHTML=`Total de pages: ${nbrPages}`;
        nbrPagesTotal.value = `${nbrPages}`;
      }
    })
    inputFile();
  }
})

const validate = document.querySelector(".validate");

validate.addEventListener("click", ()=>{
  document.querySelector("input[type=submit]").click();
})
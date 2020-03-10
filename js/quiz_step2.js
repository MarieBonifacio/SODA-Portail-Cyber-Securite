function inputFile()
{
  const fakeBtn = document.querySelectorAll("#fakebtn");
    
  fakeBtn.forEach(fake => {
    fake.addEventListener("click", (e)=>{
      let id = e.target.dataset.id,
        real = document.querySelector(`#realbtn${id}`),
        span = document.querySelector(`#img_select${id}`);

      console.log(id);
      
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

var id = 10;
var nbrQuestions = 10;

const plus = document.querySelector(".plus"),
      form = document.querySelector("form"),
      nbrQuestionsTotal = document.querySelector("input[name=nbrQuestion]"),
      total = document.createElement("p");
      total.classList.add("total");
      form.appendChild(total);
      total.innerHTML=`Total de questions: ${nbrQuestions}`;
      nbrQuestionsTotal.value = `${nbrQuestions}`;

plus.addEventListener("click", ()=>{
  if( nbrQuestions == 25)
  {
    plus.disabled = true;
  }
  else
  {
    id += 1;
    nbrQuestions += 1;
    nbrQuestionsTotal.value = `${nbrQuestions}`;
    total.innerHTML=`Total de questions: ${nbrQuestions}`;
    var div = document.createElement("div");
    div.classList.add("question");
    div.innerHTML=`
    <div>
    <label for="">Votre question:</label>
      <input type="text" name="question_${id}" value="">
    </div>
    <div class="answers">
    <label for="">Vos réponses:</label>
    <div class="abcd">
          <div class="answer">
          <label for="">A.</label>
              <input type="text" name="q_${id}_reponse_1" value="">
              <label class="true" id="truea">
                  <input type="radio" value="true" name="q_${id}_isTrue_1" checked>
                  <span>
                      <i class="fas fa-check"></i>
                      </span>
                      </label>
              <label class="false" id="falsea">
              <input type="radio" value="false" name="q_${id}_isTrue_1">
                  <span>
                  <i class="fas fa-times"></i>
                  </span>
                  </label>
                  </div>
            <div class="answer">
            <label for="">B.</label>
                <input type="text" name="q_${id}_reponse_2" value="">
                <label class="true" id="trueb">
                    <input type="radio" value="true" name="q_${id}_isTrue_2">
                    <span>
                        <i class="fas fa-check"></i>
                    </span>
                </label>
                <label class="false" id="falseb">
                <input type="radio" value="false" name="q_${id}_isTrue_2" checked>
                <span>
                <i class="fas fa-times"></i>
                </span>
                </label>
                </div>
                <div class="answer">
                <label for="">C.</label>
                <input type="text" name="q_${id}_reponse_3"  value="">
                <label class="true" id="truec">
                <input type="radio" value="true" name="q_${id}_isTrue_3" checked>
                <span>
                <i class="fas fa-check"></i>
                </span>
                </label>
                <label class="false" id="falsec">
                <input type="radio" value="false" name="q_${id}_isTrue_3">
                <span>
                <i class="fas fa-times"></i>
                </span>
                </label>
            </div>
            <div class="answer">
                <label for="">D.</label>
                <input type="text" name="q_${id}_reponse_4"  value="">
                <label class="true" id="trued">
                <input type="radio" value="true" name="q_${id}_isTrue_4">
                    <span>
                        <i class="fas fa-check"></i>
                        </span>
                </label>
                <label class="false" id="falsed">
                    <input type="radio" value="false" name="q_${id}_isTrue_4" checked>
                    <span>
                    <i class="fas fa-times"></i>
                    </span>
                    </label>
                    </div>
        </div>
        </div>
    <div>
    <label>Le media:</label>
    </div>
    <div class="media">
    <div>
    <label for="">Image :</label>
    <button type="button" disabled><p id="fakebtn" data-id="${id}">Séléctionnez une image</p></button>
    <span id="img_select${id}">Aucune image sélectionnée.</span>
        <input id="realbtn${id}" type="file" name="q_${$i}_img" hidden>
        </div>
        <p>ou</p>
      <div>
        <label for="">Video :</label>
        <input type="text" name="q_${$i}_video" value="">
      </div>
      </div>
      <i class='trash${id} trash fas fa-trash'></i>`;
    form.appendChild(div);
  
    var trash = document.querySelector(`.trash${id}`);
    
    trash.addEventListener("click", (e)=>{
      e.target.parentNode.remove();
      nbrQuestions -= 1;
      total.innerHTML=`Total de questions: ${nbrQuestions}`;
      nbrQuestionsTotal.value = `${nbrQuestions}`;
      console.log(nbrQuestionsTotal.value);
    })
    inputFile();
    console.log(nbrQuestionsTotal.value);
  }
})

console.log(nbrQuestionsTotal.value);

const validate = document.querySelector(".validate");

validate.addEventListener("click", ()=>{
  document.querySelector("input[type=submit]").click();
})
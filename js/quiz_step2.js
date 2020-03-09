const fakeBtn = document.querySelectorAll(".fakebtn");

fakeBtn.forEach(fake => {
    fake.addEventListener("click", (e)=>{
        let id = e.target.dataset.num,
            real = document.querySelector(`.realbtn${id}`),
            span = document.querySelector(`.img_select${id}`);
        
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

const plus = document.querySelector(".plus");
const form = document.querySelector(".form");
var id = 10;
console.log(form);

plus.addEventListener("click", ()=>{
  id += 1;
  var div = document.createElement("div");
  div.classList.add("question");
  div.innerHTML=`<input type="hidden" name="nbrQuestion" value = "10">
  <div>
    <label for="">Votre question: ${id}.</label>
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
                  <input type="radio" value="true" name="q_${id}_isTrue_2" checked>
                  <span>
                      <i class="fas fa-check"></i>
                  </span>
              </label>
              <label class="false" id="falseb">
                  <input type="radio" value="false" name="q_${id}_isTrue_2">
                  <span>
                      <i class="fas fa-times"></i>
                  </span>
              </label>
          </div>
          <div class="answer">
              <label for="">C.</label>
              <input type="text" name="q_${id}_reponse_3"  value="">
              <label class="true" id="truec">
                  <input type="radio" value="true" name="q_${id}_isTrue_3">
                  <span>
                      <i class="fas fa-check"></i>
                  </span>
              </label>
              <label class="false" id="falsec">
                  <input type="radio" value="false" name="q_${id}_isTrue_3" checked>
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
  <div class="media">
      <div class="left">
          <label for="">Image :</label>
          <div> 
              <button type="button" disabled><p class="fakebtn fakebtn${id}" data-num="${id}">Séléctionnez une image</p></button>
              <span class="img_select${id}">Aucune image sélectionnée.</span>
          </div>
          <input class="realbtn${id}" type="file" name="img_quiz" hidden>
      </div>
      <p>ou</p>
      <div class="right">
          <label for="">Vidéo :</label>
          <input type="text" name="url_video${id}">
      </div>
  </div>
  <i class='trash${id} fas fa-trash'></i>`;
  form.appendChild(div);

  var trash = document.querySelector(`.trash${id}`);

  trash.addEventListener("click", (e)=>{
    // console.log(e.target.parentNode);
    e.target.parentNode.remove();
    id -= 1;
  })
})
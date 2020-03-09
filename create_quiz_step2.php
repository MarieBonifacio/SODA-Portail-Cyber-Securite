<?php /* Template Name: Create Quiz Etape 2 */ get_header();?>

<h2>Titre du quiz</h2>

<div class="step2">

  <h3>Étape 2: Les questions</h3>


  <div class="steps">
      <div class="step">1</div>
      <div class="step stepInto">2</div>
      <div class="step">3</div>
      <div class="stick"></div>
  </div>
  <?php
    if(!empty($_SESSION["errorQuiz"])){
      echo "<p class='mess error'>".$_SESSION["errorQuiz"]."</p>";
      unset($_SESSION["errorQuiz"]); 
      /* SI ON REVIENT DU SCRIPT VALIDATION */
      $p = $_SESSION['formQuizStep2'];
    }
    ?>
  <form action="<?php echo get_template_directory_uri(); ?>/app/create_quiz_2.php" method="post">
    <?php
      for($i=1; $i<=10; $i++){
        echo '
        <div class="question">
          <!-- <input type="hidden" name="nbrQuestion" value = "10"> -->
          <div>
            <label for="">Votre question:</label>
            <input type="text" name="question_'.$i.'" value="'.$p['question_'.$i].'">
          </div>
          <div class="answers">
            <label for="">Vos réponses:</label>
            <div class="abcd">
              <div class="answer">
                <label for="">A.</label>
                <input type="text" name="q_'.$i.'_reponse_1" value="'.$p['q_'.$i.'_reponse_1'].'">
                <label class="true" id="truea">
                  <input checked type="radio" value="true" name="q_'.$i.'_isTrue_1">
                  <span>
                    <i class="fas fa-check"></i>
                  </span>
                </label>
                <label class="false" id="falsea">
                  <input type="radio" value="false" name="q_'.$i.'_isTrue_1">
                  <span>
                    <i class="fas fa-times"></i>
                  </span>
                </label>
              </div>
              <div class="answer">
                <label for="">B.</label>
                <input type="text" name="q_'.$i.'_reponse_2" value="'.$p['q_'.$i.'_reponse_2'].'">
                <label class="true" id="trueb">
                  <input type="radio" value="true" name="q_'.$i.'_isTrue_2">
                  <span>
                    <i class="fas fa-check"></i>
                  </span>
                </label>
                <label class="false" id="falseb">
                  <input checked type="radio" value="false" name="q_'.$i.'_isTrue_2">
                  <span>
                    <i class="fas fa-times"></i>
                  </span>
                </label>
              </div>
              <div class="answer">
                <label for="">C.</label>
                <input type="text" name="q_'.$i.'_reponse_3"  value="'.$p['q_'.$i.'_reponse_3'].'">
                <label class="true" id="truec">
                  <input checked type="radio" value="true" name="q_'.$i.'_isTrue_3">
                  <span>
                    <i class="fas fa-check"></i>
                  </span>
                </label>
                <label class="false" id="falsec">
                  <input type="radio" value="false" name="q_'.$i.'_isTrue_3">
                  <span>
                    <i class="fas fa-times"></i>
                  </span>
                </label>
              </div>
              <div class="answer">
                <label for="">D.</label>
                <input type="text" name="q_'.$i.'_reponse_4"  value="'.$p['q_'.$i.'_reponse_4'].'">
                <label class="true" id="trued">
                  <input type="radio" value="true" name="q_'.$i.'_isTrue_4">
                  <span>
                    <i class="fas fa-check"></i>
                  </span>
                </label>
                <label class="false" id="falsed">
                  <input checked type="radio" value="false" name="q_'.$i.'_isTrue_4">
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
              <button type="button" disabled><p id="fakebtn" data-id="'.$i.'">Séléctionnez une image</p></button>
              <span id="img_select'.$i.'">Aucune image sélectionnée.</span>
              <input id="realbtn'.$i.'" type="file" name="img_quiz'.$i.'" hidden>
            </div>
            <p>ou</p>
            <div>
              <label for="">Video :</label>
              <input type="text" name="video_q'.$i.'" value="">
            </div>
          </div>
        </div>
        ';
      }
    ?> 
    <input type="submit" value="Valider" hidden/>
  </form>
  <i class="plus fas fa-plus"></i>
  <p class="validate">Suivant</p>
</div>

<script src="<?php echo get_template_directory_uri(); ?>/js/quiz_step2.js">

<?php get_footer()?>
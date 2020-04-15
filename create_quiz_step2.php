<?php /* Template Name: Create Quiz Etape 2 */ get_header();?>
<!-- <?php echo '<pre>';print_r($_SESSION);echo '</pre>';?> -->
<h2 class="h2"><?php echo $_SESSION['quizData']['quiz']['title']; ?></h2>

<div class="step2">

  <!-- <img src="<?php echo get_template_directory_uri(); ?>/img/fall.jpg" alt="votre image"> -->
  <img src="<?php echo get_template_directory_uri(); ?>/img/quizs/<?php echo $_SESSION['quizData']['quiz']['title']; ?>/<?php echo $_SESSION['quizData']['quiz']['img']; ?>" alt="votre image">

  <h3>Étape 2: Les questions</h3>



  <div class="steps">
      <div class="step">1</div>
      <div class="step stepInto">2</div>
      <div class="step">3</div>
      <div class="stick"></div>
  </div>
  <?php
    $nbrQuestion = 1;
    if(!empty($_SESSION["errorQuiz"])){
      echo "<p class='mess error'>".$_SESSION["errorQuiz"]."</p>";
      unset($_SESSION["errorQuiz"]); 
      /* SI ON REVIENT DU SCRIPT VALIDATION POUR CAUSE MESSAGE D'ERREUR */
      $p = $_SESSION['formQuizStep2'];
      unset($_SESSION["formQuizStep2"]); 
      $nbrQuestion = $p['nbrQuestion'];
    }
    if(!empty($_SESSION['formQuizStep2'])){
      $nbrQuestion = $_SESSION['formQuizStep2']['nbrQuestion'];
      $p = $_SESSION['formQuizStep2'];
      unset($_SESSION["formQuizStep2"]); 
    }
    ?>
  <form action="<?php echo get_template_directory_uri(); ?>/app/create_quiz_2.php" method="post" enctype="multipart/form-data">
  <input type="text" name="nbrQuestion" value="<?php echo $nbrQuestion; ?>" hidden>
    <?php
      for($i=1; $i<=$nbrQuestion; $i++){
        echo '
        <div class="questionPage">
          <div>
            <label>Votre question:</label>
            <input type="text" name="question_'.$i.'" value="'.$p['question_'.$i].'">
          </div>
          <div class="answers">
            <label>Vos réponses:</label>
            <div class="abcd">
              <div class="answer">
                <label>A.</label>
                <input type="text" name="q_'.$i.'_reponse_1" value="'.$p['q_'.$i.'_reponse_1'].'">
                <label class="true" id="truea">
                  <input '.( ($p["q_".$i."_isTrue_1"] == "true")? "checked":"" ).' type="radio" value="true" name="q_'.$i.'_isTrue_1">
                  <span>
                    <i class="fas fa-check"></i>
                  </span>
                </label>
                <label class="false" id="falsea">
                  <input '.( ($p["q_".$i."_isTrue_1"] == "false")?"checked":"" ).' type="radio" value="false" name="q_'.$i.'_isTrue_1">
                  <span>
                    <i class="fas fa-times"></i>
                  </span>
                </label>
              </div>
              <div class="answer">
                <label>B.</label>
                <input type="text" name="q_'.$i.'_reponse_2" value="'.$p['q_'.$i.'_reponse_2'].'">
                <label class="true" id="trueb">
                  <input '.( ($p["q_".$i."_isTrue_2"] == "true")? "checked":"" ).' type="radio" value="true" name="q_'.$i.'_isTrue_2">
                  <span>
                    <i class="fas fa-check"></i>
                  </span>
                </label>
                <label class="false" id="falseb">
                  <input '.( ($p["q_".$i."_isTrue_2"] == "false")?"checked":"" ).' checked type="radio" value="false" name="q_'.$i.'_isTrue_2">
                  <span>
                    <i class="fas fa-times"></i>
                  </span>
                </label>
              </div>
              <div class="answer">
                <label>C.</label>
                <input type="text" name="q_'.$i.'_reponse_3"  value="'.$p['q_'.$i.'_reponse_3'].'">
                <label class="true" id="truec">
                  <input '.( ($p["q_".$i."_isTrue_3"] == "true")? "checked":"" ).' checked type="radio" value="true" name="q_'.$i.'_isTrue_3">
                  <span>
                    <i class="fas fa-check"></i>
                  </span>
                </label>
                <label class="false" id="falsec">
                  <input '.( ($p["q_".$i."_isTrue_3"] == "false")?"checked":"" ).' type="radio" value="false" name="q_'.$i.'_isTrue_3">
                  <span>
                    <i class="fas fa-times"></i>
                  </span>
                </label>
              </div>
              <div class="answer">
                <label>D.</label>
                <input type="text" name="q_'.$i.'_reponse_4"  value="'.$p['q_'.$i.'_reponse_4'].'">
                <label class="true" id="trued">
                  <input '.( ($p["q_".$i."_isTrue_4"] == "true")? "checked":"" ).' type="radio" value="true" name="q_'.$i.'_isTrue_4">
                  <span>
                    <i class="fas fa-check"></i>
                  </span>
                </label>
                <label class="false" id="falsed">
                  <input '.( ($p["q_".$i."_isTrue_4"] == "false")?"checked":"" ).' checked type="radio" value="false" name="q_'.$i.'_isTrue_4">
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
              <label>Image :</label>
              <button type="button" disabled><p id="fakebtn" data-id="'.$i.'">Séléctionnez une image</p></button>
              <span id="img_select'.$i.'">Aucune image sélectionnée.</span>
              <input id="realbtn'.$i.'" type="file" name="q_'.$i.'_img" hidden>
            </div>
            <p>ou</p>
            <div>
              <label>Video :</label>
              <input type="text" name="q_'.$i.'_video" value="">
            </div>
          </div>
          <i class="trash'.$id.' trash fas fa-trash" data-id="'.$id.'"></i>
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
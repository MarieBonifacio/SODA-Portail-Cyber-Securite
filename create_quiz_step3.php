<?php /* Template Name: Create Quiz Etape 3 */ get_header();?>

<h2>Titre du quiz</h2>

<div class="step3">

  <h3>Étape 3: Confirmation</h3>

  <div class="steps">
      <div class="step">1</div>
      <div class="step">2</div>
      <div class="step stepInto">3</div>
      <div class="stick"></div>
  </div>


  <div class="recap">
      <?php 
      $img = get_template_directory_uri();
      $num = 0;
      // <div class="medias">
      //   <img src="'.$img va.'/img/myAvatar.png" alt="votre image">
      // </div>
      foreach($_SESSION['quizData']['questions'] as $q)
      {
        $num ++;
        echo '
          <div class="questions">
            <span class="numQ">'.$num.'</span>
            <div class="question">
              <span>'.$num.'.</span>
              <p>'.$q['info']['text'].'</p>
            </div>
            <div class="answers">

          ';
            $lettre = array("A", "B", "C", "D");
            $lettreNum = -1;
            foreach($q['answers'] as $a)
            {
              $lettreNum ++;
              echo'
                <div>
                  <div class="spanP">
                    <span>'.$lettre[$lettreNum].'</span>
                    <p>'.$a['text'].'</p>
                  </div>
              ';
              if($a['isTrue'] == "true")
              {
                echo'
                  <div>
                  <i class="fas fa-check good"></i>
                  <i class="fas fa-times"></i>
                  </div>
                  ';
              }
              else
              {
                echo '
                  <div>
                  <i class="fas fa-check"></i>
                  <i class="fas fa-times error"></i>
                  </div>
                ';
              }
              echo '
                </div>
              ';
            }
          echo '
              </div>
            </div>
          ';
          };
          ?>
  </div>

  <a href="">Confirmez la création de votre quiz</a>

</div>

<?php get_footer();?>
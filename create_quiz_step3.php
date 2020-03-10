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
      echo $_SESSION[quiz];
      for($i=1; $i<=25; $i++)
      {
        echo '
          <div class="questions">
            <span class="numQ">'.$i.'</span>
            <div class="medias">
              <img src="'.$img.'/img/myAvatar.png" alt="votre image">
            </div>
            <div class="question">
              <span>'.$i.'.</span>
              <p>Voici la question 1, quel est la réponse ?</p>
            </div>
            <div class="answers">
              <div class="aaa">
                <span>A.</span>
                <p>hehe</p>
                <i class="fas fa-check"></i>
                <i class="fas fa-times"></i>
              </div>
              <div class="bbb">
                <span>B.</span>
                <p>hehe</p>
                <i class="fas fa-check"></i>
                <i class="fas fa-times"></i>
              </div>
              <div class="ccc">
                <span>C.</span>
                <p>hehe</p>
                <i class="fas fa-check"></i>
                <i class="fas fa-times"></i>
              </div>
              <div class="ddd">
                <span>D.</span>
                <p>hehe</p>
                <i class="fas fa-check"></i>
                <i class="fas fa-times"></i>
              </div>
            </div>
          </div>
          ';
        }
      ?>
  </div>

  <a href="">Confirmez la création de votre quiz</a>

</div>

<?php get_footer();?>
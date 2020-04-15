<?php /* Template Name: Create Quiz Etape 3 */ get_header();?>

<h2 class="h2"><?php echo $_SESSION['quizData']['quiz']['title']; ?></h2>
<?php 
echo '<pre>';print_r($_SESSION);echo '</pre>';?>
<div class="step3">

  <img class="img" src="<?php echo get_template_directory_uri(); ?>/img/quizs/<?php echo $_SESSION['quizData']['quiz']['title'].'/'.$_SESSION['quizData']['quiz']['img']?>" alt="votre image">
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
      foreach($_SESSION['quizData']['questions'] as $q)
      {
        $num ++;
        echo '
          <div class="questions">
          ';
          if($_SESSION['quizData']['quiz']['img'] !== null)
          {
            echo ' 
            <div class="medias">
            <img src="'.$img.'/img/quizs/'.$_SESSION['quizData']['quiz']['title'].'/pages/'.$q['info']['img'].'" alt="votre image">
            </div>
            ';
          }
          elseif ($_SESSION['quizData']['quiz']['video'] !== null) {
            $regex = "ton regex";
            echo ' 
            <iframe width="725" height="408" src="https://www.youtube.com/embed/'.$regex.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            ';
          }
        echo '
            <span class="numQ">'.$num.'</span>
            <div class="question">
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
                    <span>'.$lettre[$lettreNum].'.</span>
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

  <a href="<?php echo get_template_directory_uri(); ?>/app/create_quiz_3.php">Confirmez la création de votre quiz</a>

</div>

<?php get_footer();?>
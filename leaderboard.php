<?php /* Template Name: Classement */ 

$_SESSION['needAdmin'] = true;

get_header();

cleanSession(); ?>



<h2 class="h2 h2board">Classements</h2>

<div class="board">

  <div class="legend">

    <p>Légende <i class="dropIcon fas fa-sort-down"></i></p>

    <div class="square_legend dropLegend">

      <div class="gold">

        <label>1er:</label>

        <div></div>

      </div>

      <div class="silver">

        <label>2ème:</label>

        <div></div>

      </div>

      <div class="bronze">

        <label>3ème:</label>

        <div></div>

      </div>

    </div>

    

  </div>

  <div class="btns">
    <div class="type"> 
      <label>Type :</label>
      <button class="glob">Global</button>
      <button class="quizz">Quiz</button>
      <button class="cat">Catégorie</button>
    </div>
    <div class="filter">
      <label>Filtre :</label>
      <button class="gen">Général</button>
      <button class="sites">Sites</button>
    </div>
    <div class="select">
      <div class="labelSpan">
        <label class="labelList"></label>
        <p class="selected">Votre choix</p>
      </div>
      <ul class="listQuizCat listCat">
      <?php $tags = $wpdb->get_results( "SELECT tag.id AS tId, tag.name AS tName from tag");
      foreach($tags as $t){
        echo '<li class="tagLi" data-id="'.$t->tId.'">'.$t->tName.'</li>';
      }
      ?>
      </ul>
      <ul class="listQuizCat listQuiz">
      <?php $quiz = $wpdb->get_results( "SELECT quiz.id AS qId, quiz.name AS qName from quiz");
      foreach($quiz as $t){
        echo '<li class="quizLi" data-id="'.$t->qId.'">'.$t->qName.'</li>';
      }
      ?>
      </ul>
    </div>
  </div>



  <div class="leadboard">

    <table>

      <thead></thead>

      <tbody></tbody>

    </table>

  </div>

  <div class="spans">

    <span class="span_above"></span>

    <span class="span_under"></span>

  </div>

</div>



<?php get_footer();?>
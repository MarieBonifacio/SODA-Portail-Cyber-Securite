<?php /* Template Name: Classement */ 

$_SESSION['needAdmin'] = true;

get_header();

cleanSession(); ?>



<h2 class="h2 h2board">Classements</h2>

<div class="board">

  <div class="legend">

    <p>Légende <i class="dropIcon fas fa-sort-down"></i></p>

    <div class="square_legend dropLegend">

      <div class="you">

        <label>Vous:</label>

        <div></div>

      </div>

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

    <div class="btnsGlobal"> 
      <button class="global activated">Global</button>
      <button class="quiz">Quiz</button>
      <button class="tags">Tags</button>
    </div>
    <div class="btnsChoice">
      <button class="gen activated">Général</button>
      <button class="town">Site</button>
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
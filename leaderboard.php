<?php /* Template Name: Classement */ get_header(); ?>
<h2 class="h2">Classements</h2>
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
    <button class="gen">Général</button>
    <button class="town">Ville</button>
  </div>
  <div class="leadboard">
    <table>
      <thead></thead>
      <tbody></tbody>
    </table>
  </div>
  <span class="span_above"></span>
  <span class="span_under"></span>
</div>

<?php get_footer();?>
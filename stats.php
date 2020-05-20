<?php /* Template Name: Stats */ get_header();
cleanSession(); ?>
  <h2 id="debut" class="h2">Statistiques</h2>
  <div class="stats">
    <div class="type">
      <label>Type:</label>
      <div> 
        <button class="bar activated" data-id="quiz">Barre</button>
        <button class="radar" data-id="module">Radar</button>
      </div>
    </div>
    <div class="btns">
      <button class="quizBtn" data-id="quiz">Quiz</button>
      <button class="moduleBtn activated" data-id="module">Module</button>
    </div>
    <div class="infoStats">
      <i class="fas fa-info-circle"></i>
      <div class="statsExplained">
        <p>Les statistiques se basent sur le poucentage des utilisateurs ayant terminé le quiz/module.</p>
      </div>
    </div>
    <div class="canvas">
      <canvas class="quizStatsBar hidden"></canvas>
      <canvas class="moduleStatsBar"></canvas>
      <canvas class="quizStatsRadar hidden"></canvas>
      <canvas class="moduleStatsRadar hidden"></canvas>
    </div>
  </div>
<?php get_footer()?>
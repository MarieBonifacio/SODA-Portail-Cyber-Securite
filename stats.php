<?php /* Template Name: Stats */ get_header(); ?>
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
    <!-- <div class="instructions instrT"><span>Avant de visualiser les statistiques</span> de la progression globale des modules et des quizs vous devez <span>choisir entre deux types</span> de graphiques ( en haut à droite de votre écran ): </br> -<span class="types">Radar</span> </br> -<span class="types">Barre</span>
    </div>
    <div class="instructions instrQ">Maintenant vous pouvez choisir entre <span class="types">Quiz</span> et <span class="types">Module</span> pour visualiser les statistiques.</div> -->
    <canvas class="moduleStatsBar"></canvas>
    <canvas class="quizStatsBar hidden"></canvas>
    <canvas class="quizStatsRadar hidden"></canvas>
    <canvas class="moduleStatsRadar hidden"></canvas>
  </div>
<?php get_footer()?>
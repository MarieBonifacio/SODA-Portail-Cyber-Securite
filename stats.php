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
    <canvas class="moduleStatsBar"></canvas>
    <canvas class="quizStatsBar hidden"></canvas>
    <canvas class="quizStatsRadar hidden"></canvas>
    <canvas class="moduleStatsRadar hidden"></canvas>
  </div>
<?php get_footer()?>
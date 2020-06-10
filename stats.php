<?php /* Template Name: Stats */ get_header();

cleanSession(); ?>

  <h2 id="debut" class="h2">Statistiques</h2>

  <div class="stats">

    <div class="btns">
      <div>
        <label>Type :</label>
        <button class="quizBtn activated" data-id="quiz">Quiz</button>
        <button class="moduleBtn" data-id="module">Module</button>
      </div>
      <div>
        <label>Filtre :</label>
        <button class="genBtn activated" data-id="quiz">Général</button>
        <button class="siteBtn" data-id="module">Sites</button>
      </div>
      <div class="listDiv hidden">
        <label>Votre site : <span class="labelSite">Choix de votre site</span></label>
        <ul class="listSite hidden">
        <?php 
          $sites = array('Auxerre', 'Bielsko-Biala', 'Bordeaux', 'Boulogne-Sur-Mer', 'Caen', 'Calais', 'Caldas da Rainha', 'Châteauroux', 'Cracovie', 'Guimarães', 'Île de France', 'Lisbonne', 'Nevers', 'Poitiers', 'Porto', 'Porto Ferreira Dias', 'Stalowa Wola', 'Tauxigny', 'Tunis', 'Varsovie', "Villeneuve d'Ascq");
          for($i=0; $i<count($sites); $i++){
              echo '<li class="li">'.$sites[$i].'</li>';
          }
        ?>
        </ul>
      </div>
    </div>

    <div class="canvaDiv">
      <canvas class="canva"></canvas>
    </div>

  </div>

<?php get_footer()?>
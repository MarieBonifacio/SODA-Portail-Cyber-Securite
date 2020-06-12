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

    <button class="extract">Tableaux utilisateurs</button>

    <p class="mailSend">Envoi de mail de rappel aux utilisateurs</p>

    <div class="confirmMess hidden">
      <p>Vous êtes sur le point d'envoyer un mail de rappel à tous les utilisateurs n'ayant pas terminé leur module ou quiz.</br> Confirmez-vous l'envoi de ces mails ?</p>
      <div class="yesNo">
        <a href="<?php echo get_template_directory_uri(); ?>/app/">Oui</a>
        <p class="no">Non</p>
      </div>
    </div>

    <div class="users userQuiz hidden">
      <i class="fas fa-times quizCross"></i>
      <div class="select">
        <label>Votre quiz: <span class="spanQM spanQ">Choisissez votre quiz</span></label>
        <ul class="listModQuiz listQuiz hidden">
          <?php $quizs = $wpdb->get_results( "SELECT quiz.id AS qId, quiz.name AS qName from quiz");
        foreach($quizs as $q){
          echo '<li class="liQM" data-id="'.$q->qId.'">'.$q->qName.'</li>';
        }
        ?>
        </ul>
      </div>
      <p>Liste des utilisateurs n'ayant pas terminé le quiz "<span class="spanQ imp"></span>"</p>
      <span class="nbrUsers nbrUsersQ">Nombre de personnes n'ayant pas terminé ce quiz :</span>
      <div class="table">
        <table>
          <thead>
            <tr>
              <th>Utilisateur</th>
              <th>Site</th>
            </tr>
          </thead>
          <tbody class="tbodyQ">
  
          </tbody>
        </table>
      </div>
    </div>

    <div class="users userModule hidden">
      <i class="fas fa-times modCross"></i>
      <div class="select">
        <label>Votre module: <span class="spanQM spanM">Choisissez votre module</span></label>
        <ul class="listModQuiz listMod hidden">
          <?php $mods = $wpdb->get_results( "SELECT module.id AS mId, module.title AS mName from module");
        foreach($mods as $m){
          echo '<li class="liQM" data-id="'.$m->mId.'">'.$m->mName.'</li>';
        }
        ?>
        </ul>
      </div>
      <p>Liste des utilisateurs n'ayant pas terminé le module "<span class="spanM imp"></span>"</p>
      <span class="nbrUsers nbrUsersM">Nombre de personnes n'ayant pas terminé ce module :</span>
      <div class="table">
        <table>
          <thead>
            <tr>
              <th>Utilisateur</th>
              <th>Site</th>
            </tr>
          </thead>
          <tbody class="tbodyM">
  
          </tbody>
        </table>
      </div>
    </div>

    <div class="canvaDiv">
      <canvas class="canva"></canvas>
    </div>

  </div>

<?php get_footer()?>
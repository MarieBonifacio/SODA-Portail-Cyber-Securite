<?php /* Template Name: Stats Campagne */ get_header(); ?>

<h2 class="h2"> Statistiques des Campagnes </h2>

<div class="stats_camp">
  <div class="select">
    <label>Votre campagne: <span class="camp_name name_camp">votre choix</span></label>
    <ul class="listCamp hidden">
    <?php $campaigns = $wpdb->get_results( "SELECT campaign.id AS cId, campaign.name AS cName from campaign");
      foreach($campaigns as $c){
        echo '<li class="liC" data-id="'.$c->cId.'">'.$c->cName.'</li>';
      }
    ?>
    </ul>
  </div>
  <p>Tableau des stats pour la campagne <span class="camp_name"></span></p>
  <div class="tableContainer">
    <div>
      <h3><span class="nbrQuiz"></span> Quiz</h3>
      <table class="quizTable">
        <thead>
          <tr>
            <th>Sites</th>
            <th>Taux de participation</th>
            <th>Moyenne</th>
            <th>Temps en moyenne</th>
          </tr>
        </thead>
        <tbody class="bodyQ">
        </tbody>
      </table>
    </div>
    <div>
      <h3><span class="nbrMod"></span> Modules</h3>
      <table class="modTable">
        <thead>
          <tr>
            <th>Sites</th>
            <th>Taux de participation</th>
          </tr>
        </thead>
        <tbody class="bodyM">
    
        </tbody>
      </table>
    </div>
    <div class="totalDiv">
      <h3>Total</h3>
      <table class="totalTable">
        <thead>
          <tr>
            <th>Taux de participation Quiz</th>
            <th>Taux de participation Modules</th>
            <th>Moyenne des quiz</th>
            <th>Temps des quiz</th>
          </tr>
        </thead>
        <tbody class="total">
    
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php get_footer(); ?>
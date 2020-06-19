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
  <div class="selectC">
    <label>comparée à : <span class="compare_name compare_camp">votre choix</span></label>
    <ul class="listCampC hidden">
    <?php $campaigns = $wpdb->get_results( "SELECT campaign.id AS cId, campaign.name AS cName from campaign");
      foreach($campaigns as $c){
        echo '<li class="liComp" data-id="'.$c->cId.'">'.$c->cName.'</li>';
      }
    ?>
    </ul>
  </div>
  <p>Tableau des statisitques de la campagne <span class="camp_name"></span> comparée à <span class="compare_name"></span></p>
  <div class="container">
    <div class="tableContainer">
      <div>
        <h3><span class="nbrQuiz"></span> Quiz</h3>
        <table class="quizTable">
          <thead>
            <tr>
              <th>Sites</th>
              <th>Taux de participation (%)</th>
              <th>Moyenne (pts.)</th>
              <th>Temps en moyenne (sec.)</th>
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
              <th>Taux de participation (%)</th>
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
              <th>Taux de participation Quiz(%)</th>
              <th>Taux de participation Modules(%)</th>
              <th>Moyenne des quiz(pts.)</th>
              <th>Temps des quiz(sec.)</th>
            </tr>
          </thead>
          <tbody class="total">
      
          </tbody>
        </table>
      </div>
    </div>
    <div class="tableContainer">
      <div>
        <h3><span class="nbrQuizCompare"></span> Quiz</h3>
        <table class="quizTable">
          <thead>
            <tr>
              <th>Sites</th>
              <th>Taux de participation (%)</th>
              <th>Moyenne (pts.)</th>
              <th>Temps en moyenne (sec.)</th>
            </tr>
          </thead>
          <tbody class="compareQ">
          </tbody>
        </table>
      </div>
      <div>
        <h3><span class="nbrModCompare"></span> Modules</h3>
        <table class="modTable">
          <thead>
            <tr>
              <th>Sites</th>
              <th>Taux de participation (%)</th>
            </tr>
          </thead>
          <tbody class="compareM">
      
          </tbody>
        </table>
      </div>
      <div class="totalDiv">
        <h3>Total</h3>
        <table class="totalTable">
          <thead>
            <tr>
              <th>Taux de participation Quiz(%)</th>
              <th>Taux de participation Modules(%)</th>
              <th>Moyenne des quiz(pts.)</th>
              <th>Temps des quiz(sec.)</th>
            </tr>
          </thead>
          <tbody class="totalCompare">
      
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
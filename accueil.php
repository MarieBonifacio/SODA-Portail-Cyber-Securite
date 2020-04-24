<?php /* Template Name: Accueil */ get_header(); ?>

<div class="home">
  <div class="dashboard">
    <div class="window actu">
      <h3>Fil d'actualité</h3>
      <?php echo do_shortcode( '[activity-stream allow_posting=true]' ); ?>
    </div>
    <div class="window quiz lastQ">
      <h3>Dernier quiz</h3>
    </div>
    <div class="window results">
      <h3>Vos résultats</h3>
      <canvas id="myChart"></canvas>
    </div>
    <div class="window news">
      <h3>Dernières news</h3>
        <?php echo do_shortcode( '[display-posts image_size="medium" wrapper="div" wrapper_class="display-posts-listing grid"  posts_per_page="3"]' ); ?>
    </div>
    <div class="window leaderboard">
      <h3>Classement</h3>
      <div class="btns">
        <button class="gen">Général</button>
        <button class="town">Votre ville</button>
      </div>
      <div class="leadboard">
        <table>
          <thead>
              <tr>
                  <th colspan="1">Pos</th>
                  <th colspan="1">Joueur</th>
                  <th colspan="1">Ville</th>
                  <th colspan="1">Score</th>
              </tr>
          </thead>
          <tbody class="tbody">
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php  get_footer(); ?>
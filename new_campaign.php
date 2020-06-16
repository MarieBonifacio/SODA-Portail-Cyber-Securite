<?php /* Template Name: Nouvelle Campagne */ get_header(); ?>

<h2 class="h2"> Nouvelle Campagne </h2>

<div class="new_camp">
  <?php
    if(!empty($_SESSION["campaignSuccess"])){
      echo "<p class='mess error'>".$_SESSION["campaignSuccess"]."</p>";
      unset($_SESSION["campaignSuccess"]);
    }
    elseif(!empty($_SESSION["campaignError"])){
      echo "<p class='mess good'>".$_SESSION["campaignError"]."</p>";
      unset($_SESSION["campaignError"]);
    }
  ?>
  <form action="<?php echo get_template_directory_uri(); ?>/app/create_campaign.php">
    <h3>Créez votre campagne</h3>
    <div>
      <label>Nom de la campagne:</label>
      <input type="text" name="name_camp">
    </div>
    <div>
      <label> Début de la campagne:</label>
      <input type="date" name="start_camp">
    </div> 
    <div>
      <label>Fin de la campagne:</label>
      <input type="date" name="end_camp">
    </div>
    <input type="submit" value="Valider">
  </form>
  <div class="listCamp">
    <h3>Liste des Campagnes</h3>
    <ul class="camps">
    <?php $quizs = $wpdb->get_results( "SELECT quiz.id AS qId, quiz.name AS qName from quiz");
        foreach($quizs as $q){
          echo '<li class="liQM" data-id="'.$q->qId.'">'.$q->qName.'<div><button>Modifier</button><button>Supprimer</button></div></li>';
        }
        ?>
    </ul>
  </div>
</div>

<?php get_footer(); ?>
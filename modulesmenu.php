<?php /* Template Name: Modules */ get_header(); ?>

<h2 class="h2">Nos modules</h2>
<div class="quizModules">
  <div class="button-group filters-button-group">
    <button class="button" data-filter="*">tout</button>
    <?php 
     //ajout boucle tags db
      $tags = $wpdb->get_results( "SELECT name FROM tag");

      foreach($tags as $t){
        echo '<button class="button" data-filter=".'.$t->name.'">'.$t->name.'</button>';
      }
    ?>
  </div>
  
  <div class="grid">
  </div>
</div>

<?php  get_footer(); ?>
<?php /* Template Name: Menu Quiz */ get_header(); ?>

<h2 id="debut" class="h2">Nos quiz</h2>
<div class="quizModules">

  <a class="ancreTop" href="#debut">
    <i class="fas fa-sort-up"></i>
  </a>
  <a class="ancreDown" href="#end">
    <i class="fas fa-sort-down"></i>
  </a>

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
    <div id="end"></div>
  </div>
</div>

<?php get_footer()?>
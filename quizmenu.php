<?php /* Template Name: Menu Quiz */ get_header(); ?>

  <h2>Nos quiz</h2>
<div class="quiz">
  <div class="button-group filters-button-group">
    <button class="button is-checked" data-filter="*">show all</button>
    <?php 
     //ajout boucle tags db
      $tags = $wpdb->get_results( "SELECT name FROM tag");

      foreach($tags as $t){
          echo '<button class="button is-checked" data-filter=".'.$t->name.'">'.$t->name.'</button>';
      }
    ?>
  </div>

  <div class="grid">
    <?php
      
      // for($i=0; $i<count($btns); $i++){
      //   echo '<div class="element-item '.$btns[$i].'" data-category="'.$btns[$i].'"></div>';
      // }
    ?>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script>
<script>

// external js: isotope.pkgd.js

// init Isotope
var $grid = $('.grid').isotope({
  itemSelector: '.element-item',
  layoutMode: 'fitRows',
});
// filter functions
// bind filter button click
$('.filters-button-group').on( 'click', 'button', function() {
  var filterValue = $( this ).attr('data-filter');
  // use filterFn if matches value
  $grid.isotope({ filter: filterValue });
});
// change is-checked class on buttons
$('.button-group').each( function( i, buttonGroup ) {
  var $buttonGroup = $( buttonGroup );
  $buttonGroup.on( 'click', 'button', function() {
    $buttonGroup.find('.is-checked').removeClass('is-checked');
    $( this ).addClass('is-checked');
  });
});

</script>

<?php get_footer()?>
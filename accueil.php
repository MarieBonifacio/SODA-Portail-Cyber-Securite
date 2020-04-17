<?php /* Template Name: Accueil */ get_header(); ?>

<div class="home">
  <div class="dashboard">
    <div class="window actu">
      <h3>Fil d'actualité</h3>
    </div>
    <div class="window results">
      <h3>Vos résultats</h3>
    </div>
    <div class="window news">
      <h3>Dernières news</h3>
    </div>
    <div class="window leaderboard">
      <h3>Classement</h3>
    </div>
  </div>
  <!-- <div class="grid">
    <div class="grid-sizer"></div>
    <div class="grid-item grid-item--width2 grid-item--height2"></div>
    <div class="grid-item grid-item--width2"></div>
    <div class="grid-item"></div>
    <div class="grid-item"></div>
  </div> -->
</div>

<!-- <script>
  var $grid = $('.grid').packery({
  itemSelector: '.grid-item',
  columnWidth: '.grid-sizer',
  gutter: 22.5,
  percentPosition: true
});
// make all grid-items draggable
$grid.find('.grid-item').each( function( i, gridItem ) {
  var draggie = new Draggabilly( gridItem );
  // bind drag events to Packery
  $grid.packery( 'bindDraggabillyEvents', draggie );
});


</script> -->

<?php  get_footer(); ?>
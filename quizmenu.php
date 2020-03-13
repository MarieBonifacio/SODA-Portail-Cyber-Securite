<?php /* Template Name: Menu Quiz */ get_header(); ?>

<h2>Nos quiz</h2>
<div class="quiz">
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


<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script>

<script>
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

let btnQuizs = document.querySelectorAll(".btnQuiz");
btnQuizs.forEach(btn => {
  btn.addEventListener("click", (e)=>{
    const id = e.target.dataset.id;
    // var url = myScript.theme_directory;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if(this.readyState == 4 && this.status == 200)
      {
        var myQuizz = JSON.parse(this.responseText);
      }
      else
      {
        
        console.log(id);
      }
    };

    // url a trouver
    xmlhttp.open("GET", url + '/play_quiz.php?id=' + id, true);
    xmlhttp.send();
  })
});


</script>
<?php get_footer()?>
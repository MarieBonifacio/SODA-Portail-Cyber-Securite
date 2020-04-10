<?php /* Template Name: Create Module Etape 3 */ get_header();?>
<h2 class="h2"><?php echo $_SESSION['moduleData']['module']['title']; ?></h2>
<?php 
// echo '<pre>';print_r($_SESSION);echo '</pre>';?>
<div class="step3">

  <img class="img" src="<?php echo get_template_directory_uri(); ?>/img/modules/<?php echo $_SESSION['moduleData']['module']['title'].'/'.$_SESSION['moduleData']['module']['img']?>" alt="votre image">

  <h3>Étape 3: Confirmation</h3>

  <div class="steps">
      <div class="step">1</div>
      <div class="step">2</div>
      <div class="step stepInto">3</div>
      <div class="stick"></div>
  </div>


  <div class="recap">
      <?php 
      $img = get_template_directory_uri();
      $num = 0;
      foreach($_SESSION['moduleData']['pages'] as $q)
      {
        $num ++;
        echo '
          <div class="pages">
          ';
          if($q['info']['img'])
          {
            echo ' 
            <div class="medias">
              <img src="'.$img.'/img/modules/'.$_SESSION['moduleData']['module']['title'].'/questions/tonimage" alt="votre image">
            </div>
            <span class="numP">'.$num.'</span>
            <div class="content">
              <h2>'.$q['info']['title'].'</h2>
              <p>'.$q['info']['content'].'</p>
            </div>
            ';
          }
          else
          {
            echo '
                <span class="numP">'.$num.'</span>
                <div class="contentFull content">
                  <h2>'.$q['info']['title'].'</h2>
                  <p>'.$q['info']['content'].'</p>
                </div>
              ';
          }
          echo '</div>';
      };
      ?>
  </div>

  <a href="<?php echo get_template_directory_uri(); ?>/app/create_module_3.php">Confirmez la création de votre module</a>

</div>

<?php get_footer();?>
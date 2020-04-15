<?php /* Template Name: Create Module Etape 2 */ get_header();?>
<h2 class="h2"><?php echo $_SESSION['moduleData']['module']['title']; ?></h2>

<div class="step2">

  <img src="<?php echo get_template_directory_uri(); ?>/img/modules/<?php echo $_SESSION['moduleData']['module']['title']; ?>/<?php echo $_SESSION['moduleData']['module']['img']; ?>" alt="votre image">

  <h3>Étape 2: Les pages</h3>

  <div class="steps">
      <div class="step">1</div>
      <div class="step stepInto">2</div>
      <div class="step">3</div>
      <div class="stick"></div>
  </div>

  <?php
    $nbrPage = 1;
    if(!empty($_SESSION["errorModule"])){
      echo "<p class='mess error'>".$_SESSION["errorModule"]."</p>";
      unset($_SESSION["errorModule"]); 
      /* SI ON REVIENT DU SCRIPT VALIDATION POUR CAUSE MESSAGE D'ERREUR */
      $p = $_SESSION['formModuleStep2'];
      unset($_SESSION["formModuleStep2"]); 
      $nbrPage = $p['nbrPage'];
    }
    if(!empty($_SESSION['formModuleStep2'])){
      $nbrPage = $_SESSION['formModuleStep2']['nbrPage'];
      $p = $_SESSION['formModuleStep2'];
      unset($_SESSION["formModuleStep2"]); 
    }
    ?>

  <form action="<?php echo get_template_directory_uri(); ?>/app/create_module_2.php" method="post" enctype="multipart/form-data">
  <input type="text" name="nbrPage" value="<?php echo $nbrPage; ?>" hidden>
    <?php
      for($i=1; $i<=$nbrPage; $i++){
        echo '
        <div class="questionPage">
          <div>
            <label>Titre de la page :</label>
            <input type="text" name="content_'.$i.'_title" value="">
          </div>
          <div>
            <label>Contenu de la page :</label>
            <textarea name="content_'.$i.'" value=""></textarea>
          </div>
          <div class="media">
            <div>
              <label>Image :</label>
              <button type="button" disabled><p id="fakebtn" data-id="'.$i.'">Séléctionnez une image</p></button>
              <span id="img_select'.$i.'">Aucune image sélectionnée.</span>
              <input id="realbtn'.$i.'" type="file" name="content_'.$i.'_img" hidden>
            </div>
          </div>
          <i class="trash'.$id.' trash fas fa-trash" data-id="'.$id.'"></i>
        </div>
        ';
      }
      ?> 
      <input type="submit" value="Valider" hidden/>
  </form>
  <i class="plus fas fa-plus"></i>
  <p class="validate">Suivant</p>
</div>

<script src="<?php echo get_template_directory_uri(); ?>/js/module_step2.js">

<?php get_footer()?>
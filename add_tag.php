
<?php /* Template Name: Add Tag*/ 
$_SESSION['needAdmin'] = true;
get_header();
?>

<div>
    <h1>Tags Existants</h1>
        <?php 
            //ajout boucle tags db
            $tags = $wpdb->get_results( "SELECT name FROM tag");

            foreach($tags as $t){
                echo '<p>'.$t->name.'</p>';
            }
        ?>
</div>
<form action="<?php echo get_template_directory_uri(); ?>/app/add_tag.php" method="post" enctype="multipart/form-data">
    <div>
        <label for="">Ajoutez un tag :</label>
        <input type = "text" name="tag"></input>
        <input type="submit" value="Ajouter">
    </div>
</form>

<?php  get_footer(); ?>
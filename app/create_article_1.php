<?php
define('WP_USE_THEMES', false);
require('class/article.class.php');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

if(!empty($_POST['title']) && !empty($_POST['content']))
{
    //s'il y a une image
    if(!isset($_FILES['img_article']) || $_FILES['img_article']['error'] == UPLOAD_ERR_NO_FILE) 
    {
        $error_quiz = "Veuillez selectionner une image en format jpg ou png.";
        wp_redirect( home_url().'/creationarticle' );

    }else{
        //download d'image
        $dir = $_POST['title'];
        mkdir("../img/articles/".$dir, 0700, true);
        $content_dir =  get_template_directory()."../img/articles/".$dir."/";
        $tmp_file = $_FILES['img_article']['tmp_name'];

        if(!is_uploaded_file($tmp_file))
        {
            $error_quiz="Le fichier est introuvable";
            wp_redirect( home_url().'/creationarticle' );
        }
        $type_file = $_FILES['img_article']['type'];

        if( !strpos($type_file, 'jpg') && !strpos($type_file, 'jpeg') && !strpos($type_file, 'png')) 
        {
            $error_quiz = "Le format du fichier n'est pas pris en charge";
            wp_redirect( home_url().'/creationarticle' );
        }
        // on copie le fichier dans le dossier de destination
        $name_file = $_POST['title'].'.'.preg_replace("#image\/#","",$type_file);
        $img = $name_file;

        if( !move_uploaded_file($tmp_file, $content_dir . $name_file) )
        { 
            $errorQuiz = "Impossible de copier le fichier $name_file dans $content_dir";
            wp_redirect( home_url().'/creationarticle' );
        }
    }

     //enregistrement des POST en SESSION pour passer à la seconde étape sans enregistrer en base de données en cas d'abandon
     $title = htmlspecialchars($_POST['title']);
     $theme = $_POST['theme'];
 
     $article = array (
                 'title'=> $title,
                 'theme'=> $theme,
                 'img'=> $img
     );
 
     $_SESSION['article'] = $quiz;

}else{
    $error_quiz = "Veuillez remplir tous les champs.";
}

?>
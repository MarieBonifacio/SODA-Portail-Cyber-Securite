<?php
define('WP_USE_THEMES', false);
require('class/user.class.php');
require('class/module.class.php');
require('class/module_slide.class.php');
require('class/tag.class.php');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

if(!empty($_POST['title']) && !empty($_POST['theme']))
{
    if(!isset($_FILES['img_module']) || $_FILES['img_module']['error'] == UPLOAD_ERR_NO_FILE) 
    {
        $error_module = "Veuillez selectionner une image en format jpg ou png.";
        wp_redirect( home_url().'/creationmoduleetape1' );

    }else{
        $dir = $_POST['title'];
        mkdir("../img/modules/".$dir, 0700, true);
        $content_dir =  get_template_directory()."../img/modules/".$dir."/";
        $tmp_file = $_FILES['img_module']['tmp_name'];

        if(!is_uploaded_file($tmp_file))
        {
            $error_module="Le fichier est introuvable";
            wp_redirect( home_url().'/creationmoduleetape1' );
        }

        $type_file = $_FILES['img_module']['type'];

        if( !strpos($type_file, 'jpg') && !strpos($type_file, 'jpeg') && !strpos($type_file, 'png')) 
        {
            $error_module = "Le format du fichier n'est pas pris en charge";
            wp_redirect( home_url().'/creationmoduleetape1' );
        }
            // on copie le fichier dans le dossier de destination
        $name_file = $_POST['title'].'.'.preg_replace("#image\/#","",$type_file);
        $img = $name_file;

        if( !move_uploaded_file($tmp_file, $content_dir . $name_file) )
        { 
            $error_module = "Impossible de copier le fichier $name_file dans $content_dir";
            wp_redirect( home_url().'/creationmoduleetape1' );
        }

    }
     //enregistrement des POST en SESSION pour passer à la seconde étape sans enregistrer en base de données en cas d'abandon
     $title = htmlspecialchars($_POST['title']);
     $theme = $_POST['theme'];
 
     $module = array (
                 'title'=> $title,
                 'theme'=> $theme,
                 'img'=> $img
     );
 
     $_SESSION['moduleData']['module'] = $module;
     
}else{
    $error_module = "Veuillez remplir tous les champs.";
}

$_SESSION["errorModule"] = $error_module;
$_SESSION["moduleOk"] = $module_ok;
wp_redirect( home_url().'/creationmoduleetape2' );

?>
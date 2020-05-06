<?php
define('WP_USE_THEMES', false);
require('class/module.class.php');
require('class/module_slide.class.php');
require('class/tag.class.php');


$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

$nbrPage = $_POST['nbrPage'];
$_SESSION['errorModule'] = "";
$_SESSION['formModuleStep2'] = $_POST;

if(!empty($_SESSION['moduleData'])){
    $_SESSION['moduleData']['module']['pages'] = null;
}

if($nbrPage >= 1){
    for( $i = 1; $i <= $nbrPage; $i++) 
    {
        $page = array();
        if(!empty($_POST['content_'.$i]) && !empty($_POST['content_'.$i.'_title']))
        {
            $page['info']['content'] =  $_POST['content_'.$i];
            $page['info']['title'] = $_POST['content_'.$i.'_title'];
            $page['info']['order'] =  $i;

            //videos
            $page['info']['video'] = "";

            if(!empty($_POST['content_'.$i.'_video']))
            {
                $url = $_POST['content_'.$i.'_video'];
                $page['info']['video'] = $url;
            }
///////////////////////////////////////////////////
            //images
            if($_FILES['content_'.$i.'_img']['error'] != UPLOAD_ERR_NO_FILE && !empty($_FILES['content_'.$i.'_img']))
            {
                $dir = $_SESSION['moduleData']['module']['title'];
                $path = "../img/modules/".$dir."/pages";
                if(!is_dir($path))
                {
                    mkdir($path, 0775, true);
                }
                $content_dir =  get_template_directory()."/img/modules/".$dir."/pages/";
                $tmp_file = $_FILES['content_'.$i.'_img']['tmp_name'];

                if(!is_uploaded_file($tmp_file))
                {
                    $error_module="Un des fichiers est introuvable";
                    wp_redirect( home_url().'/creationmoduleetape2' );
                }

                $type_file = $_FILES['content_'.$i.'_img']['type'];

                if( !strpos($type_file, 'jpg') && !strpos($type_file, 'jpeg') && !strpos($type_file, 'png'))
                {
                    $error_module = "Le format d'un des fichiers n'est pas pris en charge.";
                    wp_redirect( home_url().'/creationmoduleetape2' );
                }

                $name_file = md5($tmp_file).'.'.preg_replace("#image\/#","",$type_file);

                if( !move_uploaded_file($tmp_file, $content_dir . $name_file) )
                {
                    $error_module = "Impossible de copier le fichier $name_file dans $content_dir";
                    wp_redirect( home_url().'/creationmoduleetape2' );
                }

                $img = $name_file;
                $page['info']['img'] = $img;
            }

            $_SESSION['moduleData']['pages'][$i] = $page;
            
        }else{
            $_SESSION['errorModule'] = "Veuillez remplir tous les champs.";
        }
    }
}

if($_SESSION['errorModule'] == "")
{
    wp_redirect( home_url().'/creationmoduleetape3' );
}else{
    wp_redirect( home_url().'/creationmoduleetape2' );
}

?>
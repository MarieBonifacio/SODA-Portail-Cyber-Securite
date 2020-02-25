<?php
global $wpdb;
define('WP_USE_THEMES', false);
require('class/user.class.php');
$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

$error = "Veuillez remplir tous les champs";

if(!empty($_POST['avatar'] && !empty($_POST['first_mail']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['id_user']) && !empty($_POST['location'])){
    global $wpdb;

    $img = $_POST['img'];
    $mail = $_POST['first_mail'];
    $name = htmlspecialchars($_POST['first_name']);
    $lastName = htmlspecialchars($_POST['last_name']);
    $idUser = $_POST['id_user'];
    $location = $_POST['location'];

    $id = $_SESSION['userConnected'];
    $r = $wpdb->get_results("SELECT * FROM user where id='".$id."'");

    //si l'image n'existe pas en bdd
    if($r->getImgPath()==null){
        $directoryName = $r->getid();
        //créer dossier
        mkdir(public_path(home_url().'img/avatar/').$directoryName, 0775);
    } 
    }elseif( !preg_match ( " /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ ", $mail)){
        $error = "L'adresse mail n'est pas valide.";
    }elseif( !preg_match("#^[0-9]{1,6}$# ", $idUser)){
        $error = "Votre identifiant n'est pas correct";
    }elseif($r==null){


        $newUser = new User();
        $newUser->setImgPath($img);
        $newUser->setName($name);
        $newUser->setLastName($lastName);
        $newUser->setIdUser($idUser);
        $newUser->setMail($mail);
        $newUser->setLocation($location);
        $newUser->update();
        

        $error = "Modifications validées.";

    }
}

$_SESSION["errorRegister"] = $error;
wp_redirect( home_url()."/profile.php" ); 

?>
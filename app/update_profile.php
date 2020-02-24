<?php
global $wpdb;
define('WP_USE_THEMES', false);
require('class/user.class.php');
$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

// $id = $_SESSION['userConnected']->getId();

// $r = $wpdb->get_results("SELECT * FROM user where id='".$id."'");

// if($r != null){
//     $_SESSION['userConnected']->print();
// }


$error = "Veuillez remplir tous les champs";

if(!empty($_POST['first_mail']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['first_password']) && !empty($_POST['check_password']) && !empty($_POST['id_user']) && !empty($_POST['location'])){
    global $wpdb;

    $mail = $_POST['first_mail'];
    $name = htmlspecialchars($_POST['first_name']);
    $lastName = htmlspecialchars($_POST['last_name']);
    $password = $_POST['first_password'];
    $passwordChecked = $_POST['check_password'];
    $idUser = $_POST['id_user'];
    $location = $_POST['location'];

    $id = $_SESSION['userConnected']->getId();
    $r = $wpdb->get_results("SELECT * FROM user where id='".$id."'");

    if ( !preg_match ( " /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ ", $mail)){
        $error = "L'adresse mail n'est pas valide.";
    }elseif(!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{10,}$#', $password)){
        $error = "Votre mot de passe doit contenir au moins une majuscule, un chiffre et un caractère spécial.";
    }elseif($password != $passwordChecked){
        $error = "votre mot de passe et sa vérification sont différents.";
    }elseif( !preg_match("#^[0-9]{1,6}$# ", $idUser)){
        $error = "Votre identifiant n'est pas correct";
    }elseif($r==null){
        $newUser = new User();
        $newUser->setName($name);
        $newUser->setLastName($lastName);
        $newUser->setIdUser($idUser);
        $newUser->setMail($mail);
        $newUser->setPassword($password);
        $newUser->setLocation($location);
        $newUser->update();
        
        $error = "Modifications validées.";
    }
}

$_SESSION["errorRegister"] = $error;
wp_redirect( $home_url()."/profile.php" ); 

?>
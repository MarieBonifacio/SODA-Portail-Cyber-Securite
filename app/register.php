<?php
define('WP_USE_THEMES', false);
global $wpdb;
require('class/user.class.php');
$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

if(!empty($_POST['first_mail']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['first_password']) && !empty($_POST['check_password']) && !empty($_POST['id_user']) && !empty($_POST['location'])){
    global $wpdb;

    $_SESSION["error"]=$error;

    $mail = $_POST['first_mail'];
    $name = htmlspecialchars($_POST['first_name']);
    $lastName = htmlspecialchars($_POST['last_name']);
    $password = $_POST['first_password'];
    $passwordChecked = $_POST['check_password'];
    $idUser = $_POST['id_user'];
    $location = $_POST['location'];

    $r = $wpdb->get_results("SELECT * FROM user where mail='".$mail."'"); 

    if ( !preg_match ( " /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ ", $mail)){
        wp_redirect('http://localhost/wordpress/');
        $error = "L'adresse mail n'est pas valide.";
    }elseif(!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{10,}$#', $password)){
        wp_redirect('http://localhost/wordpress/');
        $error = "Votre mot de passe doit contenir au moins une majuscule, un chiffre et un caractère spécial.";
    }elseif($password != $passwordChecked){
        wp_redirect('http://localhost/wordpress/');
        $error = "votre mot de passe et sa vérification sont différents.";
    }elseif( !preg_match("#^[0-9]{1,6}$# ", $idUser)){
        wp_redirect('http://localhost/wordpress/');
        $error = "Votre identifiant n'est pas correct";
    }elseif($r==null){
        $newUser = new User();
        $newUser->setName($name);
        $newUser->setLastName($lastName);
        $newUser->setIdUser($idUser);
        $newUser->setMail($mail);
        $newUser->setPassword($password);
        $newUser->setLocation($location);
        $newUser->save();
        
        
    }else{
        wp_redirect('http://localhost/wordpress/');
        $error = "Utilisateur déjà existant";
    }

}else{
    wp_redirect('http://localhost/wordpress/');
    $error = "Veuillez remplir tous les champs";
}

?>
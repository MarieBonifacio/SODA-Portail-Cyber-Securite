<?php
define('WP_USE_THEMES', false);
global $wpdb;
require('class/user.class.php');
require('../../../../wp-load.php');

if(!empty($_POST['first_mail']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['first_password']) && !empty($_POST['location'])){
    global $wpdb;

    $mail = $_POST['first_mail'];
    $name = htmlspecialchars($_POST['first_name']);
    $lastName = htmlspecialchars($_POST['last_name']);
    $password = $_POST['first_password'];
    $location = $_POST['location'];

    $r = $wpdb->get_row("SELECT * FROM 'user' where mail='$mail'");

    if ( !preg_match ( " /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ ", $mail)){
        echo("L'adresse mail n'est pas valide.");
    }elseif(!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{10,}$#', $password)){
        echo("Votre mot de passe doit contenir au moins une majuscule, un chiffre et un caractère spécial.");
    }elseif($r==null){
        $newUser = new User();
        $newUser->setName($name);
        $newUser->setLastName($lastName);
        $newUser->setMail($mail);
        $newUser->setPassword($password);
        $newUser->setLocation($location);
        $newUser->save();
        echo 'test';
    }else{
        echo("Utilisateur déjà existant");
    }

}else{
    echo("Veuillez remplir tous les champs");
}

?>
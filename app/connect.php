<?php
session_start();
global $wpdb;
define('WP_USE_THEMES', false);
require('class/user.class.php');
require('../../../../wp-load.php');

$mail = $_POST['mail'];
$password = $_POST['mdp'];




if(!empty($_POST['mail']) && !empty($_POST['mdp'])){

    global $wpdb;
    $r = $wpdb->get_row("SELECT * FROM user where mail='$mail' and password='$password'");
    if($r == 0){
        echo "L'adresse mail ou le mot de passe ne sont pas corrects";
    }else{
        $_SESSION['mail'] = $mail; 
        echo "vous êtes co !";
    }
}else{
    echo "veuillez remplir tous les champs";
}

?>
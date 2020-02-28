<?php
define('WP_USE_THEMES', false);
require('class/user.class.php');
$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

if(!empty($_POST['mail']) && !empty($_POST['mdp'])){
    global $wpdb;
    $mail = $_POST['mail'];
    $password = $_POST['mdp'];

    $r = $wpdb->get_row("SELECT * FROM user where mail='".$mail."'");
   
    if($r == null || !password_verify($password, $r->password)){
        $_SESSION['errorConnect'] = "L'adresse mail ou le mot de passe ne sont pas corrects";
        wp_redirect( home_url() );
    }else{
        $_SESSION['userConnected'] = $r->id;

        setcookie('user', json_encode([
            "userConnected" => $r->id,
        ]), time() + 3600 * 24 * 30);

        wp_redirect( home_url().'/profil' );
    }
}else{
    $_SESSION['errorConnect'] = "veuillez remplir tous les champs";
    wp_redirect( home_url() );
}

?>
<?php
define('WP_USE_THEMES', false);
require('class/user.class.php');
$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

if(!empty($_POST['mail']) && !empty($_POST['mdp'])){
    global $wpdb;
    $mail = $_POST['mail'];
    $password = $_POST['mdp'];

    $r = $wpdb->get_row("SELECT * FROM wp_users where user_email='".$mail."'");
   
    if($r == null || !wp_check_password($password, $r->user_pass)){
        $_SESSION['errorConnect'] = "L'adresse mail ou le mot de passe ne sont pas corrects";
        wp_redirect( home_url() );
    }else{
        $_SESSION['userConnected'] = $r->ID;
        $creds = array(
            'user_login'    => $r->user_login,
            'user_password' => $password,
            'remember'      => true
        );
     
        $user = wp_signon( $creds, false );
        echo "<h1>";
        print_r($user);
        echo "</h1>";
        setcookie('user', json_encode([
            "userConnected" => $r->ID,
        ]), time() + 3600 * 24 * 30);

        wp_redirect( home_url().'/profil' );
    }
}else{
    $_SESSION['errorConnect'] = "veuillez remplir tous les champs";
    wp_redirect( home_url() );
}

?>
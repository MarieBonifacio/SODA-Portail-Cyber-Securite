<?php
session_start();
global $wpdb;
define('WP_USE_THEMES', false);
require('class/user.class.php');
require('../../../../wp-load.php');

if(!empty($_POST['mail']) && !empty($_POST['mdp'])){
    global $wpdb;
    $mail = $_POST['mail'];
    $password = $_POST['mdp'];

    $r = $wpdb->get_results("SELECT * FROM user where mail='".$mail."'");
    print_r($r);
    echo '---'.($r ==null).'--'.(password_verify($password, $r['password'])).'---';
    if($r == null || !password_verify($password, $r[0]->password)){
        echo "L'adresse mail ou le mot de passe ne sont pas corrects";
    }else{
        $_SESSION['mail'] = $mail; 
       
        echo "vous êtes co !";
    }
}else{
    echo "veuillez remplir tous les champs";
}

?>
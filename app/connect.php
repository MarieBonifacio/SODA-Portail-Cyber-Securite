<?php
global $wpdb;
define('WP_USE_THEMES', false);
require('class/user.class.php');
$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

if(!empty($_POST['mail']) && !empty($_POST['mdp'])){
    global $wpdb;
    $mail = $_POST['mail'];
    $password = $_POST['mdp'];

    $r = $wpdb->get_results("SELECT * FROM user where mail='".$mail."'");
   
    echo '---'.($r ==null).'--'.(password_verify($password, $r['password'])).'---';
    if($r == null || !password_verify($password, $r[0]->password)){
        echo "L'adresse mail ou le mot de passe ne sont pas corrects";
    }else{
        $_SESSION['userConnected'] = $r[0]->id;
        print_r($_SESSION);

        setcookie('user', json_encode([
            'mail' => $mail,
            'password' => $password
        ]), time() + 3600 * 24 * 30);

        echo "vous êtes co !";
        wp_redirect('http://localhost/wordpress/?page_id=7');
        exit;
    }
}else{
    echo "veuillez remplir tous les champs";
}

?>
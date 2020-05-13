<?php
define('WP_USE_THEMES', false);
require('app/class/tag.class.php');


$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

if(!checkAuthorized(true)){
    wp_redirect( home_url() );  exit;
}

//ajout tag 
 if(!empty($_POST['tag'])){
     global $wpdb;
     $tag = $_POST['tag'];
     $data = array("name" => $tag);
    $wpdb->insert('tag, $data');
 }else{
    $error_tag = "Veuillez ajouter un tag.";
 }

?>
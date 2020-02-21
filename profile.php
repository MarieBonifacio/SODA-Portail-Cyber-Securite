<?php /* Template Name: Profil */ get_header(); 
require('app/class/user.class.php');
global $wpdb;
$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');


if(!empty($_SESSION['userConnected'])){
    $id = $_SESSION['userConnected'];
    
    $userConnected = new User();
    $userConnected->selectById($id);
    
    echo $userConnected->print();
  }


?>
<?php
global $wpdb;
define('WP_USE_THEMES', false);
require('class/user.class.php');
$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

$id = $_SESSION['userConnected']->getId();

$r = $wpdb->get_results("SELECT * FROM user where id='".$id."'");

if($r != null){
    $_SESSION['userConnected']->print();
}

?>
<?php
define('WP_USE_THEMES', false);
require('class/user.class.php');
$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

if(!empty($_SESSION['userConnected'])){
    session_destroy();
    wp_redirect( home_url() );
}


?>
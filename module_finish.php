<?php

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

$module = new Module();
$module->selectById($_GET['id']);

$wpdb->delete( 'module_progress' ,
    array(
        'user_id' => $_SESSION['userConnected'],
        'module_id' => $module->getId(),
    )
);


?>
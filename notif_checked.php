<?php
$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

//maj user meta 
$lastCheck = get_user_meta( $user, $key = 'notification', true );

?>
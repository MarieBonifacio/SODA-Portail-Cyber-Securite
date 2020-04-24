<?php
$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

//maj user meta 
update_user_meta( $user, $key = 'notification', date("Y-m-d H:i:s") );


?>
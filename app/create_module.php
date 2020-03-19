<?php
define('WP_USE_THEMES', false);
require('class/user.class.php');
require('class/module.class.php');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');


?>
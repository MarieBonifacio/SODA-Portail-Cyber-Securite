<?php 
header('content-type:application/json');

require('app/class/tag.class.php');
require('app/class/module.class.php');
require('app/class/module_slide.class.php');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');


$id = $_POST["idModule"];

$table = "module";


$wpdb::delete($table, array('id' => $id));

//delete slides 
$wpdb::delete('module_slide', array('module_id' => $id));

//delete module progress
$wpdb::delete('module_progress', array('module_id' => $id));

//delete module finish
$wpdb::delete('module_finish', array('module_id' => $id));



?>
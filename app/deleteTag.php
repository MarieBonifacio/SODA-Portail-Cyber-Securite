<?php 
header('content-type:application/json');

require('app/class/tag.class.php');


$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

if(!checkAuthorized(true)){
    wp_redirect( home_url() );  exit;
}


$id = $_GET["idTag"];
$table = "tag";

$queryMod = $wpdb->get_results("SELECT id FROM module where tag_id = ".$id." ");

$queryQ =  $wpdb->get_results("SELECT id FROM quiz where tag_id = ".$id." ");


if(){
    $wpdb->delete($table, array('id' => $id));
}






?>

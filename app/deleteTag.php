<?php 

header('content-type:application/json');

require('app/class/tag.class.php');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);

include($path.'wp-load.php');

if(!checkAuthorized(true)){

    wp_redirect( home_url() );  exit;

}

$id = $_GET["id"];

$table = "tag";

// $query = $wpdb->get_var("SELECT count(quiz.id) as nbUse FROM `tag`LEFT JOIN quiz ON quiz.tag_id = tag.id LEFT JOIN module ON module.tag_id = tag.id  WHERE tag.id =".$id." GROUP BY tag.name");

$queryMod = $wpdb->get_var("SELECT count(id) FROM module where tag_id = ".$id." ");

$queryQ =  $wpdb->get_var("SELECT count(id) FROM quiz where tag_id = ".$id." ");

if($queryMod == 0 && $queryQ == 0){

    $wpdb->delete($table, array('id' => $id));

}

wp_redirect( home_url()."/ajouter-tag" ); 

?>


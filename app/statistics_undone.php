<?php

define('WP_USE_THEMES', false);



$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

if(!checkAuthorized(true)){
    wp_redirect( home_url() );  exit;
}


function moduleStat($moduleId){
    global $wpdb;
    // $users = $wpdb->get_results( "SELECT wp_users.ID AS ID, wp_users.display_name AS Utilisateur, wp_usermeta.meta_value AS Site FROM wp_users LEFT JOIN wp_usermeta ON wp_usermeta.user_id = wp_users.ID AND wp_usermeta.meta_key = 'location' ");
    // $users_fnsh = $wpdb->get_results("SELECT wp_users.ID as ID, wp_users.display_name AS Utilisateur FROM wp_users LEFT JOIN module_finish ON wp_users.ID = module_finish.user_id WHERE '.$moduleId.'= module_finish.module_id ");
   
    return  $wpdb->get_results( "SELECT wp_users.ID AS ID, wp_users.display_name AS Utilisateur, wp_usermeta.meta_value AS Site FROM wp_users LEFT JOIN wp_usermeta ON wp_usermeta.user_id = wp_users.ID AND wp_usermeta.meta_key = 'location' WHERE wp_users.ID NOT IN (SELECT user_id FROM module_finish WHERE module_id ='".$moduleId."')");


    // $users_undone = array_filter($users, function($user){
    //     if( !in_array($user->ID, $users_fnsh) ){
    //         return $user;
    //     }else{
    //         return "";
    //     }
    // }); 
}

function quizStat($quizId){
    global $wpdb;

    return  $wpdb->get_results( "SELECT wp_users.ID AS ID, wp_users.display_name AS Utilisateur, wp_usermeta.meta_value AS Site FROM wp_users LEFT JOIN wp_usermeta ON wp_usermeta.user_id = wp_users.ID AND wp_usermeta.meta_key = 'location' WHERE wp_users.ID NOT IN (SELECT user_id FROM quiz_score WHERE '".$quizId."' = quiz_id)");
}

$str_json = file_get_contents('php://input'); //($_POST doesn't work here)
$request = json_decode($str_json, true); // decoding received JSON to array
$type = $request['type'];
$id = $request['id'];

if($type === "Module"){
    echo json_encode(moduleStat($id));
}else{
    echo json_encode(quizStat($id));
}
   



?>
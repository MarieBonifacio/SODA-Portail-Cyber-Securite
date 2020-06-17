<?php
define('WP_USE_THEMES', false);

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

if(!checkAuthorized(true)){
    wp_redirect( home_url() );  exit;
}

//Récupérer les created at etc des quizs et des modules
function quizStatsByCampaign($site){
    return $wpdb->get_results( "SELECT wp_users.ID AS ID, wp_users.display_name AS Utilisateur, wp_usermeta.meta_value AS Site FROM wp_users LEFT JOIN wp_usermeta ON wp_usermeta.user_id = wp_users.ID AND wp_usermeta.meta_key = 'location' WHERE wp_users.ID NOT IN (SELECT user_id FROM quiz_score WHERE '".$quizId."' = quiz_id)");
}

function moduleStatsByCampaign($site){
    return  $wpdb->get_results( "SELECT wp_users.ID AS ID, wp_users.display_name AS Utilisateur, wp_usermeta.meta_value AS Site FROM wp_users LEFT JOIN wp_usermeta ON wp_usermeta.user_id = wp_users.ID AND wp_usermeta.meta_key = 'location' WHERE wp_users.ID NOT IN (SELECT user_id FROM module_finish WHERE module_id ='".$moduleId."')");
}
//récupérer les scores, taux de participation etc par ville 

?>
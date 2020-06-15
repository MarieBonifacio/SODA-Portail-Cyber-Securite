<?php

define('WP_USE_THEMES', false);



$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

if(!checkAuthorized(true)){
    wp_redirect( home_url() );  exit;
}


function notify(){
    global $wpdb;
    // $users = $wpdb->get_results( "SELECT wp_users.ID AS ID, wp_users.display_name AS Utilisateur, wp_usermeta.meta_value AS Site FROM wp_users LEFT JOIN wp_usermeta ON wp_usermeta.user_id = wp_users.ID AND wp_usermeta.meta_key = 'location' ");
    // $users_fnsh = $wpdb->get_results("SELECT wp_users.ID as ID, wp_users.display_name AS Utilisateur FROM wp_users LEFT JOIN module_finish ON wp_users.ID = module_finish.user_id WHERE '.$moduleId.'= module_finish.module_id ");
   
    $users = $wpdb->get_results( "SELECT * FROM wp_users");
    $quizs = $wpdb->get_results("SELECT id, name FROM quiz");
    $modules = $wpdb->get_results("SELECT id, title FROM module");

    foreach($users as $user){
        $userId = $user->id;
        if($userId != 798){
            continue;
        }

        $quizUndone = $wpdb->get_results("SELECT id, name FROM quiz WHERE id NOT IN (SELECT quiz_id FROM quiz_score WHERE user_id = '.$userId.')");
        $moduleUndone = $wpdb->get_results("SELECT id, title FROM module WHERE id NOT IN (SELECT module_id FROM module_finish WHERE user_id = '.$userId.')");

        if(count($quizUndone) === 0 && count($moduleUndone) === 0 ){
            continue;
        }
     
        $to = get_userdata($userId)->get("user_email");
        $subject = "Quizs et modules à faire";

        $message = "Merci de bien vouloir effectuer ce(s) "; 
        
        if(count($quizUndone) === 0){
            $message.="module(s)";
        }elseif(count($moduleUndone) === 0){
            $message.="quiz(s)";
        }else{
            $message.="quiz(s) et ce(s) module(s)";
        }
        
        $message.=" sur le portail Soda CyberDéfense. \n ";

        foreach($moduleUndone as $module){
            $message.="\n \t-".$module->title;
        }

        foreach($quizUndone as $quiz){
            $message.="\n \t-".$quiz->name;
        }

        wp_mail($to, $subject, $message);
    }
}

notify();
wp_redirect(home_url()."/statistiques");

?>
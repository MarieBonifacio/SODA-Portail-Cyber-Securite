<?php
define('WP_USE_THEMES', false);
require('app/class/quiz.class.php');
require('app/class/quiz_score.class.php');
require('app/class/module.class.php');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

if(!checkAuthorized(true)){
    wp_redirect( home_url() );  exit;
}

$response = array();

//nombre d'utilisateur
$nbUsers = count_users();

//Pour chaque module terminé
$module = $wpdb->get_results( "SELECT id, title FROM module");

foreach($module as $m){
    $moduleId = $m->id;
    //je vais dans les modules terminés
    $nbrDone = $wpdb->get_var("SELECT count(module_id) FROM module_finish WHERE module_id = '$moduleId'");
    $pourcent = round(((int)$nbrDone * 100)/(int)$nbUsers['total_users']);
    $response['modules'][] = [
        "pourcentage" => $pourcent,
        "id" => $m->id,
        "titre" => $m->title,
    ];
}

//Pour chaque quiz terminé 
$quiz = $wpdb->get_results( "SELECT id, name FROM quiz");

foreach($quiz as $q){
    $quizId = $q->id;
    //je vais dans les quizs terminés
    $nbrDone = $wpdb->get_var("SELECT count(quiz_id) FROM quiz_score WHERE quiz_id = '$quizId'");
    $pourcent = round(((int)$nbrDone * 100)/(int)$nbUsers['total_users']);
    $response['quizs'][] = [
        "pourcentage" => $pourcent,
        "id" => $q->id,
        "titre" => $q->name,
    ];
}

echo json_encode($response);
?>
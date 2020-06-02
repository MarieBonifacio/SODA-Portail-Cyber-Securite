<?php

header('content-type:application/json');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');


if(!checkAuthorized(true, true)){
    wp_redirect( home_url() );  exit;
}

function getQuizGeneralClassement($idQuiz){
    global $wpdb;

    $sql = "
    SELECT 
        wp_users.display_name AS Joueur,  
        wp_usermeta.meta_value AS Site 
        quiz_score.score AS Score, 
        quiz_score.time AS Temps,
    FROM 
        quiz_score 
        LEFT JOIN wp_users ON wp_users.ID = quiz_score.user_id 
        LEFT JOIN wp_usermeta ON wp_usermeta.user_id = wp_users.ID AND wp_usermeta.meta_key = 'location' 
    WHERE 
        quiz_id = ".$quizId;

    $sql .= " ORDER BY quiz_score.score, quiz_score.time DESC";
}

function getQuizSiteClassement($ville){
    global $wpdb;

    $sql = "
    SELECT
        
    FROM

    WHERE

    ";
}

$userId = $_SESSION['userConnected'];
$ville = $wpdb->get_var("SELECT meta_value FROM wp_usermeta WHERE meta_key='location' AND user_id='".$userId."'");
$str_json = file_get_contents('php://input'); //($_POST doesn't work here)
$request = json_decode($str_json, true); // decoding received JSON to array

if($request['type'] == "global"){
    if($request['filtre'] == "general"){
        echo json_encode(getUserClassement());
    }else{
        echo json_encode(getCityClassement());
    }
}

if($request['type'] == "quiz"){
    $idQuiz = $request['id'];
    if($request['filtre'] == "general"){
        echo json_encode();
    }else{
        //quiz site
    }
}

if($request['type'] == "tag"){
    if($request['filtre'] == "general"){
        //tag general
    }else{
        //tag site
    }
}
//dashboard admin

// $response['classementVilleGeneral'] = getCityClassement();

// $response['classementUser'] = getUserClassement();

// $response['classementUserByQuiz'] = getUserByQuizClassement();

// $response['classementUserByTag'] = getUserByTagClassement();

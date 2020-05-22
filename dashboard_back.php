<?php

header('content-type:application/json');

require('app/class/answer.class.php');
require('app/class/question.class.php');
require('app/class/quiz.class.php');
require('app/class/quiz_score.class.php');
require('app/class/tag.class.php');
require('app/class/module.class.php');
require('app/class/module_slide.class.php');


$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');


if(!checkAuthorized(false, true)){
    wp_redirect( home_url() );  exit;
}

//dernier quiz
function getLastQuiz($userId){ 

    global $wpdb;   

    $quiz = $wpdb->get_row( "SELECT id, name, tag_id, img_path FROM quiz ORDER BY created_at DESC LIMIT 1" );



    $score= null;

    $score = $wpdb->get_row( "SELECT score, time FROM quiz_score where quiz_id = ".$quiz->id." AND user_id = ".$userId." ");



    $quizTmp = new Quiz();

    $quizTmp->selectById($quiz->id);  



    return array(

        "id" => $quizTmp->getId(),

        "name" => $quizTmp->getName(),

        "tag_id" => $quizTmp->getTag()->getId(),

        "tag_name" => $quizTmp->getTag()->getName(),

        "img" => $quizTmp->getImgPath(),

        "user_score" => $score->score,

        "user_time" => $score->time,

    );

}

$userId = $_SESSION['userConnected'];

$ville = $wpdb->get_var("SELECT meta_value FROM wp_usermeta WHERE meta_key='location' AND user_id='".$userId."'");

$str_json = file_get_contents('php://input'); //($_POST doesn't work here)
$response = json_decode($str_json, true); // decoding received JSON to array

$quizId = isset($response['quizId']) ? $response['quizId'] : null;

$response['ville']= $ville;

$response['lastQuiz'] = getLastQuiz($userId);

$response['top30User'] = getUserClassement($userId, null, 30);

$response['top30UserVille'] = getUserClassement($userId, $ville, 30);

$response['userResults'] = getUserResults($userId);


echo json_encode($response);


?>
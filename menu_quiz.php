<?php 

header('content-type:application/json');

require('app/class/answer.class.php');
require('app/class/question.class.php');
require('app/class/quiz.class.php');
require('app/class/quiz_score.class.php');
require('app/class/tag.class.php');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

//JSON encode 

$quizs = $wpdb->get_results( "SELECT id, name, tag_id, img_path FROM quiz" );

//Si le quiz est déjà fait
// {

// }else{
$quizArray = [];
foreach ($quizs as $q){
    $score = null;
    $userId = $_SESSION['userConnected'];
    $score = $wpdb->get_row( "SELECT score, time FROM quiz_score where quiz_id = ".$q->id." AND user_id = ".$userId." ");

    $quizTmp = new Quiz();
    $quizTmp->selectById($q->id);
    
    $quiz = array(
        "id" => $quizTmp->getId(),
        "name" => $quizTmp->getName(),
        "tag_id" => $quizTmp->getTag()->getId(),
        "tag_name" => $quizTmp->getTag()->getName(),
        "img" => $quizTmp->getImgPath(),
        "user_score" => $score->score,
        "user_time" => $score->time,
    );
$quizArray[] = $quiz;
}
// }
echo json_encode($quizArray);

?>

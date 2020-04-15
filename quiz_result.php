<?php
require('app/class/answer.class.php');
require('app/class/question.class.php');
require('app/class/quiz.class.php');
require('app/class/quiz_score.class.php');
require('app/class/tag.class.php');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

/* SAVE TO BDD / JSON DECODE 
{"score":0,"time":5}
*/

$str_json = file_get_contents('php://input'); //($_POST doesn't work here)
$response = json_decode($str_json, true); // decoding received JSON to array


$newScore = new Quiz_score();

$user = $_SESSION['userConnected'];
$newScore->setUserId($user);

$quiz = new Quiz();
$quiz->selectById($response['id_quiz']);
$newScore->setQuizId($quiz);

$score = $response['score'];
$newScore->setScore($score);

$time = $response['time'];
$newScore->setTime($time);
$newScore->save();

$wpdb->delete( 'quiz_progress' ,
    array(
        'id_user' => $user->getId(),
        'id_quiz' => $quiz->getId(),
    )
);
     


?>
<?php
require('app/class/answer.class.php');
require('app/class/question.class.php');
require('app/class/quiz.class.php');
require('app/class/quiz_score.class.php');
require('app/class/tag.class.php');
require('app/class/user.class.php');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

$str_json = file_get_contents('php://input'); //($_POST doesn't work here)
$response = json_decode($str_json, true); // decoding received JSON to array
print_r($response);
$wpdb->insert(
    'quiz_progress',
    array(
        'id_quiz' => $response['id_quiz'],
        'id_user' => $_SESSION['userConnected'],
        'id_question' => $response['questions'],
        'id_answer' => $response['answer'],
        'time' => $response['time'],
    )
);

?>
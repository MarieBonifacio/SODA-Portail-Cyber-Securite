<?php 

header('content-type:application/json');

require('app/class/answer.class.php');
require('app/class/question.class.php');
require('app/class/quiz.class.php');
require('app/class/quiz_score.class.php');
require('app/class/tag.class.php');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

if(!checkAuthorized(true)){
    wp_redirect( home_url() );  exit;
}

$idQuiz = $_GET["idQuiz"];

$table = "quiz";

//delete quiz
$wpdb->delete($table, array('id' => $idQuiz));

$questions = $wpdb->get_results( "SELECT id FROM question WHERE id_quiz = ".$idQuiz." ");
foreach ($questions as $q){
    $qid = $q->id;
    $wpdb->delete('answer', array('id_question' => $qid));
}

//delete questions
$wpdb->delete('question', array('id_quiz' => $idQuiz));


//delete score
$wpdb->delete('quiz_score', array('quiz_id' => $idQuiz));

//delete progress
$wpdb->delete('quiz_progress', array('id_quiz' => $idQuiz));


?>
<?php
require('app/class/answer.class.php');
require('app/class/question.class.php');
require('app/class/quiz.class.php');
require('app/class/quiz_score.class.php');
require('app/class/tag.class.php');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');


if(!checkAuthorized(false, true)){
    wp_redirect( home_url() );  exit;
}

//JSON encode 
$quiz = new Quiz();
$quiz->selectById($_GET['id']);

$quizId = $quiz->getId();
$questions = $wpdb->get_results( "SELECT * FROM question WHERE id_quiz='$quizId'");
$quizArray = [];

    $quiz = array(
        'id' => $quiz->getId(),
        'name' => $quiz->getName(),
        'tag_id' => $quiz->getTag()->getId(),
        'img' => $quiz->getImgPath(),
        'player' => $_SESSION['userConnected'],
    );
    foreach($questions as $q){
        $question = array(  
            "id" => $q->id,
            "id_quiz" => $q->id_quiz,
            "content" => $q->content,
            "img_path" => $q->img_path,
            "url" => $q->url,
            "points" => $q->points,
        );
        
        $questionId = $question['id'];
        $answers = $wpdb->get_results( "SELECT * FROM answer where id_question='$questionId'" );
        foreach($answers as $a){
            $answer = array(
                'id' => $a->id,
                'id_question' => $a->id_question,
                'content' => $a->content,
                'is_true' => $a->is_true,
            );
            $question['answers'][] = $answer;
        }
        $quiz['questions'][] = $question;
    }

    $userId = $_SESSION['userConnected'];
    $query = $wpdb->get_results("SELECT id_question, id_answer, time FROM quiz_progress WHERE id_user= '$userId' AND id_quiz = '$quizId'");
    $previous = array();
    foreach($query as $q)
    {
        $answerId = $q->id_answer;
        $answer =  $wpdb->get_var("SELECT is_true FROM answer WHERE id='$answerId'");
        $previous[] = array(
            "id_question" => $q->id_question,
            "id_answer" => $q->id_answer,
            "time" => $q->time,
            "is_true" => $answer,
        );
    }
    $quiz["previous"] = $previous;

echo json_encode($quiz);

?>
<?php
require('app/class/answer.class.php');
require('app/class/question.class.php');
require('app/class/quiz.class.php');
require('app/class/quiz_score.class.php');
require('app/class/tag.class.php');
require('app/class/user.class.php');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

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


echo json_encode($quiz);

?>
<?php

define('WP_USE_THEMES', false);
require('class/answer.class.php');
require('class/question.class.php');
require('class/quiz.class.php');
require('class/quiz.score.class.php');
require('class/user.class.php');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');



$nbrQuestions = $_POST['nbrQuestion'];

if($nbrQuestion >= 10) {

    for( $i = 1, $i<$nrbQuestion, $i++){

        $questions = $_POST['question_'.$i];
        $answers= array();

        for( $r=1; $r <= 4; $r++){

            $answers[] = array(
                'text' => $_POST['q_'.$i.'_reponse_'.$r],
                'isTrue' => $_POST['q_'.$i.'_isTrue_'.$r],
            );
        }
    $_SESSION['quizData']['questions'] = $answers;
    $_SESSION['quizData']['answers'] = $questions;

    wp_redirect( home_url().'/create_quiz_3' );
    }
}else{
    $_SESSION['errorQuiz'] = "Veuillez créer au moins 10 questions.";
    wp_redirect( home_url().'/create_quiz_2' );

+ne pas afficher le bouton envoyer en ajax
}



?>
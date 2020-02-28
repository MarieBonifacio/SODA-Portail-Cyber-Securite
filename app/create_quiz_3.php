<?php

define('WP_USE_THEMES', false);
require('class/answer.class.php');
require('class/question.class.php');
require('class/quiz.class.php');
require('class/quiz.score.class.php');
require('class/user.class.php');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

$_SESSION['quizData']['quiz'] = $quiz;
$_SESSION['quizData']['questions'] = $question;
$_SESSION['quizData']['answers'] = $answer;



foreach()
{

    
    $quiz = new Quiz();
    $quiz ->setName($quiz=>$title);
    //voir pour récup l'id du thème
    $quiz ->setTagId($quiz->$theme);
    $quiz->setImgPath($quiz->$img);
    $quiz->save();

    $question = new Question();
    $question->setContent($question->$text);
    $question->setImgPath($question->$img);
    $question->setUrl($question->$video);
    $question->setPoints(10);
    $question->save();


    $answer = new Answer();
    //??
    $answer->setIdQuestion($question);
    $answer->setContent($answer->$text);
    $answer->setIsTrue($answer->$isTrue);
    $answer->save();

}








?>
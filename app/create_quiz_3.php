<?php

define('WP_USE_THEMES', false);
require('class/answer.class.php');
require('class/question.class.php');
require('class/quiz.class.php');
require('class/quiz_score.class.php');
require('class/tag.class.php');
require('class/user.class.php');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');



/* SAVE TO BDD  */


if(!empty($_SESSION['userConnected']))
{
    $id = $_SESSION['userConnected'];
    $userConnected = new User();
    $userConnected->selectById($id);
}

//recuperation quiz
$newQuiz = new Quiz();
$newQuiz->setName($_SESSION['quizData']['quiz']['title']);


$tag = new Tag();
$tag->selectByName($_SESSION['quizData']['quiz']['theme']);
$newQuiz->setTag($tag);
$newQuiz->setAuthorById($_SESSION['userConnected']);
$newQuiz->setImgPath($_SESSION['quizData']['quiz']['img']);
$newQuiz->save();
$newQuizId = $wpdb->insert_id;


//recupération questions/réponses
foreach($_SESSION['quizData']['questions'] as $q)
{
    $newQuestion = new Question();
    $newQuestion->setIdQuiz($newQuizId);
    $newQuestion->setContent($q['info']['text']);
    $points = 100/sizeof($_SESSION['quizData']['questions']);
    $newQuestion->setImgPath($q['info']['img']);
    $newQuestion->setUrl($q['info']['video']);
    $newQuestion->setPoints($points);
    $newQuestion->save();
    $newQuestionId = $wpdb->insert_id;
   
    foreach($q['answers'] as $a)
    {
        $newAnswer = new Answer();
        $newAnswer->setIdQuestion($newQuestionId);
        $newAnswer->setContent($a['text']);
        $newAnswer->setIsTrue($a['isTrue']);
        $newAnswer->save();
        
    }

}
?>
<?php

define('WP_USE_THEMES', false);
require('class/answer.class.php');
require('class/question.class.php');
require('class/quiz.class.php');
require('class/quiz.score.class.php');
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

echo $_SESSION['userConnected'];

$_SESSION['quizData'];

echo '<pre>';
 print_r($_SESSION['quizData']); 
 echo '</pre>';

//recuperation quiz
$newQuiz = new Quiz();
$newQuiz->setName($_SESSION['quizData']['quiz']['title']);

//A FAIRE (faire table tags)
$tagId = new Tag();
$tagId->selectByName($_SESSION['quizData']['quiz']['theme']);
$newQuiz->setTag($tagId);
$u = new User();
$u->selectById ($_SESSION['userconnected']);
$newQuiz->setAuthor($u);
$newQuiz->setImgPath($_SESSION['quizData']['quiz']['img']);
$newQuiz->save();
$newQuizId = $wpdb->insert_id;


//recupération questions/réponses
foreach($_SESSION['quizData']['questions'] as $q)
{
    $newQuestion = new Question();
    $newQuestion->setIdQuiz($newQuizId);
    $newQuestion->setContent($q['info']['text']);
    $points = 100/$nbrQuestion;
    $newQuestion->setPoints($points);
    $newQuestion->save();
    $newQuestionId = $wpdb->insert_id;
   

    {
        
        $newAnswer = new Answer();
        $newAnswer->setIdQuestion($newQuestionId);
        $newAnswer->setContent($a['text']);
        $newAnswer->setIsTrue($a['isTrue']);
        $newAnswer->save();
        
    }

}






?>
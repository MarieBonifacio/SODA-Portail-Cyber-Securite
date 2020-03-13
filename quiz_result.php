<?php
require('app/class/answer.class.php');
require('app/class/question.class.php');
require('app/class/quiz.class.php');
require('app/class/quiz_score.class.php');
require('app/class/tag.class.php');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

/* SAVE TO BDD / JSON DECODE */
$data = json_decode($json);


$data['id_quiz']
$data['score']
$data['time']

$newScore = new quiz_score();
$newScore->setUserId();
$newScore->setQuizId();
$newScore->setScore();
$newScore->setTime();
$newScore->save();

?>
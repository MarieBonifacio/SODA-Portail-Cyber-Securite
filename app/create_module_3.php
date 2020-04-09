<?php
define('WP_USE_THEMES', false);
require('class/user.class.php');
require('class/module.class.php');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

/* SAVE TO BDD  */
if(!empty($_SESSION['userConnected']))
{
    $id = $_SESSION['userConnected'];
    $userConnected = new User();
    $userConnected->selectById($id);
}

//recuperation module
$newModule = new Module();
$newModule->setTitle($_SESSION['moduleData']['module']['title']);


$tag = new Tag();
$tag->selectByName($_SESSION['moduleData']['module']['theme']);
$newModule->setTag($tag);
$newModule->setAuthorById($_SESSION['userConnected']);
$newModule->setImgPath($_SESSION['moduleData']['module']['img']);
$newModule->save();
$newModuleId = $wpdb->insert_id;


//recupération questions/réponses
foreach($_SESSION['moduleData']['pages'] as $m)
{
    $newQuestion = new ModuleSlide();
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

wp_redirect( home_url().'/menu-module' );

?>

?>
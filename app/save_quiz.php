<?php

define('WP_USE_THEMES', false);
require('class/answer.class.php');
require('class/question.class.php');
require('class/quiz.class.php');
require('class/quiz.score.class.php');
require('class/user.class.php');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

//1st Step creation de quiz / thème + image 

if(!empty($_POST['titre']) && !empty($_POST['theme']) && !empty($_POST['img']){

    //enregistrement des POST en variable session pour passer à la seconde étape sans enregistrer en base de données en cas d'abandon
    $title = htmlspecialchars($_POST['titre']);
    $theme = $_POST['theme'];
    $img = $_POST['img'];

    $quiz = array (
                'title'=> $title,
                'theme'=> $theme,
                'img'=> $img
            )

    $_SESSION['quizData']['quiz'] = $quiz;
    wp_redirect( home_url().'/create_quiz_2' );

}else{
    $_SESSION['errorQuiz'] = "Veuillez remplir tous les champs.";
    wp_redirect( home_url().'/create_quiz_1' );
}

?>
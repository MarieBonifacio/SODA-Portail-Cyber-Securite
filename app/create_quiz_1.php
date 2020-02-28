<?php

define('WP_USE_THEMES', false);
require('class/answer.class.php');
require('class/question.class.php');
require('class/quiz.class.php');
require('class/quiz_score.class.php');
require('class/user.class.php');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

//1st Step creation de quiz / thème + image 

if(!empty($_POST['title']) && !empty($_POST['theme']))
{
    print_r($_FILES['img_quiz']);
    if(!empty($_FILES['img_quiz'])){

        $content_dir =  get_template_directory().'/img/quizs/';
        $tmp_file = $_FILES['img_quiz']['tmp_name'];

        if(!is_uploaded_file($tmp_file))
        {
            $error_quiz="Le fichier est introuvable";
        }
        $type_file = $_FILES['img_quiz']['type'];

        if( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'png')) 
        {
            $errorQuiz="Le format du fichier n'est pas pris en charge";
        }
            // on copie le fichier dans le dossier de destination
        $name_file = $_POST['title'].'.'.preg_replace("#image\/#","",$type_file);

        if( !move_uploaded_file($tmp_file, $content_dir . $name_file) )
        { 
            $errorQuiz = "Impossible de copier le fichier $name_file dans $content_dir";
        }

            $img = $name_file;
            $quiz_ok = "Le fichier a bien été uploadé";
    }
    //enregistrement des POST en SESSION pour passer à la seconde étape sans enregistrer en base de données en cas d'abandon
    $title = htmlspecialchars($_POST['title']);
    $theme = $_POST['theme'];

    $quiz = array (
                'title'=> $title,
                'theme'=> $theme,
                'img'=> $img
    );

    $_SESSION['quizData']['quiz'] = $quiz;
    

}else{
    $error_quiz = "Veuillez remplir tous les champs.";
}




$_SESSION["errorQuiz"] = $error_quiz;
$_SESSION["quizOk"] = $quiz_ok;
print_r($quiz);
wp_redirect( home_url().'/create-quiz-1' );
?>
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



$nbrQuestion = $_POST['nbrQuestion'];
$_SESSION['errorQuiz'] = "";

if(!empty($_SESSION['quizData'])){
    $_SESSION['quizData']['quiz']['questions'] = null;
}

if($nbrQuestion >= 1){
    for( $i = 1; $i <= $nbrQuestion; $i++) 
    {
        if(!empty($_POST['question_'.$i]))
        {
            $question['info'] = array(
                'text' => $_POST['question_'.$i],
                'img' => "",
                'video' => "",
            );

            if(!empty($_POST['q_'.$i.'_video']))
            {
                $url = $_POST['q_'.$i.'_video'];
                $question['info']['video'] = $url;
            }

            if($_FILES['q_'.$i.'_img']['error'] != UPLOAD_ERR_NO_FILE && !empty($_FILES['q_'.$i.'_img']))
            {
                $dir = $_SESSION['quizData']['quiz']['title'];
                $path = "../img/quizs/".$dir."/questions";
                if(!is_dir($path))
                {
                    mkdir($path, 0700, true);
                }
                $content_dir =  get_template_directory()."/img/quizs/".$dir."/questions/";
                $tmp_file = $_FILES['q_'.$i.'_img']['tmp_name'];

                if(!is_uploaded_file($tmp_file))
                {
                    $error_quiz="Un des fichiers est introuvable";
                    wp_redirect( home_url().'/creationquizetape2' );
                }

                $type_file = $_FILES['q_'.$i.'_img']['type'];

                if( !strpos($type_file, 'jpg') && !strpos($type_file, 'jpeg') && !strpos($type_file, 'png'))
                {
                    $error_quiz = "Le format d'un des fichiers n'est pas pris en charge.";
                    wp_redirect( home_url().'/creationquizetape2' );
                }

                $name_file = md5($tmp_file).'.'.preg_replace("#image\/#","",$type_file);

                if( !move_uploaded_file($tmp_file, $content_dir . $name_file) )
                {
                    $errorQuiz = "Impossible de copier le fichier $name_file dans $content_dir";
                    wp_redirect( home_url().'/creationquizetape2' );
                }

                $img = $name_file;
                $question['info']['img'] = $img;
            }

            $_SESSION['quizData']['questions'][$i] = $question;
            
// REPONSES ----------------------------------------------------------------------------------------------------------
            $answers= array();

            $nbrAnswer = 0;
            $nbrTrue = 0;
            for( $r=1; $r <= 4; $r++){
                if(!empty($_POST['q_'.$i.'_reponse_'.$r])){
                    $nbrAnswer += 1;
                    if($_POST['q_'.$i.'_isTrue_'.$r] == "true"){
                        $nbrTrue += 1;
                    }

                    $answer = array(
                        'text' => $_POST['q_'.$i.'_reponse_'.$r],
                        'isTrue' => $_POST['q_'.$i.'_isTrue_'.$r],
                    );
                    $_SESSION['quizData']['questions'][$i]['answers'][$r] = $answer;
                }
            }
           
            if($nbrTrue < 1)
            {
                $_SESSION['errorQuiz'] = "Merci de renseigner une bonne réponse par question.";
            }
            if($nbrTrue > 1){
                $_SESSION['errorQuiz'] = "Merci de renseigner une seule bonne réponse par question.";
            }
            if($nbrAnswer < 2){
                $_SESSION['errorQuiz'] = "Merci de renseigner au moins deux réponses par question.";
            }
        }else{
            $_SESSION['errorQuiz'] = "Veuillez remplir l'énoncé des questions.";
        }
    }
}elseif($nbrQuestion < 3 || sizeof($_SESSION['quizData']['quiz']['questions']) <3 ){
    $_SESSION['errorQuiz'] = "Veuillez créer au moins 3 questions.";
}

if($_SESSION['errorQuiz'] == "")
{
    wp_redirect( home_url().'/creationquizetape3' );
}else{
    $_SESSION['formQuizStep2'] = $_POST;
    wp_redirect( home_url().'/creationquizetape2' );
}

?>
    
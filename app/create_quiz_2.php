<?php
define('WP_USE_THEMES', false);
require('class/answer.class.php');
require('class/question.class.php');
require('class/quiz.class.php');
require('class/quiz_score.class.php');
require('class/tag.class.php');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

if(!checkAuthorized(true)){
    wp_redirect( home_url() );  exit;
}


$nbrQuestion = $_POST['nbrQuestion'];
$_SESSION['errorQuiz'] = "";
$_SESSION['formQuizStep2'] = $_POST;
$tmpQuestionData = array();

if(!empty($_SESSION['quizData']) && $_SESSION['quiEdit'] === false){
    $_SESSION['quizData']['quiz']['questions'] = null;
}

if($nbrQuestion >= 1){
    for( $i = 1; $i <= $nbrQuestion; $i++)
    {
        $question = array();
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
            }else{
                if($_FILES['q_'.$i.'_img']['error'] != UPLOAD_ERR_NO_FILE && !empty($_FILES['q_'.$i.'_img']))
                {
                    $dir = md5($_SESSION['quizData']['quiz']['title']);
                    $path = "../img/quizs/".$dir."/questions";
                    $pathClean = $dir."/questions";
                    if(!is_dir($path))
                    {
                        mkdir($path, 0775, true);
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
                        $error_quiz = "Impossible de copier le fichier $name_file dans $content_dir";
                        wp_redirect( home_url().'/creationquizetape2' );
                    }

                    $img = $name_file;
                    $question['info']['img'] = $pathClean.'/'.$img;
                }else{
                    if (!empty($_SESSION['quizData']['questions'][$i]['info']['img'])){
                        $question['info']['img'] = $_SESSION['quizData']['questions'][$i]['info']['img'];
                    }
                }
            }
            $tmpQuestionData[$i] = $question;

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
                    $tmpQuestionData[$i]['answers'][$r] = $answer;
                }
            }

            if($nbrTrue < 1)
            {
                $_SESSION['errorQuiz'] = "Merci de renseigner au moins une bonne réponse par question.";
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
    $_SESSION['quizData']['questions'] = $tmpQuestionData;
    wp_redirect( home_url().'/creationquizetape3' );
}else{
    wp_redirect( home_url().'/creationquizetape2' );
}

?>

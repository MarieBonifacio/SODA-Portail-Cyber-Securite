<?php

define('WP_USE_THEMES', false);
require('class/answer.class.php');
require('class/question.class.php');
require('class/quiz.class.php');
require('class/quiz_score.class.php');
require('class/user.class.php');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');


$nbrQuestion = $_POST['nbrQuestion'];
$_SESSION['errorQuiz'] = "";
print_r($_POST);


if(!empty($_SESSION['quizData'])){
    unset($_SESSION['quizData']);
}

//si le nombre de question est supérieur ou égal à 10
if($nbrQuestion >= 10)
{
    //pour chaque question du formulaire
    for( $i = 1; $i <= $nbrQuestion; $i++)
    {
        //Si l'énoncé de la question est rempli
        if(!empty($_POST['question_'.$i]))
        {
            //on récupère l'énoncé
            //img/vidéo vides de base

            $question['info'] = array(
                'text' => $_POST['question_'.$i],
                'img' => $_FILES['q_'.$i.'_img'],
                'video' => $_POST['q_'.$i.'_video'],
            );
            
            //si le lien d'une vidéo est donné
            if(!empty($_POST['q_'.$i.'_video'])){
                $question['info']['video'] = $_POST['q_'.$i.'_video'];
            }
            
            //Si une image est donnée
            if(!isset($_FILES['q_'.$i.'_img']) || $_FILES['q_'.$i.'_img']['error'] == UPLOAD_ERR_NO_FILE)
            {
                $error_quiz = "Veuillez selectionner une image en format jpg ou png.";
                // wp_redirect( home_url().'/creationquizetape2' );
            }else{

                // FAUT FAIRE LE TRAITEMENT UPLOAD => DEPLACEMENT + RENOMMAGE
                $content_dir =  get_template_directory().'/img/quizs/questions';
                $tmp_file = $_FILES['q_'.$i.'_img']['tmp_name'];
        
                if(!is_uploaded_file($tmp_file))
                {
                    $error_quiz="Un fichier est introuvable";
                    // wp_redirect( home_url().'/creationquizetape2' );
                }
                $type_file = $_FILES['q_'.$i.'_img']['type'];
        
                if( !strpos($type_file, 'jpg') && !strpos($type_file, 'jpeg') && !strpos($type_file, 'png')) 
                {
                    $error_quiz = "Le format d'un des fichiers n'est pas pris en charge";
                    // wp_redirect( home_url().'/creationquizetape2' );
                }
                    // on copie le fichier dans le dossier de destination
                $name_file = $_POST['q_'.$i.'_img'].'.'.preg_replace("#image\/#","",$type_file);
                $img = $name_file;
        
                if( !move_uploaded_file($tmp_file, $content_dir . $name_file) )
                { 
                    $errorQuiz = "Impossible de copier le fichier $name_file dans $content_dir";
                    // wp_redirect( home_url().'/creationquizetape2' );
                }
        
                // Puis stocker le resultat $question[$i]['img'] => $_POST['q_'.$i.'_img'];
                $question['info']['img'] = $img;
            }

            //on stocke le tableau questions dans la liste des questions (['questions']) de la variable de session quizdata
            $_SESSION['quizData']['questions'][$i] = $question;

        
            $answers= array();

            $nbrAnswer = 0;
            $nbrTrue = 0;
            //pour chaque réponse à cette question
            for( $r=1; $r <= 4; $r++){
                //compteur de bonne reponse par question
                //Si le texte de la réponse est rempli
                if(!empty($_POST['q_'.$i.'_reponse_'.$r])){
                    
                     //si la réponse est marque bonne, on incremente le compteur de bonne reponse
                    if($_POST['q_'.$i.'_isTrue_'.$r] == true){
                        $nbrTrue ++;
                    }
                    //on stocke le text et le isTrue dans une variable answer
                    $answer = array(
                        'text' => $_POST['q_'.$i.'_reponse_'.$r],
                        'isTrue' => $_POST['q_'.$i.'_isTrue_'.$r],
                    );

                     //on stock le tableau answer dans la liste des reponses ['answers'] de la question ([$i])
                    $_SESSION['quizData']['questions'][$i]['answers'][$r] = $answer;
                }
                /*else{
                    //On renvoie sur la page précedente si une des 4 réponse n'est pas rempli
                    $_SESSION['errorQuiz'] = "Veuillez remplir 4 réponses par questions.";
                    //wp_redirect( home_url().'/create_quiz_2' );
                }*/
                
                //si plus d'une reponse à été mise comme bonne pour la question
                if($nbrTrue != 1)
                {
                    $_SESSION['errorQuiz'] = "Il faut une unique bonne réponse par question.";
                    // wp_redirect( home_url().'/create_quiz_2' );
                }
                if($nbrAnswer < 2)
                {
                    $_SESSION['errorQuiz'] = "Il faut deux réponses minimum par question.";
                    //wp_redirect( home_url().'/create_quiz_2' );
                }
            }
        }else{
            //on renvoie sur la page precedente si une question n'a pas d'énoncé
            $_SESSION['errorQuiz'] = "Veuillez remplir l'énoncé des questions.";
            //wp_redirect( home_url().'/creationquizetape2' );
        }
    }
    
} else {
    $_SESSION['errorQuiz'] = "Veuillez créer au moins 10 questions.";
    //wp_redirect( home_url().'/creationquizetape2' );
    //ne pas afficher le bouton envoyer en ajax
}
//quand toutes les questions/réponses on été traité on renvoie à la page suivante

if($_SESSION['errorQuiz'] == ""){
    //wp_redirect( home_url().'/create_quiz_3' );
}

/* SAVE TO BDD TEST */

$_SESSION['quizData'];

echo '<pre>';
 print_r($_SESSION['quizData']); 
 echo '</pre>';

//recuperation quiz
$newQuiz = new Quiz();
$newQuiz->setName($_SESSION['quizData']['quiz']['title']);

//A FAIRE (faire table tags)
$newQuiz->setTagId(1);
$author = new User();
$author->selectById(1);
$newQuiz->setAuthor( $author->getId() );
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
   
    foreach ($q['answers'] as $a)
    {
        
        $newAnswer = new Answer();
        $newAnswer->setIdQuestion($newQuestionId);
        $newAnswer->setContent($a['text']);
        $newAnswer->setIsTrue($a['isTrue']);
        $newAnswer->save();
        
    }

}


?>
    
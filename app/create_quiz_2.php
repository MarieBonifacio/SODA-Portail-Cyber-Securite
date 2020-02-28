<?php

define('WP_USE_THEMES', false);
require('class/answer.class.php');
require('class/question.class.php');
require('class/quiz.class.php');
require('class/quiz.score.class.php');
require('class/user.class.php');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');



$nbrQuestions = $_POST['nbrQuestion'];

//si le nombre de question est supérieur ou égal à 10
if($nbrQuestion>=10)
{
    //pour chaque question du formulaire
    for( $i = 1, $i<$nrbQuestion, $i++)
    {
        //Si l'énoncé de la question est rempli
        if(!empty($_POST['question_'.$i]))
        {
            //on récupère l'énoncé
            //img/vidéo vides de base
            $question[$i] = array(
                'text' => $_POST['question_'.$i],
                'img' => '',
                'video' => '',
            );
            
            //si le lien d'une vidéo est donné
            if(!empty($_POST['q_'.$i.'_video'])){
                $question[$i]['video'] => $_POST['q_'.$i.'_video'];
            }
            
            //Si une image est donnée
            if(!empty($_POST['q_'.$i.'_img'])){
                // FAUT FAIRE LE TRAITEMENT UPLOAD => DEPLACEMENT + RENOMMAGE
                // Puis stocker le resultat $question[$i]['img'] => $_POST['q_'.$i.'_img'];
            }

            //on stocke le tableau questions dans la liste des questions (['questions']) de la variable de session quizdata
            $_SESSION['quizData']['questions'][$i] = $question;

        
            $answers= array();
            
            //pour chaque réponse à cette question
            for( $r=1; $r <= 4; $r++){
                //compteur de bonne reponse par question
                $nbrTrue = 0;
                //Si le texte de la réponse est rempli
                if(!empty([$_POST['q_'.$i.'_reponse_'.$r])){
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
                }else{
                    //On renvoie sur la page précedente si une des 4 réponse n'est pas rempli
                    $_SESSION['errorQuiz'] = "Veuillez remplir 4 réponses par questions.";
                    wp_redirect( home_url().'/create_quiz_2' );
                }
    
                //si plus d'une reponse à été mise comme bonne pour la question
                if($nbrTrue != 1){
                    $_SESSION['errorQuiz'] = "Il faut une unique bonne réponse par question.";
                    wp_redirect( home_url().'/create_quiz_2' );
                }
            }
        }else{
            //on renvoie sur la page precedente si une question n'a pas d'énoncé
            $_SESSION['errorQuiz'] = "Veuillez remplir l'énoncé des questions.";
            wp_redirect( home_url().'/create_quiz_2' );
        }
    }
    //quand toutes les questions/réponses on été traité on renvoie à la page suivante
    wp_redirect( home_url().'/create_quiz_3' );
    
} else {
    $_SESSION['errorQuiz'] = "Veuillez créer au moins 10 questions.";
    wp_redirect( home_url().'/create_quiz_2' );
    
    //ne pas afficher le bouton envoyer en ajax
    
?>
    
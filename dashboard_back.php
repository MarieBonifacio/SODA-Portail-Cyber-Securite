<?php
//header('content-type:application/json');

require('app/class/answer.class.php');
require('app/class/question.class.php');
require('app/class/quiz.class.php');
require('app/class/quiz_score.class.php');
require('app/class/tag.class.php');
require('app/class/module.class.php');
require('app/class/module_slide.class.php');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

$userId = $_SESSION['userConnected'];

//JSON ENCODE

    //classements par villes
    function getClassement($ville = null){
        $sql = "SELECT quiz_score.user_id,  quiz_score.score, wp_users.display_name  FROM  quiz_score,  wp_users, wp_usermeta WHERE quiz_score.user_id = wp_users.ID AND wp_users.ID = wp_usermeta.user_id ";

        if($ville != null){
            $sql .= "AND wp_usermeta.meta_key = 'location' AND wp_usermeta.meta_value='".$ville."'";
        }

        $sql .= "ORDER BY score DESC LIMIT 10";
        return $wpdb->get_results($sql);
    }

    //classements par utilisateur
    function getClassementById($id){
        $sql = "SELECT quiz_score.user_id,  quiz_score.score, wp_users.display_name  FROM  quiz_score,  wp_users, wp_usermeta WHERE quiz_score.user_id = wp_users.ID AND wp_users.ID = wp_usermeta.user_id ";

        if($ville != null){
            $sql .= "AND wp_usermeta.meta_key = 'location' AND wp_usermeta.meta_value='".$ville."'";
        }

        $sql .= "ORDER BY score DESC LIMIT 10";
        return $wpdb->get_results($sql);
    }


    //Derniers articles

    //Scores 

    //dernier quiz
function getLastQuiz(){ 
    global $wpdb;   
    $quiz = $wpdb->get_results( "SELECT id, name, tag_id, img_path FROM quiz ORDER BY created_at DESC LIMIT 1" );

    $score = null;
    $userId = $_SESSION['userConnected'];
    $score = $wpdb->get_row( "SELECT score, time FROM quiz_score where quiz_id = ".$quiz->id." AND user_id = ".$userId." ");

    $quizTmp = new Quiz();
    $quizTmp->selectById($quiz->id);  

    return array(

    );
}

$response['lastQuiz'] = getLastQuiz();
$response['classementVille'] = getClassement($ville);
echo getClassement('Calais').'<br/>';
echo getClassement().'<br/>';
//echo json_encode($response);

?>
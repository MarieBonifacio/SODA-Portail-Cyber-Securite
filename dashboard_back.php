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

    //classements par utilisateur
    function getClassement($userId, $ville=null){
        global $wpdb;
        $sql = "SELECT quiz_score.user_id, avg(quiz_score.score),  sum(quiz_score.time), count(quiz_score.id),  wp_users.display_name,  wp_usermeta.meta_value ";
        $sql .= "FROM quiz_score LEFT JOIN wp_users ON wp_users.ID = quiz_score.user_id LEFT JOIN wp_usermeta ON wp_usermeta.user_id = wp_users.ID AND wp_usermeta.meta_key = 'location' ";

        if($ville !== null){
            $sql .= "WHERE wp_usermeta.meta_value='".$ville."'";
        }

        $sql .= "group by quiz_score.user_id order by  count(quiz_score.id) DESC, avg(quiz_score.score) DESC, sum(quiz_score.time) DESC";
        
        
        $q = $wpdb->get_results($sql);

        $place = null;
        $userStat = null;
        if (array_search($userId, array_column($q,'user_id')) !== false){
            $place = array_search($userId, array_column($q,'user_id')) + 1;
            $userStat = $q[array_search($userId, array_column($q,'user_id'))];
        }

        return array(
            "top10" => array_slice($q, 0, 10),
            "userPlace" => $place,
            "userStat" => $userStat,
        );
    }


    //Derniers articles

    function getLastArticles(){

    }


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

print_r(getClassement(5,'Calais'));
/*
$response['lastQuiz'] = getLastQuiz();
$response['classementVille'] = getClassement($ville);
$response['classementGénéral'] = getClassementById($userId);

echo getClassement('Calais').'<br/>';
echo getClassement().'<br/>';
*/
//echo json_encode($response);

?>
<?php

header('content-type:application/json');



require('app/class/answer.class.php');

require('app/class/question.class.php');

require('app/class/quiz.class.php');

require('app/class/quiz_score.class.php');

require('app/class/tag.class.php');

require('app/class/module.class.php');

require('app/class/module_slide.class.php');



$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);

include($path.'wp-load.php');



if(!checkAuthorized(false, true)){

    wp_redirect( home_url() );  exit;

}



$userId = $_SESSION['userConnected'];



//JSON ENCODE



    //classements par utilisateur

    // function getUserClassement($userId = null, $ville=null, $limit=null){

    //     global $wpdb;

    //     $sql = "SELECT quiz_score.user_id, avg(quiz_score.score) AS moyenne,  sum(quiz_score.time) AS time, count(quiz_score.id) AS count,  wp_users.display_name,  wp_usermeta.meta_value ";

    //     $sql .= "FROM quiz_score LEFT JOIN wp_users ON wp_users.ID = quiz_score.user_id LEFT JOIN wp_usermeta ON wp_usermeta.user_id = wp_users.ID AND wp_usermeta.meta_key = 'location' ";



    //     if($ville !== null){

    //         $sql .= "WHERE wp_usermeta.meta_value='".$ville."'";

    //     }



    //     $sql .= "group by quiz_score.user_id ORDER BY avg(quiz_score.score) DESC, sum(quiz_score.time) ASC, count(quiz_score.id) DESC ";



    //     if($limit != null){

    //         $sql .= "LIMIT ".$limit;

    //     }



    //     $q = $wpdb->get_results($sql);



    //     $userQuery = $wpdb->get_row("SELECT wp_users.display_name AS name,  wp_usermeta.meta_value as city FROM quiz_score LEFT JOIN wp_users ON wp_users.ID = quiz_score.user_id LEFT JOIN wp_usermeta ON wp_usermeta.user_id = wp_users.ID AND wp_usermeta.meta_key = 'location' WHERE wp_users.ID='.$userId.'");



    //     $place = null;

    //     $userStat = null;

    //     if (array_search($userId, array_column($q,'user_id')) !== false){

    //         $place = array_search($userId, array_column($q,'user_id')) + 1;

    //         $userStat = $q[array_search($userId, array_column($q,'user_id'))];

    //     }



    //     return array(

    //         "classement" => array_slice($q, 0, 30),

    //         "userPlace" => $place,

    //         "userStat" => $userStat,

    //     );

    // }





    // classements par ville



    //ville/moyenne globale

    //ville//moyennes par quiz



    // function getCityClassement($quizId = null){

    //     global $wpdb;

    //     //Select la moyenne du score de la table quiz_score comme "moyenne" + la somme du temps dans la table quiz_score comme "temps" 

    //     //+ le nombre d'idi dans quiz_score comme "compteur de quizs" + le nom de la ville (meta value) dans la table wp_usermeta comme "ville"

    //     $sql = "SELECT avg(quiz_score.score) AS moyenne,  sum(quiz_score.time) AS time, count(quiz_score.id) AS quizCount, wp_usermeta.meta_value AS city ";

    //     //

    //     $sql .= "FROM quiz_score LEFT JOIN wp_users ON wp_users.ID = quiz_score.user_id LEFT JOIN wp_usermeta ON wp_usermeta.user_id = wp_users.ID AND wp_usermeta.meta_key = 'location' ";



    //     if($quizId !== null){

    //         $sql .= "WHERE quiz_score.quiz_id='".$quizId."'";

    //     }



    //     $sql .= "group by wp_usermeta.meta_value order by avg(quiz_score.score) DESC, sum(quiz_score.time) ASC, count(quiz_score.id) DESC";

        

    //     return $wpdb->get_results($sql);



    // }

  

// Tous les résultats de l'user



// function getUserResults($userId){

//     global $wpdb;

//     return $wpdb->get_results( "SELECT quiz.name, quiz_score.score, quiz_score.time FROM quiz_score left join quiz ON quiz_score.quiz_id = quiz.id WHERE quiz_score.user_id=$userId

//     " );



// }





    //dernier quiz

function getLastQuiz($userId){ 

    global $wpdb;   

    $quiz = $wpdb->get_row( "SELECT id, name, tag_id, img_path FROM quiz WHERE status=1 ORDER BY created_at DESC LIMIT 1" );



    $score= null;

    $score = $wpdb->get_row( "SELECT score, time FROM quiz_score where quiz_id = ".$quiz->id." AND user_id = ".$userId." ");



    $quizTmp = new Quiz();

    $quizTmp->selectById($quiz->id);  



    return array(

        "id" => $quizTmp->getId(),

        "name" => $quizTmp->getName(),

        "tag_id" => $quizTmp->getTag()->getId(),

        "tag_name" => $quizTmp->getTag()->getName(),

        "img" => $quizTmp->getImgPath(),

        "user_score" => $score->score,

        "user_time" => $score->time,

    );

}



$str_json = file_get_contents('php://input'); //($_POST doesn't work here)

$response = json_decode($str_json, true); // decoding received JSON to array



$userId = $_SESSION['userConnected'];

$ville = $wpdb->get_var("SELECT meta_value FROM wp_usermeta WHERE meta_key='location' AND user_id='".$userId."'");

$quizId = isset($response['quizId'])?$response['quizId']:null;



$response['ville']= $ville;

$response['lastQuiz'] = getLastQuiz($userId);



//dashboard user

$response['top30User'] = getUserClassement($userId, null, 30);

$response['top30UserVille'] = getUserClassement($userId, $ville, 30);

$response['userResults'] = getUserResults($userId);



//dashboard admin

$response['classementVilleGeneral'] = getCityClassement();

$response['classementUser'] = getUserClassement();



//$response['classementUserVille'] = getUserClassement($userId, $ville);

//$response['classementUserGeneral'] = getUserClassement($userId);

//$response['classementVilleQuiz'] = getCityClassement($quizId);

//$response['classementVilleGeneral'] = getCityClassement();







echo json_encode($response);



?>
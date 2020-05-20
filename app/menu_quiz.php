<?php 

header('content-type:application/json');

require('app/class/answer.class.php');
require('app/class/question.class.php');
require('app/class/quiz.class.php');
require('app/class/quiz_score.class.php');
require('app/class/tag.class.php');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

if(!checkAuthorized(false, true)){
    wp_redirect( home_url() );  exit;
}

//JSON encode 

$quizs = $wpdb->get_results( "SELECT id, name, tag_id, img_path FROM quiz" );
$quizArray = [];
        foreach ($quizs as $q){
            $quizTmp = new Quiz();
            $quizTmp->selectById($q->id);
            
            $quiz = array(
                "id" => $quizTmp->getId(),
                "name" => $quizTmp->getName(),
                "tag_id" => $quizTmp->getTag()->getId(),
                "tag_name" => $quizTmp->getTag()->getName(),
                "img" => $quizTmp->getImgPath(),
            );
 $quizArray[] = $quiz;
}

echo json_encode($quizArray);
?>

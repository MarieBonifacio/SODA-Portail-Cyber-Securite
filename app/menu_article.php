<?php 

header('content-type:application/json');

require('app/class/answer.class.php');
require('app/class/question.class.php');
require('app/class/quiz.class.php');
require('app/class/quiz_score.class.php');
require('app/class/tag.class.php');
require('app/class/user.class.php');
require('app/class/article.class.php');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

//JSON encode 

$quizs = $wpdb->get_results( "SELECT id, title, content, view, tag_id, img_path FROM quiz" );
$quizArray = [];
        foreach ($article as $a){
            $articleTmp = new Article();
            $articleTmp->selectById($q->id);
            
            $quiz = array(
                "id" => $articleTmp->getId(),
                "title" => $articleTmp->getTitle(),
                "content" => $articleTmp->getContent(),
                "tag_id" => $articleTmp->getTag()->getId(),
                "tag_name" => $articleTmp->getTag()->getName(),
                "img" => $articleTmp->getImgPath(),
            );
 $quizArray[] = $quiz;
}

echo json_encode($quizArray);
?>

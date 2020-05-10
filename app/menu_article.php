<?php 

header('content-type:application/json');

require('app/class/answer.class.php');
require('app/class/question.class.php');
require('app/class/quiz.class.php');
require('app/class/quiz_score.class.php');
require('app/class/tag.class.php');
require('app/class/article.class.php');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

if(!checkAuthorized(false, true)){
    wp_redirect( home_url() );  exit;
}

//JSON encode 

$articles = $wpdb->get_results( "SELECT id, title, content, view, tag_id, img_path, author_id FROM quiz" );
$articleArray = [];
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
                "author_id" => $articleTmp->getAuthor()->getId(),
                "author_name" => $articleTmp->getAuthor()->getName()
            );
 $articleArray[] = $quiz;
}

echo json_encode($articleArray);
?>

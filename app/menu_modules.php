<?php 

header('content-type:application/json');

require('app/class/answer.class.php');
require('app/class/question.class.php');
require('app/class/quiz.class.php');
require('app/class/quiz_score.class.php');
require('app/class/tag.class.php');
require('app/class/user.class.php');
require('app/class/module.class.php');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

//JSON encode 

$modules = $wpdb->get_results( "SELECT id, title, content,tag_id, img_path, author_id FROM module" );
$moduleArray = [];
        foreach ($modules as $q){
            $moduleTmp = new Module();
            $moduleTmp->selectById($q->id);
            
            $module = array(
                "id" => $articleTmp->getId(),
                "title" => $articleTmp->getTitle(),
                "content" => $articleTmp->getContent(),
                "tag_id" => $articleTmp->getTag()->getId(),
                "tag_name" => $articleTmp->getTag()->getName(),
                "img" => $articleTmp->getImgPath(),
                "view" => $articleTmp->getView(),
                "author_id" => $articleTmp->getAuthor()->getId(),
                "author_name" => $articleTmp->getAuthor()->getName()
            );
 $moduleArray[] = $module;
}

echo json_encode($moduleArray);
?>

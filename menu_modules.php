<?php 

header('content-type:application/json');

require('app/class/tag.class.php');
require('app/class/module.class.php');
require('app/class/module_slide.class.php');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

//JSON encode 

$modules = $wpdb->get_results( "SELECT id, title, content,tag_id, img_path, author_id FROM module" );
$moduleArray = [];
        foreach ($modules as $m){
            $moduleTmp = new Module();
            $moduleTmp->selectById($m->id);
            
            $module = array(
                "id" => $moduleTmp->getId(),
                "title" => $moduleTmp->getTitle(),
                "content" => $moduleTmp->getContent(),
                "tag_id" => $moduleTmp->getTag()->getId(),
                "tag_name" => $moduleTmp->getTag()->getName(),
                "img" => $moduleTmp->getImgPath(),
                "author_id" => $moduleTmp->getAuthor(),
                "author_name" => get_user_meta($moduleTmp->getAuthor(), 'first_name', true) . ' ' . get_user_meta($moduleTmp->getAuthor(), 'last_name', true),
            );
 $moduleArray[] = $module;
}
echo json_encode($moduleArray);
?>

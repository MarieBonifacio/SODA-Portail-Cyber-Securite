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
            $moduleProg = 0;
            $moduleTmp = new Module();
            $moduleTmp->selectById($m->id);
            $userId = $_SESSION['userConnected'];
            $moduleId = $m->id;
            $query = $wpdb->get_var("SELECT id FROM module_finish WHERE user_id = ".$userId." AND module_id = ".$moduleId." ");
            if($query > 0){
                $moduleProg = 100;
            }else{
                $userProgress = $swpdb->get_var("SELECT count(*) FROM module_progress WHERE user_id = ".$userId." AND module_id = ".$moduleId." ");
                $moduleNbSlides = $swpdb->get_var("SELECT count(*) FROM module_slide WHERE module_id = ".$moduleId." ");
                $moduleProg = ceil(($userProgress * 100)/$moduleNbSlides);
            }

            
            $module = array(
                "id" => $moduleTmp->getId(),
                "title" => $moduleTmp->getTitle(),
                "content" => $moduleTmp->getContent(),
                "tag_id" => $moduleTmp->getTag()->getId(),
                "tag_name" => $moduleTmp->getTag()->getName(),
                "img" => $moduleTmp->getImgPath(),
                "author_id" => $moduleTmp->getAuthor(),
                "author_name" => get_user_meta($moduleTmp->getAuthor(), 'first_name', true) . ' ' . get_user_meta($moduleTmp->getAuthor(), 'last_name', true),
                "user_prog" => $moduleProg,
            );
 $moduleArray[] = $module;
}
echo json_encode($moduleArray);
?>

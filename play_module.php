<?php
require('app/class/module.class.php');
require('app/class/module_slide.class.php');
require('app/class/tag.class.php');


$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

//JSON encode 
$module = new Module();
$module->selectById($_GET['id']);

$moduleId = $module->getId();
$pages = $wpdb->get_results( "SELECT * FROM module_slide WHERE module_id='$moduleId' ORDER BY 'order' DESC");
print_r($moduleId);
    $module = array(
        'id' => $module->getId(),
        'title' => $module->getTitle(),
        'tag_id' => $module->getTag()->getId(),
        'img' => $module->getImgPath(),
        'player' => $_SESSION['userConnected'],
    );
    foreach($pages as $p){
        $page = array(  
            "id" => $p->id,
            "module_id" => $p->module_id,
            "content" => $p->content,
            "img_path" => $p->img_path,
            "order" => $p->order,
        );
        $module['slides'][] = $page;
    }

    $userId = $_SESSION['userConnected'];
    $query = $wpdb->get_results("SELECT slide_id FROM module_progress WHERE id_user= '$userId' AND module_id = '$moduleId'");
    $previous = array();
    foreach($query as $q)
    {
        $previous[] = array(
            "id_module" => $q->module_id,
            "id_slide" => $q->slide_id
        );
    }
    $module["previous"] = $previous;


echo json_encode($module);

?>
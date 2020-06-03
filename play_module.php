<?php
require('app/class/module.class.php');
require('app/class/module_slide.class.php');
require('app/class/tag.class.php');
require('app/class/quiz.class.php');


$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

if(!checkAuthorized(false, true)){
    wp_redirect( home_url() );  exit;
}

//JSON encode
$module = new Module();
$module->selectById($_GET['id']);

$moduleId = $module->getId();
$pages = $wpdb->get_results( "SELECT * FROM module_slide WHERE module_id='$moduleId' ORDER BY 'order' DESC");
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
            "title" => $p->title,
            "module_id" => $p->module_id,
            "content" => nl2br($p->content),
            "img_path" => $p->img_path,
            "video" => $p->url,
            "order" => $p->order,
        );
        $module['slides'][] = $page;
    }
/////
$quizQuery = $wpdb->get_results("SELECT id_quiz FROM module_quiz WHERE id_module='$moduleId'");
$quizInfo = array();
foreach($quizQuery as $q){
    $quizRelated = new Quiz();
    $quizRelated->selectById($q->id_quiz);
    $quizInfo[] = $quizRelated->getInfos($_SESSION['userConnected']);
}
$module["quizs"] = $quizInfo;
/////
$userId = $_SESSION['userConnected'];
$query = $wpdb->get_results("SELECT slide_id FROM module_progress WHERE user_id= '$userId' AND module_id = '$moduleId'");
$previous = array();
foreach($query as $q)
{
    $slideId = $q->slide_id;
    $order = $wpdb->get_var("SELECT `order` FROM module_slide WHERE id='$slideId'");
    $previous[] = array(
        "id_module" => $moduleId,
        "id_slide" => $slideId,
        "order" => $order,
    );
}
$module["previous"] = $previous;


echo json_encode($module);

?>

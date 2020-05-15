<?php
define('WP_USE_THEMES', false);
$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

require('./class/quiz.class.php');
require('./class/question.class.php');
require('./class/answer.class.php');
require('./class/tag.class.php');

//http://localhost/SODA/wp-content/themes/SODA-Portail-Cyber-Securite/app/module_edit.php?id=XX
if(isset($_GET['id'])){
    global $wpdb;
    $quizId = $_GET['id'];
    if(isset($_SESSION['quizData'])){
        unset($_SESSION['quizData']);
    }
    $_SESSION['quizEdit'] = true;

    $quiz = new Quiz();
    $quiz->selectById($quizId);

    $_SESSION['quizData']['quiz'] = array (
        'id' => $quiz->getId(),
        'title'=> $quiz->getName(),
        'theme'=> $quiz->getTag()->getId(),
        'img'=> $quiz->getImgPath()
        "moduleRelated" => $quiz
    );

    $slides = $wpdb->get_results("SELECT * FROM module_slide WHERE module_id=".$moduleId." ORDER BY `order`");
    $_SESSION['formModuleStep2']['nbrPage'] = count($slides);
    foreach($slides as $key => $slide){
        $page['info']['id'] = $slide->id;
        $page['info']['title'] = $slide->title;
        $page['info']['content'] = $slide->content;
        $page['info']['url'] = $slide->url;
        $page['info']['img'] = $slide->img_path;
        $page['info']['order'] = $slide->order;
        
        $i = $key + 1;
        $_SESSION['formModuleStep2']['content_'.$i.'_title'] = $slide->title;
        $_SESSION['formModuleStep2']['content_'.$i] = $slide->content;
        $_SESSION['formModuleStep2']['content_'.$i.'_video'] = $slide->url;

        $_SESSION['moduleData']['pages'][] = $page;
    }

    wp_redirect(home_url().'/creationmoduleetape1/');
}else{
    wp_redirect(home_url());
}
?>
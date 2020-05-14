<?php
define('WP_USE_THEMES', false);
require('class/module.class.php');
require('class/module_slide.class.php');
require('class/tag.class.php');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

if(!checkAuthorized(true)){
    wp_redirect( home_url() );  exit;
}

/* SAVE TO BDD  */
if(!empty($_SESSION['userConnected']))
{
    $id = $_SESSION['userConnected'];
}

if($_SESSION['moduleEdit'] === true){
    $newModule = new Module();
    $newModule->selectById($_SESSION['moduleData']['module']['id']);
}else{
    $newModule = new Module();
}
//recuperation module
$newModule->setTitle($_SESSION['moduleData']['module']['title']);

$tag = new Tag();
$tag->selectByName($_SESSION['moduleData']['module']['theme']);
$newModule->setTag($tag);
$newModule->setAuthor($_SESSION['userConnected']);
$newModule->setImgPath($_SESSION['moduleData']['module']['img']);
$t = $newModule->save();
if($_SESSION['moduleEdit']){
    $newModuleId = $_SESSION['moduleData']['module']['id'];
}else{
    $newModuleId = $wpdb->insert_id;
}

$wpdb->delete('module_slide', array('module_id' => $newModuleId));
   

//recupération slides
foreach($_SESSION['moduleData']['pages'] as $m)
{
    $newSlide = new ModuleSlide();
    $newSlide->setModuleId($newModuleId);
    $newSlide->setContent($m['info']['content']);
    $newSlide->setTitle($m['info']['title']);
    $newSlide->setOrder($m['info']['order']);
    $newSlide->setImgPath($m['info']['img']);
    $newSlide->setUrl($m['info']['video']);
    $newSlide->save();
    $newSlideId = $wpdb->insert_id;

}
unset($_SESSION['moduleData']);
$_SESSION['moduleEdit'] = false;
wp_redirect( home_url().'/menu-module' );

?>
<?php
define('WP_USE_THEMES', false);
require('class/user.class.php');
require('class/module.class.php');
require('class/module_slide.class.php');
require('class/tag.class.php');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

/* SAVE TO BDD  */
if(!empty($_SESSION['userConnected']))
{
    $id = $_SESSION['userConnected'];
}
//recuperation module
$newModule = new Module();
$newModule->setTitle($_SESSION['moduleData']['module']['title']);

$tag = new Tag();
$tag->selectByName($_SESSION['moduleData']['module']['theme']);
$newModule->setTag($tag);
$newModule->setAuthor($_SESSION['userConnected']);
$newModule->setImgPath($_SESSION['moduleData']['module']['img']);
$t = $newModule->save();
$newModuleId = $wpdb->insert_id;



//recupération slides
foreach($_SESSION['moduleData']['pages'] as $m)
{
    $newSlide = new ModuleSlide();
    $newSlide->setModuleId($newModuleId);
    $newSlide->setContent($m['info']['content']);
    $newSlide->setTitle($m['info']['title']);
    $newSlide->setOrder($m['info']['order']);
    $newSlide->setImgPath($m['info']['img']);
    $newSlide->save();
    $newSlideId = $wpdb->insert_id;

}

wp_redirect( home_url().'/menu-module' );

?>
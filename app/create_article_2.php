<?php
define('WP_USE_THEMES', false);
require('class/article.class.php');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

if(!checkAuthorized(true)){
    wp_redirect( home_url() );  exit;
}

//enregistrement en db

if(!empty($_SESSION['userConnected']))
{
    $id = $_SESSION['userConnected'];
    $userConnected = new User();
    $userConnected->selectById($id);
}

//recuperation article

$newArticle = new Article();
$newArticle->setTitle($_SESSION['article']['title']);

$tag = new Tag();
$tag->selectByName($_SESSION['article']['theme']);
$newQuiz->setTag($tag);


?>
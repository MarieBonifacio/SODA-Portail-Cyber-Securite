<?php /* Template Name: test*/
header('content-type:application/json');

require('app/class/answer.class.php');
require('app/class/question.class.php');
require('app/class/quiz.class.php');
require('app/class/quiz_score.class.php');
require('app/class/user.class.php');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

//JSON encode 


$quizs = $wpdb->get_results( "SELECT id, name, tag_id, img_path FROM quiz" );
$quizArray = [];
foreach ($quizs as $q){
  $quiz = array(
     "id" => $q->id,
     "name" => $q->name,
     "tag_id" => $q->tag_id,
     "img" => $q->img_path,
  );
 $quizArray[] = $quiz;
}

echo json_encode($quizArray);
?>
<?php
require('app/class/answer.class.php');
require('app/class/question.class.php');
require('app/class/quiz.class.php');
require('app/class/quiz_score.class.php');
require('app/class/tag.class.php');

$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

if(!checkAuthorized(false, true)){
    wp_redirect( home_url() );  exit;
}

$str_json = file_get_contents('php://input');
$response = json_decode($str_json, true);
$id_quiz = $response['id_quiz'];
$id_user = $response['id_user'];

$query = $wpdb->get_results("SELECT id_question, id_answer, time FROM quiz_progress WHERE id_user= '$id_user' AND id_quiz = '$id_quiz'");

$result = array(
    "questions" => array(),
    "good" => 0,
    "score" => 0,
    "time" => 0,
);
$questionsGood = 0;
$maxTime = 0;

// echo "id quiz : ".$id_quiz."<br/>";
// echo "id user : ".$id_user."<br/>";
// print_r($query);echo "<br/>";
// echo "<hr/>";

foreach($query as $q)
{
    // echo "<hr/>";
    // echo "process : ".$q->id_question."<br/>";
    $questionId = $q->id_question;
    $answersTrue = $wpdb->get_results("SELECT id, is_true FROM answer WHERE id_question='$questionId' and (is_true='true' or is_true=1)");
    // echo "SELECT id, is_true FROM answer WHERE id_question='".$questionId."' and is_true='true'<br/>";
    // print_r($answersTrue);echo "<br/>";
    $answersUser = json_decode($q->id_answer);
    // print_r($answersUser);echo "<br/>";

    $question = array(
        "id" => $questionId,
        "content" => $wpdb->get_var("SELECT content FROM question WHERE id='$questionId'"),
        "answers" => $wpdb->get_results("SELECT id, content, is_true FROM answer WHERE id_question='$questionId'"),
        "user_answer" => $answersUser,
        "good" => false,

    );


    if($q->time > $maxTime){
        $maxTime = $q->time;
    }

    // echo "nb good answer : ".count($answersTrue)."<br/>";
    // echo "=> "; print_r($answersTrue);echo "<br/>";
    // echo "nb user answer : ".count($answersUser)."<br/>";
    // echo "=> "; print_r($answersUser);echo "<br/>";

    if(count($answersUser) != count($answersTrue)){
        $result['questions'][] = $question;
        continue;
    }

    $allGood = true;
    foreach ($answersTrue as $a) {
        if(!in_array((int)$a->id, $answersUser)) {
            // echo gettype($a->id)."<br/>";
            // echo gettype($answersUser[0])."<br/>";
            // echo $a->id." not in<br/>";
            $allGood = false;
        }
    }

    if($allGood){
        // echo 'good<br/>';
        $questionsGood++;
        $question['good'] = true;
    }

    $result['questions'][] = $question;
}

$quiz = new Quiz();
$quiz->selectById($response['id_quiz']);

$score = round(100/count($query) * $questionsGood);

$newScore = new Quiz_score();
$newScore->setUserId($id_user);
$newScore->setQuizId($quiz);
$newScore->setScore($score);
$newScore->setTime($maxTime);
$newScore->save();

$result['score'] = $score;
$result['time'] = $maxTime;
$result['good'] = $questionsGood;

// echo "<br/>";
// echo "<hr/>";
// echo "<pre>";
// print_r($result);
// echo "</pre>";
// echo "<br/>";
// echo "<hr/>";

$wpdb->delete( 'quiz_progress' ,
    array(
        'id_user' => $id_user,
        'id_quiz' => $id_quiz,
    )
);

echo json_encode($result);
?>

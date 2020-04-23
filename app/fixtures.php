<?php
define('WP_USE_THEMES', false);
$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

require('./class/answer.class.php');
require('./class/question.class.php');
require('./class/quiz.class.php');
require('./class/quiz_score.class.php');
require('./class/tag.class.php');


$users = array();
$tags = array();
$quizs = array();
$questions = array();
$answers = array();


//CREATE USERS
add_user_meta(1, 'location', 'Calais');
add_user_meta(1, 'id_alc', '111111');
add_user_meta(1, 'avatar', "default.jpg");


for($i = 0; $i < 10; $i++){
    $userdata = array(
        'first_name' =>   'firstname_'.$i,
        'last_name' =>   'lastname_'.$i,
        'user_login' =>   'test_'.$i.'@test'.$i.'.com',
        'user_email' =>   'test_'.$i.'@test'.$i.'.com',
        'user_pass' =>   'test.TEST.123',
    );

    $location = array("Auxerre", "Bielsko-Biala", "Bordeaux", "Boulogne-Sur-Mer", "Caen", "Calais", "Caldas da Rainha", "Châteauroux", "Cracovie", "Guimarães", "Île de France", "Lisbonne", "Nevers", "Poitiers", "Porto", "Porto Ferreira Dias", "Stalowa Wola", "Tauxigny", "Tunis", "Varsovie", "Villeneuve d\'Ascq");
    $idLocation = ($i % 2 == 0);
    $users[] = wp_insert_user( $userdata );

    add_user_meta($user, 'location', $location[$idLocation]);
    add_user_meta($user, 'id_alc', '12345'.$i);
    add_user_meta($user, 'avatar', "default.jpg");
}

//CREATE TAG
    $t = new Tag();
    $t->setName('tag_'.$i);
    $tags[] = $t->save();
}


//CREATE QUIZS
for($i = 0; $i < 10; $i++){
    $tid = rand (0, 9);
    $uid = rand (0, 9);

    $t = new Tag();
    $t->selectById($tags[$tid]);

    $q = new Quiz();
    $q->setName('quiz_'.$i);
    $q->setTag($t);
    $q->setImgPath('default.jpg');
    $q->setAuthor($users[$uid]);
    $quizId = $q->save();

    $quizs[] = $quizId;

//CREATE QUESTIONS
    for ($k = 0; $k < 5 ; $k++) {
        $q = new Question();
        $q->setIdQuiz($quizId);
        $q->setContent('quiz_'.$quizId.'_question_'.$k);
        $q->setImgPath('default.jpg');
        $q->setPoints(20);
        $qId = $q->save();
        
        $questions[] = $qid;

//CREATE ANSWERS
        for ($j = 0; $j < 4; $j++) {
            $a = new Answer();
            $a->setIdQuestion($qId);
            $a->setContent('question_'.$qId.'_answer_'.$j);
            $a->setIsTrue(($j == 2)?true:false);
            $answers[] = $a->save();
        }
    }
}

//CREATE QUIZS_SCORE
foreach ($users as $u => $userId) {
    for ($i = 0; $i < $u+1 ; $i++) {
        $qz = new Quiz();
        $qz->selectById($quizs[$i]);

        $qs = new Quiz_score();
        $qs->setUserId($userId);
        $qs->setQuizId($qz);
        $qs->setScore(rand(0,100));
        $qs->setTime(rand(0,100));

        $qs->save();
    }
}

?>

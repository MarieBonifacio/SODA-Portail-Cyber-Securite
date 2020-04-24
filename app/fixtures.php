<?php
define('WP_USE_THEMES', false);
$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

require('./class/answer.class.php');
require('./class/question.class.php');
require('./class/quiz.class.php');
require('./class/quiz_score.class.php');
require('./class/tag.class.php');
require('./class/module.class.php');
require('./class/module_slide.class.php');

function delTree($dir) {
    $files = array_diff(scandir($dir), array('.','..'));
    foreach ($files as $file) {
        (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
    }
    return rmdir($dir);
}

function clean(){
    global $wpdb;
    $wpdb->query($wpdb->prepare( "DELETE FROM answer"));
    $wpdb->query($wpdb->prepare( "DELETE FROM module"));
    $wpdb->query($wpdb->prepare( "DELETE FROM module_finish"));
    $wpdb->query($wpdb->prepare( "DELETE FROM module_progress"));
    $wpdb->query($wpdb->prepare( "DELETE FROM module_slide"));
    $wpdb->query($wpdb->prepare( "DELETE FROM question"));
    $wpdb->query($wpdb->prepare( "DELETE FROM quiz"));
    $wpdb->query($wpdb->prepare( "DELETE FROM quiz_progress"));
    $wpdb->query($wpdb->prepare( "DELETE FROM quiz_score"));
    $wpdb->query($wpdb->prepare( "DELETE FROM tag"));

    $wpdb->query($wpdb->prepare( "DELETE FROM wp_users WHERE ID != 1"));
    $wpdb->query($wpdb->prepare( "DELETE FROM wp_usermeta WHERE user_id != 1 OR meta_key = 'location' OR meta_key = 'id_alc' OR meta_key = 'avatar' OR meta_key = 'notification'"));

    delTree('../img/quizs');
    delTree('../img/modules');
}

function createUsers(){
    $users = array();
    add_user_meta(1, 'location', 'Calais');
    add_user_meta(1, 'id_alc', '111111');
    add_user_meta(1, 'avatar', "default.jpg");
    add_user_meta(1, 'notification', date("Y-m-d H:i:s"));
    for($i = 0; $i < 20; $i++){
        $userdata = array(
            'first_name' =>   'firstname_'.$i,
            'last_name' =>   'lastname_'.$i,
            'user_login' =>   'test_'.$i.'@test'.$i.'.com',
            'user_email' =>   'test_'.$i.'@test'.$i.'.com',
            'user_pass' =>   'test.TEST.123',
        );

        $location = array("Auxerre", "Bielsko-Biala", "Bordeaux", "Boulogne-Sur-Mer", "Caen", "Calais", "Caldas da Rainha", "Châteauroux", "Cracovie", "Guimarães", "Île de France", "Lisbonne", "Nevers", "Poitiers", "Porto", "Porto Ferreira Dias", "Stalowa Wola", "Tauxigny", "Tunis", "Varsovie", "Villeneuve d\'Ascq");
        $idLocation = rand(0,2);
        $userId = wp_insert_user( $userdata );
        $users[] = $userId;

        add_user_meta($userId, 'location', $location[$idLocation]);
        add_user_meta($userId, 'id_alc', '12345'.$i);
        add_user_meta($userId, 'avatar', "default.jpg");
        add_user_meta($userId, 'notification', date("Y-m-d H:i:s"));
        if($i == 0){
            $v = ["administrator" =>true];
            update_user_meta( $userId, 'wp_capabilities', $v );
            update_user_meta( $userId, 'wp_user_level', '10' );
        }
    }
    return $users;
}

function createTags(){
    $tags = array();
    for($i = 0; $i < 4; $i++){
        $t = new Tag();
        $t->setName('tag_'.$i);
        $tags[] = $t->save();
    }
    return $tags;
}

function createQuizs($users, $tags){
    mkdir('../img/quizs/', 0775, true);
    $quizs = array();
    for($i = 0; $i < 10; $i++){
        $tid = rand (0, 3);
        $uid = rand (0, 19);

        $t = new Tag();
        $t->selectById($tags[$tid]);

        $q = new Quiz();
        $q->setName('quiz_'.$i);
        $q->setTag($t);
        $q->setImgPath('image.jpg');
        $q->setAuthor($users[$uid]);
        $quizId = $q->save();

        $quizs[] = $quizId;

        $path = "../img/quizs/quiz_".$i;
        mkdir($path, 0775, true);
        copy('../img/fall.jpg', $path.'/image.jpg');
    }
    return $quizs;
}

function createQuestions($quizs){
    $questions = array();
    foreach ($quizs as $key => $quiz) {
        for ($k = 0; $k < 5 ; $k++) {
            $q = new Question();
            $q->setIdQuiz($quiz);
            $q->setContent('quiz_'.$quiz.'_question_'.$k);
            $q->setImgPath('default.jpg');
            $q->setPoints(20);
            $questions[] = $q->save();
        }
    }
    return $questions;
}

function createAnswers($questions){
    $answers = array();
    foreach ($questions as $key => $question) {
        $good = rand(0,3);
        for ($j = 0; $j < 4; $j++) {
            $a = new Answer();
            $a->setIdQuestion($question);
            $a->setContent('question_'.$question.'_answer_'.$j);
            $a->setIsTrue(($j == $good)?true:false);
            $answers[] = $a->save();
        }
    }
    return $answers;
}

function createScore($users, $quizs){
    foreach ($users as $u => $userId) {
        for ($i = 0; $i < 5 ; $i++) {
            $qz = new Quiz();
            $qz->selectById($quizs[$i]);

            $qs = new Quiz_score();
            $qs->setUserId($userId);
            $qs->setQuizId($qz);
            $qs->setScore(rand(0,5)*20);
            $qs->setTime(rand(0,100));

            $qs->save();
        }
    }
}

function createQuizsProgress($quizs, $users){
    global $wpdb;
    foreach ($users as $u => $userId) {
        for ($i = 5; $i < count($quizs); $i++) {
            $limit = rand(1,4);
            $quizId = $quizs[$i];
            $quiz = new Quiz();
            $quiz->selectById($quizId);

            $questions=  $wpdb->get_results("SELECT * FROM question WHERE id_quiz=".$quizId." LIMIT ".$limit."");

            $time = 5;
            foreach ($questions as $question) {
                $questionId = $question->id;

                $answer = $wpdb->get_row("SELECT * FROM answer WHERE id_question=".$questionId." ORDER BY RAND() LIMIT 1");
                $answerId = $answer->id;

                $time += 5;

                $wpdb->insert(
                    'quiz_progress', array(
                        "id_quiz" => $quizId,
                        "id_user" => $userId,
                        "id_question" => $questionId,
                        "id_answer" => $answerId,
                        "time" => $time,
                    )
                );
            }
        }
    }
}

function createModules($users, $tags){
    mkdir('../img/modules/', 0775, true);
    $modules = array();
    for($i = 0; $i < 10; $i++){
        $tid = rand (0, 3);
        $uid = rand (0, 19);

        $t = new Tag();
        $t->selectById($tags[$tid]);

        $m = new Module();
        $m->setTitle('module_'.$i);
        $m->setContent('');
        $m->setTag($t);
        $m->setImgPath('image.jpg');
        $m->setAuthor(1);
        $moduleId = $m->save();

        $modules[] = $moduleId;

        $path = "../img/modules/module_".$i;
        mkdir($path, 0775, true);
        copy('../img/fall.jpg', $path.'/image.jpg');
    }

    return $modules;
}

function createSlides($modules){
    $slides = array();

    foreach ($modules as $key => $m) {
        for ($i=0; $i < 4; $i++) {
            $slide = new ModuleSlide();
            $slide->setModuleId($m);
            $slide->setTitle('module_'.$key.'_slide_'.$i);
            $slide->setImgPath('default.jpg');
            $slide->setContent("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.");
            $slide->setOrder($i);
            $slideId = $slide->save();

            $slides[] = $slideId;
        }
    }

    return $slides;
}

function createModuleFinish($users, $modules){
    global $wpdb;
    foreach ($users as $key => $u) {
        for ($i=0; $i < 5 ; $i++) {
            $moduleId = $modules[$i];
            $wpdb->insert(
                'module_finish', array(
                    "user_id" => $u,
                    "module_id" => $moduleId,
                )
            );
        }
    }
}

function createModuleProgress($users, $modules, $slides){
    global $wpdb;
    foreach ($users as $u => $userId) {
        for ($i = 5; $i < count($modules); $i++) {
            $moduleId = $modules[$i];
            for ($j=0; $j < 4; $j++) {
                $slideId = $slides[$j];
                $wpdb->insert(
                    'module_progress', array(
                        "user_id" => $u,
                        "module_id" => $moduleId,
                        "slide_id" => $slideId,
                    )
                );
            }
        }
    }
}

clean();

$users = createUsers();
$tags = createTags();

$quizs = createQuizs($users, $tags);
$questions = createQuestions($quizs);
$answers = createAnswers($questions);
createScore($users, $quizs);
createQuizsProgress($quizs, $users);

$modules = createModules($users, $tags);
$slides = createSlides($modules);
createModuleFinish($users, $modules);
createModuleProgress($users, $modules, $slides);
?>

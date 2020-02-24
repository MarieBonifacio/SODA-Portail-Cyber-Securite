<?php
$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

class Quiz_score {
    private $id;
    private $user_id;
    private $quiz_id;
    private $score;
    private $time;
    private $date;

    public function selectById($id){
        global $wpdb;
        $r = $wpdb->get_row("SELECT * FROM 'quiz_score' where id=".$id."");
        $this->id = $r->id;
        $this->user_id = (new User())->selectById($r->id);
        $this->quiz_id = (new Quiz())->selectById($r->id);
        $this->score = $r->score;
        $this->time = $r->time;
        $this->date = $r->date;
    }

    public function getId(){
        return $this->id;
    }

    public function getUserId(){
        return $this->user_id;
    }
    public function setUserId($user_id){
        $this->user_id = $user_id;
    }

    //Set user_id with id of user
    public function setUserIdById(int $UserId){
        $this->user_id = new User();
        $this->user_id->selectById($UserId);
    }


    public function getQuizId(){
        return $this->quiz_id;
    }
    public function setQuizId($quiz_id){
        $this->quiz_id = $quiz_id;
    }

    //Set quiz_id with id of quiz
    public function setQuizIdById(int $quizId){
        $this->quiz_id = new User();
        $this->quiz_id->selectById($quizId);
    }


    public function getScore(){
        return $this->score;
    }
    public function setScore($score){
        $this->score = $score;
    }

    public function getTime(){
        return $this->time;
    }
    public function setTime($time){
        $this->time = $time;
    }

    public function getDate(){
        return $this->date;
    }
    public function setDate($date){
        $this->date = $date;
    }


    public function save(){
        if ($this->id != null){
            global $wpdb;
            $wpdb->insert(
                'quiz_score', array(
                    "id" => $this->id,
                    "user_id" => $this->user_id;
                    "quiz_id" => $this->quiz_id;
                    "score" => $this->score;
                    "time" => $this->time;
                    "date" => $this->date;
            ));
        }else{
            global $wpdb;
            $wpdb->update(
                'quiz_score', array(
                    "user_id" => $this->user_id;
                    "quiz_id" => $this->quiz_id
                    "score" => $this->score;
                    "time" => $this->time;
                    "date" => $this->date;
            ), array(
                "id" => $this->id,
            ));
            
        }
    }

    public function delete(){
        global $wpdb;
        $wpdb->delete( 'quiz_score', array( 'id' => $id ) );
    }

    //moyenne globale de toutes les notes tous utilisateurs compris
    public function globalAverage(){
        global $wpdb;

        return $wpdb->get_var( "SELECT AVG(`score`) from quiz_score" );
    }
    
    //Moyenne de l'utilisateur sur tous les quizs
    public function userAverage($id_user){
        global $wpdb;

        return $wpdb->get_var( "SELECT AVG(`score`) from quiz_score  where user_id =".$user_id."" );
    }
 
    //Moyenne des utilisateurs sur un quiz
    public function quizAverage($id_quiz){
        global $wpdb;

        return $wpdb->get_var( "SELECT AVG(`score`) from quiz_score  where quiz_id =".$quiz_id."" );
    }


    //Moyenne par locatiçon sur tous les quizs
    public function locationAverage($location){
        global $wpdb;

        return $wpdb->get_var( "SELECT AVG(`score`) from quiz_score  inner join user on quiz_score.user_id = user.id where `location` =".$location."" );
    }


    //Classement par score global
    public function orderByGlobalScore(){
        global $wpdb;

        $wpdb->get_result( "SELECT * from quiz_score order by score");
    }

    //Classement sur un quiz
    public function orderByQuizScore($quizId){
        global $wpdb;

        $wpdb->get_result( "SELECT * from quiz_score where quiz_id =".$quiz_id." order by score");
    }

    //Classement par lieux    
    public function orderByLocationScore($location){
        global $wpdb;

        $wpdb->get_result(" SELECT * from quiz_score inner join user on quiz_score.user_id = user.id where `location` =".$location." order by `score`");
    }
}


//faire moyennes globales et par quiz

?>
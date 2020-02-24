<?php
global $wpdb;
$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

class Question {

    private $id;
    private $id_quiz;
    private $content;
    private $points;

    public function selectById($id){
        global $wpdb;
        $r = $wpdb->get_row("SELECT * FROM 'question' where id=".$id."");
        $this->id = $r->id;
        $this->id_quiz = (new Quiz())->selectById($r->id);
        $this->content = $r->content;
        $this->points = $r->points;
    }

    public function getId(){
        return $this->id;
    }

    public function getIdQuiz(){
        return $this->id_quiz;
    }
    public function setIdQuiz($id_quiz){
        $this->id_quiz = $id_quiz;
    }

    //Set id_Quiz with id of quiz
    public function setIdQuizById(int $idQuiz){
        $this->id_quiz = new quiz();
        $this->id_quiz->selectById($idQuiz);
    }

    public function getContent(){
        return $this->content;
    }
    public function setContent($content){
        $this->content = $content;
    }

    public function getViewt(){
        return $this->view;
    }
    public function setView($view){
        $this->view = $view;
    }

    public function save(){
        if ($this->id == null){
            global $wpdb;
            $wpdb->insert(
                'question', array(
                    "id" => $this->id,
                    "id_quiz" => $this->id_quiz;
                    "content" => $this->content;
                    "points" => $this->points;
                    )
                );
        }else{
            global $wpdb;
            $wpdb->update(
                'question', array(
                    "id_quiz" => $this->id_quiz;
                    "content" => $this->content;
                    "content" => $this->content;
                ), array(
                    "id" => $this->id,
                )
            );
        }
    }

    public function delete(){
        global $wpdb;
        $wpdb->delete( 'question', array( 'id' => $id ) );
    }
}

?>
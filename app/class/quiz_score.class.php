<?php

class Article {
    private $id;
    private $title;
    private $content;
    private $view;
    private $authorId;
    private $createdAt;

    public function getId(){
        return $this->id;
    }

    public function getTitle(){
        return $this->title;
    }
    public function setTitle($title){
        $this->name = $title;
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

    public function getAuthorId(){
        return $this->authorId;
    }
    public function setMail($authorId){
        $this->authorId = $authorId;
    }

    public function getCreatedAt(){
        return $this->created_at;
    }
    public function setCreatedAt($created_at){
        $this->created_at = $created_at;
    }


    public function save(){
        if ($this->id != null){
            global $wpdb;
            $wpdb->insert('article', array(
            "id"  => $this->id,
            "title" => $this->title;
            "content" => $this->content;
            "view" => $this->view;
            "authorId" => $this->authorId;
            "created_at" => $this->created_at;
            ));
        }else{
            global $wpdb;
            $wpdb->update('article', array(
                "id"  => $this->id,
                "title" => $this->title;
                "content" => $this->content;
                "view" => $this->view;
                "authorId" => $this->authorId;
                "created_at" => $this->created_at;
            ));
            
        }
    }

    public static function delete(){
        global $wpdb;
        $wpdb->delete( 'user', array( 'id' => $id ) );
    }
}

?>
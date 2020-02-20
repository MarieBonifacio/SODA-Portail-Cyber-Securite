<?php

<<<<<<< HEAD
=======
class Module {
    private $id;
    private $title;
    private $content;
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
            $wpdb->insert('module', array(
            "id"  => $this->id,
            "title" => $this->title;
            "content" => $this->content;
            "authorId" => $this->authorId;
            "created_at" => $this->created_at;
            ));
        }else{
            global $wpdb;
            $wpdb->update('module', array(
                "id"  => $this->id,
                "title" => $this->title;
                "content" => $this->content;
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
>>>>>>> classes

?>
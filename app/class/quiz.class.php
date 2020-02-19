<?php

class Quiz {
    private $id;
    private $name;
    private $author;
    private $created_at;

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }
    public function setName($name){
        $this->name = $name;
    }

    public function getAuthor(){
        return $this->author;
    }
    public function setAuthor($author){
        $this->author = $author;
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
            $wpdb->insert('quiz', array(
                "id" => $this->$id,
                "name" => $this->$name,
                "author" => $this->$author,
                "created_at" => $this->$createdAt
            ))
        }else{
            global $wpdb;
            $wpdb->update('quiz', array(
                "id" => $this->$id,
                "name" => $this->$name,
                "author" => $this->$author,
                "created_at" => $this->$createdAt
            ))
        }
    }
    
    public function delete(){
        global $wpdb;
        $wpdb->delete( 'user', array( 'id' => $id ) );
    }
}

?>
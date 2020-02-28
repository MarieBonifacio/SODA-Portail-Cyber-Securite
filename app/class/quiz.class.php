<?php
global $wpdb;
$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

class Quiz {

    private $id;
    private $name;
    private $tag_id;
    private $img_path;
    private $author;
    private $created_at;

    public function selectById($id){
        global $wpdb;
        $r = $wpdb->get_row("SELECT * FROM quiz where id='".$id."'");
        $this->id = $r->id;
        $this->name = $r->name;
        $this->tag_id = (new Tag())->selectById($r->id);
        $this->img_path = $r->img_path;
        $this->author = (new User())->selectById($r->id);
        $this->createAt = $r->created_at;
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }
    public function setName($name){
        $this->name = $name;
    }

    public function getTagId(){
        $this->tag_id->$tag_id;
    }

    public function setTagId($tag_id){
        $this->tag_id = $tag_id;
    }

    public function getImgPath(){
        $this->img_path->$img_path;
    }

    public function setImgPath($img_path){
        $this->img_path = $img_path;
    }

    public function getAuthor(){
        return $this->author;
    }
    public function setAuthor($author){
        $this->author = $author;
    }

    //Set author with id of author
    public function setAuthorById(int $authorId){
        $this->author = new User();
        $this->author->selectById($authorId);
    }

    public function getCreatedAt(){
        return $this->created_at;
    }
    public function setCreatedAt($created_at){
        $this->created_at = $created_at;
    }

    public function save(){
        if ($this->id == null){
            global $wpdb;
            $this->created_at = (new DateTime())->format('Y-m-d H:i:s');
            $wpdb->insert(
                'quiz', array(
                    "id" => $this->id,
                    "name" => $this->name,
                    "tag_id" => $this->tag_id,
                    "img_path" => $this->img_path,
                    "author" => $this->author,
                    "created_at" => $this->created_at
                )
            );
        }else{
            global $wpdb;
            $wpdb->update(
                'quiz', array(
                    "name" => $this->name,
                    "tag_id" => $this->tag_id,
                    "img_path" => $this->img_path,
                    "author" => $this->author,
                    "created_at" => $this->created_at
                ), array(
                    "id" => $this->$id,
                )
            );
        }
    }
    
    public function delete(){
        global $wpdb;
        $wpdb->delete( 'quiz', array( 'id' => $id ) );
    }
}

?>
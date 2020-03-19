<?php
global $wpdb;
$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

class Article {

    private $id;
    private $title;
    private $content;
    private $tag;
    private $img_path;
    private $view;
    private $author;
    private $created_at;


    // $article = new Article()
    public function __construct(){

    }

    //
    public function selectById($id){
        $r = $wpdb->get_row("SELECT * FROM 'article' where id=".$id."");
        $this->id = $r->id;
        $this->title = $r->title;
        $this->content = $r->content;
        $tagId = new tag();
        $tagId->selectById($r->tag_id);
        $this->tag = $tagId;
        $this->img_path = $r->img_path;
        $this->view = $r->$view;
        $author = new User();
        $author->selectById($r->author_id);
        $this->author = $author;
        $this->created_at = $r->created_at;
    }

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

    public function getTag(){
        return $this->tag;
    }

    public function setTag($tag){
        $this->tag = $tag;
    }

    public function getImgPath(){
        return $this->imgPath;
    }
    public function setImgPath($imgPath){
        $this->imgPath = $imgPath;
    }

    public function getView(){
        return $this->view;
    }
    public function setView($view){
        $this->view = $view;
    }

    public function getAuthor(){
        return $this->author;
    }
    //Set author with instance of author
    public function setAuthor(User $author){
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
                'article', array(
                    "title" => $this->title,
                    "content" => $this->content,
                    "tag_id" => $this->tag->getId(),
                    "img_path" => $this->img_path,
                    "view" => $this->view,
                    "author_id" => $this->author->getId(),
                    "created_at" => $this->created_at,
                    )
                );
        }else{
            global $wpdb;
            $wpdb->update(
                'article', array(
                    "title" => $this->title,
                    "content" => $this->content,
                    "tag_id" => $this->tag->getId(),
                    "img_path" => $this->img_path,
                    "view" => $this->view,
                    "author_id" => $this->author->getId(),
                    "created_at" => $this->created_at,
                ), array(
                    "id" => $this->id,
                )
            ); 
        }
    }

    public function delete(){
        global $wpdb;
        $wpdb->delete( 'article', array( 'id' => $id ) );
    }

    public function print(){
        return '
            <div>
                <h2>'.$this->title.'</h2>
                <p>'.$this->content.'</p>
                <p>'.$this->author->getName().'</p>
            </div>
        ';
    }

    public function printIndex(){
        return '
            <div>
                <h2>'.$this->title.'</h2>
                <p>'.$this->views.'</p>
                <p>'.$this->author->getName().'</p>
                <p>'.substr($this->content, 0, 100).'...</p>
            </div>
        ';
    }
}

?>

<?php

$_POST['title']
$_POST['content']

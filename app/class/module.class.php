<?php

class Module {
    private $id;
    private $title;
    private $content;
    private $imgPath;
    private $author;
    private $createdAt;



    public function selectById($id){
        $r = $wpdb->get_row("SELECT * FROM 'module' where id=".$id."");
        $this->id = $r['id'];
        $this->title = $r['title'];
        $this->content = $r['content'];
        $this->imgPath = $r['img_path'];
        $this->author = (new User())->selectById($r->id);
        $this->createAt = $r['create_at'];
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

    public function getImgPath(){
        return $this->imgPath;
    }
    public function setImgPath($imgPath){
        $this->imgPath = $imgPath;
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
        if ($this->id != null){
            global $wpdb;
            $wpdb->insert(
                'module', array(
                    "id"  => $this->id,
                    "title" => $this->title,
                    "content" => $this->content,
                    "img_path" => $this->imgPath,
                    "author_id" => $this->author->getId(),
                    "created_at" => $this->created_at,
                    )
                );
        }else{
            global $wpdb;
            $wpdb->update(
                'module', array(
                    
                    "title" => $this->title,
                    "content" => $this->content,
                    "img_path" => $this->imgPath,
                    "author_id" => $this->author->getId(),
                    "created_at" => $this->created_at,
                ), array(
                    "id"  => $this->id,
                )
            );
        }
    }

    public static function delete(){
        global $wpdb;
        $wpdb->delete( 'user', array( 'id' => $id ) );
    }

    public function printIndex(){
        return '
            <div>
                <h2>'.$this->title.'</h2>
            </div>
        ';
    }
}

?>
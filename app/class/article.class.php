<?php

class Article {
    private $id;
    private $title;
    private $content;
    private $view;
    private $author;
    private $createdAt;


    // $article = new Article()
    public function __construct(){

    }

    //
    public function selectById($id){
        $r = $wpdb->get_row("SELECT * FROM 'article' where id=".$id."");
        $this->id = $r['id'];
        $this->title = $r['title'];
        $this->content = $r['content'];
        $this->view = $r['view'];
        $this->author = (new User())->selectById($r['id']);
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

    public function getViewt(){
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
        if ($this->id != null){
            global $wpdb;
            $wpdb->insert(
                'article', array(
                    "id"  =>  $this->id,
                    "title" => $this->title,
                    "content" => $this->content,
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
                    "view" => $this->view,
                    "author_id" => $this->author->getId(),
                    "created_at" => $this->created_at,
                ), array(
                    "id"  =>  $this->id,
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
                <p>vues</p>
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

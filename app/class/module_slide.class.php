<?php
global $wpdb;
$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');


class ModuleSlide {
    private $id;
    private $module_id;
    private $title;
    private $img_path;
    private $content;
    private $order;


    public function selectById($id){
        $r = $wpdb->get_row("SELECT * FROM 'module_slide' where id=".$id."");
        $this->id = $r->id;
        $moduleId = new Module();
        $moduleId = selectById($r->module_id);
        $this->module_id = $moduleId;
        $this->title = $r->title;
        $this->content = $r->content;
        $this->img_path = $r->img_path;
    }

    public function getId(){
        return $this->id;
    }

    public function getModuleId(){
        return $this->moduleId;
    }
    public function setModuleId($moduleId){
        $this->module_id = $moduleId;
    }

    public function getTitle(){
        return $this->title;
    }
    public function setTitle($title){
        $this->title = $title;
    }

    public function getImgPath(){
        return $this->img_path;
    }
    public function setImgPath($img_path){
        $this->img_path = $img_path;
    }

    public function getContent(){
        return $this->content;
    }
    public function setContent($content){
        $this->content = $content;
    }

    public function getOrder(){
        return $this->order;
    }
    public function setOrder($order){
        $this->order= $order;
    }



    public function save(){
        if ($this->id == null){
            global $wpdb;
            $wpdb->insert('module_slide', array(
            "module_id" => $this->module_id,
            "title" => $this->title,
            "img_path" => $this->img_path,
            "content" => $this->content,
            "order" => $this->order,
            ));
        }else{
            global $wpdb;
            $wpdb->update('module_slide', array(
                "module_id" => $this->module_id,
                "title" => $this->title,
                "content" => $this->content,
                "order" => $this->order,
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
}

?>
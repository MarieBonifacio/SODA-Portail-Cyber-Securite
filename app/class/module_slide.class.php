<?php

class ModuleSlide {
    private $id;
    private $moduleId;
    private $title;
    private $content;
    private $order;

    public function getId(){
        return $this->id;
    }

    public function getModuleId(){
        return $this->moduleId;
    }
    public function setModuleId($moduleId){
        $this->moduleId = $moduleId;
    }

    public function getTitle(){
        return $this->title;
    }
    public function setTitle($title){
        $this->title = $title;
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
        if ($this->id != null){
            global $wpdb;
            $wpdb->insert('module_slide', array(
            "id"  => $this->id,
            "moduleId" => $this->moduleId;
            "title" => $this->title;
            "content" => $this->content;
            "order" => $this->order;
            ));
        }else{
            global $wpdb;
            $wpdb->update('module_slide', array(
                "id"  => $this->id,
                "moduleId" => $this->moduleId;
                "title" => $this->title;
                "content" => $this->content;
                "order" => $this->order;
            ));
            
        }
    }

    public static function delete(){
        global $wpdb;
        $wpdb->delete( 'user', array( 'id' => $id ) );
    }
}

?>
<?php

class Quiz {
    private $id;
    private $userId;
    private $moduleId;
    private $slideId;

    public function getId(){
        return $this->id;
    }

    public function getUserId(){
        return $this->userId;
    }
    public function setUserId($userId){
        $this->userId = $userId;
    }

    public function getModuleId(){
        return $this->moduleId;
    }
    public function setModuleId($moduleId){
        $this->moduleId = $moduleId;
    }

    public function getMail(){
        return $this->mail;
    }
    public function setMail($mail){
        $this->mail = $mail;
    }

    public function getPassword(){
        return $this->password;
    }
    public function setPassword($password){
        $this->paswword = $password;
    }

    public function getLocation(){
        return $this->location;
    }
    public function setLocation($location){
        $this->location = $location;
    }

    public function getCreatedAt(){
        return $this->created_at;
    }
    public function setCreatedAt($created_at){
        $this->created_at = $created_at;
    }


    public function save(){
        $servername = "localhost";
        $username = "username";
        $password = "password";
        $conn = new mysqli($servername, $username, $password);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        echo "Connected successfully";
        /*
        si $this->id != null
            enregistrer en bdd
        sinon
            update
        */
        if ($this->id != null){
            INSERT INTO user ($id, $role, $name, $lastName, $mail, $password, $location, $created_at);
        }else{
            
        }
    }

    public static function delete(){

    }
}

?>
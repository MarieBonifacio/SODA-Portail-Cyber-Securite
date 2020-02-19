<?php

class Quiz {
    private $id;
    private $role;
    private $name;
    private $lastName;
    private $mail;
    private $password;
    private $location;
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

    public function getlastName(){
        return $this->lastName;
    }
    public function setlastName($lastName){
        $this->lastname = $lastName;
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
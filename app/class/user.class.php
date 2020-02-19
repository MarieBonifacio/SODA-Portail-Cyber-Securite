<?php
global $wpdb;

class User {
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
        if ($this->id != null){
            global $wpdb;
            $wpdb->insert('user', array(
            "id"  => $this->id,
            "role" => $this->role;
            "name" => $this->name;
            "lastName" => $this->lastName;
            "mail" => $this->mail;
            "password" => $this->password;
            "location" => $this->location;
            "created_at" => $this->created_at;
            ));
        }else{
            global $wpdb;
            $wpdb->update('user', array(
            "id"  => $this->id,
            "role" => $this->role;
            "name" => $this->name;
            "lastName" => $this->lastName;
            "mail" => $this->mail;
            "password" => $this->password;
            "location" => $this->location;
            "created_at" => $this->created_at;
            ));
            
        }
    }

    public static function delete(){
        global $wpdb;
        $wpdb->delete( 'user', array( 'id' => $id ) );
    }
}

?>
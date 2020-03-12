<?php
$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

class User {
    
    private $id;
    private $role;
    private $name;
    private $lastName;
    private $mail;
    private $password;
    private $location;
    private $idUser;
    private $imgPath;
    private $created_at;
    
    public function selectById($id){
        global $wpdb;
        $r = $wpdb->get_row("SELECT * FROM user where id='".$id."'");
        $this->id = $r->id;
        $this->role = $r->role;
        $this->name = $r->name;
        $this->lastName= $r->last_name;
        $this->mail = $r->mail;
        $this->password = $r->password;
        $this->location = $r->location;
        $this->idUser = $r->id_number;
        $this->imgPath = $r->img_path;
        $this->created_at = $r->created_at;
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

    public function getLastName(){
        return $this->lastName;
    }
    public function setLastName($lastName){
        $this->lastName = $lastName;
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
        $this->password = password_hash($password,PASSWORD_BCRYPT);
    }

    public function getLocation(){
        return $this->location;
    }
    public function setLocation($location){
        $this->location = $location;
    }

    public function getIdUser(){
        return $this->idUser;
    }
    public function setIdUser($idUser){
        $this->idUser = $idUser;
    }

    public function getImgPath(){
        return $this->imgPath;
    }
    public function setImgPath($imgPath){
        $this->imgPath = $imgPath;
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
                'user', array(
                    "role" => $this->role,
                    "name" => $this->name,
                    "last_name" => $this->lastName,
                    "mail" => $this->mail,
                    "password" => $this->password,
                    "location" => $this->location,
                    "id_number" => $this->idUser,
                    "img_path" => $this->imgPath,
                    "created_at" => $this->created_at,
                )
            );
        }else{
            global $wpdb;
            $wpdb->update(
                'user', array(
                    "role" => $this->role,
                    "name" => $this->name,
                    "last_name" => $this->lastName,
                    "mail" => $this->mail,
                    "password" => $this->password,
                    "location" => $this->location,
                    "id_number" => $this->idUser,
                    "img_path" => $this->imgPath,
                    "created_at" => $this->created_at,
                ), array(
                    "id" => $this->id,
                )
            );  
        }
    }

    public function delete(){
        global $wpdb;
        $wpdb->delete( 'user', array( 'id' => $id ) );
    }
//Affichage user    
    public function print(){
        return '
            <div>
                <p>'.$this->name.'<p>
                <p>'.$this->lastName.'</p>
                <p>'.$this->location.'</p>
                <p>'.$this->idUser.'</p>
            </div>
        ';
    }
}

?>
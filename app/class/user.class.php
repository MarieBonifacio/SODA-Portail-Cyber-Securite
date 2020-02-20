<?php
global $wpdb;
require('../../../../wp-load.php');
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
        $test = 
        $r = $wpdb->get_row("SELECT * FROM 'user' where id=".$id."");
        echo '---'.$test.'---';
        $this->id = $r['id'];
        $this->title = $r['role'];
        $this->content = $r['name'];
        $this->view = $r['last_name'];
        $this->view = $r['mail'];
        $this->view = $r['password'];
        $this->view = $r['location'];
        $this->view = $r['id_number'];
        $this->view = $r['img_path'];
        $this->createAt = $r['created_at'];
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
        $this->paswword = password_hash($password,PASSWORD_BCRYPT);
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
    public function setIdNumber($idUser){
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
            $test = $wpdb->insert(
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

            echo '---'.$test.'---';
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
                    "id_user" => $this->idUser,
                    "img_path" => $this->imgPath,
                    "created_at" => $this->created_at,
                ), array(
                    "id" => $this->id,
                )
            );  
        }
        echo 'coucou';
    }

    public function delete(){
        global $wpdb;
        $wpdb->delete( 'user', array( 'id' => $id ) );
    }
//Affichage user    
    public function print(){
        return '
            <img src="'.$this->imgPath.'">
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
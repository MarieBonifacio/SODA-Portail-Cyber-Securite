<?php
define('WP_USE_THEMES', false);
global $wpdb;
require('class/user.class.php');
$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');




if(!empty($_POST['first_mail']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['id_user']) && !empty($_POST['location']))
{
    global $wpdb;

    $imgPath = $_FILES['avatar'];
    $mail = $_POST['first_mail'];
    $name = htmlspecialchars($_POST['first_name']);
    $lastName = htmlspecialchars($_POST['last_name']);
    $idUser = $_POST['id_user'];
    $location = $_POST['location'];

    $id = $_SESSION['userConnected'];
    $r = $wpdb->get_row("SELECT * FROM user where id='".$id."'");

    //si l'image n'existe pas en bdd
    if($r->img_path==null && !empty($_FILES['avatar']))
    {
        // //créer dossier image au nom de l'id de l'User
        // $directoryName = $r->id;
        // mkdir(public_path(home_url().'img/avatar/').$directoryName, 0775);
        //upload image 
        $content_dir = home_url().'img/avatar/';
        $tmp_file = $_FILES['avatar']['tmp_name'];
        if( !is_uploaded_file($tmp_file) )
        {
            $error="Le fichier est introuvable";
        }
        $type_file = $_FILES['fichier']['type'];
        if( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'png')) 
        {
            $error="Le format du fichier n'est pas pris en charge";
        }
        // on copie le fichier dans le dossier de destination
        $name_file = $r->id;

        if( !move_uploaded_file($tmp_file, $content_dir . $name_file) )
        { 
            $error = "Impossible de copier le fichier dans $content_dir";
        }
        $newUser = new User();
        $newUser->setImgPath($img);
        $newUser->save();

        $error = "Le fichier a bien été uploadé";

    } 
    elseif( !preg_match ( " /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ ", $mail))
    {
        $error = "L'adresse mail n'est pas valide.";
    }
    elseif( !preg_match("#^[0-9]{1,6}$# ", $idUser))
    {
        $error = "Votre identifiant n'est pas correct";
    }
    else
    {

        $newUser = new User();
        $newUser->setImgPath($imgPath);
        $newUser->setName($name);
        $newUser->setLastName($lastName);
        $newUser->setIdUser($idUser);
        $newUser->setMail($mail);
        $newUser->setLocation($location);
        $newUser->save();
        
        $error = "Modifications validées.";
    }

}
else
{
    $error = "Veuillez remplir tous les champs";
}


$_SESSION["errorRegister"] = $error;
echo $error;
// wp_redirect( home_url()."/profil" ); 

?>
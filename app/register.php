<?php
if(isset($_POST['first_mail']) AND isset($_POST['first_name']) AND isset($_POST['last_name']) AND isset($_POST['password']) AND isset($_POST['location'])){

    $mail = $_POST['mail'];
    $name = htmlspecialchars($_POST['name'];
    $lastName = htmlspecialchars($_POST['lastName'];
    $password = $_POST['password'];
    $location = $_POST['location'];

    $r = $wpdb->get_row("SELECT * FROM 'user' where mail="$mail"");

    if ( !preg_match ( " /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ " , $mail)){
        echo("L'adresse mail n'est pas valide.");
    }elseif(!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{10,}$#', $password)){
        echo("Votre mot de passe doit contenir au moins une majuscule, un chiffre et un caractère spécial.");
    }elseif($r==null){
        $newUser = new User();
        $newUser->setName($name);
        $newUser->setLastName($lastName);
        $newUser->setMail($mail);
        $newUser->setPassword($password);
        $newUser->setLocation($location);
        $newUser->save()
    }else{
        echo("Utilisateur déjà existant");
    }
}else{
    echo("Veuillez remplir tous les champs");
    header("Location:accueil");
}

?>
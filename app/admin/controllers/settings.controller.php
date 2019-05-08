<?php

use App\Models\Admin;

$adminModel = new Admin();

$admin = $adminModel->getAdmin();

if ($admin->role != 'administrator'){
    header("Location:admin.php?p=admin");
}

$admins = $adminModel->getAll();


// Ajout d'un modérateur

if(array_key_exists('submit', $_POST)) { // Recuperation des données du formulaire

    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $email_again = htmlspecialchars(trim($_POST['email_again']));
    $role = htmlspecialchars(trim($_POST['role']));
    $token = App::randomKeygen(20);

    $errors = [];

    // Vérification des données
    if (empty($name) || empty($email) || empty($email_again)) {
        $errors['empty'] = "Veuillez remplir tous les champs";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['invalide'] = "Votre adresse email n'est pas valide";
    }

    if ($email != $email_again) {
        $errors['different'] = "Les deux adresses email ne sont pas identiques";
    }

    if ($adminModel->email_taken($email) != false){
        $errors['taken'] = "Cette adresse email est déjà utilisée";
    }

    // Création du nouveau admin en BD
    if (empty($errors)){
        $adminModel->addAdmin($name, $email, $token, $role);

        // Envoi du token par email
        $subject = "Validation de compte | Ma Cuisine";
        $message = '
        <html lang="fr" style="font-family: sans-serif;">
            <head>
                <meta charset="UTF-8">
            </head>
            <body>
                Voici votre identifiant et mot de passe pour valider votre compte sur <a href="http://localhost/tp-3wa/public/admin.php?p=new">cette page</a>:
                <br/>Identifiant: '.$email.'
                <br/>Mot de passe: '.$token.'
                <br/>Vous êtes: '.$role.'
                <br/><br/>Après avoir inséré ces informations, vous devrez choisir un mot de passe.
            </body>
        </html>
    ';

        $header = "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html; charset=UTF-8\r\n";
        $header .= 'From: no-reply@macuisine.com' . "\r\n" . 'Reply-To: contact@macuisine.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion();

        mail($email,$subject,$message,$header);


    }

}
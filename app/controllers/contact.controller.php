<?php


if (array_key_exists('submit', $_POST)){

    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['comment']));

    $headers = 'FROM: $email';

    if (!empty($name) && !empty($email) && !empty($comment)){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)){
            mail('contact@macuisine.com', 'Formulaire de contact', $message, $headers);

            header("Location:index.php?p=contact");

        }
    }
}


App::setTitle('Contact');
<?php

use App\Models\Admin;

$_admin = new Admin();

/**
 * Si l'administrateur est déjà connecté, on le redirige ves la page admin
 */
if (isset($_SESSION['admin'])){
    header('Location:admin.php?p=admin');
}


if(isset($_POST['submit'])){
    $email= htmlspecialchars(trim($_POST['email']));
    $token= htmlspecialchars(trim($_POST['token']));

    $error = "";


    if($_admin->newModo($email,$token) === true){
        $_SESSION['admin'] = $email;
        header("Location:admin.php?p=password");
    }
    else {
        $error = "Les données introduites sont incorrectes";
    }
}


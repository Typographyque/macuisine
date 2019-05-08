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
    $password= htmlspecialchars(trim($_POST['password']));
    $error = "";

    $login = $_admin->login($email,$password);

    if($login == 1){
        $_SESSION['admin'] = $email;
        header("Location:admin.php?p=admin");
    }
    else {
        $error = "Les données introduites sont incorrectes";
    }
}


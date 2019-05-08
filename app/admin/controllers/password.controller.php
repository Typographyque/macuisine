<?php

use App\Models\Admin;

$_admin = new Admin();

$admin = $_admin->getAdmin();

if (!empty($admin->password)){
    header("Location:admin.php?p=admin");
}


if(isset($_POST['submit'])){
    $password= htmlspecialchars(trim($_POST['password']));
    $password_again= htmlspecialchars(trim($_POST['password_again']));

    $errors = [];

    if (empty($password) || empty($password_again)){
        $errors['empty'] = "Tous les champs n'ont pas été remplis";
    }

    if ($password != $password_again){
        $errors['differents'] = "Les deux champs doivent être identiques";
    }

    else {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $_admin->validateModo($password);

        header("Location:admin.php?p=admin");

    }


}


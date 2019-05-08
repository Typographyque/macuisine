<?php

use App\Models\Admin;

$adminModel = new Admin();

if (!empty($_POST)){

    $delete = $adminModel->removeAdmin($_POST['id']);

    header("Location:admin.php?p=settings");

}
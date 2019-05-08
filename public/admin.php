<?php

define('ROOT', dirname(__DIR__));
require ROOT . '/app/App.php';
App::load();

/**
 * Recupère la URL et la stocke dans une variable
 * si cette variable n'est pas définie, sa valeur par défaut est 'admin'
 * */
if(isset($_GET['p'])){
    $page = $_GET['p'];
} else {
    $page = 'admin';
}

if($page != 'login' && $page != 'validation' && !isset($_SESSION['admin'])){
    header('Location:admin.php?p=login');
}

if (file_exists(ROOT . "/app/admin/controllers/$page.controller.php")) {
    // chargement des controlleurs
    require ROOT . "/app/admin/controllers/$page.controller.php";
}

// si la page n'est pas trouvé on définie la page sur 404.phtml
if (!file_exists(ROOT . "/app/admin/views/$page.phtml")) {
    $page = 404;
}

/**
 * chargement du template
 * */
require ROOT . '/app/admin/views/templates/layoutadmin.phtml';

<?php

use App\Models\Category;
use App\Models\Recipe;


$categoryModel = new Category();

// Recuperation de la catégorie en cours

if(array_key_exists('id', $_GET)){

    $category = $categoryModel->getCategory($_GET['id']);

}

if ($category == null){
    header("Location:index.php?p=404");
}

// Recuperation de la liste de catégories

$categories = $categoryModel->getAll();


// Recuperation des recettes de la catégorie en cours

$recipeModel = new Recipe();

if(array_key_exists('id', $_GET)){

    $recipes = $recipeModel->getByCategory($_GET['id']);

}

App::setTitle($category->category_name);
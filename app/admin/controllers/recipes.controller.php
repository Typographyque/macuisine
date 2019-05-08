<?php
use App\Models\Recipe;
use App\Models\Category;


$recipeModel = new Recipe();
$categoryModel = new Category();


// Recuperation des dernières recettes

$recipes = $recipeModel->getAll();


// Recuperation de la liste de catégories

$categories = $categoryModel->getAll();




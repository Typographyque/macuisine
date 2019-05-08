<?php
use App\Models\Category;
use App\Models\Recipe;
use Lib\searcher;

$recipeModel = new Recipe();
$categoryModel = new Category();
$search = new searcher();




// Recuperation des dernières recettes

$recipes = $recipeModel->getLastPosted();




// Recuperation de la liste de catégories

$categories = $categoryModel->getAll();




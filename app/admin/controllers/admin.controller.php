<?php
use App\Models\Recipe;
use App\Models\Category;
use App\Models\Comment;


$recipeModel = new Recipe();
$categoryModel = new Category();
$commentModel = new Comment();


// Recuperation des dernières recettes

$recipes = $recipeModel->getLast();


// Recuperation de la liste de catégories

$categories = $categoryModel->getAll();


// Recuperation de la liste de commentaires

$comments = $commentModel->getUnread();


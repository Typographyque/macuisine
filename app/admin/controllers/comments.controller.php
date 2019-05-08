<?php
use App\Models\Comment;
use App\Models\Recipe;

$commentModel = new Comment();

$recipeModel = new Recipe();


// Recuperation de tous les commentaires

$comments = $commentModel->getAll();


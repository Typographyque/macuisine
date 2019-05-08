<?php
use App\Models\Recipe;

$recipeModel = new Recipe();

$recipes = $recipeModel->getAll();



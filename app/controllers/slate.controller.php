<?php
use App\Models\Recipe;

$recipeModel = new Recipe();

$pays = 'Argentine';

$recipes = $recipeModel->getByPays($pays);
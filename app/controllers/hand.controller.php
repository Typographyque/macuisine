<?php

use App\Models\Recipe;




$recipeModel = new Recipe();

$burgers = $recipeModel->getByCategory("5");

$pizzas = $recipeModel->getByCategory("6");

$sandwhichs = $recipeModel->getByCategory("7");


App::setTitle("Sur le pouce");
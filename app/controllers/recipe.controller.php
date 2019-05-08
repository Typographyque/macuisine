<?php

use App\Models\Recipe;
use App\Models\Comment;

//recupetion de la recette en cours

$recipeModel = new Recipe();


if(array_key_exists('id', $_GET)){

    $recipe = $recipeModel->getRecipe($_GET['id']);
}

if ($recipe == null){
    header("Location:index.php?p=404");
}

// Recuperation des commentaires de la recette en cours

$commentModel = new Comment();

if(array_key_exists('id', $_GET)){

    $comments = $commentModel->getByRecipe($_GET['id']);

}


// Envoi du formulaire des commentaires

if (array_key_exists('submit', $_POST)){

    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $comment = htmlspecialchars(trim($_POST['comment']));
    $recipe_id = $_GET["id"];

        if (!empty($name) && !empty($email) && !empty($comment)){
            if (filter_var($email, FILTER_VALIDATE_EMAIL)){
                $commentModel->addComment($name, $email, $comment, $recipe_id);

                header("Location:index.php?p=recipe&id=".$recipe_id);

            }
        }
    }



App::setTitle($recipe->title);
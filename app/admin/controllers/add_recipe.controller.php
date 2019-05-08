<?php
use App\Models\Recipe;
use App\Models\Category;

use App\Models\Admin;

$loginModel = new Admin();
$admin = $loginModel->getAdmin();



// Recuperation de la liste de catégories pour le sélect
$categoryModel = new Category();
$categories = $categoryModel->getAll();

// Recuperation des données du formulaire

if(array_key_exists('addRecipe', $_POST)){

    $title = htmlspecialchars(trim($_POST['title']));
    $ingredients = trim($_POST['ingredients']);
    $description = trim($_POST['description']);
    $category_id = $_POST['category_id'];
    $posted = isset($_POST['public']) ? "1" : "0";
    $picture = $_POST['picture'];
    $admin_id = $admin->id;

    $maxsize = '2000000';
    $error = "";

    // Verification et upload de l'image

    if (!empty($_FILES['picture']['name'])){
            $file = $_FILES['picture']['name'];
            $extensions = ['.png', '.jpg', '.jpeg', '.gif', '.PNG', '.JPG', '.JPEG', '.GIF'];
            $extension = strrchr($file, '.');
            if(!in_array($extension,$extensions)){
                $error = "Cette image n'est pas valable";
            }else{
                $tmp_name = $_FILES["picture"]["tmp_name"];
                $name = basename($_FILES["picture"]["name"]);
                move_uploaded_file($tmp_name, "../public/img/recipes/".$name);
            }
        }

    // Envoi des données de la recette en BDD

    $recipeModel = new Recipe();

        $id= $recipeModel->addRecipe($title, $description, $category_id, $ingredients, $picture, $posted, $admin_id);

        header("Location:admin.php?p=edit_recipe&id=".$id);

}
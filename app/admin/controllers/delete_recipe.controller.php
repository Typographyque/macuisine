
<?php
use App\Models\Recipe;

$recipeModel = new Recipe();

if (!empty($_POST)){

    $delete = $recipeModel->removeRecipe($_POST['id']);

    header("Location:admin.php?p=recipes");

}
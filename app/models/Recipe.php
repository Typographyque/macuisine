<?php

namespace App\Models;
use App;

Class Recipe {

      /////////////////////////
     // METHODES DE LECTURE //
    /////////////////////////

    /**
     * Recupère toutes les recettes
     * @return array
     */
    public function getAll(){
        return App::getDatabase()->query_all("
          SELECT *
          FROM recipes
          ORDER BY post_date DESC
        ");
    }

    public function getPosted(){
        return App::getDatabase()->query_all("
          SELECT *
          FROM recipes 
          WHERE posted='1'
        ");
    }

    public function getRecipe($id){
        return App::getDatabase()->query_one("
          SELECT recipes.id, title, post_date, recipes.description,  category_id, ingredients, picture, posted, category_id, category_name as categorie, admin_name as admin  
          FROM recipes 
          LEFT JOIN categories 
            ON recipes.category_id = categories.id
          LEFT JOIN admin 
            ON recipes.admin_id = admin.id
          WHERE recipes.id = ?
        ", [$id]);
    }

    public function getByCategory($category_id){
        return App::getDatabase()->query_all("
          SELECT recipes.id, title, recipes.description, picture, category_name as categorie 
          FROM recipes 
          LEFT JOIN categories 
            ON recipes.category_id = categories.id
          WHERE category_id = ? AND posted='1'
          ORDER BY recipes.post_date DESC 
        ", [$category_id]);
    }

    public function getByPays($pays){
        return App::getDatabase()->query_all("
          SELECT * 
          FROM recipes
          WHERE pays = ? AND posted='1'
          ORDER BY recipes.post_date DESC 
        ", [$pays]);
    }

    public function getLastPosted(){
        return App::getDatabase()->query_all("
          SELECT recipes.id, title, recipes.description, post_date, picture, category_name as categorie 
          FROM recipes 
          LEFT JOIN categories 
            ON recipes.category_id = categories.id
          WHERE posted='1'
          ORDER BY recipes.post_date DESC 
          LIMIT 10
        ");
    }

    public function getLast(){
        return App::getDatabase()->query_all("
          SELECT recipes.id, title, recipes.description, post_date, picture, category_name as categorie 
          FROM recipes 
          LEFT JOIN categories 
            ON recipes.category_id = categories.id
          ORDER BY recipes.post_date DESC 
          LIMIT 5
        ");
    }

    public function getUrl(){
        return 'index.php?p=recipe&id=' . $this->id;
    }


      /////////////////////////
     // METHODES D'ECRITURE //
    /////////////////////////

    public function removeRecipe($id){
        return App::getDatabase()->execute("
          DELETE
          FROM recipes
          WHERE id = ?
          ", [$id] );
    }

    public function updateRecipe($title, $description, $category_id, $ingredients, $picture, $posted, $id) {
        return App::getDatabase()->execute("
        UPDATE recipes
        SET title=?, post_date=NOW(), description=?, category_id=?, ingredients=?, picture=?, posted=?
        WHERE id=?
         ", [$title, $description, $category_id, $ingredients, $picture, $posted, $id]);
    }

        public function addRecipe($title, $description, $category_id, $ingredients, $picture, $posted, $admin_id){
        return App::getDatabase()->execute("
            INSERT INTO recipes 
            (title, post_date, description, category_id, ingredients, picture, posted, admin_id) 
            VALUES (?,NOW(),?,?,?,?,?,?)
        ", [$title, $description, $category_id, $ingredients, $picture, $posted, $admin_id]);
    }



}

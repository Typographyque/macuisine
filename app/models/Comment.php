<?php

namespace App\Models;
use App;


class Comment {


    /////////////////////////
    // METHODES DE LECTURE //
    /////////////////////////


    public function getAll(){
        return App::getDatabase()->query_all("
        SELECT comments.id, name, email, date, recipe_id, comment, title
        FROM comments
        JOIN recipes
        ON comments.recipe_id = recipes.id
        ORDER BY comments.id DESC
        ");
    }

    public function getUnread(){
        return App::getDatabase()->query_all("
        SELECT comments.id, name, email, date, recipe_id, comment, title
        FROM comments
        JOIN recipes
        ON comments.recipe_id = recipes.id
        WHERE seen = '0'
        ORDER BY date ASC 
        ");
    }

    public function getByRecipe($recipe_id){
        return App::getDatabase()->query_all("
        SELECT comments.id, name, comment, date, recipe_id AS recipe
        FROM comments
        LEFT JOIN recipes
          ON comments.recipe_id = recipes.id
        WHERE recipes.id = ?
        ORDER BY comments.date DESC 
        ", [$recipe_id]);
    }


    /////////////////////////
    // METHODES D'ECRITURE //
    /////////////////////////

    public function addComment($name, $email, $comment, $recipe_id){
        return App::getDatabase()->execute("
            INSERT INTO comments
            (name, email, comment, recipe_id, date)
            VALUES (?,?,?,?,NOW())",
         [$name, $email, $comment, $recipe_id]);
    }

    public function seeComment($id){
        App::getDatabase()->execute("
            UPDATE comments
            SET seen = '1'
            WHERE id = ?
            ",[$id]);
    }

    public function deleteComment($id){
        return App::getDatabase()->execute("
            DELETE FROM comments
            WHERE id = ?
            ",[$id]);
    }
}

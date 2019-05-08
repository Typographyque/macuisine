<?php

namespace App\Models;

use App;

Class Category {


    public function getCategory($id){
        return App::getDatabase()->query_one("
          SELECT *
          FROM categories 
          WHERE id = ?
        ", [$id]);
    }

    /**
     * Recupère toutes les catégories
     * @return array
     */
    Public function getAll(){
        return App::getDatabase()->query_all("
          SELECT *
          FROM categories 
        ");
    }


    public function addCategory($category_name){
        return App::getDatabase()->execute("
            INSERT INTO categories 
            (category_name) 
            VALUES (?)
        ", [$category_name]);
    }



    public function getUrl(){
        return 'index.php?p=category&id=' . $this->id;
    }
}


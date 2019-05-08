<?php

namespace Lib;
use App;

Class searcher{

    public function results($search){

        $where = "";

        $search = preg_split('/[\s\-]/', $search); //récupère les mots clés entre les espaces et les tirets

        $count_keywords = count($search); // conte le nombre de mots clés

        foreach ($search as $key=>$searches){

            $where = "description LIKE '%$searches%'";

            if ($key != ($count_keywords-1)){   //s'il y a plusieurs mots clés on rajoute 'AND' entre chacun

                $where .="AND";
            }

        }

        $results = App::getDatabase()->query_all("
            SELECT *
            FROM recipes
            WHERE $where
        ");

        return $results;

    }

}
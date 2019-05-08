<?php
use Lib\searcher;

$searcher = new searcher();

// Recherche
if (isset($_POST['submit'])){

    $errors = [];

    $search = htmlspecialchars(trim($_POST['search']));


    if (!empty($search)){

        if (strlen($search) >= 3){

            $searcher->results($search);

        }
    }

       $results = $searcher->results($search);

}

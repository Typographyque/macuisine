<?php

namespace App;

/**
 * Class Autoloader
 * Charge de manière dynamique les classes
 * Evite les conflits quand on utilise plusieurs autoloaders
 */
class Autoload{

    /**
     * Enregistre l'autoloader
     * Permet de creer, si besoin, plusieurs fonctions d'autochargement
     * @param (Magic constant) classe courante
     * @param (autoload) Function appelée
     */
    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * Inclue le fichier correspondant à la classe
     * @param $class Le nom de la classe à charger
     */
    static function autoload($class){
        if (strpos($class, __NAMESPACE__ . '\\') === 0){                        //Les clases doivent être dans le même namespaces que l'autoloader
            $class = str_replace(__NAMESPACE__ . '\\', '', $class);      //
            $class = str_replace('\\', '/', $class);
            require __DIR__ . '/' . $class . '.php';
        }
    }

}


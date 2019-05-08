<?php

use Lib\Database;

Class App{

    // Constantes de la configuration de la base de données
    const DB_NAME = 'cooking_recipes';
    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PASS = '';


    private static $database; // Sauvegarde la connexion à la base de données


    /**
     * @var string
     */
    private static $title = 'Ma Cuisine';

    /**
     * Charge les autoloaders
     * Demarre la sesion
     * */
    public static function load(){
        session_start();
        require ROOT . '/app/Autoload.php';
        App\Autoload::register();
        require ROOT . '/lib/Autoload.php';
        Lib\Autoload::register();
    }

    /**
     * Initialise la connexion à la base de données
     * @return Database
     */
    public static function getDatabase(){
        if(self::$database === null){
            self::$database = new Database(self::DB_NAME, self::DB_HOST, self::DB_USER, self::DB_PASS);
        }
        return self::$database;
    }

    public static function notFound(){
        header("HTTP/1.0 404 Not Found");
        header('Location:index.php?p=404');
    }

    /**
     * @return mixed
     */
    public static function getTitle()
    {
        return self::$title;
    }

    /**
     * @param mixed $title
     */
    public static function setTitle($title)
    {
        self::$title = $title . ' | ' . self::$title;
    }

    /**
     * @param $length
     * @return bool|string
     */
    public static function randomKeygen($length){
        $chars = "azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN0123456789";
        return substr(str_shuffle(str_repeat($chars,$length)),0,$length);
    }

    /**
     * @param $variable
     */
    public static function debug($variable){
        echo '<pre>' . print_r($variable, true) . '</pre>';
    }


}
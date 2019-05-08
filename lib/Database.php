<?php

namespace Lib;

use PDO;

class Database{

    private $db_name;
    private $db_host;
    private $db_user;
    private $db_pass;
    private $pdo;


    /**
     * Database constructor.
     * Appelé à chaque instanciation, permet d'initialiser les paramètres
     * @param string $db_name
     * @param string $db_host
     * @param string $db_user
     * @param string $db_pass
     */
    public function __construct($db_name, $db_host, $db_user, $db_pass)
    {
        $this->db_name = $db_name;
        $this->db_host = $db_host;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
    }


    /**
     * Établie la connexion à la base de données si cela n'est déjà fait
     */
    private function getPDO()
    {
        if($this->pdo === null){                                                                                  // Si $this->pdo n'est pas défini :
            $pdo = new PDO('mysql:dbname=' . $this->db_name . ';host=' . $this->db_host, $this->db_user, $this->db_pass, [        // alors, initialise PDO,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,                                                     // define les attributs
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
            ]);
            $this->pdo = $pdo;                                                                                  // stocke l'instance dans une variable

        }
        return $this->pdo;
    }



    public function query_all($sql, array $params = []) {
        $query = $this->getPDO()->prepare($sql);
        $query->execute($params);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function query_one($sql, array $params = []) {
        $query = $this->getPDO()->prepare($sql);
        $query->execute($params);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function get_row($sql, array $params = []) {
        $query = $this->getPDO()->prepare($sql);
        $query->execute($params);
        return $query->fetchColumn();
    }

    public function execute($sql, array $params = []) {
        $query = $this->getPDO()->prepare($sql);
        $query->execute($params);

        // retourne le numéro de l'id de la rernière ligne inséré dans la base,
        // pratique pour récupérer l'id d'un user qu'on viendrait de créer par exemple
        return $this->getPDO()->lastInsertId();
    }

}


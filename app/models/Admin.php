<?php

namespace App\Models;

use App;

class Admin
{

    public function isAdmin(){
        $email = $_SESSION['admin'];
        return App::getDatabase()->query_one("
                SELECT role
                FROM admin
                WHERE email = ?
                ", [$email]);
    }

    /**
     * @param $admin
     * @param $password
     * @return boolean
     */
    public function login($email, $password){
        $admin = App::getDatabase()->query_one("
                SELECT * 
                FROM admin 
                WHERE email = ?
                ", [$email]);

        return password_verify($password, $admin->password);
    }

    public function newModo($email, $token){
        $admin = App::getDatabase()->query_one("
                SELECT * 
                FROM admin 
                WHERE email = ?
                ", [$email]);

        if(!empty($admin)){
            if($admin->token === $token) {
                return true;
            }
        }

        return false;
    }


    /**
     * @param $password
     * @return string
     */
    public function validateModo($password){
        $email = $_SESSION['admin'];
        return App::getDatabase()->execute("
        UPDATE admin
        SET password = ?, token = null 
        WHERE email = ?
         ", [$password, $email]);
    }

    public function getAdmin(){
        $email = $_SESSION['admin'];
        return App::getDatabase()->query_one("
                SELECT *
                FROM admin
                WHERE email = ?
                ", [$email]);
    }

    public function getAll(){
        return App::getDatabase()->query_all("
          SELECT *
          FROM admin
          ORDER BY id
        ");
    }

    /**
     * @param $email
     * @return mixed
     */
    public function email_taken($email){
        return App::getDatabase()->query_one("
                SELECT id
                FROM admin 
                WHERE email = ?
                ", [$email]);
    }

    public function addAdmin($name, $email, $token, $role){
        return App::getDatabase()->execute("
            INSERT INTO admin 
            (admin_name, email, token, role) 
            VALUES (?,?,?,?)
        ", [$name, $email, $token, $role]);
    }

    public function removeAdmin($id){
        return App::getDatabase()->execute("
          DELETE
          FROM admin
          WHERE id = ?
          ", [$id] );
    }
}
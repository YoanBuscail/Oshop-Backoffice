<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class User extends CoreModel{

    private $email;
    private $password;
    private $firstname;
    private $lastname;
    private $role;
    private $status;


    public static function find($id){
        $pdo = Database::getPDO();

        $sql = 'SELECT * FROM `app_user` WHERE `id` =' . $id;

        $pdoStatement = $pdo->query($sql);

        $user = $pdoStatement->fetchObject('App\Models\User');

        // retourner le résultat
        return $user;
    }
    
    public static function findAll(){
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `app_user`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\User');

        return $results;
    }

    public function insert(){

    }

    public function update(){

    }

    public static function delete($id)
    {
        
    }

    public static function findByEmail($email){
        $pdo = Database::getPDO();
        $sql = "SELECT * FROM `app_user` WHERE `email` = :email";

        $preparedQuery = $pdo->prepare($sql);
        $preparedQuery->execute(['email'=> $email]);

        $result = $preparedQuery->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $user = new User();
            $user->email = $result['email'];
            $user->password = $result['password'];
            $user->firstname = $result['firstname'];
            $user->lastname = $result['lastname'];
            $user->role = $result['role'];
            $user->status = $result['status'];
            $user->id = $result['id'];

            return $user;
        } else {
            return false;
        }

    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of firstname
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */ 
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */ 
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }
}
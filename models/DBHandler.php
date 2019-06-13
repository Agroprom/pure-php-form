<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

/**
 * Description of DBHandler
 *
 * @author agroprom
 */
class DBHandler {
    
    private $_pdo;
    
    public function __construct(\PDO $pdo)
    {
        $this->_pdo = $pdo;
    }
    
    
    
    /**
     * 
     * @param string $login
     * @return array
     */
    public function getUser(string $login = null)
    {
        $result = false;
        if (!empty($login)) {
            $sth = $this->_pdo->prepare("SELECT * FROM `user` WHERE `login` = ?");
            $sth->execute(array($login));
            $result = $sth->fetch(\PDO::FETCH_ASSOC);
        } 
        
        if (empty($result['login'])) {
            $result = false;
        }
        return $result;
    }
    
    /**
     * 
     * @param string $email
     * @return array
     */
    public function getUserByEmail(string $email = null)
    {
        $result = false;
        if (!empty($email)) {
            $sth = $this->_pdo->prepare("SELECT * FROM `user` WHERE `email` = ?");
            $sth->execute(array($email));
            $result = $sth->fetch(\PDO::FETCH_ASSOC);
        } 
        
        if (empty($result['email'])) {
            $result = false;
        }
        return $result;
    }    
    
            
    /**
     * 
     * @param string $login
     * @param string $name
     * @param string $email
     * @param string $avatar
     * @param string $password
     */
    public function createUser(string $login, string $name, string $email, string $avatar, string $password) {
        if ($this->getUser($login) || $this->getUserByEmail($email)) {
           throw new \Exception("The user already exists!"); 
        }
        
        if (
              !Helper::validateLogin($login)
           || !Helper::validateName($name)     
           || !Helper::validateEmail($email)
           || !Helper::validatePassword($password)                        
                ) {
            throw new \Exception("Can't create user! One of parameters is wrong!");
        }
        
        try {
            $db = $this->_pdo->prepare("INSERT INTO `user`( `login`, `name`, `email`, `avatar`, `password`) VALUES (:login,:name,:email,:avatar,:password)");
            $db->bindParam(':login', $login);
            $db->bindParam(':name', $name);
            $db->bindParam(':email', $email);
            $db->bindParam(':avatar', $avatar);
            $passwordHash = password_hash($password, 1);
            $db->bindParam(':password', $passwordHash);
            $db->execute();
            
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
         
    }
    
    /**
     * 
     * @param string $login
     * @param string $password
     * @return boolean
     */
    public function login(string $login, string $password)
    {
       $user = $this->getUser($login);
       if ($user == false) {
           return false;
       }
       if (password_verify($password, $user['password'])) {
           return true;
       } else {
           return false;
       }
    }


}

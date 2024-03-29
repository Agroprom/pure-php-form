<?php

namespace app\models;

/**
 * 
 * Синглетон для подключения к БД
 * @author agroprom
 */

class DB {
    
    const DB_NAME = "routes";
    const DB_USER = "root";
    const DB_HOST = "localhost";
    const DB_PASS = "../avatar/";
        
    private static $_dbCon;
    
    /**
     * 
     * @param string $host
     * @param string $name
     * @param string $user
     * @param string $password
     */
    private function __construct($host, $name, $user, $password)
    {
        try {
            self::$_dbCon = new \PDO("mysql:host=" . $host . ";dbname=" . $name . ";charset=utf8", $user, $password);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    /**
     * 
     * @param string $host
     * @param string $name
     * @param string $user
     * @param string $password
     * @return PDO
     */
   public static function connect($host, $name, $user, $password)
   {
        if (is_null(self::$_dbCon)) {
            new self($host, $name, $user, $password);  
        }       
        return  self::$_dbCon;
    }
 
    private function __clone()
    {
    }

    private function __wakeup()
    {
    } 


   


}

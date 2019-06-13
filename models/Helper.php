<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

/**
 * Содержит необходимые проекту константы и вспомогательные методы
 *
 * @author agroprom
 */
class Helper {
    
const LOGIN_MIN_LENGTH = 3;
const LOGIN_MAX_LENGTH = 16;

const NAME_MIN_LENGTH = 3;
const NAME_MAX_LENGTH = 16;  

const EMAIL_MAX_LENGTH = 32;

const PASSWORD_MIN_LENGTH = 3;
const PASSWORD_MAX_LENGTH = 16;  

const UPLOAD_DIR = '../avatar/';
const MAX_IMAGE_SIZE = 1048576; 

    /**
     * 
     * @param string $login
     * @return boolean
     */
    public static function validateLogin(string $login)
    {
        $length = strlen($login);
        if($length<=self::LOGIN_MAX_LENGTH && $length >= self::LOGIN_MIN_LENGTH) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @param string $name
     * @return boolean
     */
    public static function validateName(string $name)
    {
        $length = strlen($name);
        if($length<=self::NAME_MAX_LENGTH && $length >= self::NAME_MIN_LENGTH) {
            return true;
        } else {
            return false;
        }    
    }
    
    /**
     * 
     * @param string $email
     * @return boolean
     */
    public static function validateEmail(string $email)
    {
       $length = strlen($email);
       if (filter_var($email, FILTER_VALIDATE_EMAIL)==true && $length <= self::EMAIL_MAX_LENGTH) {
           return true;
       } else {
           return false;
       }
    }
    
    /**
     * 
     * @param string $password
     * @return boolean
     */
    public static function validatePassword(string $password)
    {
        $length = strlen($password);
        if($length<=self::PASSWORD_MAX_LENGTH && $length >= self::PASSWORD_MIN_LENGTH) {
            return true;
        } else {
            return false;
        }        
    }


    
}

<?php

namespace app\models;

/**
 * 
 * Класс-переводчик. Массив $dictionary содержит пары ключ-значение фраз для которых 
 * необходим перевод. Сам ключ также является значением фразы на английском
 * В зависимости от установленного в куки языка возвращает либо ключ (английский вариант фразы)
 * либо значение (русский вариант фразы).
 * @author agroprom
 */
class Translator {
    
    const COOKIE_NAME = 'language';
    const EN = 'en';
    const RU = 'ru';
        

    private static $dictionary = [
        'Change Language' => 'Сменить Язык',
        'Simple Registration Form' => 'Простая Форма Регистрации',
        'Enter Login' => 'Введите Логин',
        'Enter Name' => 'Введите Имя',
        'Enter Email' => 'Введите Электронную Почту',
        'Enter Password' => 'Введите Пароль',
        'Submit' => 'Отправить',
        'Profile' => 'Профиль',
        'Login' => 'Логин',
        'Name' => 'Имя',
        'Email' => 'Электронная почта',
        'Avatar' => 'Аватарка',
        'Exit' => 'Выход',
        'Login Form' => 'Форма Входа',
        'Wrong login or password!' => 'Неверный логин или пароль!',
        'No Image Available' => 'Картинка не доступна',
        'Size of file exceeds 1 mbyte' => 'Размер файла превышает 1 мегабайт',
    ];
    
    /**
     * 
     * @param string $key
     * @return string
     */
    public static function get(string $key) 
    {
        switch (self::getLang()) {
            case self::EN: $result = $key; break;
            case self::RU: $result = self::getByKey($key); break;     
            default: $result = $key;
        }
        return $result;
    }
     
    /**
     * 
     * @param type $val
     */
    public static function setLang($val)
    {
        if(empty($_COOKIE[self::COOKIE_NAME])) {
        setcookie(self::COOKIE_NAME, $val);
        }
    }

    /**
     * 
     * @return type
     */
    protected static function getLang()
    {   if(!empty($_COOKIE[self::COOKIE_NAME])) {
        return $_COOKIE[self::COOKIE_NAME];
    } else {
        return self::EN;
    }
        
    }
    
    /**
     * 
     * @param string $key
     * @return string
     */
    protected static function getByKey(string $key)
    {
        if (key_exists($key, self::$dictionary)) {       
            return self::$dictionary[$key];
        } else {
            return $key;
        }
    }
    
    
    
}

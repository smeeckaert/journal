<?php

namespace Session;

use Api\Model\User;

class Session
{
    /**
     * @return User
     */
    public static function user()
    {
        return static::getUser(static::getInfos());
    }

    private static function getInfos()
    {
        return array(
            'login' => isset($_SESSION['login']) ? $_SESSION['login'] : '',
            'pwd'   => isset($_SESSION['pwd']) ? $_SESSION['pwd'] : '');
    }

    private static function getUser($infos)
    {
        return User::find(array('and_where' => $infos));
    }

    public static function check($login, $pwd)
    {
        $array = array('login' => $login, 'pwd' => $pwd);
        return static::getUser($array);
    }

    public static function set($login, $pwd)
    {
        $array    = array('login' => $login, 'pwd' => $pwd);
        $_SESSION = $array;
    }
}
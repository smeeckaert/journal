<?php

namespace Api\Model;

use FW\Orm\Model;

/**
 * Class User
 *
 * @property Post     posts
 * @property Agenda   agendas
 * @property Category categories
 * @package Api\Model
 */
class User extends Model
{
    static protected $_prefix = 'user';
    protected static $_table = 'user';
    protected static $_unique = array('mail', 'login');

    public $id;
    public $mail;
    public $pwd;
    public $login;

    protected static $_relations = array(
        'posts'         => array(
            'from'  => 'id',
            'to'    => 'user_id',
            'model' => '\Api\Model\Post',
        ), 'agendas'    => array(
            'from'  => 'id',
            'to'    => 'user_id',
            'model' => '\Api\Model\Agenda',
        ), 'categories' => array(
            'from'  => 'id',
            'to'    => 'user_id',
            'model' => '\Api\Model\Category',
        ), 'todos'      => array(
            'from'  => 'id',
            'to'    => 'user_id',
            'model' => '\Api\Model\Todo',
        )
    );
}
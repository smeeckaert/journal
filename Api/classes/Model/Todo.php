<?php

namespace Api\Model;

use FW\Orm\Model;

/**
 * Class Todo
 *
 * @property user User
 * @package Api\Model
 */
class Todo extends Model
{
    use Serializable;
    protected static $_toSerialize = array('content');

    static protected $_prefix = 'todo';
    protected static $_table = 'todo';

    public $id;
    public $user_id;
    public $content;
    protected static $_relations = array(
        'user' => array(
            'from'  => 'user_id',
            'to'    => 'id',
            'model' => '\Api\Model\User',
        )
    );
}
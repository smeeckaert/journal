<?php

namespace Api\Model;

use FW\Orm\Model;


/**
 * Class Category
 *
 * @property User   user
 * @property Agenda agendas
 * @package Api\Model
 */
class Category extends Model
{
    use Serializable;

    static protected $_prefix = 'cate';
    protected static $_table = 'category';
    protected static $_toSerialize = array('title', 'color');

    public $id;
    public $title;
    public $color;
    public $user_id;

    protected static $_relations = array(
        'agendas' => array(
            'from'  => 'id',
            'to'    => 'cate_id',
            'model' => '\Api\Model\Agenda',
        ),
        'user'    => array(
            'from'  => 'user_id',
            'to'    => 'id',
            'model' => '\Api\Model\User',
        )
    );
}
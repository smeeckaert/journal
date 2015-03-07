<?php

namespace Api\Model;

use Orm\Model;

/**
 * Class Agenda
 *
 * @property User     user
 * @property Category category
 * @package Api\Model
 */
class Agenda extends Model
{
    use Serializable;
    static protected $_prefix = 'agen';
    protected static $_table = 'agenda';

    public $id;
    public $user_id;
    public $title;
    public $content;
    public $start;
    public $end;
    public $cate_id;
    protected static $_toSerialize = array('title', 'content', 'start', 'end');

    /**
     * @param $dateBegin
     * @param $dateEnd
     * @param $user
     *
     * @return Agenda
     */
    public static function getByDate($dateBegin, $dateEnd, $user)
    {
        return static::find(array('where' =>
                                      "agen_user_id = $user AND ((agen_start <= '$dateBegin' AND agen_end >= '$dateBegin') OR (agen_start >= '$dateBegin' AND agen_start <= '$dateEnd'))"
        ), true);
    }


    protected static $_relations = array(
        'user'        => array(
            'from'  => 'user_id',
            'to'    => 'id',
            'model' => '\Api\Model\User',
        ), 'category' => array(
            'from'  => 'cate_id',
            'to'    => 'id',
            'model' => '\Api\Model\Category',
        )
    );
}
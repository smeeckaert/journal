<?php

namespace Api\Model;

use Orm\Model;

/**
 * Class Post
 *
 * @property user User
 * @package Api\Model
 */
class Post extends Model
{
    use Serializable;

    static protected $_prefix = 'post';
    protected static $_table = 'post';
    protected static $_toSerialize = array('content');

    public $id;
    public $user_id;
    public $content;
    public $created_at;
    public $updated_at;

    protected static $_relations = array(
        'user' => array(
            'from'  => 'user_id',
            'to'    => 'id',
            'model' => '\Api\Model\User',
        )
    );

    /**
     * @param $dateBegin
     * @param $dateEnd
     * @param $user
     *
     * @return Post
     */
    public static function getByDate($date, $user)
    {
        return static::find(array('limit' => 1, 'and_where' => array('user_id' => $user, array(array('created_at' => "$date%"), " LIKE "))));
    }

    protected function before_save()
    {
        parent::before_save();
        $date = date('Y-m-d H:i:s');
        if (!$this->id) {
            $this->created_at = $date;
        }
        $this->updated_at = $date;
    }
}
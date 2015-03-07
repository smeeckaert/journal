<?php

namespace Api\Model;

trait Serializable
{

    public function serialize()
    {
        $array = array();
        foreach (static::$_toSerialize as $field) {
            $array[$field] = $this->$field;
        }
        return $array;
    }
}
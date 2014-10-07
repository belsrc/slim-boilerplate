<?php namespace Belsrc\Boilerplate\Model;

abstract class BaseModel extends \Illuminate\Database\Eloquent\Model {

    public static function tableName() {
        return with(new static)->getTable();
    }
}

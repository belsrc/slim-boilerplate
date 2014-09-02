<?php namespace Belsrc\Boilerplate\Repository;

use \Illuminate\Support\Collection;

abstract class BaseRepository implements IRepository {

    private $_model;

    /**
     * Initializes a new instance of the BaseRepository class.
     * @param string $model The model to use with the repository.
     * @return void
     */
    public function __construct($model) {
        $this->_model = $model;
    }

    /**
     * Reads all records from a given table.
     * @param  array $select An array of the columns to select.
     * @return \Illuminate\Support\Collection
     */
    private function readAll($selects, $withs) {
        $mod = $this->_model;
        return $mod::with($withs)->get($selects);
    }

    /**
     * Executes a single where clause query on the database.
     * @param  mixed  $val    A value to check for.
     * @param  string $field  A field to check in.
     * @param  string $method A method to use when checking.
     * @param  array  $select An array of the columns to select.
     * @return mixed
     */
    private function readSingleStatement($val, $field, $method, $selects, $withs) {
        $mod = $this->_model;
        if($field === null) {
            return $mod::with($withs)->find($val);
        }

        if($method === null) {
            if(is_array($val)) {
                return $mod::with($withs)->whereIn($field, $val)->get($selects);
            }

            return $mod::with($withs)->where($field, $val)->get($selects);
        }

        return $mod::with($withs)->where($field, $method, $val)->get($selects);
    }

    /**
     * Executes a multiple where clause query on the database.
     * @param  array $val    An array of values to check for.
     * @param  array $field  An array of fields to check in.
     * @param  array $method An array of methods to use when checking.
     * @param  array $select An array of the columns to select.
     * @return \Illuminate\Support\Collection
     */
    private function readMultipleStatement($val, $field, $method, $selects, $withs) {
        if(empty($val)) { throw new InvalidArgumentException('Argument empty exception, $val'); }
        if(empty($field)) { throw new InvalidArgumentException('Argument empty exception, $field'); }

        $mod = $this->_model;

        // get the first one then we can loop through the rest
        // since I dont know how to make a new one and its not the same
        // as QueryBuilder
        if($method !== null) {
            $count = count($method);
            $query = $mod::where($field[0], $method[0], $val[0]);
            for($i = 1; $i <= $count; $i++) {
                $query->where($field[$i], $method[$i], $val[$i]);
            }
        }
        else {
            $count = count($field);
            if($count > 0) {
                $query = $mod::where( $field[0], $val[0] );
                for($i = 1; $i < $count; $i++) {
                    $query->where($field[$i], $val[$i]);
                }
            }
        }

        return $query->with($withs)->get($selects);
    }

    /**
     * Creates a new database record.
     * @param  array $data A key-value array of the rows data.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create($data) {
        $mod = $this->_model;
        return $mod::create($data);
    }

    /**
     * Reads a row from the database.
     * @param  mixed  $val    The value(s) to query for.
     * @param  mixed  $field  The table column(s) to query in.
     * @param  string $method The method to use when querying.
     * @param  array  $select An array of the columns to select.
     * @return mixed
     */
    public function read($val=null, $field=null, $method=null, $selects=array('*'), $with=array()) {
        $mod = $this->_model;
        if($val === null) {
            return $this->readAll($selects, $with);
        }

        if(is_array($val) && is_array($field)) {
            return $this->readMultipleStatement($val, $field, $method, $selects, $with);
        }

        return $this->readSingleStatement($val, $field, $method, $selects, $with);
    }

    /**
     * Performs a simple read with eager loading of relationships.
     * @param  array $withs An array of the with statements.
     * @param  int   $id    The ID of the model to find.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function readWith($withs, $id) {
        $mod = $this->_model;
        return $mod::with($withs)->find($id);
    }

    /**
     * Updates a row in the database.
     * @param  int   $id   The entity ID of the item to update.
     * @param  array $data A key value array of the new data.
     * @return array
     */
    public function update($id, $data) {
        $mod = $this->_model;
        $obj = $mod::find($id);
        $old = array();
        foreach($data as $k => $v) {
            $old[$k] = $obj->$k;
            $obj->$k = $v;
        }

        $res = $obj->save();

        return array('result' => $res, 'old' => $old);
    }

    /**
     * Deletes row(s) from the database.
     * @param  mixed  $id The entity ID of the item to delete.
     * @return bool
     */
    public function delete($id) {
        $mod = $this->_model;

        if(is_array($id)) {
            return $mod::destroy($id);
        }

        $tmp = $mod::find($id);
        return $tmp->delete();
    }
}


<?php namespace Belsrc\Boilerplate\Repository;

interface IRepository {

    /**
     * Creates a new database record.
     * @param  array $data A key-value array of the rows data.
     */
    public function create($data);

    /**
     * Reads a row from the database.
     * @param  int|string $val    The value to query for.
     * @param  string     $field  The table column to query in.
     * @param  string     $method The method to use when querying.
     */
    public function read($val = null, $field = null, $method = null);

    /**
     * Updates a row in the database.
     * @param  int   $id   The entity ID of the item to update.
     * @param  array $data A key value array of the new data.
     */
    public function update($id, $data);

    /**
     * Deletes a row from the database.
     * @param  int $id The entity ID of the item to delete.
     */
    public function delete($id);
}

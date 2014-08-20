<?php

class MY_Model extends CI_Model
{

    /* --------------------------------------------------------------
     * VARIABLES
     * ------------------------------------------------------------ */

    /**
     * This model's default database table. Automatically
     * guessed by pluralising the model name.
     */
    protected $_table;

    /**
     * The database connection object. Will be set to the default
     * connection. This allows individual models to use different DBs
     * without overwriting CI's global $this->db connection.
     */
    public $_database;

    /**
     * This model's default primary key or unique identifier.
     * Used by the get(), update() and delete() functions.
     */
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();

        $this->_database = $this->db;

    }

    /* --------------------------------------------------------------
     * CRUD INTERFACE
     * ------------------------------------------------------------ */

    /**
     * Fetch a single record based on the primary key. Returns an object.
     */
    public function get($primary_value)
    {
        return $this->get_by($this->primary_key, $primary_value);
    }

    /**
     * Fetch a single record based on an arbitrary WHERE call. Can be
     * any valid value to $this->_database->where().
     */
    public function get_by()
    {
        $where = func_get_args();

        $this->_set_where($where);

        $row = $this->_database->get($this->_table)
            ->{$this->_return_type()}();
        $this->_temporary_return_type = $this->return_type;

        $this->_with = array();

        return $row;
    }

    /**
     * Insert a new row into the table. $data should be an associative array
     * of data to be inserted. Returns newly created ID.
     */
    public function insert($data)
    {

        if($data)
        {

            $this->_database->insert($this->_table, $data);

            $insert_id = $this->_database->insert_id();

            return $insert_id;
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Updated a record based on the primary value.
     */
    public function update($primary_value, $data)
    {

        if($data)
        {
            $result = $this->_database->where($this->primary_key, $primary_value)
                ->set($data)
                ->update($this->_table);

            return $result;
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Delete a row from the table by the primary value
     * Ideally a soft delete should be set-up
     */
    public function delete($id)
    {

        $this->_database->where($this->primary_key, $id);

        $result = $this->_database->delete($this->_table);

        return $result;
    }
}
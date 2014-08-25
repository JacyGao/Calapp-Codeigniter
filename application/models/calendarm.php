<?php

class Calendarm extends MY_Model
{
    /**
     * Model Configuration
     */

    public $_table = 'calendar';
    public $primary_key = 'id';

    // ------------------------------------------------------------------------

    /**
     * Constructor
     */

    public function __construct()
    {
        parent::__construct();

    }

    // ------------------------------------------------------------------------

    /**
     * Fetch calendar by ID
     *
     * @author		Jacy Gao
     * @return		object
     * @param		id <calendar.id>
     */

    public function get($id)
    {
        $this->db->select('*')
            ->where('id', $id);

        $q = $this->db->get($this->_table);

        return ($q->num_rows() > 0) ? $q->row() : false;
    }

    // ------------------------------------------------------------------------

    /**
     * Fetch all calendars
     *
     * @author		Jacy Gao
     * @return		object
     * @param		void
     */

    public function get_all()
    {

        $this->db->select('*')
            ->order_by('id', 'asc');

        $q = $this->db->get($this->_table);

        return $q->result();
    }
}
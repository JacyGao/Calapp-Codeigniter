<?php

class Appointmentm extends MY_Model
{
    /**
     * Model Configuration
     */

    public $_table = 'appointment';
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
     * Fetch appointment by ID
     *
     * @author		Jacy Gao
     * @return		void
     * @param		id <appointment.id>
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
     * Fetch Services based on Calendar ID
     *
     * @author		Jacy Gao
     * @return		void
     * @param		$cid <appointment.calendar_id>
     */

    public function get_by_calendar($cid)
    {
        $q = $this->db->select('*')
            ->where('calendar_id', $cid)
            ->get($this->_table);

        return $q->result();
    }
}
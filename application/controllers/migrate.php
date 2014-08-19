<?php


class Migrate extends MY_Controller {

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        //define database
        $this->db = $this->load->database('default', TRUE);
    }

    // ------------------------------------------------------------------------

    /**
     * Migrate Database
     *
     * @author		Jacy Gao
     * @return		void
     * @param		void
     */
    public function index()
    {
        $this->load->library('migration');
        $this->migration->latest();
        echo "database is up to date!";
    }

}
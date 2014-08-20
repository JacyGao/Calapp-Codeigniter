<?php

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Render the view page including header and footer
     */

    protected function _render($view, $data)
    {
        $title = (isset($data['title'])) ? $data['title'] : null;

        $this->load->view('layout/header', array('title' => $title));
        $this->load->view($view, $data);
        $this->load->view('layout/footer');
    }
}
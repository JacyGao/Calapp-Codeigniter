<?php

class Appointment extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        // Here we define the calendar id in order to get all appointments in that calendar
        if(!$Calendar_id = $this->session->userdata('calendar'))
        {
            redirect('admin');
        }

        // Load Models
        $this->load->model('appointmentm');

        // Load Helpers
        $this->load->helper('date');
    }

    // ------------------------------------------------------------------------

    /**
     * Index page
     *
     * @author		Jacy Gao
     * @return		void
     * @param		void
     */

    public function index()
    {

        $this->_render('appointment', array(
            'title' => 'Appointment',
            'data' => $this->appointmentm->get_by_calendar($this->session->userdata('calendar'))
        ));
    }

    // ------------------------------------------------------------------------

    /**
     * Create appointment
     *
     * @author		Jacy Gao
     * @return		void
     * @param		void
     */

    public function create()
    {

        if($_POST)
        {
            // Validation process...
            $this->load->library('form_validation');

            $this->form_validation->set_rules(array(
                array(
                    'field'   => 'title',
                    'label'   => 'title',
                    'rules'   => 'required'
                ),
                array(
                    'field'   => 'location',
                    'label'   => 'location',
                    'rules'   => 'required'
                ),
                array(
                    'field'   => 'start_date',
                    'label'   => 'start_date',
                    'rules'   => 'required|val_is_not_zero'
                ),
                array(
                    'field'   => 'start_time',
                    'label'   => 'start_time',
                    'rules'   => 'required|val_is_not_zero'
                ),
                array(
                    'field'   => 'end_date',
                    'label'   => 'end_date',
                    'rules'   => 'required|val_is_not_zero'
                ),
                array(
                    'field'   => 'end_time',
                    'label'   => 'end_time',
                    'rules'   => 'required|val_is_not_zero'
                ),
                array(
                    'field'   => 'notes',
                    'label'   => 'notes',
                    'rules'   => ''
                )
            ));

            // Validation failed...
            if ( ! $this->form_validation->run())
            {
                $this->_render('forms/appointmentf', array(
                    'title' => 'Create Appointment',
                    'validation_error' => true
                ));
            }

            // Validation passed...
            else
            {
                // Attempt to insert to appointment table...
                if( $appointment_id = $this->appointmentm->insert(array(
                    'title' => $this->input->post('title'),
                    'calendar_id' => $this->session->userdata('calendar'),
                    'location' => $this->input->post('location'),
                    'start_date' => date('Y-m-d', strtotime($this->input->post('start_date'))),
                    'start_time' => date('H:i:s', strtotime($this->input->post('start_time'))),
                    'end_date' => date('Y-m-d', strtotime($this->input->post('end_date'))),
                    'end_time' => date('H:i:s', strtotime($this->input->post('end_time'))),
                    'note' => $this->input->post('note')
                )))
                {
                    log_message('info', mdate("%Y-%m-%d %h:%i %a", time())." CREATE appointment with ID ".$appointment_id." has been created!");
                    redirect('appointment');
                }
                else
                {
                    $this->_render('forms/appointmentf', array(
                        'title' => 'Create Appointment',
                        'validation_error' => true
                    ));
                }
            }
        }

        // Just viewing...
        else
        {
            $this->_render('forms/appointmentf', array(
                'title' => 'Create Appointment'
            ));
        }

    }

    // ------------------------------------------------------------------------

    /**
     * view appointment
     *
     * @author		Jacy Gao
     * @return		void
     * @param		$id <appointment.id>
     */

    public function view($id)
    {

        // Fetch appointment data
        $data = $this->appointmentm->get($id) or show_404();

        // Logger

        log_message('info', mdate("%Y-%m-%d %h:%i %a", time())." VIEW Viewing appointment with ID ".$id."...");

        // Render view
        $this->_render('forms/appointmentf', array(
            'title' => 'Viewing Appointment #' . $data->id ,
            'data' => $data
        ));

    }

    // ------------------------------------------------------------------------

    /**
     * update appointment
     *
     * @author		Jacy Gao
     * @return		void
     * @param		$id <appointment.id>
     */

    public function update($id)
    {

        // Fetch invoice data
        $data = $this->appointmentm->get($id) or show_404();

        if($_POST)
        {
            if( ! $this->appointmentm->update($id, array(
                'title' => $this->input->post('title'),
                'calendar_id' => $this->session->userdata('calendar'),
                'location' => $this->input->post('location'),
                'start_date' => date('Y-m-d', strtotime($this->input->post('start_date'))),
                'start_time' => date('H:i:s', strtotime($this->input->post('start_time'))),
                'end_date' => date('Y-m-d', strtotime($this->input->post('end_date'))),
                'end_time' => date('H:i:s', strtotime($this->input->post('end_time'))),
                'note' => $this->input->post('note')
            )))
            {
                log_message('error', mdate("%Y-%m-%d %h:%i %a", time())." UPDATE appointment with ID ".$id." has failed!");
                echo mdate("%Y-%m-%d %h:%i %a", time())." UPDATE appointment with ID ".$id." has failed!";
            }
            else
            {
                log_message('info', mdate("%Y-%m-%d %h:%i %a", time())." UPDATE appointment with ID ".$id." has been updated!");

                // Redirect
                redirect('appointment');
            }
        }
        else
        {
            // Render view
            $this->_render('forms/appointmentf', array(
                'title' => 'Edit Invoice #' . $data->id ,
                'data' => $data,
                'edit' => true
            ));
        }
    }

    // ------------------------------------------------------------------------

    /**
     * delete appointment
     *
     * @author		Jacy Gao
     * @return		void
     * @param		$id <appointment.id>
     */

    public function delete($id)
    {

        $data = $this->appointmentm->get($id) or show_404();

        // Attempt to delete appointment
        $this->appointmentm->delete($data->id);

        // Logger
        log_message('info', mdate("%Y-%m-%d %h:%i %a", time())." DELETE appointment with ID ".$id." has been deleted!");

        // Redirect
        redirect('appointment');

    }
}
<?php

class Admin extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Load Models
        $this->load->model('calendarm');

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

        $this->_render('calendar', array(
            'title' => 'Calendar',
            'data' => $this->calendarm->get_all()
        ));
    }

    // ------------------------------------------------------------------------

    /**
     * Create calendar
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
                    'field'   => 'name',
                    'label'   => 'name',
                    'rules'   => 'required'
                ),
            ));

            // Validation failed...
            if ( ! $this->form_validation->run())
            {
                $this->_render('forms/calendarf', array(
                    'title' => 'Create Calendar',
                    'validation_error' => true
                ));
            }

            // Validation passed...
            else
            {
                // this is a practise for using factory pattern
                $new = CalendarFactory::create($this->input->post('name'));

                // Successfully created new calendar...
                if( $calendar_id = $this->calendarm->insert(array(
                    'name' => $new->get_name()
                )))
                {

                    log_message('info', mdate("%Y-%m-%d %h:%i %a", time())." CREATE calendar with ID ".$calendar_id." has been created!");
                    redirect('admin');

                }
                // failed to create new calendar...
                else
                {

                    log_message('error', mdate("%Y-%m-%d %h:%i %a", time())." CREATE calendar with ID ".$calendar_id." has failed!");
                    echo mdate("%Y-%m-%d %h:%i %a", time())." CREATE calendar with ID ".$calendar_id." has failed!";
                    exit;

                }
            }
        }
        // Just viewing...
        else
        {
            $this->_render('forms/calendarf', array(
                'title' => 'Create Calendar'
            ));
        }
    }

    // ------------------------------------------------------------------------

    /**
     * Update Calendar
     *
     * @author		Jacy Gao
     * @return		void
     * @param	    $id <calendar.id>
     */

    public function update($id)
    {

        // Fetch invoice data
        $data = $this->calendarm->get($id) or show_404();

        if($_POST)
        {
            if( ! $this->calendarm->update($id, array(
                'name' => $this->input->post('name')
            )))
            {
                log_message('error', mdate("%Y-%m-%d %h:%i %a", time())." UPDATE calendar with ID ".$id." has failed!");
                echo mdate("%Y-%m-%d %h:%i %a", time())." UPDATE calendar with ID ".$id." has failed!";
            }
            else
            {
                log_message('info', mdate("%Y-%m-%d %h:%i %a", time())." UPDATE calendar with ID ".$id." has been updated!");
                // Redirect
                redirect('admin');
            }
        }
        else
        {
            // Render view
            $this->_render('forms/calendarf', array(
                'title' => 'Edit Calendar #' . $data->id ,
                'data' => $data,
                'edit' => true
            ));
        }

    }

    // ------------------------------------------------------------------------

    /**
     * View Calendar
     *
     * @author		Jacy Gao
     * @return		void
     * @param	    $id <calendar.id>
     */

    public function view($id)
    {
        $this->session->set_userdata('calendar', $id);

        // Logger
        log_message('info', mdate("%Y-%m-%d %h:%i %a", time())." VIEW Viewing calendar with ID ".$id."...");

        //Redirect
        redirect('appointment');
    }


    // ------------------------------------------------------------------------

    /**
     * Delete Calendar
     *
     * @author		Jacy Gao
     * @return		void
     * @param	    $id <calendar.id>
     */

    public function delete($id)
    {
        $data = $this->calendarm->get($id) or show_404();

        // Attempt to delete appointment
        $this->calendarm->delete($data->id);

        // Logger
        log_message('info', mdate("%Y-%m-%d %h:%i %a", time())." DELETE calendar with ID ".$id." has been deleted!");

        // Redirect
        redirect('admin');
    }
}

class CalendarFactory
{
    public static function create($name)
    {
        return new Calendar($name);
    }
}

class Calendar
{

    private $calendar_name;

    // ------------------------------------------------------------------------

    /**
     * Constructor
     */

    public function __construct($name)
    {
        $this->calendar_name = $name;

    }

    public function get_name()
    {
        return $this->calendar_name;
    }

}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_create_appointment extends CI_Migration {
    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
                'null' => FALSE,
            ),
            'calendar_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'location' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'start_date' => array(
                'type' => 'DATE',
                'null' => TRUE,
            ),
            'start_time' => array(
                'type' => 'TIME',
                'null' => TRUE,
            ),
            'end_date' => array(
                'type' => 'DATE',
                'null' => TRUE,
            ),
            'end_time' => array(
                'type' => 'TIME',
                'null' => TRUE,
            ),
            'note' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('appointment', TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table('appointment');
    }
}

?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_create_calendar extends CI_Migration {
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
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('calendar', TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table('calendar');
    }
}

?>
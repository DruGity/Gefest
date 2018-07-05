<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Migration_create_table_articles extends CI_Migration  {

    public function up(){
        $this->dbforge->add_field([
           'id' => [
               'type' => 'INT',
               'unsigned' => TRUE,
               'auto_increment' => TRUE,
               ] ,
            'title' => [
               'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'body' => [
                'type' => 'TEXT'
            ]
        ]);
        $this->dbforge->add_key('id' , TRUE);
        $this->dbforge->create_table('test');

    }
    public function down() {
        $this->dbforge->drop_table('test');
    }
}
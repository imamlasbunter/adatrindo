<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tbldiscountprogramin extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'id_discount_program' => [
                'type' => 'INT'
            ],
            'id_product_item' => [
                'type' => 'INT'
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => '5'
            ],
            'user_create' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'user_update' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'user_delete' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tbl_discount_program_in');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_discount_program_in');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tbldiscountprogram extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'program_name' => [
                'type' => 'VARCHAR',
                'constraint' => 200
            ],
            'discription' => [
                'type' => 'VARCHAR',
                'constraint' => '250'
            ],
            'discount' => [
                'type' => 'VARCHAR',
                'constraint' => '250'
            ],
            'date_start' => [
                'type' => 'DATE'
            ],
            'date_end' => [
                'type' => 'DATE'
            ],
            'picture' => [
                'type' => 'VARCHAR',
                'constraint' => '250'
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
        $this->forge->createTable('tbl_discount_program');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_discount_program');
    }
}

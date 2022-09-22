<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblTaxes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'tax_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ],
            'tax' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ],
            'tax_persen' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ],
            'tax_category' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ],
            'tax_status' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
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
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tbl_taxes');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_taxes');
    }
}

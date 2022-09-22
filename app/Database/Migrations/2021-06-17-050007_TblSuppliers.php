<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblSuppliers extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'supplier_name'       => [
				'type'       => 'VARCHAR',
				'constraint' => '250',
			],
			'no_telp' => [
				'type' => 'VARCHAR',
				'constraint' => '20',
			],
			'email' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
			'npwp' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],
			'address' => [
				'type' => 'VARCHAR',
				'constraint' => '500',
			],
			'user_create' => [
				'type' => 'VARCHAR',
				'constraint' => '100'
			],
			'user_update' => [
				'type' => 'VARCHAR',
				'constraint' => '100'
			],
			'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
			'updated_at' => [
				'type' => 'DATETIME'
			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('tbl_suppliers');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_suppliers');
	}
}

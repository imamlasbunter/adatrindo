<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tblproductunit extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'unsigned'       => true,
				'auto_increment' => true
			],
			'unit' => [
				'type' => 'VARCHAR',
				'constraint' => '100'
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
		$this->forge->createTable('tbl_product_units');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_product_units');
	}
}

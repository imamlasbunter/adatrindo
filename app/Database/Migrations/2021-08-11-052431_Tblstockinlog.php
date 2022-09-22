<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tblstockinlog extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'unsigned' => true,
				'auto_increment' => true
			],
			'id_stock_out' => [
				'type' => 'INT',
			],
			'product_code' => [
				'type' => 'VARCHAR',
				'constraint' => 100
			],
			'qty' => [
				'type' => 'INT',
			],
			'status' => [
				'type' => 'VARCHAR',
				'constraint' => 5
			],
			'desc' => [
				'type' => 'VARCHAR',
				'constraint' => 255
			],
			'user_create' => [
				'type' => 'VARCHAR',
				'constraint' => '100'
			],
			'created_at' => [
				'type' => 'DATETIME'
			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('tbl_stock_in_log');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_stock_in_log');
	}
}

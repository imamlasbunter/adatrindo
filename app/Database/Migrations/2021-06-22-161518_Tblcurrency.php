<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tblcurrency extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'unsigned' => true,
				'auto_increment' => true
			],
			'symbol' => [
				'type' => 'VARCHAR',
				'constraint' => 10
			],
			'code' => [
				'type' => 'VARCHAR',
				'constraint' => 10
			],
			'currency_name' => [
				'type' => 'VARCHAR',
				'constraint' => 25
			],
			'country' => [
				'type' => 'VARCHAR',
				'constraint' => 100
			],
			'kurs' => [
				'type' => 'VARCHAR',
				'constraint' => 50
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
		$this->forge->addKEy('id', true);
		$this->forge->createTable('tbl_currency');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_currency');
	}
}

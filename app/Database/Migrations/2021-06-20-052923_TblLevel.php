<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use PHPUnit\Framework\Constraint\Constraint;

class TblLevel extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'unsigned' => true,
				'auto_increment' => true
			],
			'descripsion' => [
				'type' => 'VARCHAR',
				'Constraint' => 100
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
		$this->forge->createTable('tbl_levels');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_levels');
	}
}

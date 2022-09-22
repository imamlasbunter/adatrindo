<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Categorymenu extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'unsigned' => true,
				'auto_increment' => true
			],
			'name' => [
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
		$this->forge->createTable('tbl_category_menus');
	}
	public function down()
	{
		$this->forge->dropTable('tbl_category_menus');
	}
}

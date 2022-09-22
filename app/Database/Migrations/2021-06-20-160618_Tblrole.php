<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tblrole extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'unsigned' => true,
				'auto_increment' => true
			],
			'id_menu' => [
				'type' => 'INT'
			],
			'id_level' => [
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
		$this->forge->createTable('tbl_role_menus');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_role_menus');
	}
}

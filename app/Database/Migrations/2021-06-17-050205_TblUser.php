<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblUser extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'username' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
			'password' => [
				'type' => 'VARCHAR',
				'constraint' => '200'
			],
			'salt' => [
				'type' => 'VARCHAR',
				'constraint' => '200'
			],
			'name' => [
				'type' => 'VARCHAR',
				'constraint' => '250'
			],
			'email' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => true
			],
			'level' => [
				'type' => 'INT',
			],
			'pp' => [
				'type' => 'BLOB',
			],
			'pp_name' => [
				'type' => 'VARCHAR',
				'constraint' => 255
			],
			'pp_type' => [
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
		$this->forge->addKey('id', true);
		$this->forge->createTable('tbl_users');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_users');
	}
}

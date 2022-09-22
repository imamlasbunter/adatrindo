<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tblaccount extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'unsigned' => true,
				'auto_increment' => true
			],
			'account_number' => [
				'type' => 'VARCHAR',
				'constraint' => 25
			],
			'account_name' => [
				'type' => 'VARCHAR',
				'constraint' => 250
			],
			'tax' => [
				'type' => 'VARCHAR',
				'constraint' => 250
			],
			'account_category_id' => [
				'type' => 'INT'
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
		$this->forge->createTable('tbl_account_lists');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_account_lists');
	}
}

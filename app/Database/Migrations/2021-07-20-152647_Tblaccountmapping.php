<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tblaccountmapping extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'unsigned' => true,
				'auto_increment' => true
			],
			'id_acc_list' => [
				'type' => 'INT'
			],
			'cat_mapping' => [
				'type' => 'VARCHAR',
				'constraint' => 100
			],
			'item_mapping' => [
				'type' => 'VARCHAR',
				'constraint' => 255
			],
			'user_create' => [
				'type' => 'VARCHAR',
				'constraint' => '100'
			],
			'user_update' => [
				'type' => 'VARCHAR',
				'constraint' => '100'
			],
			'created_at' => [
				'type' => 'DATETIME'
			],
			'updated_at' => [
				'type' => 'DATETIME'
			]
		]);

		$this->forge->addKey('id', true);
		$this->forge->createTable('tbl_account_mapping');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_account_mapping');
	}
}

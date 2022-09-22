<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblProfileComp extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'unsigned' => true,
				'auto_increment' => true
			],

			'bank_name' => [
				'type' => 'VARCHAR',
				'constraint' => 100
			],
			'bank_branch' => [
				'type' => 'VARCHAR',
				'constraint' => 200
			],
			'bank_address' => [
				'type' => 'VARCHAR',
				'constraint' => 500
			],
			'account_number' => [
				'type' => 'VARCHAR',
				'constraint' => 50
			],
			'bautno' => [
				'type' => 'VARCHAR',
				'constraint' => 200
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
		$this->forge->createTable('tbl_contact_account_bank');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_contact_account_bank');
	}
}

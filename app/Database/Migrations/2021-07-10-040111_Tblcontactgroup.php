<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tblcontactgroup extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'unsigned' => true,
				'auto_increment' => true
			],
			'group' => [
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
			'created_at' => [
				'type' => 'DATETIME'
			],
			'updated_at' => [
				'type' => 'DATETIME'
			]
		]);

		$this->forge->addKey('id', true);
		$this->forge->createTable('tbl_contact_group');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_contact_group');
	}
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblLogActionUser extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'unsigned' => true,
				'auto_increment' => true
			],
			'name_act' => [
				'type' => 'VARCHAR',
				'constraint' => 50
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
		$this->forge->createTable('tbl_act_user');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_act_user');
	}
}

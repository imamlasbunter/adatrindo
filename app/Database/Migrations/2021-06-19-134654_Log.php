<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Log extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'unsigned' => true,
				'auto_increment' => true

			],
			'log_name' => [
				'type' => 'VARCHAR',
				'constraint' => 100
			],
			'log_code' => [
				'type' => 'VARCHAR',
				'constraint' => 50
			],
			'log_qty' => [
				'type' => 'INT'
			],
			'log_qty_before' => [
				'type' => 'INT'
			],
			'user_create' => [
				'type' => 'VARCHAR',
				'constraint' => '100'
			],
			'created_at DATETIME DEFAULT CURRENT_TIMESTAMP'

		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('tbl_log_trans_menus');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_log_trans_menus');
	}
}

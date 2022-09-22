<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tblmenu extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'unsigned' => true,
				'auto_increment' => true
			],
			'category_menu' => [
				'type' => 'VARCHAR',
				'constraint' => 50,
				'null' => false
			],
			'menu_name' => [
				'type' => 'VARCHAR',
				'constraint' => 250,
				'null' => false
			],
			'sequence' => [
				'type' => 'INT'
			],
			'status' => [
				'type' => 'VARCHAR',
				'constraint' => '5'
			],
			'parent_id' => [
				'type' => 'INT'
			],
			'icon_menu' => [
				'type' => 'VARCHAR',
				'constraint' => '50'
			],
			'link_menu' => [
				'type' => 'VARCHAR',
				'constraint' => 300
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
		$this->forge->createTable('tbl_menus');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_menus');
	}
}

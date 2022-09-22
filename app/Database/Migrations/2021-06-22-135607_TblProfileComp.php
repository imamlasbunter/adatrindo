<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

use function PHPSTORM_META\type;

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
			'logo' => [
				'type' => 'VARCHAR',
				'constraint' => 100
			],
			'logo_type' => [
				'type' => 'VARCHAR',
				'constraint' => 10
			],
			'show_logo' => [
				'type' => 'VARCHAR',
				'constraint' => 5
			],
			'company_name' => [
				'type' => 'VARCHAR',
				'constraint' => '200'
			],
			'address' => [
				'type' => 'VARCHAR',
				'constraint' => 500,
			],
			'shipping_address' => [
				'type' => 'VARCHAR',
				'constraint' => 500
			],
			'telp' => [
				'type' => 'VARCHAR',
				'constraint' => 20
			],
			'fax' => [
				'type' => 'VARCHAR',
				'constraint' => 20
			],
			'npwp' => [
				'type' => 'VARCHAR',
				'constraint' => 50
			],
			'website' => [
				'type' => 'VARCHAR',
				'constraint' => 100
			],
			'email' => [
				'type' => 'VARCHAR',
				'constraint' => 50
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
			'swift_code' => [
				'type' => 'VARCHAR',
				'constraint' => 50
			],
			'currency_id' => [
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
		$this->forge->createTable('tbl_profile_comp');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_profile_comp');
	}
}

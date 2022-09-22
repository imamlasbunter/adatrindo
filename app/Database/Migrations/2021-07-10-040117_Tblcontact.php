<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tblcontact extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'unsigned' => true,
				'auto_increment' => true
			],
			'name' => [
				'type' => 'VARCHAR',
				'constraint' => 255
			],
			'type' => [
				'type' => 'INT',
			],
			'group' => [
				'type' => 'INT',
			],
			'hp' => [
				'type' => 'INT',
			],
			'identity_type' => [
				'type' => 'VARCHAR',
				'constraint' => 50
			],
			'no_identity' => [
				'type' => 'varchar',
				'constraint' => '100'
			],
			'email' => [
				'type' => 'varchar',
				'constraint' => '100'
			],
			'company_name' => [
				'type' => 'varchar',
				'constraint' => '255'
			],
			'telp' => [
				'type' => 'varchar',
				'constraint' => '20'
			],
			'fax' => [
				'type' => 'varchar',
				'constraint' => '20'
			],
			'npwp' => [
				'type' => 'varchar',
				'constraint' => '30'
			],
			'payment_address' => [
				'type' => 'varchar',
				'constraint' => '500'
			],
			'shipping_address' => [
				'type' => 'varchar',
				'constraint' => '500'
			],
			'bank_name' => [
				'type' => 'varchar',
				'constraint' => '100'
			],
			'bank_branch' => [
				'type' => 'varchar',
				'constraint' => '100'
			],
			'bank_address' => [
				'type' => 'varchar',
				'constraint' => '255'
			],
			'bautno' => [
				'type' => 'varchar',
				'constraint' => '100'
			],
			'account_no' => [
				'type' => 'varchar',
				'constraint' => '100'
			],
			'accounts_receivable' => [
				'type' => 'int',
			],
			'accounts_payable' => [
				'type' => 'int',
			],
			'top' => [
				'type' => 'int',
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
		$this->forge->createTable('tbl_contact');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_contact');
	}
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblInvoice extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'unsigned' => true,
				'auto_increment' => true
			],
			'nomor_invoice' => [
				'type' => 'VARCHAR',
				'constraint' => '100'
			],
			'disc_caegory' => [
				'type' => 'ENUM',
				'value' => 'all'
			],
			'disc' => [
				'type' => 'VARCHAR',
				'constraint' => '50'
			],
			'disc_type' => [
				'type' => 'VARCHAR',
				'constraint' => '50'
			],
			'disc_amount' => [
				'type' => 'BIGINT',
				'constraint' => '50'
			],
			'grandtotal' => [
				'type' => 'BIGINT',
				'constraint' => '50'
			],
			'ppn' => [
				'type' => 'BIGINT',
				'constraint' => '50'
			],
			'grandtotalpayment' => [
				'type' => 'BIGINT',
				'constraint' => '20'
			],
			'id_user' => [
				'type' => 'INT'
			],
			'created_at' => [
				'type' => 'DATETIME'
			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('tbl_invoice');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_invoice');
	}
}

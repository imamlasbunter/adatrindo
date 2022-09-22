<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblInvoiceDetail extends Migration
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
			'id_product_item' => [
				'type' => 'INT'
			],
			'id_user' => [
				'type' => 'INT'
			],
			'Product_name' => [
				'type' => 'VARCHAR',
				'constraint' => 200
			],
			'quantity' => [
				'type' => 'INT',
				'default' => 0
			],
			'disc_caegory' => [
				'type' => 'ENUM',
				'value' => 'item'
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
			'unit_price' => [
				'type' => 'BIGINT',
				'constraint' => '50'
			],
			'ppn' => [
				'type' => 'BIGINT',
				'constraint' => '50'
			],
			'unit_price_final' => [
				'type' => 'BIGINT',
				'constraint' => '50'
			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('tbl_invoice_detail');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_invoice_detail');
	}
}

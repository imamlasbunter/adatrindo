<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tblsales extends Migration
{
	public function up()
	{
		$this->forge->addField(
			[
				'id' => [
					'type' => 'INT',
					'unsigned' => true,
					'auto_increment' => true
				],
				'product_code' => [
					'type' => 'VARCHAR',
					'constraint' => 25
				],
				'quantity' => [
					'type' => 'INT'
				],
				'selling_price' => [
					'type' => 'INT'
				],
				'sub_total' => [
					'type' => 'INT'
				],
				'tax_amount' => [
					'type' => 'INT'
				],
				'total' => [
					'type' => 'INT'
				],
				'unit_id' => [
					'type' => 'INT'
				],
				'category_id' => [
					'type' => 'INT'
				],
				'customer_id' => [
					'type' => 'INT'
				],
				'user_create' => [
					'type' => 'VARCHAR',
					'constraint' => '100'
				],
				'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
				'updated_at' => [
					'type' => 'DATETIME'
				]

			]
		);

		$this->forge->addKey('id', true);
		$this->forge->createTable('tbl_sales');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_sales');
	}
}

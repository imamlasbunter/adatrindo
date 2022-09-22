<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

use function PHPSTORM_META\type;

class Tblproductitems extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'product_code' => [
				'type' => 'VARCHAR',
				'constraint' => '25'
			],
			'product_name' => [
				'type' => 'VARCHAR',
				'constraint' => '200'

			],
			'quantity' => [
				'type' => 'INT',
				'default' => 0
			],
			'minimum_quantity' => [
				'type' => 'INT',
				'default' => 0
			],
			'unit_id' => [
				'type' => 'INT'

			],
			'purchase_price' => [
				'type' => 'INT'
			],
			'last_purchase_price' => [
				'type' => 'INT'
			],
			'selling_price' => [
				'type' => 'INT'
			],
			'category_id' => [
				'type' => 'INT'
			],
			'discount' => [
				'type' => 'DECIMAL'
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
			],


		]);

		$this->forge->addKey('id', true);
		$this->forge->createTable('tbl_product_items');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_product_items');
	}
}

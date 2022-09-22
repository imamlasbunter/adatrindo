<?php

namespace App\Models;

use CodeIgniter\Model;

class Stockoutmodel extends Model
{
	protected $table                = 'tbl_product_items';
	protected $primaryKey           = 'id';
	protected $returnType           = 'array';
	protected $allowedFields        = [
		'quantity',
		'user_update',
		'updated_at'

	];

	// Dates
	protected $useTimestamps        = false;

	public function index()
	{
		$builder = $this->table('tbl_product_items');
		$builder->select('tbl_product_items.id, tbl_product_items.product_code,
		tbl_product_items.product_name,
		tbl_product_items.quantity,
		tbl_product_items.minimum_quantity,
		tbl_product_items.unit_id,
		tbl_product_items.purchase_price,
		tbl_product_items.last_purchase_price,
		tbl_product_items.selling_price,
		tbl_product_items.category_id, tbl_product_units.unit, tbl_product_categories.category');
		$builder->join('tbl_product_units', 'tbl_product_units.id = tbl_product_items.unit_id', 'left');
		$builder->join('tbl_product_categories', 'tbl_product_categories.id = tbl_product_items.category_id', 'left');

		//dd($builder);
		return $builder->get()->getResultArray();
	}

	public function insert_stock_out($data)
	{
		$db = \Config\Database::connect();
		$sql = $db->table('tbl_stock_out');
		$sql->insert($data);
	}

	public function history($product_code)
	{
		$db = \Config\Database::connect();
		$sql = $db->table('tbl_stock_out');
		$sql->select('tbl_stock_out.id, tbl_stock_out.qty, tbl_stock_out.desc, tbl_stock_out.created_at, tbl_stock_out.product_code, tbl_stock_out.id_product_item, tbl_product_items.quantity');
		$sql->join('tbl_product_items', 'tbl_product_items.id = tbl_stock_out.id_product_item', 'inner');
		$sql->where('tbl_stock_out.product_code', $product_code);
		$sql->where('tbl_stock_out.status', 'so');
		$hsl = $sql->get();
		return $hsl->getResultArray();
	}

	public function update_qty_so($id, $data)
	{
		$db = \Config\Database::connect();
		$sql = $db->table('tbl_stock_out');
		$sql->where('id', $id);
		$sql->update($data);
	}

	public function insert_stock_out_log($data_insert)
	{
		$db = \Config\Database::connect();
		$sql = $db->table('tbl_stock_out_log');
		$sql->insert($data_insert);
	}
}

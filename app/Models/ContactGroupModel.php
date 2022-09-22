<?php

namespace App\Models;

use CodeIgniter\Model;


class ContactGroupModel extends Model
{
	protected $table                = 'tbl_product_items';
	protected $primaryKey           = 'id';
	protected $returnType           = 'array';
	protected $allowedFields        = [
		'product_code',
		'product_name',
		'quantity',
		'minimum_quantity',
		'unit_id',
		'purchase_price',
		'last_purchase_price',
		'selling_price',
		'category_id',
		'user_create',
		'user_update',
		'user_delete'
	];

	// Dates
	protected $useTimestamps        = true;


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
		return $builder;
	}

	public function search($keyword)
	{
		// $builder = $this->table('tbl_customer');
		// $builder->like('name', $keyword);
		// return $builder;


		// return $this->table('tbl_product_items')->like('product_code', $keyword)->orLike('product_name', $keyword);

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
		$builder->like('tbl_product_items.product_code', $keyword);
		$builder->Orlike('tbl_product_items.product_name', $keyword);
		return $builder;
	}
}

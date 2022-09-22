<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactTypeModel extends Model
{
	protected $table                = 'tbl_product_categories';
	protected $primaryKey           = 'id';
	protected $returnType           = 'array';
	protected $allowedFields        = [
		'category',
		'user_create',
		'user_update',
		'user_delete'
	];

	// Dates
	protected $useTimestamps        = true;

	public function search($keyword)
	{
		// $builder = $this->table('tbl_customer');
		// $builder->like('name', $keyword);
		// return $builder;


		return $this->table('tbl_product_categories')->like('category', $keyword);
	}
}

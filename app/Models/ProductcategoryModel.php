<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductcategoryModel extends Model
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
}

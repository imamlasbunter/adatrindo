<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductunitsModel extends Model
{
	protected $table                = 'tbl_product_units';
	protected $primaryKey           = 'id';
	protected $returnType           = 'array';
	protected $allowedFields        = [
		'unit',
		'user_create',
		'user_update',
		'user_delete'
	];

	// Dates
	protected $useTimestamps        = true;
}

<?php

namespace App\Models;

use CodeIgniter\Database\MySQLi\Builder;
use CodeIgniter\Model;

class CustomersModel extends Model
{
	protected $table                = 'tbl_customers';
	protected $primaryKey           = 'id';
	protected $returnType           = 'array';
	protected $allowedFields        = [
		'name',
		'no_telp',
		'address',
		'user_create',
		'user_update',
		'user_delete'
	];

	// Dates
	protected $useTimestamps        = True;

	public function search($keyword)
	{
		// $builder = $this->table('tbl_customer');
		// $builder->like('name', $keyword);
		// return $builder;


		return $this->table('tbl_customers')->like('name', $keyword)->orLike('address', $keyword)->orLike('no_telp', $keyword);
	}
}

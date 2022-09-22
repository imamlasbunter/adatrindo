<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
	protected $table                = 'tbl_suppliers';
	protected $primaryKey           = 'id';
	protected $allowedFields		= [
		'supplier_name',
		'no_telp',
		'address',
		'user_create',
		'user_update',
		'user_delete'

	];
	protected $returnType = 'array';

	// Dates
	protected $useTimestamps        = TRUE;
	// protected $dateFormat           = 'datetime';
	// protected $createdField         = 'created_at ';
	// protected $updatedField         = 'updated_at';
	// protected $deletedField         = 'deleted_at';

	public function search($keyword)
	{
		// $builder = $this->table('tbl_customer');
		// $builder->like('name', $keyword);
		// return $builder;


		return $this->table('tbl_suppliers')->like('supplier_name', $keyword)->orLike('address', $keyword)->orLike('no_telp', $keyword);
	}
}

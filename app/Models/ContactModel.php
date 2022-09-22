<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactModel extends Model
{
	protected $table                = 'tbl_contact';
	protected $primaryKey           = 'id';
	protected $returnType           = 'array';
	protected $allowedFields        = [
		'name',
		'type',
		'hp',
		'identity_type',
		'no_identity',
		'email',
		'company_name',
		'telp',
		'fax',
		'npwp',
		'payment_address',
		'shipping_address',
		'bank_name',
		'bank_branch',
		'bank_address',
		'account_no',
		'bautno',
		'user_create',
		'created_at'
	];

	// Dates
	protected $useTimestamps        = false;
	public function customer($param)
	{
		return $this->db->table('tbl_contact')->where('type', $param)->get()->getResultArray();
	}
	public function supplier($param)
	{
		return $this->db->table('tbl_contact')->where('type', $param)->get()->getResultArray();
	}
	public function employee($param)
	{
		return $this->db->table('tbl_contact')->where('type', $param)->get()->getResultArray();
	}
	public function vendor($param)
	{
		return $this->db->table('tbl_contact')->where('type', $param)->get()->getResultArray();
	}
	public function others($param)
	{
		return $this->db->table('tbl_contact')->where('type', $param)->get()->getResultArray();
	}

	public function search($keyword)
	{
		// $builder = $this->table('tbl_customer');
		// $builder->like('name', $keyword);
		// return $builder;
		return $this->table('tbl_product_units')->like('unit', $keyword);
	}
}

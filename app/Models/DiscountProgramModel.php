<?php

namespace App\Models;

use CodeIgniter\Model;


class DiscountProgramModel extends Model
{
	protected $table                = 'tbl_discount_program';
	protected $primaryKey           = 'id';
	protected $returnType           = 'array';
	protected $allowedFields        = [
		'program_name',
		'discription',
		'discount',
		'date_start',
		'date_end',
		'picture',
		'status',
		'user_create',
		'created_at',
		'user_update',
		'updated_at'
	];

	public function index()
	{
		$builder = $this->table('tbl_discount_program');
		$builder->select('*');
		$builder->where('tbl_discount_program.status', 'Y');
		//dd($builder);
		return $builder->get()->getResultArray();
	}

	public function deleteProgram($id)
	{
		$this->db->transStart();
		$this->db->query("UPDATE tbl_discount_program SET tbl_discount_program.status = 'D', tbl_discount_program.user_delete = '" . session()->get('username') . "',  tbl_discount_program.deleted_at = '" . date('Y-m-d H:i:s') . "' WHERE tbl_discount_program.id ='$id' AND tbl_discount_program.status != 'D'");
		$this->db->query("UPDATE tbl_discount_program_in SET tbl_discount_program_in.status = 'D', tbl_discount_program_in.user_delete = '" . session()->get('username') . "',  tbl_discount_program_in.deleted_at = '" . date('Y-m-d H:i:s') . "' WHERE tbl_discount_program_in.id_discount_program ='$id' AND tbl_discount_program_in.status != 'D'");
		$this->db->transComplete();
	}

	public function dp_in()
	{
		// $db = \Config\Database::connect();
		// $builder = $this->table('tbl_discount_program');
		// $builder->select('tbl_discount_program_in.id, tbl_discount_program.program_name, tbl_discount_program.discount, tbl_discount_program.date_start, tbl_discount_program.date_end, tbl_product_items.product_name, tbl_product_items.quantity');
		// $builder->join('tbl_discount_program_in', 'tbl_discount_program_in.id_discount_program = tbl_discount_program_in.id', 'inner');
		// $builder->join('tbl_product_items', 'tbl_product_items.id = tbl_discount_program_in.id_product_item', 'inner');
		// $builder->where('tbl_discount_program_in.status', 'Y');
		// $builder->where('tbl_discount_program.status', 'Y');
		// return $builder->get()->getResultArray();

		$sql = $this->db->query("SELECT tbl_discount_program_in.id,
										tbl_discount_program.program_name,
										tbl_discount_program.discount,
										tbl_discount_program.date_start,
										tbl_discount_program.date_end,
										tbl_product_items.product_name,
										tbl_product_items.quantity 
									FROM
										tbl_discount_program_in
										INNER JOIN tbl_discount_program ON tbl_discount_program.id = tbl_discount_program_in.id_discount_program
										INNER JOIN tbl_product_items ON tbl_product_items.id = tbl_discount_program_in.id_product_item 
									WHERE
										tbl_discount_program_in.status = 'Y' 
										AND tbl_discount_program.status = 'Y'");
		return $sql->getResultArray();
	}

	public function items()
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
		$builder->where('tbl_product_items.quantity >', 0);
		//dd($builder);
		return $builder->get()->getResultArray();
	}

	public function save_in($data)
	{
		$db = \Config\Database::connect();
		$sql = $db->table('tbl_discount_program_in');
		$sql->insert($data);
	}

	public function delete_in($id)
	{
		$this->db->transStart();
		$this->db->query("UPDATE tbl_discount_program_in SET tbl_discount_program_in.status = 'D' WHERE tbl_discount_program_in.id='$id' AND tbl_discount_program_in.status != 'D'");
		$this->db->transComplete();
	}
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
	protected $table                = 'tbl_menus';
	protected $primaryKey           = 'id';
	protected $returnType           = 'array';
	protected $allowedFields        = ['category_menu', 'menu_name', 'sequence', 'status', 'parent_id', 'icon_menu', 'link_menu', 'user_create', 'user_update', 'user_delete'];

	// Dates
	protected $useTimestamps        = true;


	public function category_menu()
	{
		$db      = \Config\Database::connect();
		$builder = $db->table('tbl_category_menus');

		return $builder->get();
	}

	public function submenu($id)
	{
		$builder = $this->builder();
		$builder->getTable('tbl_menus');
		$builder->select('tbl_menus.id, tbl_menus.category_menu, tbl_menus.menu_name, tbl_menus.sequence, tbl_menus.status, tbl_menus.icon_menu, tbl_menus.link_menu,tbl_category_menus.id as id_cat, tbl_category_menus.name');
		$builder->join('tbl_category_menus', 'tbl_category_menus.id = tbl_menus.category_menu', 'left');
		$builder->where('tbl_menus.id', $id);
		$row = $builder->get()->getResultArray();
		return $row;

		// return $this->db->table('tbl_menus')
		// 	->select('tbl_menus.id, tbl_menus.menu_name, tbl_menus.sequence, tbl_menus.status, tbl_menus.icon_menu, tbl_menus.link_menu,tbl_category_menus.id as id_cat, tbl_category_menus.name')
		// 	->join('tbl_category_menus', 'tbl_category_menus.id = tbl_menus.category_menu', 'left')->get()->getResultArray();
	}

	function del_role_menu($id)
	{

		$db = \Config\Database::connect();
		$db->transStart();
		$sql = $db->table('tbl_role_menus');
		$sql->delete(['id_menu' => $id]);
		$sql2 = $this->table('tbl_menus');
		$sql2->delete(['id' => $id]);
		$db->transComplete();
	}
}

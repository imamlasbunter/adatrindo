<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
	protected $table                = 'tbl_users';
	protected $primaryKey           = 'id';
	protected $allowedFields        = ['username', 'password', 'salt', 'name', 'email', 'level', 'user_create', 'user_update', 'user_delete'];

	// Dates
	protected $useTimestamps        = true;

	public function index()
	{
		return $this->table('tbl_users')->select('tbl_users.id, tbl_users.username, tbl_users.name, tbl_users.email, tbl_users.level, tbl_levels.descripsion')->join('tbl_levels', 'tbl_levels.id = tbl_users.level')->get()->getResultArray();
	}
	public function search($keyword)
	{

		return $this->table('tbl_users')->select('tbl_users.id, tbl_users.username, tbl_users.name, tbl_users.email, tbl_users.level, tbl_levels.descripsion')->join('tbl_levels', 'tbl_levels.id = tbl_users.level')->like('username', $keyword)->orLike('name', $keyword);
	}

	public function level()
	{
		$db = \Config\Database::connect();
		return $db->table('tbl_levels')->get()->getResultArray();

		// $builder = $this->table('tbl_levels');
		// $builder->select('*');
		// return $builder;
	}
}

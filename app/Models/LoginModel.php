<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
	protected $table = 'tbl_users';
	protected $primaryKey = 'id';

	public function checkFirst($username)
	{

		return  $this->table('tbl_users')
			->where('username', $username)
			->get()->getRowArray();

		//dd($return);
	}

	public function LoginCheck($username, $password)
	{

		return  $this->table('tbl_users')
			->select('tbl_users.*, tbl_levels.descripsion')
			->where(array('username' => $username, 'password' => $password))
			->join('tbl_levels', 'tbl_levels.id = tbl_users.level', 'left')
			->get()->getRowArray();
		//dd($return);
	}
}

<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Tblroles extends Seeder
{
	public function run()
	{
		$data_insert = [
			[
				'id_menu' => 1,
				'id_level' => 1,
				'status' => 'Y',
				'user_create' => 'System'
			],
			$data_insert = [
				'id_menu' => 2,
				'id_level' => 1,
				'status' => 'Y',
				'user_create' => 'System'
			],
			$data_insert = [
				'id_menu' => 3,
				'id_level' => 1,
				'status' => 'Y',
				'user_create' => 'System'
			],
			$data_insert = [
				'id_menu' => 4,
				'id_level' => 1,
				'status' => 'Y',
				'user_create' => 'System'
			],
			$data_insert = [
				'id_menu' => 5,
				'id_level' => 1,
				'status' => 'Y',
				'user_create' => 'System'
			],
			$data_insert = [
				'id_menu' => 6,
				'id_level' => 1,
				'status' => 'Y',
				'user_create' => 'System'
			],
			[
				'id_menu' => 7,
				'id_level' => 1,
				'status' => 'Y',
				'user_create' => 'System'
			],
			$data_insert = [
				'id_menu' => 8,
				'id_level' => 1,
				'status' => 'Y',
				'user_create' => 'System'
			],
			$data_insert = [
				'id_menu' => 9,
				'id_level' => 1,
				'status' => 'Y',
				'user_create' => 'System'
			],
			$data_insert = [
				'id_menu' => 10,
				'id_level' => 1,
				'status' => 'Y',
				'user_create' => 'System'
			],
			$data_insert = [
				'id_menu' => 11,
				'id_level' => 1,
				'status' => 'Y',
				'user_create' => 'System'
			],
			$data_insert = [
				'id_menu' => 12,
				'id_level' => 1,
				'status' => 'Y',
				'user_create' => 'System'
			],
			$data_insert = [
				'id_menu' => 13,
				'id_level' => 1,
				'status' => 'Y',
				'user_create' => 'System'
			],
			$data_insert = [
				'id_menu' => 14,
				'id_level' => 1,
				'status' => 'Y',
				'user_create' => 'System'
			],
			$data_insert = [
				'id_menu' => 15,
				'id_level' => 1,
				'status' => 'Y',
				'user_create' => 'System'
			]
		];

		foreach ($data_insert as $data) {
			$this->db->table('tbl_role_menus')->insert($data);
		}
	}
}

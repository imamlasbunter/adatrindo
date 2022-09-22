<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Tblcategorymenu extends Seeder
{
	public function run()
	{
		$data_insert = [
			[
				'id' => 1,
				'name' => 'MAIN MENU',
				'user_create' => 'System'
			],
			[
				'id' => 2,
				'name' => 'REPORT',
				'user_create' => 'System'
			],
			[
				'id' => 3,
				'name' => 'SETTING',
				'user_create' => 'System'
			]
		];

		foreach ($data_insert as $data) {

			$this->db->table('tbl_category_menus')->insert($data);
		}
	}
}

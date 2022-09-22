<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TblLevel extends Seeder
{
	public function run()
	{
		$data_level = [
			['descripsion' => 'Admin', 'user_create' => 'System']

		];

		foreach ($data_level as $data) {
			$this->db->table('tbl_levels')->insert($data);
		}
	}
}

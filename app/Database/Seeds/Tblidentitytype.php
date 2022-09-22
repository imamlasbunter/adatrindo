<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Tblidentitytype extends Seeder
{
	public function run()
	{
		$data_insert = [
			[
				'name_type' => 'KTP',
				'user_create' => 'System'
			],
			[
				'name_type' => 'Passport',
				'user_create' => 'System'
			],
			[
				'name_type' => 'SIM',
				'user_create' => 'System'
			],
		];

		foreach ($data_insert as $data) {
			$this->db->table('tbl_identity_type')->insert($data);
		}
	}
}

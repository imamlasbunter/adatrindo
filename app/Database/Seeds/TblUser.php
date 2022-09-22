<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TblUser extends Seeder
{
	public function run()
	{
		// membuat data
		$tbl_user_data = [
			[
				'username' => 'admin',
				'password'  => '0192023a7bbd73250516f069df18b50060cf29177ae836.78292036',
				'salt'  => '60cf29177ae836.78292036',
				'name' => 'Aziz Hadi Dwiputra',
				'email' => 'admin@gamil.com',
				'level' => 1,
				'user_create' => 'System'
			],
		];

		foreach ($tbl_user_data as $data) {
			// insert semua data ke tabel
			$this->db->table('tbl_users')->insert($data);
		}
	}
}

<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TblCurrency extends Seeder
{
	public function run()
	{
		$data_tbl_currency = [
			[
				'symbol' => 'Rp',
				'code' => 'IDR',
				'currency_name' => 'Rupiah',
				'country' => 'Indonesia',
				'user_create' => 'System'
			],
			[
				'symbol' => '$',
				'code' => 'USD',
				'currency_name' => 'Dollar',
				'country' => 'United States of America',
				'user_create' => 'System'
			],
			[
				'symbol' => '฿',
				'code' => 'THB',
				'currency_name' => 'Baht',
				'country' => 'Thailand',
				'user_create' => 'System'
			],
			[
				'symbol' => '¥',
				'code' => 'CNY',
				'currency_name' => 'Yuan',
				'country' => 'Tiongkok',
				'user_create' => 'System'
			]


		];

		foreach ($data_tbl_currency as $data) {
			$this->db->table('tbl_currency')->insert($data);
		}
	}
}

<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Database\SQLite3\Table;

class TblPaymentTerms extends Seeder
{
	public function run()
	{
		$data_payment_terms = [
			['payment_term' => 'Cash on delivery', 'user_create' => 'System'],
			['payment_term' => 'Net 15', 'user_create' => 'System'],
			['payment_term' => 'Net 28', 'user_create' => 'System'],
			['payment_term' => 'Tempo 15 days', 'user_create' => 'System'],
			['payment_term' => 'Tempo 28 days', 'user_create' => 'System']
		];

		foreach ($data_payment_terms as $data) {
			$this->db->table('tbl_payment_terms')->insert($data);
		}
	}
}

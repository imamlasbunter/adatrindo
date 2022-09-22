<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TblTaxes extends Seeder
{
    public function run()
    {
        $data_insert = [
            [

                'tax_name' => 'PPN',
                'tax' => '11%',
                'tax_persen' => '0.11',
                'tax_status' => 'A',
                'user_create' => 'System',
                'created_at' => date('Y-m-d H:is')
            ]
        ];

        foreach ($data_insert as $data) {
            $this->db->table('tbl_taxes')->insert($data);
        }
    }
}

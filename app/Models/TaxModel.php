<?php

namespace App\Models;

use CodeIgniter\Model;

class TaxModel extends Model
{
    protected $table            = 'tbl_taxes';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'tax_name',
        'tax',
        'tax_persen',
        'tax_status',
        'user_create',
        'created_at',
        'tax_category',
        'user_update',
        'updated_at'

    ];
    // Dates
    protected $useTimestamps        = false;

    public function index()
    {
        $builder = $this->table('tbl_taxes');
        $builder->select('*');
        //dd($builder);
        return $builder->get()->getResultArray();
    }
}

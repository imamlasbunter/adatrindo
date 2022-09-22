<?php

namespace App\Models;

use CodeIgniter\Database\Config;
use CodeIgniter\Model;

class CompanyModel extends Model
{
    protected $table                = 'tbl_profile_comp';
    protected $primaryKey           = 'id';
    protected $returnType           = 'array';
    protected $allowedFields        = [
        'logo',
        'logo_type',
        'show_logo',
        'company_name',
        'address',
        'shipping_address',
        'telp',
        'fax',
        'npwp',
        'website',
        'email',
        'bank_name',
        'bank_branch',
        'bank_address',
        'account_number',
        'bautno',
        'swift_code',
        'currency_id',
        'user_create',
        'user_update'
    ];
    // Dates
    protected $useTimestamps        = true;

    function currency()
    {
        $db      = \Config\Database::connect();
        return $db->table('tbl_currency')->get()->getresultarray();
    }

    function getData()
    {
        $sql = $this->table('tbl_profile_comp');
        $sql->select('tbl_profile_comp.*, tbl_currency.currency_name');
        $sql->join('tbl_currency', 'tbl_currency.id=tbl_profile_comp.currency_id', 'left');
        $result = $sql->get();
        return $result->getresultarray();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;


class AccountsettingModel extends Model
{
    protected $table                = 'tbl_account_lists';
    protected $primaryKey           = 'id';
    protected $returnType           = 'array';
    protected $allowedFields        = [
        'account_number',
        'account_name',
        'account_category_id',
        'user_create',
        'user_update'
    ];

    // Dates
    protected $useTimestamps        = true;

    function mapping($item_mapping)
    {
        $db = \config\Database::connect();
        $sql = $db->table('tbl_account_mapping');
        $sql->where('item_mapping', $item_mapping);
        return $sql->get()->getRow();
    }

    function list()
    {
        return $this->db->table('tbl_account_lists')->select('tbl_account_lists.id, tbl_account_lists.account_number, tbl_account_lists.account_name, tbl_account_categories.name ')->join('tbl_account_categories', 'tbl_account_lists.account_category_id = tbl_account_categories.id ', 'left')->limit('5')->get()->getResultArray();
    }

    function list_mapping()
    {
        // $tes = $this->db->table('tbl_account_lists')->select('tbl_account_lists.id, tbl_account_lists.account_number, tbl_account_lists.account_name, tbl_account_mapping.id_acc_list')->join('tbl_account_mapping', 'tbl_account_lists.id = tbl_account_mapping.id_acc_list', 'left')->get()->getResultArray();
        // // dd($tes);
        return $this->db->table('tbl_account_mapping')->groupBy('tbl_account_mapping.id_acc_list')->get()->getResultArray();
    }

    function category_save($data)
    {
        $db = \Config\Database::connect();
        $sql = $db->table('tbl_account_categories');
        $sql->insert($data);
    }

    function find_category($id = null)
    {
        $db      = \Config\Database::connect();
        if ($id == null) {
            return $db->table('tbl_account_categories')->limit('5')->get()->getresultarray();
        } else {
            return $db->table('tbl_account_categories')->where('id', $id)->limit('5')->get()->getresultarray();
        }
    }

    function delete_category($id)
    {
        $db = \Config\Database::connect();
        $sql = $db->table('tbl_account_categories');
        $sql->where('id', $id);
        $sql->delete();
    }

    function category_update($data, $id)
    {
        $db      = \Config\Database::connect();
        $sql = $db->table('tbl_account_categories');
        $sql->update($data, ['id' => $id]);
    }
}

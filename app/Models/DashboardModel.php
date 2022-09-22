<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    protected $table                = 'tbl_invoice';
    protected $primaryKey           = 'id';
    protected $returnType           = 'array';
    public function NewOrder()
    {
        $db = \Config\Database::connect();
        $date = date("Y-m-d") . ' 00:00:01';
        $date2 = date('Y-m-d', strtotime('+7 days')) . ' 23:59:59';
        // $date = date("2021-10-07") . ' 00:00:01';
        // $date2 = date('2021-10-14') . ' 23:59:59';

        $sql = $db->query("SELECT COUNT(*) as jml FROM tbl_invoice WHERE tbl_invoice.created_at >= '" . $date . "' AND tbl_invoice.created_at <= '" . $date2 . "' ");
        return $sql->getResultArray();
    }

    function stockRepeat()
    {
        $sql = $this->db->query(" SELECT COUNT(*) as jml FROM tbl_product_items WHERE tbl_product_items.quantity = 1 or tbl_product_items.quantity = 0");
        return $sql->getResultArray();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class SalesModelReport extends Model
{
	protected $table                = 'tbl_invoice';
	protected $primaryKey           = 'id';
	protected $returnType           = 'array';
	//protected $allowedFields        = [];

	// Dates
	protected $useTimestamps        = true;

	function dayly($date_dayly_weekly)
	{
		$month = substr($date_dayly_weekly, 0, 2);
		$year = substr($date_dayly_weekly, 3, 4);

		$sql = $this->db->query("SELECT * FROM tbl_invoice Where DATE_FORMAT(tbl_invoice.created_at, '%m') = '$month' AND DATE_FORMAT(tbl_invoice.created_at, '%y') = '$year'");
		// $sql = "SELECT * FROM tbl_invoice Where DATE_FORMAT(tbl_invoice.created_at, '%m') = '$month' AND DATE_FORMAT(tbl_invoice.created_at, '%Y') = '$year'";
		// print_r($sql);
		// die;
		return $sql->getResult();
	}
	function getInvoice()
	{
		$sql = $this->db->query("SELECT * FROM tbl_invoice  ORDER BY id DESC");
		return $sql->getResultArray();
	}

	function in()
	{
	}
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DashboardModel;

class Dashboard extends BaseController
{
	public function __construct()
	{
		$this->dashboardModel = new DashboardModel();
	}
	public function index()
	{
		$data = [
			'title' => 'Dashboard',
			'h1' => 'Dashboard',
			'breadcrumb' => 'Dashboard',
			'newOrder'  => $this->dashboardModel->NewOrder(),
			'stockRepeat' => $this->dashboardModel->stockRepeat(),
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];
		echo view('v_dashboard', $data);
	}

	public function graph()
	{
		$report_type = 'Sales Report';
		// dd($report_type);
		$date_start =  date('Y-m-d', strtotime('first day of january this year'));
		$date_end =  date('Y-m-d');

		$start = $date_start;
		$end = $date_end;
		$result = array();
		$from = mktime(1, 0, 0, substr($start, 5, 2), substr($start, 8, 2), substr($start, 0, 4));
		$until = mktime(1, 0, 0, substr($end, 5, 2), substr($end, 8, 2), substr($end, 0, 4));
		if ($until >= $from) {
			array_push($result, date('Y-m-d', $from));
			while ($from < $until) {
				$from += 86400;
				array_push($result, date('Y-m-d', $from));
			}
		}

		$arr_label_month = array();
		$arr_year_month = array();
		$arr_month = array();
		for ($i = 0; $i < count($result); $i++) {
			if (!in_array(date('F Y', strtotime($result[$i])), $arr_label_month)) {
				$arr_label_month[] = date('F Y', strtotime($result[$i]));
				$arr_year_month[] = date('Y-m', strtotime($result[$i]));
				$arr_month[] = date('n', strtotime($result[$i]));
			}
		}
		$arr_jml = array();
		for ($i = 0; $i < count($arr_month); $i++) {
			$the_start_of_date = date('Y-m-d', strtotime($arr_year_month[$i] . '-01'));
			if ($start > $the_start_of_date) {
				$date_start = $start;
			} else {
				$date_start = $the_start_of_date;
			}

			$the_end_of_date = date('Y-m-t', strtotime($arr_year_month[$i] . '-01'));
			if ($end < $the_end_of_date) {
				$date_end = $end;
			} else {
				$date_end = $the_end_of_date;
			}
			$db = \Config\Database::connect();
			$sql = $db->query("SELECT count(tbl_invoice.id) as jml FROM tbl_invoice Where tbl_invoice.created_at >= '$date_start' AND tbl_invoice.created_at <= '$date_end' ");

			foreach ($sql->getResult() as $row) {
				$arr_jml[] = $row->jml;
			}
		}

		$data['monthly'] = $arr_label_month;
		$data['arr_jml'] = $arr_jml;
		$data['title-graph'] = $report_type;
		$data['description-graph'] = 'Montly chart is calculate Montly sales amount';
		echo json_encode($data, true);

		// echo '<pre>';
		// print_r($arr_label_month);
		// echo '<pre>';
		// printphp spark_r($arr_jml);
		// echo '<pre>';
		// die;
		// echo $date_start . '-' . $date_end;

	}

	public function popularProduct()
	{

		$date_start =  date('Y-m-d', strtotime('first day of january this year'));
		$date_end =  date('Y-m-d');
		$db = \Config\Database::connect();
		$arr_jml = array();
		$arr_product_name = array();
		$sql = $db->query("SELECT tbl_product_items.product_name, SUM(tbl_invoice_detail.quantity) AS most_popular FROM tbl_invoice INNER JOIN tbl_invoice_detail ON tbl_invoice_detail.nomor_invoice = tbl_invoice.nomor_invoice INNER JOIN tbl_product_items ON tbl_product_items.id = tbl_invoice_detail.id_product_item WHERE tbl_invoice.created_at >= '$date_start' AND tbl_invoice.created_at <= '$date_end' GROUP BY tbl_invoice_detail.nomor_invoice ORDER BY most_popular DESC LIMIT 0,5");

		foreach ($sql->getResult() as $row) {
			$arr_jml[] = $row->most_popular;
			$arr_product_name[] = $row->product_name;
		}


		$data['arr_product_name'] = $arr_product_name;
		$data['arr_jml'] = $arr_jml;
		// $data['title-graph'] = ucwords(str_replace('_', ' ', $report_type));
		// $data['title-graph'] = $report_type;
		$data['description-graph'] = 'Montly chart is calculate Montly most popular product sales';

		echo json_encode($data, true);
	}
}

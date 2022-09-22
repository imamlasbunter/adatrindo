<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductitemsModel;
use App\Models\SalesModelReport;
use App\Models\StockinoutModelReport;

class Stockinoutreport extends BaseController
{
	public function __construct()
	{
		$this->itemsModel = new ProductitemsModel();
		$this->salesModelReport = new SalesModelReport();
		$this->stockinoutModelReport = new StockinoutModelReport();
	}
	public function index()
	{
		$data = [
			'title' => 'Stock In Out|Report',
			'h1' => 'Stock In Out Report',
			'breadcrumb' => 'Sales Report',
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];
		echo view('report/stock/v_stockinout_report', $data);
	}

	public function StockIn()
	{
		$data = [
			'title' => 'Stock In Out|Report',
			'h1' => 'Stock In Out Report',
			'h2' => 'Stock In',
			'report_type' => '',
			'breadcrumb' => 'Sales Report',
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];
		echo view('report/stock/v_stockinout_report_stock_in', $data);
	}


	public function graph()
	{

		$report_type = $this->request->getPost('report_type');
		$date_daily_weekly = $this->request->getPost('date_daily_weekly');
		// dd($report_type);
		if ($report_type == 'daily') {
			// $date_daily_weekly = $this->request->getPost('date_daily_weekly');
			$month = substr($date_daily_weekly, 0, 2);
			$year = substr($date_daily_weekly, 3, 4);
			$firstDay = mktime(0, 0, 0, substr($date_daily_weekly, 0, 2), 1, substr($date_daily_weekly, 3, 4));
			$lastDay = mktime(0, 0, 0, substr($date_daily_weekly, 0, 2), date('t'), substr($date_daily_weekly, 3, 4));
			$firstDay = date("d", $firstDay);
			$lastDay = date("d", $lastDay);

			$arr_label_day = array();
			$arr_jml = array();
			$sql = array();
			for ($i = $firstDay; $i <= $lastDay; $i++) {
				if (strlen($i) == 1) {
					$arr_label_day[] = '0' . $i;
					$day = '0' . $i;
				} else {
					$arr_label_day[] = $i;
					$day = $i;
				}
				$db = \Config\Database::connect();
				$sql = $db->query("SELECT sum(tbl_stock_in.qty) as jml FROM tbl_stock_in Where DATE_FORMAT(tbl_stock_in.created_at, '%d') = '$day' AND DATE_FORMAT(tbl_stock_in.created_at, '%m') = '$month' AND DATE_FORMAT(tbl_stock_in.created_at, '%Y') = '$year'");

				foreach ($sql->getResult() as $row) {
					$arr_jml[] = $row->jml;
				}
			}
			$data['day'] = $arr_label_day;
			$data['arr_jml'] = $arr_jml;
			// $data['title-graph'] = ucwords(str_replace('_', ' ', $report_type));
			$data['title-graph'] = $report_type;
			$data['description-graph'] = 'Weekly chart is calculate daily sales amount';

			echo json_encode($data, true);
			// echo '<pre>';
			// print_r($arr_label_day);
			// echo '<pre>';
			// print_r($arr_jml);
			// echo '<pre>';
			// die;
		} else if ($report_type == 'weekly') {
			$date_daily_weekly = $this->request->getPost('date_daily_weekly');
			// echo $date_daily_weekly;
		} else if ($report_type == 'monthly') {
			$date_start =  date('Y-m-d', strtotime($this->request->getPost('date_start')));
			$date_end =  date('Y-m-d', strtotime($this->request->getPost('date_end')));

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
				$sql = $db->query("SELECT sum(tbl_stock_in.qty) as jml FROM tbl_stock_in Where tbl_stock_in.created_at >= '$date_start' AND tbl_stock_in.created_at <= '$date_end' ");

				foreach ($sql->getResult() as $row) {
					$arr_jml[] = $row->jml;
				}
			}

			$data['monthly'] = $arr_label_month;
			$data['arr_jml'] = $arr_jml;
			// $data['title-graph'] = ucwords(str_replace('_', ' ', $report_type));
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
		} else if ($report_type == 'yearly') {


			$year_start = $this->request->getPost('year_start');
			$year_end = $this->request->getPost('year_end');
			// echo $year_start.'-'.$year_end;
			// die;

			$start = '2021-10-01';
			$end = '2021-11-21';

			$result = array();
			$from = mktime(1, 0, 0, substr($start, 5, 2), substr($start, 8, 2), substr($start, 0, 4));
			$until = mktime(1, 0, 0, substr($end, 5, 2), substr($end, 8, 2), substr($end, 0, 4));
			if ($until >= $from) {
				array_push($result, date('Y', $from));
				while ($from < $until) {
					$from += 86400;
					array_push($result, date('Y', $from));
				}
			}

			$arr_label_month = array();
			$arr_year_month = array();
			$arr_month = array();
			$arr_label_year = array();
			for ($i = $year_start; $i <= $year_end; $i++) {
				$arr_label_year[] = $i;
			}

			$arr_jml = array();
			for ($i = $year_start; $i <= $year_end; $i++) {

				$db = \Config\Database::connect();
				$sql = $db->query("SELECT sum(tbl_stock_in.qty) as jml FROM tbl_stock_in Where DATE_FORMAT(tbl_stock_in.created_at, '%Y') = '$i'");

				foreach ($sql->getResult() as $row) {
					$arr_jml[] = $row->jml;
				}
			}

			$data['yearly'] = $arr_label_year;
			$data['arr_jml'] = $arr_jml;
			$data['title-graph'] = $report_type;
			$data['description-graph'] = 'Yearly chart is calculate yearly sales amount';

			echo json_encode($data, true);

			// echo '<pre>';
			// print_r($tahun);
			// echo '<pre>';
			// print_r($arr_year_month);
			// echo '<pre>';
			// print_r($arr_month);
			// echo '<pre>';
			// print_r($arr_label_year);
			// echo '<pre>';

		}
	}

	public function StockOut()
	{
		$data = [
			'title' => 'Stock In Out|Report',
			'h1' => 'Stock In Out Report',
			'h2' => 'Stock Out',
			'report_type' => '',
			'breadcrumb' => 'Sales Report',
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];
		echo view('report/stock/v_stockinout_report_stock_out', $data);
	}

	public function graph2()
	{

		$report_type = $this->request->getPost('report_type');
		$date_daily_weekly = $this->request->getPost('date_daily_weekly');
		// dd($report_type);
		if ($report_type == 'daily') {
			// $date_daily_weekly = $this->request->getPost('date_daily_weekly');
			$month = substr($date_daily_weekly, 0, 2);
			$year = substr($date_daily_weekly, 3, 4);
			$firstDay = mktime(0, 0, 0, substr($date_daily_weekly, 0, 2), 1, substr($date_daily_weekly, 3, 4));
			$lastDay = mktime(0, 0, 0, substr($date_daily_weekly, 0, 2), date('t'), substr($date_daily_weekly, 3, 4));
			$firstDay = date("d", $firstDay);
			$lastDay = date("d", $lastDay);

			$arr_label_day = array();
			$arr_jml = array();
			$sql = array();
			for ($i = $firstDay; $i <= $lastDay; $i++) {
				if (strlen($i) == 1) {
					$arr_label_day[] = '0' . $i;
					$day = '0' . $i;
				} else {
					$arr_label_day[] = $i;
					$day = $i;
				}
				$db = \Config\Database::connect();
				$sql = $db->query("SELECT sum(tbl_stock_out.qty) as jml FROM tbl_stock_out Where DATE_FORMAT(tbl_stock_out.created_at, '%d') = '$day' AND DATE_FORMAT(tbl_stock_out.created_at, '%m') = '$month' AND DATE_FORMAT(tbl_stock_out.created_at, '%Y') = '$year'");

				foreach ($sql->getResult() as $row) {
					$arr_jml[] = $row->jml;
				}
			}


			$data['day'] = $arr_label_day;
			$data['arr_jml'] = $arr_jml;
			// $data['title-graph'] = ucwords(str_replace('_', ' ', $report_type));
			$data['title-graph'] = $report_type;
			$data['description-graph'] = 'Weekly chart is calculate daily sales amount';

			echo json_encode($data, true);

			// echo '<pre>';
			// print_r($arr_label_day);
			// echo '<pre>';
			// print_r($arr_jml);
			// echo '<pre>';
			// die;
		} else if ($report_type == 'weekly') {
			$date_daily_weekly = $this->request->getPost('date_daily_weekly');
			// echo $date_daily_weekly;
		} else if ($report_type == 'monthly') {
			$date_start =  date('Y-m-d', strtotime($this->request->getPost('date_start')));
			$date_end =  date('Y-m-d', strtotime($this->request->getPost('date_end')));

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
				$sql = $db->query("SELECT sum(tbl_stock_out.qty) as jml FROM tbl_stock_out Where tbl_stock_out.created_at >= '$date_start' AND tbl_stock_out.created_at <= '$date_end' ");

				foreach ($sql->getResult() as $row) {
					$arr_jml[] = $row->jml;
				}
			}

			$data['monthly'] = $arr_label_month;
			$data['arr_jml'] = $arr_jml;
			// $data['title-graph'] = ucwords(str_replace('_', ' ', $report_type));
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
		} else if ($report_type == 'yearly') {


			$year_start = $this->request->getPost('year_start');
			$year_end = $this->request->getPost('year_end');
			// echo $year_start.'-'.$year_end;
			// die;

			$start = '2021-10-01';
			$end = '2021-11-21';

			$result = array();
			$from = mktime(1, 0, 0, substr($start, 5, 2), substr($start, 8, 2), substr($start, 0, 4));
			$until = mktime(1, 0, 0, substr($end, 5, 2), substr($end, 8, 2), substr($end, 0, 4));
			if ($until >= $from) {
				array_push($result, date('Y', $from));
				while ($from < $until) {
					$from += 86400;
					array_push($result, date('Y', $from));
				}
			}

			$arr_label_month = array();
			$arr_year_month = array();
			$arr_month = array();
			$arr_label_year = array();
			for ($i = $year_start; $i <= $year_end; $i++) {
				$arr_label_year[] = $i;
			}

			$arr_jml = array();
			for ($i = $year_start; $i <= $year_end; $i++) {

				$db = \Config\Database::connect();
				$sql = $db->query("SELECT sum(tbl_stock_out.qty) as jml FROM tbl_stock_out Where DATE_FORMAT(tbl_stock_out.created_at, '%Y') = '$i'");

				foreach ($sql->getResult() as $row) {
					$arr_jml[] = $row->jml;
				}
			}

			$data['yearly'] = $arr_label_year;
			$data['arr_jml'] = $arr_jml;
			$data['title-graph'] = $report_type;
			$data['description-graph'] = 'Yearly chart is calculate yearly sales amount';

			echo json_encode($data, true);

			// echo '<pre>';
			// print_r($tahun);
			// echo '<pre>';
			// print_r($arr_year_month);
			// echo '<pre>';
			// print_r($arr_month);
			// echo '<pre>';
			// print_r($arr_label_year);
			// echo '<pre>';

		}
	}

	public function in()
	{
	}
}

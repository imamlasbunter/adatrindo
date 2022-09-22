<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductitemsModel;
use App\Models\SalesModelReport;
use App\Models\SalesModel;
use App\ThirdParty\FPDF;

class Salesreport extends BaseController
{
	public function __construct()
	{
		$this->itemsModel = new ProductitemsModel();
		$this->salesModelReport = new SalesModelReport();
		$this->salesModel = new SalesModel();
	}
	public function index()
	{
		$data = [
			'title' => 'Sales|Report',
			'category_menu' => 'Main Menu',
			'h1' => 'Sales Report',
			'breadcrumb' => 'Sales Report',
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];
		echo view('report/sales/v_sales_report', $data);
	}

	public function productSales()
	{
		$data = [
			'title' => 'Sales|Report',
			'category_menu' => 'Main Menu',
			'h1' => 'Sales Report',
			'h2' => 'Product Sales',
			'report_type' => '',
			'breadcrumb' => 'Sales Report',
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];
		echo view('report/sales/v_sales_report_product_sales', $data);
	}

	public function productSales1()
	{
		$report_type = $this->request->getPost('report_type');
		$date_daily_weekly = $this->request->getPost('date_daily_weekly');
		$data = [
			'title' => 'Sales|Report',
			'category_menu' => 'Main Menu',
			'h1' => 'Sales Report',
			'h2' => 'Product Sales',
			'report_type' => '',
			'breadcrumb' => 'Sales Report',
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];
		// echo view('report/sales/v_sales_report_product_sales?' . 'report_type=' . $report_type . 'date_daily_weekly' . $date_daily_weekly, $data);
		return redirect()->to('report/sales/v_sales_report_product_sales?' . 'report_type=' . $report_type . 'date_daily_weekly' . $date_daily_weekly);
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
				$sql = $db->query("SELECT count(tbl_invoice.id) as jml FROM tbl_invoice Where DATE_FORMAT(tbl_invoice.created_at, '%d') = '$day' AND DATE_FORMAT(tbl_invoice.created_at, '%m') = '$month' AND DATE_FORMAT(tbl_invoice.created_at, '%Y') = '$year'");

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
				$sql = $db->query("SELECT count(tbl_invoice.id) as jml FROM tbl_invoice Where tbl_invoice.created_at >= '$date_start' AND tbl_invoice.created_at <= '$date_end' ");

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
				$sql = $db->query("SELECT count(tbl_invoice.id) as jml FROM tbl_invoice Where DATE_FORMAT(tbl_invoice.created_at, '%Y') = '$i'");

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

	public function PopularProduct()
	{
		$data = [
			'title' => 'Sales|Report',
			'category_menu' => 'Main Menu',
			'h1' => 'Sales Report',
			'h2' => 'Popular Products',
			'breadcrumb' => 'Sales Report',
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];
		echo view('report/sales/v_sales_report_popular_product', $data);
	}

	public function graph2()
	{

		$date_start =  date('Y-m-d', strtotime($this->request->getPost('date_start')));
		$date_end =  date('Y-m-d', strtotime($this->request->getPost('date_end')));
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
	public function invoiceReport()
	{
		$data = [
			'title' => 'Sales|Report',
			'category_menu' => 'Main Menu',
			'h1' => 'Sales Report',
			'h2' => 'Invoice',
			'breadcrumb' => 'Sales Report',
			'product' => $this->itemsModel->index(),
			'invoice' => $this->salesModelReport->getInvoice(),
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];
		echo view('report/sales/v_sales_report_invoice', $data);
	}
	public function invoice()
	{
		$no_invoice = $this->request->getGet('no_invoice');
		$db = \Config\Database::connect();
		$sql = $db->query("SELECT * FROM tbl_profile_comp");
		if ($sql->getNumRows()) {
			$row = $sql->getRow();
			$comp_name = $row->company_name;
			$comp_address = $row->address;
			$comp_telp = $row->telp;
			$comp_email = $row->email;
			$comp_bank = $row->bank_name;
			$comp_bank_account = $row->account_number;
			$comp_bank_account_under_name = $row->bautno;
		} else {
			$comp_name = '';
			$comp_address = '';
			$comp_telp = '';
			$comp_email = '';
			$comp_bank = '';
			$comp_bank_account = '';
			$comp_bank_account_under_name = '';
		}

		$sql2 = $db->query("SELECT * FROM tbl_invoice WHERE nomor_invoice = '" . $no_invoice . "'");
		if ($sql2->getNumRows()) {
			$row2 = $sql2->getRow();
			$contact_name = $row2->contact_name;
			$contact_company = $row2->contact_company;
			$contact_telp = $row2->contact_telp;
			$contact_email = $row2->contact_email;
			$contact_address = $row2->contact_address;
		} else {
			$contact_name = '';
			$contact_company = '';
			$contact_telp = '';
			$contact_email = '';
			$contact_address = '';
		}
		$data = [
			'title' => 'Sales|Report',
			'category_menu' => 'Main Menu',
			'h1' => 'Sales Report',
			'h2' => 'Invoice',
			'h3' => 'Detail',
			'no_invoice' => $no_invoice,
			'comp_name' => $comp_name,
			'comp_address' => $comp_address,
			'comp_telp' => $comp_telp,
			'comp_email' => $comp_email,
			'comp_bank' => $comp_bank,
			'contact_name' => $contact_name,
			'contact_company' => $contact_company,
			'contact_telp' => $contact_telp,
			'contact_email' => $contact_email,
			'contact_address' => $contact_address,
			'comp_bank_account' => $comp_bank_account,
			'comp_bank_account_under_name' => $comp_bank_account_under_name,
			'breadcrumb' => 'Sales',
			'invoice' => $this->salesModel->getInvoice($no_invoice),
			'grandTotal' => $this->salesModel->grandTotalInv1($no_invoice),
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];
		echo view('sales/v_invoice', $data);
	}
	public function invoicePrint2()
	{
		$no_invoice = $this->request->getGet('no_invoice');
		$db = \Config\Database::connect();
		$sql = $db->query("SELECT * FROM tbl_profile_comp");
		if ($sql->getNumRows()) {
			$row = $sql->getRow();
			$comp_name = $row->company_name;
			$comp_address = $row->address;
			$comp_telp = $row->telp;
			$comp_email = $row->email;
			$comp_bank = $row->bank_name;
			$comp_bank_account = $row->account_number;
			$comp_bank_account_under_name = $row->bautno;
		} else {
			$comp_name = '';
			$comp_address = '';
			$comp_telp = '';
			$comp_email = '';
			$comp_bank = '';
			$comp_bank_account = '';
			$comp_bank_account_under_name = '';
		}
		$data = [
			'title' => 'Sales|Report',
			'no_invoice' => $no_invoice,
			'comp_name' => $comp_name,
			'comp_address' => $comp_address,
			'comp_telp' => $comp_telp,
			'comp_email' => $comp_email,
			'comp_bank' => $comp_bank,
			'comp_bank_account' => $comp_bank_account,
			'comp_bank_account_under_name' => $comp_bank_account_under_name,
			'invoice' => $this->salesModel->getInvoice($no_invoice),
			'grandTotal' => $this->salesModel->grandTotalInv1($no_invoice)
		];
		echo view('sales/v_invoice_print2', $data);
	}

	public function in()
	{
	}
}

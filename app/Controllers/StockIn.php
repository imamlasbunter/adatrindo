<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StockinModel;

class StockIn extends BaseController
{
	public function __construct()
	{
		$this->stockinmodel = new Stockinmodel();
	}
	public function index()
	{
		$data = [
			'title' => 'Stock In',
			'h1' => 'Stock In',
			'breadcrumb' => 'Stock In',
			'stockout' => $this->stockinmodel->index(),
			'validation' => \Config\Services::validation(),
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];
		echo view('stock/v_stockin_index', $data);
	}

	public function save()
	{
		$db = \Config\Database::connect();
		$db->transStart();

		$id = $this->request->getPost('id');
		$qty_before_stockout = $this->request->getPost('qty_before_stockout');
		$quantity = $this->request->getPost('quantity');
		$qty_new = $qty_before_stockout + $quantity;
		// update quantity product item
		$data = [
			'quantity' => $qty_new,
			'user_update' =>  $this->request->getPost('usernamelogin'),
			'updated_date' => date('Y-m-d H:i:s')
		];
		$this->stockinmodel->update($id, $data);

		// insert stcok in history/log
		$data_insert = [
			'id_product_item' => $id,
			'product_code' => $this->request->getPost('product_code'),
			'qty' => $this->request->getPost('quantity'),
			'status' => 'si', //stock in
			'desc' => $this->request->getPost('description'),
			'user_create' =>  $this->request->getPost('usernamelogin'),
			'created_at' => date('Y-m-d H:i:s')
		];
		$this->stockinmodel->insert_stock_in($data_insert);
		$db->transComplete();
		session()->setFlashdata('success', 'The Data has been updated.');
		return redirect()->to('/stock-in');
	}

	public function detail($product_code)
	{
		$data = [
			'title' => 'Stck In',
			'h1' => 'Stock In',
			'h2' => 'History',
			'breadcrumb' => 'Stock In',
			'stockout' => $this->stockinmodel->history($product_code),
			'validation' => \Config\Services::validation(),
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];
		echo view('stock/v_stockin_detail', $data);
	}

	public function save_restore()
	{
		$db = \Config\Database::connect();
		$db->transStart();


		$id_product_item = $this->request->getPost('id_product_item'); // id tabel product item
		$product_item_qty = $this->request->getPost('product_item_qty'); // jumlah quantity product item
		$quantity_restore_si = $this->request->getPost('quantity_restore_si'); // jumlah produk item yang akan di restore produk item dari table stock in
		$qty_new = $product_item_qty - $quantity_restore_si; // jika stock in di restore quantity di product item berkurang

		$id = $this->request->getPost('id'); // id table srcok out
		$qty_si = $this->request->getPost('qty_si'); // jumlah quantity produk di tabel stock in
		$qty_si_new = $qty_si - $quantity_restore_si; // jika stock in di restore qty di tabel stock in berkurang

		// update product item
		$data = [
			'quantity' => $qty_new,
			'user_update' =>  $this->request->getPost('usernamelogin'),
			'updated_at' => date('Y-m-d H:i:s')
		];
		$this->stockinmodel->update($id_product_item, $data);
		// end update product item
		// update jumlah stock in qty
		$data_update_si = [
			'qty' => $qty_si_new,
			'user_update' =>  $this->request->getPost('usernamelogin'),
			'updated_at' => date('Y-m-d H:i:s')
		];
		$this->stockinmodel->update_qty_si($id, $data_update_si);
		// end update jumlah stock in qty
		// insert history stock in 
		$data_insert = [
			'id_stock_in ' => $id,
			'product_code' => $this->request->getPost('product_code'),
			'qty' => $this->request->getPost('quantity_restore_si'),
			'status' => 're', //restore stock out
			'desc' => $this->request->getPost('description'),
			'user_create' =>  $this->request->getPost('usernamelogin'),
			'created_at' => date('Y-m-d H:i:s')
		];
		$this->stockinmodel->insert_stock_in_log($data_insert);
		// end insert history stock in
		$db->transComplete();
		session()->setFlashdata('success', 'The Data has been updated.');
		return redirect()->to('/stock-in/detail/' . $this->request->getPost('product_code'));
	}
}

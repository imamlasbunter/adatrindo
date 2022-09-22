<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StockoutModel;

class StockOut extends BaseController
{
	public function __construct()
	{
		$this->StockoutModel = new StockoutModel();
	}
	public function index()
	{
		$data = [
			'title' => 'Stck out',
			'h1' => 'Stock Out',
			'breadcrumb' => 'Stock Out',
			'stockout' => $this->StockoutModel->index(),
			'validation' => \Config\Services::validation(),
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];
		echo view('stock/v_stockout_index', $data);
	}

	public function save()
	{
		$db = \Config\Database::connect();
		$db->transStart();

		$id = $this->request->getPost('id');
		$qty_before_stockout = $this->request->getPost('qty_before_stockout');
		$quantity = $this->request->getPost('quantity');
		$qty_new = $qty_before_stockout - $quantity;
		$data = [
			'quantity' => $qty_new,
			'user_update' =>  $this->request->getPost('usernamelogin'),
			'updated_date' => date('Y-m-d H:i:s')
		];
		$this->StockoutModel->update($id, $data);

		$data_insert = [
			'id_product_item' => $id,
			'product_code' => $this->request->getPost('product_code'),
			'qty' => $this->request->getPost('quantity'),
			'status' => 'so', //stock out
			'desc' => $this->request->getPost('description'),
			'user_create' =>  $this->request->getPost('usernamelogin'),
			'created_at' => date('Y-m-d H:i:s')
		];
		$this->StockoutModel->insert_stock_out($data_insert);
		$db->transComplete();
		session()->setFlashdata('success', 'The Data has been updated.');
		return redirect()->to('/stock-out');
	}

	public function detail($product_code)
	{
		$data = [
			'title' => 'Stock Out',
			'h1' => 'Stock Out',
			'h2' => 'History',
			'breadcrumb' => 'Stock Out',
			'stockout' => $this->StockoutModel->history($product_code),
			'validation' => \Config\Services::validation(),
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];
		echo view('stock/v_stockout_detail', $data);
	}

	public function save_restore()
	{
		$db = \Config\Database::connect();
		$db->transStart();


		$id_product_item = $this->request->getPost('id_product_item'); // id tabel product item
		$product_item_qty = $this->request->getPost('product_item_qty'); // jumlah quantity product item
		$quantity_restore_so = $this->request->getPost('quantity_restore_so'); // jumlah produk item yang akan di restore produk item dari table stock out
		$qty_new = $product_item_qty + $quantity_restore_so;

		$id = $this->request->getPost('id'); // id table srcok out
		$qty_so = $this->request->getPost('qty_so'); // jumlah quantity produk di tabel staock out
		$qty_so_new = $qty_so - $quantity_restore_so;

		// update product item
		$data = [
			'quantity' => $qty_new,
			'user_update' =>  $this->request->getPost('usernamelogin'),
			'updated_at' => date('Y-m-d H:i:s')
		];
		$this->StockoutModel->update($id_product_item, $data);
		// end update product item
		// update jumlah stock out qty
		$data_update_so = [
			'qty' => $qty_so_new,
			'user_update' =>  $this->request->getPost('usernamelogin'),
			'updated_at' => date('Y-m-d H:i:s')
		];
		$this->StockoutModel->update_qty_so($id, $data_update_so);
		// end update jumlah stock out qty
		// insert history stock out 
		$data_insert = [
			'id_stock_out ' => $id,
			'product_code' => $this->request->getPost('product_code'),
			'qty' => $this->request->getPost('quantity_restore_so'),
			'status' => 're', //restore stock out
			'desc' => $this->request->getPost('description'),
			'user_create' =>  $this->request->getPost('usernamelogin'),
			'created_at' => date('Y-m-d H:i:s')
		];
		$this->StockoutModel->insert_stock_out_log($data_insert);
		// end insert history stock out
		$db->transComplete();
		session()->setFlashdata('success', 'The Data has been updated.');
		return redirect()->to('/stock-out/detail/' . $this->request->getPost('product_code'));
	}
}

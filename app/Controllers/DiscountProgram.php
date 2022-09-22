<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductcategoryModel;
use App\Models\ProductunitsModel;
use App\Models\ProductitemsModel;
use App\Models\DiscountProgramModel;

class Discountprogram extends BaseController
{
	public function __construct()
	{
		$this->itemsModel = new ProductitemsModel();
		$this->unitsModel = new ProductunitsModel();
		$this->categoryModel = new ProductcategoryModel();
		$this->dpmodel = new DiscountProgramModel();
	}
	public function index()
	{

		$data = [
			'title' => 'Discount Program',
			'h1' => 'Discount Program',
			'breadcrumb' => 'Discount Program',
			'dp' => $this->dpmodel->index(),
			'dp_in' => $this->dpmodel->dp_in(),
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];

		echo view('discountprogram/v_discount_program_index', $data);
	}
	public function add()
	{

		$data = [
			'title' => 'Add|Discount Program',
			'h1' => 'Discount Program',
			'h2' => 'Add',
			'breadcrumb' => 'Discount Program / Add Discount Program',
			'validation' => \Config\Services::validation(),
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];
		echo view('discountprogram/v_discount_program_add', $data);
	}
	public function save()
	{
		$check = $this->validate([
			'program_name' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Please provide a program name.'
				]
			],
			'program_description' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Please provide a program description.'
				]
			],
			'date_start' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Please provide a date start.'
				]
			],
			'date_end' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Please provide a minimum date end.'
				]
			],
			'discount' => [
				'rules' => 'required|numeric',
				'errors' => [
					'required' => 'Please provide a discount.',
					'numeric' => 'Please provide a numeric'
				]
			]
		]);

		if (!$check) {
			return redirect()->to('discount-program/add')->withInput()->with('validation', $check);
		} else {
			$data = [
				'program_name' => $this->request->getPost('program_name'),
				'program_description' => $this->request->getPost('program_description'),
				'date_start' => date('Y-m-d', strtotime($this->request->getPost('date_start'))),
				'date_end' => date('Y-m-d', strtotime($this->request->getPost('date_end'))),
				'discount' => $this->request->getPost('discount'),
				'status' => 'Y',
				'user_create' =>  $this->request->getPost('usernamelogin'),
				'created_at' => date('Y-m-d H:i:s')


			];

			session()->setFlashdata('success', 'The Data has been saved successfully.');
			$this->dpmodel->save($data);
			return redirect()->to('discount-program');
		}
	}

	public function delete($id)
	{

		$this->dpmodel->deleteProgram($id);
		session()->setFlashdata('success', 'The Data has been deleted.');
		return redirect()->to('discount-program');
	}

	public function add_in()
	{

		$data = [
			'title' => 'Add|Product Discount',
			'h1' => 'Product Discount',
			'h2' => 'Add',
			'breadcrumb' => 'Discount Program / Add Product Discount',
			'validation' => \Config\Services::validation(),
			'dp' => $this->dpmodel->index(),
			'items' => $this->itemsModel->index(),
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];
		echo view('discountprogram/v_discount_program_add_in', $data);
	}

	public function save_in()
	{
		$check = $this->validate([
			'program_name' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Please provide a program name.'
				]
			],
			'product' => [
				'rules' => 'required|',
				'errors' => [
					'required' => 'Please provide a product.'
				]
			]
		]);

		if (!$check) {
			return redirect()->to('discount-program-in/add')->withInput()->with('validation', $check);
		} else {

			##validasi product id
			$db = \Config\Database::connect();
			$check = $db->query("SELECT * FROM tbl_discount_program_in WHERE id_discount_program = '" . $this->request->getPost('program_name') . "' AND id_product_item = '" . $this->request->getPost('product') . "' ");
			if ($check->getNumRows() > 0) {
				session()->setFlashdata('warning', 'The product is already registered in the program.');
				return redirect()->to('discount-program-in/add');
			} else {
				$data = [
					'id_discount_program' => $this->request->getPost('program_name'),
					'id_product_item' => $this->request->getPost('product'),
					'status' => 'Y',
					'user_create' =>  $this->request->getPost('usernamelogin'),
					'created_at' => date('Y-m-d H:i:s')


				];

				session()->setFlashdata('success', 'The Data has been saved successfully.');
				$this->dpmodel->save_in($data);
				return redirect()->to('discount-program');
			}
		}
	}

	public function delete_in($id)
	{

		$this->dpmodel->delete_in($id);
		session()->setFlashdata('success', 'The Data has been deleted.');
		return redirect()->to('discount-program');
	}
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CustomersModel;

class Customers extends BaseController
{
	protected $customersmodel;
	public function __construct()
	{
		$this->customersmodel = new CustomersModel();
		//$pager = \Config\Services::pager();
	}
	public function index()
	{

		$currentPage = $this->request->getVar('page_customers') ? $this->request->getVar('page_customers') : 1;

		$keyword = $this->request->getVar('keyword');
		if ($keyword) {
			$customer = $this->customersmodel->search($keyword);
		} else {
			$customer = $this->customersmodel;
		}

		$data = [
			'title' => 'Customers',
			'h1' => 'Customers',
			'breadcrumb' => 'Customers',
			'customer' => $customer->paginate(10, 'customers'),
			'pager' => $this->customersmodel->pager,
			'currentPage' => $currentPage,
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];

		echo view('customers/v_customers_index', $data);
	}

	public function add()
	{
		$data = [
			'title' => 'Add|Customers',
			'h1' => 'Add Customers',
			'breadcrumb' => 'Customers / Add Customers',
			'validation' => \Config\Services::validation(),
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];
		echo view('customers/v_customers_add', $data);
	}

	public function save()
	{
		$check = $this->validate([
			'name' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Please provide a customer name.'
				]
			],
			'no_telp' => [
				'rules' => 'required|numeric',
				'errors' => [
					'required' => 'Please provide a telephone number.',
					'numeric' => 'No. Telephone must be filled with numbers.'
				]
			],
			'address' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Please provide address detail.'
				]

			]
		]);

		if (!$check) {
			$validation = \Config\Services::validation();
			return redirect()->to('/customers/add')->withInput()->with('validation', $check);
		} else {

			$data = [
				'name' => $this->request->getPost('name'),
				'no_telp'  => $this->request->getPost('no_telp'),
				'address'  => $this->request->getPost('address'),
				'user_create' =>  $this->request->getPost('usernamelogin')
			];

			session()->setFlashdata('success', 'The Data has been saved successfully.');
			$this->customersmodel->save($data);
			return redirect()->to('/customers');
		}
	}

	public function edit($id)
	{

		$data = [
			'title' => 'Edit|Customers',
			'h1' => 'Edit Customers',
			'breadcrumb' => 'Customers / Edit Customers',
			'validation' => \Config\Services::validation(),
			'edit' => $this->customersmodel->find($id),
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];

		echo view('customers/v_customers_edit', $data);
	}

	public function update()
	{
		$check = $this->validate([
			'name' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Please provide a customer name.'
				]
			],
			'no_telp' => [
				'rules' => 'required|numeric',
				'errors' => [
					'required' => 'Please provide a telephone number.',
					'numeric' => 'No. Telephone must be filled with numbers.'
				]
			],
			'address' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Please provide address detail'
				]

			]
		]);

		if (!$check) {
			$validation = \Config\Services::validation();
			return redirect()->to('/customers/edit/' . $this->request->getPost('id'))->withInput()->with('validation', $check);
		} else {

			$id = $this->request->getPost('id');
			$data = [
				'name' => $this->request->getPost('name'),
				'no_telp'  => $this->request->getPost('no_telp'),
				'address'  => $this->request->getPost('address'),
				'user_update' =>  $this->request->getPost('usernamelogin')
			];

			session()->setFlashdata('success', 'The Data has been updated.');
			$this->customersmodel->update($id, $data);
			return redirect()->to('/customers');
		}
	}

	public function delete($id)
	{
		$this->customersmodel->delete($id);
		session()->setFlashdata('success', 'The Data has been deleted.');
		return redirect()->to('/customers');
	}
}

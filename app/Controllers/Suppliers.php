<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SupplierModel;
use Config\App;

class Suppliers extends BaseController
{
	protected $suppliermodel;
	public function __construct()
	{
		$this->suppliermodel = new SupplierModel();
	}
	public function index()
	{
		$currentPage = $this->request->getVar('page_suppliers') ? $this->request->getVar('page_suppliers') : 1;

		$keyword = $this->request->getVar('keyword');
		if ($keyword) {
			$supplier = $this->suppliermodel->search($keyword);
		} else {
			$supplier = $this->suppliermodel;
		}

		$data = [
			'title' => 'Suppliers',
			'h1' => 'Suppliers',
			'breadcrumb' => 'Suppliers',
			'supplier' =>  $supplier->paginate(10, 'suppliers'),
			'pager' => $this->suppliermodel->pager,
			'currentPage' => $currentPage,
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];

		echo view('suppliers/v_suppliers_index', $data);
	}

	public function add()
	{
		$data = [
			'title' => 'Add|Suppliers',
			'h1' => 'Add Suppliers',
			'breadcrumb' => 'Suppliers / Add Suppliers',
			'validation' => \Config\Services::validation(),
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];
		echo view('suppliers/v_suppliers_add', $data);
	}

	public function save()
	{
		$check = $this->validate([
			'supplier_name' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Please provide a supplier name.'
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
			return redirect()->to('/suppliers/add')->withInput()->with('validation', $check);
		} else {

			$data = [
				'supplier_name' => $this->request->getPost('supplier_name'),
				'no_telp'  => $this->request->getPost('no_telp'),
				'address'  => $this->request->getPost('address'),
				'user_create' =>  $this->request->getPost('usernamelogin')
			];

			session()->setFlashdata('success', 'The Data has been saved successfully.');
			$this->suppliermodel->save($data);
			return redirect()->to('/suppliers');
		}
	}

	public function edit($id)
	{
		// $edit = $this->suppliermodel->find($id);
		// dd($edit);

		$data = [
			'title' => 'Edit|Suppliers',
			'h1' => 'Edit Suppliers',
			'breadcrumb' => 'Suppliers / Edit Suppliers',
			'validation' => \Config\Services::validation(),
			'edit' => $this->suppliermodel->find($id),
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];

		echo view('suppliers/v_suppliers_edit', $data);
	}

	public function update()
	{
		$check = $this->validate([
			'supplier_name' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Please provide a supplier name.'
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
			return redirect()->to('/suppliers/edit/' . $this->request->getPost('id'))->withInput()->with('validation', $check);
		} else {

			$id = $this->request->getPost('id');
			$data = [
				'supplier_name' => $this->request->getPost('supplier_name'),
				'no_telp'  => $this->request->getPost('no_telp'),
				'address'  => $this->request->getPost('address'),
				'user_update' =>  $this->request->getPost('usernamelogin')
			];

			session()->setFlashdata('success', 'The Data has been updated.');
			$this->suppliermodel->update($id, $data);
			return redirect()->to('/suppliers');
		}
	}

	public function delete($id)
	{
		$this->suppliermodel->delete($id);
		session()->setFlashdata('success', 'The Data has been deleted.');
		return redirect()->to('/suppliers');
	}
}

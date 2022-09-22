<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductunitsModel;

class Units extends BaseController
{
	protected $unitsModel;
	public function __construct()
	{
		$this->unitsModel = new ProductunitsModel();
		//$pager = \Config\Services::pager();
	}
	public function index()
	{



		$data = [
			'title' => 'Product Units',
			'h1' => 'Products',
			'h2' => 'Product Units',
			'breadcrumb' => 'Product Units',
			'productUnits' => $this->unitsModel->findall(),
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];

		echo view('productUnits/v_productUnits_index', $data);
	}

	public function add()
	{
		$data = [
			'title' => 'Add|Product Units',
			'h1' => 'Products',
			'h2' => 'Product Units',
			'h3' => 'Add',
			'breadcrumb' => 'Product Units / Add Product Units',
			'validation' => \Config\Services::validation(),
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];
		echo view('productUnits/v_productUnits_add', $data);
	}

	public function save()
	{
		$check = $this->validate([
			'unit' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Please provide a unit name.'
				]
			]
		]);

		if (!$check) {
			$validation = \Config\Services::validation();
			return redirect()->to('/units/add')->withInput()->with('validation', $validation);
		} else {

			$data = [
				'unit' => $this->request->getPost('unit'),
				'user_create' =>  $this->request->getPost('usernamelogin')
			];

			session()->setFlashdata('success', 'The Data has been saved successfully.');
			$this->unitsModel->save($data);
			return redirect()->to('/units');
		}
	}

	public function edit($id)
	{

		$data = [
			'title' => 'Edit|Product Units',
			'h1' => 'Products',
			'h2' => 'Product Units',
			'h3' => 'Edit',
			'breadcrumb' => 'Product Units / Edit Product Units',
			'validation' => \Config\Services::validation(),
			'edit' => $this->unitsModel->find($id),
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];

		echo view('productUnits/v_productUnits_edit', $data);
	}

	public function update()
	{
		$check = $this->validate([
			'unit' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Please provide a unit name.'
				]
			]
		]);

		if (!$check) {
			$validation = \Config\Services::validation();
			return redirect()->to('/unit/edit/' . $this->request->getPost('id'))->withInput()->with('validation', $validation);
		} else {

			$id = $this->request->getPost('id');
			$data = [
				'unit' => $this->request->getPost('unit'),
				'user_update' =>  $this->request->getPost('usernamelogin')
			];

			session()->setFlashdata('success', 'The Data has been updated.');
			$this->unitsModel->update($id, $data);
			return redirect()->to('/units');
		}
	}

	public function delete($id)
	{
		$this->unitsModel->delete($id);
		session()->setFlashdata('success', 'The Data has been deleted.');
		return redirect()->to('/units');
	}
}

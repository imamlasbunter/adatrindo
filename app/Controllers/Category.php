<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductcategoryModel;

class Category extends BaseController
{
	protected $productcategoryModel;
	public function __construct()
	{
		$this->productcategoryModel = new ProductcategoryModel();
		//$pager = \Config\Services::pager();
	}
	public function index()
	{
		$data = [
			'title' => 'Product Categories',
			'h1' => 'Products',
			'h2' => 'Product Categories',
			'breadcrumb' => 'Product Categories',
			'productCategories' => $this->productcategoryModel->findall(),
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];

		echo view('productCategories/v_productCategories_index', $data);
	}
	public function add()
	{
		$data = [
			'title' => 'Add|Product Category',
			'h1' => 'Products',
			'h2' => 'Product Categories',
			'h3' => 'Add',
			'breadcrumb' => 'Product Category / Add Product Category',
			'validation' => \Config\Services::validation(),
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];
		echo view('productCategories/v_productCategories_add', $data);
	}

	public function save()
	{
		$check = $this->validate([
			'category' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Please provide a category name.'
				]
			]
		]);

		if (!$check) {
			//$validation = \Config\Services::validation();
			return redirect()->to('/category/add')->withInput()->with('validation', $check);
		} else {

			$data = [
				'category' => $this->request->getPost('category'),
				'user_create' =>  $this->request->getPost('usernamelogin')
			];

			session()->setFlashdata('success', 'The Data has been saved successfully.');
			$this->productcategoryModel->save($data);
			return redirect()->to('/category');
		}
	}

	public function edit($id)
	{

		$data = [
			'title' => 'Edit|Product Category',
			'h1' => 'Products',
			'h2' => 'Product Categories',
			'h3' => 'Edit',
			'breadcrumb' => 'Product Category / Edit Product Category',
			'validation' => \Config\Services::validation(),
			'edit' => $this->productcategoryModel->find($id),
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];

		echo view('productCategories/v_productCategories_edit', $data);
	}

	public function update()
	{
		$check = $this->validate([
			'category' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Please provide a category name.'
				]
			]
		]);

		if (!$check) {
			//$validation = \Config\Services::validation();
			return redirect()->to('/category/edit/' . $this->request->getPost('id'))->withInput()->with('validation', $check);
		} else {

			$id = $this->request->getPost('id');
			$data = [
				'category' => $this->request->getPost('category'),
				'user_update' =>  $this->request->getPost('usernamelogin')
			];

			session()->setFlashdata('success', 'The Data has been updated.');
			$this->productcategoryModel->update($id, $data);
			return redirect()->to('/category');
		}
	}

	public function delete($id)
	{
		$this->productcategoryModel->delete($id);
		session()->setFlashdata('success', 'The Data has been deleted.');
		return redirect()->to('/category');
	}
}

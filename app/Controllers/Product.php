<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductcategoryModel;
use App\Models\ProductunitsModel;
use App\Models\ProductitemsModel;

class Product extends BaseController
{
	public function __construct()
	{
		$this->itemsModel = new ProductitemsModel();
		$this->unitsModel = new ProductunitsModel();
		$this->categoryModel = new ProductcategoryModel();
	}
	public function index()
	{
		$currentPage = $this->request->getVar('page_items') ? $this->request->getVar('page_items') : 1;
		$productCategpries = $this->categoryModel;
		$productUnits = $this->unitsModel;

		$data = [
			'title' => 'Products',
			'h1' => 'Products',
			'breadcrumb' => 'Products',
			'items' => $this->itemsModel->index(),
			'currentPage' => $currentPage,
			'productCategories' => $productCategpries->paginate(5, 'categories'),
			'productUnits' => $productUnits->paginate(5, 'units'),
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];

		echo view('v_products', $data);
	}
}

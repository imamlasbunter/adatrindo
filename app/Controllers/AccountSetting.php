<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AccountsettingModel;

class Accountsetting extends BaseController
{
	public function __construct()
	{
		$this->accountsetting = new AccountsettingModel();
	}
	public function index()
	{

		$data = [
			'title' => 'Journal Setting',
			'h1' => 'Journal Setting',
			'breadcrumb' => 'Journal Setting',
			'mapping' => $this->accountsetting->findAll(),
			'accountcategory' => $this->accountsetting->find_category(),
			'accountlist' => $this->accountsetting->list(),
			'accountlist_mapping' => $this->accountsetting->list_mapping(),
			'validation' => \Config\Services::validation(),
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];

		echo view('account/v_account_index', $data);
	}

	public function save_data()
	{
		$usernamelogin = $this->request->getPost('usernamelogin');
		$cat_mapping = $this->request->getPost('cat_mapping');
		$item_mapping = $this->request->getPost('item_mapping');
		$acc_list = $this->request->getPost('acc_list');
		/////
		// $sales_revenue = $this->request->getPost('sales_revenue');
		// $sales_discount = $this->request->getPost('sales_discount');
		// $sales_return = $this->request->getPost('sales_return');
		// $sales_delivery = $this->request->getPost('sales_delivery');
		// $advance_payment = $this->request->getPost('advance_payment');
		// $unbilled_sales = $this->request->getPost('unbilled_sales');
		// $unbilled_receivables = $this->request->getPost('unbilled_receivables');
		// $sales_tax_payable = $this->request->getPost('sales_tax_payable');
		// $purchase_COGS = $this->request->getPost('purchase_COGS');
		// $purchase_delivery = $this->request->getPost('purchase_delivery');
		// $down_payment = $this->request->getPost('down_payment');
		// $unpaid_debt = $this->request->getPost('unpaid_debt');
		// $purchase_tax = $this->request->getPost('purchase_tax');
		// $accounts_receivable = $this->request->getPost('accounts_receivable');
		// $account_payable = $this->request->getPost('account_payable');
		// $stock = $this->request->getPost('stock');
		// $general_supplies = $this->request->getPost('general_supplies');
		// $broken_inventory = $this->request->getPost('broken_inventory');
		// $production_inventory = $this->request->getPost('production_inventory');
		// $initial_balance_equity = $this->request->getPost('initial_balance_equity');
		// $fixed_assets = $this->request->getPost('fixed_assets');
		// $bank_revaluation = $this->request->getPost('bank_revaluation');
		// $realized_profit_loss = $this->request->getPost('realized_profit_loss');
		// $profit_loss_before_realization = $this->request->getPost('profit_loss_before_realization');
		///////

		for ($i = 0; $i < count($acc_list); $i++) {


			$check = $this->accountsetting->mapping($item_mapping[$i]);
			//dd($check);
			if ($check <> '') {
				$data = [
					'id_acc_list' => $acc_list[$i],
					'cat_mapping' => $cat_mapping[$i],
					'item_mapping' => $item_mapping[$i],
					'user_update' => $usernamelogin,
					'updated_at' => date('Y-m-d H:i:s')
				];
				$db      = \Config\Database::connect();
				$builder = $db->table('tbl_account_mapping');
				$builder->where('item_mapping', $item_mapping[$i]);
				$builder->update($data);
				// update
			} else {
				$data = [
					'id_acc_list' => $acc_list[$i],
					'cat_mapping' => $cat_mapping[$i],
					'item_mapping' => $item_mapping[$i],
					'user_create' => $usernamelogin,
					'created_at' => date('Y-m-d H:i:s')
				];
				//dd($data);
				$db      = \Config\Database::connect();
				$builder = $db->table('tbl_account_mapping');
				$builder->insert($data);
			}
		}
		session()->setFlashdata('success', 'The Data has been saved successfully.');
		return redirect()->to('/journal-setting');
	}

	public function category_index()
	{
		$data = [
			'title' => 'Account Categories',
			'h1' => 'Account',
			'h2' => 'Account Categories',
			'breadcrumb' => 'Journal Setting',
			'mapping' => $this->accountsetting->findAll(),
			'accountcategory' => $this->accountsetting->find_category(),
			'accountlist' => $this->accountsetting->findAll(),
			'validation' => \Config\Services::validation(),
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];
		echo view('account/v_accountCategories_index', $data);
	}

	public function category_add()
	{
		$data = [
			'title' => 'Add|Account Category',
			'h1' => 'Journal Setting',
			'h2' => 'Account Category',
			'h3' => 'Add',
			'breadcrumb' => 'Add Account Category',
			'validation' => \Config\Services::validation(),
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];
		echo view('account/v_accountCategories_add', $data);
	}

	public function category_save()
	{
		$check = $this->validate([
			'category_account' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Please provide a category.'
				]
			]
		]);

		if (!$check) {
			return redirect()->to('/journal-setting/category/add')->withInput()->with('validation', $check);
		} else {

			$data = [
				'name' => $this->request->getPost('category_account'),
				'user_create' => $this->request->getPost('usernamelogin'),
				'created_at' => date('Y-m-d H:i:s')
			];

			$this->accountsetting->category_save($data);
			session()->setFlashdata('success', 'The Data has been saved successfully.');
			return redirect()->to('/journal-setting/category');
		}
	}

	public function category_delete($id)
	{
		$this->accountsetting->delete_category($id);
		session()->setFlashdata('success', 'The Data has been deleted.');
		return redirect()->to('/journal-setting/category');
	}

	public function category_edit($id)
	{
		$data = [
			'title' => 'Edit|Account Category',
			'h1' => 'Journal Setting',
			'h2' => 'Account Category',
			'h3' => 'Edit',
			'breadcrumb' => 'Add Account Category',
			'validation' => \Config\Services::validation(),
			'edit' => $this->accountsetting->find_category($id),
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];
		echo view('account/v_accountCategories_edit', $data);
	}

	public function category_update()
	{
		$check = $this->validate([
			'category_account' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Please provide a category.'
				]
			]
		]);
		//dd($check);
		if (!$check) {
			return redirect()->to('/journal-setting/category/edit/' . $this->request->getPost('id'))->withInput()->with('validation', $check);
		} else {
			$id = $this->request->getPost('id');
			$data = [
				'name' => $this->request->getPost('category_account'),
				'user_update' => $this->request->getPost('usernamelogin'),
				'updated_at' => date('Y-m-d H:i:s')
			];
			$this->accountsetting->category_update($data, $id);
			session()->setFlashdata('success', 'The Data has been saved successfully.');
			return redirect()->to('/journal-setting/category');
		}
	}

	public function list_index()
	{
		$data = [
			'title' => 'Account List',
			'h1' => 'Account',
			'h2' => 'Account List',
			'breadcrumb' => 'Journal Setting',
			'accountcategory' => $this->accountsetting->find_category(),
			'accountlist' => $this->accountsetting->list(),
			'validation' => \Config\Services::validation(),
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];
		echo view('account/v_accountList_index', $data);
	}

	public function list_add()
	{
		$data = [
			'title' => 'Add|Account List',
			'h1' => 'Journal Setting',
			'h2' => 'Account List',
			'h3' => 'add',
			'breadcrumb' => 'Journal Setting',
			'accountcategory' => $this->accountsetting->find_category(),
			'validation' => \Config\Services::validation(),
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];
		echo view('account/v_accountList_add', $data);
	}

	public function list_save()
	{
		$check = $this->validate([
			'account_number' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Please provide a account code.'
				]
			],
			'account_name' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Please provide a account name.'
				]
			],
			'account_category' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Please provide a account name.'
				]
			]
		]);

		if (!$check) {
			return redirect()->to('/journal-setting/list/add')->withInput()->with('validation', $check);
		} else {

			$data = [
				'account_number' => $this->request->getPost('account_number'),
				'account_name' => $this->request->getPost('account_name'),
				'account_category_id' => $this->request->getPost('account_category'),
				'user_create' => $this->request->getPost('usernamelogin'),
				'created_at' => date('Y-m-d H:i:s')
			];

			$this->accountsetting->save($data);
			session()->setFlashdata('success', 'The Data has been saved successfully.');
			return redirect()->to('/journal-setting/list');
		}
	}

	public function list_edit($id)
	{
		$data = [
			'title' => 'Edit|Account List',
			'h1' => 'Journal Setting',
			'h2' => 'Account List',
			'h3' => 'Edit',
			'breadcrumb' => 'Add Account Category',
			'validation' => \Config\Services::validation(),
			'edit' => $this->accountsetting->find($id),
			'accountcategory' => $this->accountsetting->find_category(),
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];
		echo view('account/v_accountList_edit', $data);
	}

	public function list_update()
	{
		$check = $this->validate([
			'account_number' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Please provide a account code.'
				]
			],
			'account_name' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Please provide a account name.'
				]
			],
			'account_category' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Please provide a account name.'
				]
			]
		]);

		if (!$check) {
			return redirect()->to('/journal-setting/list/edit/' . $this->request->getPost('id'))->withInput()->with('validation', $check);
		} else {
			$id = $this->request->getPost('id');
			$data = [
				'account_number' => $this->request->getPost('account_number'),
				'account_name' => $this->request->getPost('account_name'),
				'account_category_id' => $this->request->getPost('account_category'),
				'user_update' => $this->request->getPost('usernamelogin'),
				'updated_at' => date('Y-m-d H:i:s')
			];
			$this->accountsetting->update($id, $data);
			session()->setFlashdata('success', 'The Data has been saved successfully.');
			return redirect()->to('/journal-setting/list');
		}
	}
}

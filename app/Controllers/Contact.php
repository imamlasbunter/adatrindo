<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ContactModel;

class Contact extends BaseController
{
	public function __construct()
	{
		$this->contactmodel = new ContactModel();
	}
	public function index()
	{
		$data = [
			'title' => 'Contact',
			'h1' => 'Contact',
			'breadcrumb' => 'Contact',
			'customer' => $this->contactmodel->customer(1),
			'supplier' => $this->contactmodel->supplier(2),
			'employee' => $this->contactmodel->employee(3),
			'vendor' => $this->contactmodel->vendor(4),
			'others' => $this->contactmodel->others(5),
			'validation' => \Config\Services::validation(),
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];

		echo view('contact/v_contact_index', $data);
	}

	public function add()
	{
		$data = [
			'title' => 'Contact|Add',
			'h1' => 'Contact',
			'h2' => 'Add',
			'breadcrumb' => 'Contact',
			'validation' => \Config\Services::validation(),
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];

		echo view('contact/v_contact_add', $data);
	}

	public function save()
	{

		$check = $this->validate([
			'name' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Please provide a name'
				]
			],
			'contact_type' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Please provide a name'
				]
			],
			'no_identity' => [
				'rules' => 'required_with[identity_type]',
				'errors' => [
					'required_with' => 'Please provide identity number'
				]
			],
			'identity_type' => [
				'rules' => 'required_with[no_identity]',
				'errors' => [
					'required_with' => 'Please provide identity type'
				]
			]
		]);

		if (!$check) {
			return redirect()->to('/contact/add')->withInput()->with('validation', $check);
		} else {

			$data = [
				'name' => $this->request->getPost('name'),
				'type' => $this->request->getPost('contact_type'),
				'hp' => $this->request->getPost('hp'),
				'identity_type' => $this->request->getPost('identity_type'),
				'no_identity' => $this->request->getPost('no_identity'),
				'email' => $this->request->getPost('email'),
				'company_name' => $this->request->getPost('company_name'),
				'telp' => $this->request->getPost('telephone'),
				'fax' => $this->request->getPost('fax'),
				'npwp' => $this->request->getPost('npwp'),
				'payment_address' => $this->request->getPost('payment_address'),
				'shipping_address' => $this->request->getPost('shipping_address'),
				'bank_name' => $this->request->getPost('bank_name'),
				'bank_branch' => $this->request->getPost('bank_branch'),
				'bank_address' => $this->request->getPost('bank_address'),
				'account_no' => $this->request->getPost('account_number'),
				'bautno' => $this->request->getPost('bautno'),
				'user_create' => $this->request->getPost('usernamelogin'),
				'created_at' => date('Y-m-d H:i:s')

			];
			session()->setFlashdata('success', 'The Data has been saved successfully.');
			$this->contactmodel->save($data);
			return redirect()->to('/contact');
		}
	}

	public function edit($id)
	{
		$data = [
			'title' => 'Contact|Edit',
			'h1' => 'Contact',
			'h2' => 'Edit',
			'breadcrumb' => 'Contact',
			'validation' => \Config\Services::validation(),
			'edit' => $this->contactmodel->find($id),
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];

		echo view('contact/v_contact_edit', $data);
	}

	public function update()
	{
		$check = $this->validate([
			'name' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Please provide a name'
				]
			],
			'contact_type' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Please provide a name'
				]
			],
			'no_identity' => [
				'rules' => 'required_with[identity_type]',
				'errors' => [
					'required_with' => 'Please provide identity number'
				]
			],
			'identity_type' => [
				'rules' => 'required_with[no_identity]',
				'errors' => [
					'required_with' => 'Please provide identity type'
				]
			]
		]);

		if (!$check) {
			return redirect()->to('/contact/edit/' . $this->request->getPost('id'))->withInput()->with('validation', $check);
		} else {
			$id = $this->request->getPost('id');
			$data = [
				'name' => $this->request->getPost('name'),
				'type' => $this->request->getPost('contact_type'),
				'hp' => $this->request->getPost('hp'),
				'identity_type' => $this->request->getPost('identity_type'),
				'no_identity' => $this->request->getPost('no_identity'),
				'email' => $this->request->getPost('email'),
				'company_name' => $this->request->getPost('company_name'),
				'telp' => $this->request->getPost('telephone'),
				'fax' => $this->request->getPost('fax'),
				'npwp' => $this->request->getPost('npwp'),
				'payment_address' => $this->request->getPost('payment_address'),
				'shipping_address' => $this->request->getPost('shipping_address'),
				'bank_name' => $this->request->getPost('bank_name'),
				'bank_branch' => $this->request->getPost('bank_branch'),
				'bank_address' => $this->request->getPost('bank_address'),
				'account_no' => $this->request->getPost('account_number'),
				'bautno' => $this->request->getPost('bautno'),
				'user_update' => $this->request->getPost('usernamelogin'),
				'updated_at' => date('Y-m-d H:i:s')

			];
			session()->setFlashdata('success', 'The Data has been saved successfully.');
			$this->contactmodel->update($id, $data);
			return redirect()->to('/contact');
		}
	}

	public function delete($id)
	{
		$this->contactmodel->delete($id);
		session()->setFlashdata('success', 'The Data has been deleted.');
		return redirect()->to('/contact');
	}
}

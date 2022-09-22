<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MenuModel;
use App\Models\UsersModel;

class Users extends BaseController
{
	public function __construct()
	{
		$this->usersModel = new UsersModel();
		$this->menu = new MenuModel();
	}
	public function index()
	{
		$data = [
			'title' => 'Users',
			'h1' => 'Users',
			'breadcrumb' => 'Users',
			'users' =>  $this->usersModel->index(),
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];

		echo view('users/v_users_index', $data);
	}

	public function add()
	{
		$level = $this->usersModel->level();
		$data = [
			'title' => 'Add|Users',
			'h1' => 'Users',
			'h2' => 'Add',
			'breadcrumb' => 'Users / Add Users',
			'validation' => \Config\Services::validation(),
			'level' => $level,
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];
		echo view('users/v_users_add', $data);
	}

	public function save()
	{

		$salt = uniqid('', true);
		$check = $this->validate([
			'username' => [
				'rules' => 'required|alpha_numeric|is_unique[tbl_users.username]',
				'errors' => [
					'required' => 'Please provide a username.',
					'is_unique' => 'Username has been registered',
					'alpha_numeric' => 'Username can only contain letters and numbers'
				]
			],
			'password' => [
				'rules' => 'required|alpha_numeric_punct',
				'errors' => [
					'required' => 'Please provide a password.',
					'alpha_numeric_punct' => 'Passwords can only contain numbers, letters, and characters .'
				]
			],
			'repassword' => [
				'rules' => 'required|matches[password]',
				'errors' => [
					'required' => 'Please repeat the password.',
					'matches' => 'Confirm password does not match'
				]
			],
			'name' => [
				'rules' => 'required|alpha_space',
				'error' => [
					'required' => 'Please provide a name',
					'alpha_space' => 'Name can only contain letters and space.'
				]
			],
			'level' => [
				'rules' => 'required',
				'error' => [
					'required' => 'Please provide a level.'
				]
			],
			'email' => [
				'rules' => 'valid_email',
				'errors' => [
					'valid_emails' => 'Email is not valid'
				]
			]

		]);

		if (!$check) {
			$validation = \Config\Services::validation();
			return redirect()->to('/users/add')->withInput()->with('validation', $check);
		} else {
			$password = MD5($this->request->getPost('password')) . $salt;
			$data = [
				'username' => $this->request->getPost('username'),
				'password'  => $password,
				'salt'  => $salt,
				'name'  => $this->request->getPost('name'),
				'level'  => $this->request->getPost('level'),
				'email'  => $this->request->getPost('email'),
				'user_create' =>  $this->request->getPost('usernamelogin')
			];

			session()->setFlashdata('success', 'The Data has been saved successfully.');
			$this->usersModel->save($data);
			return redirect()->to('/users');
		}
	}

	public function edit($id)
	{
		$level = $this->usersModel->level();
		$data = [
			'title' => 'Edit|Users',
			'h1' => 'Users',
			'h2' => 'Edit',
			'breadcrumb' => 'Users / Edit Users',
			'validation' => \Config\Services::validation(),
			'edit' => $this->usersModel->find($id),
			'level' => $level,
			'menu1' => $this->menusidebarmodel->CategoryList1(),
			'menu2' => $this->menusidebarmodel->CategoryList2(),
			'menu3' => $this->menusidebarmodel->CategoryList3(),
			'logo' => $this->menusidebarmodel->logo()
		];

		echo view('users/v_users_edit', $data);
	}

	public function update()
	{
		if ($this->request->getPost('password')) {
			$check = $this->validate([
				'password' => [
					'rules' => 'required|alpha_numeric_punct',
					'errors' => [
						'required' => 'Please provide a password.',
						'alpha_numeric_punct' => 'Passwords can only contain numbers, letters, and characters .'
					]
				],
				'repassword' => [
					'rules' => 'required|matches[password]',
					'errors' => [
						'required' => 'Please repeat the password.',
						'matches' => 'Confirm password does not match'
					]
				],
				'name' => [
					'rules' => 'required|alpha_space',
					'error' => [
						'required' => 'Please provide a name',
						'alpha_space' => 'Name can only contain letters and space.'
					]
				],
				'level' => [
					'rules' => 'required',
					'error' => [
						'required' => 'Please provide a level.'
					]
				],
				'email' => [
					'rules' => 'valid_email',
					'errors' => [
						'valid_emails' => 'Email is not valid'
					]
				]

			]);

			if (!$check) {
				$validation = \Config\Services::validation();
				return redirect()->to('/users/edit/' . $this->request->getPost('id'))->withInput()->with('validation', $check);
			} else {

				$id = $this->request->getPost('id');
				$salt = uniqid('', true);
				$password = MD5($this->request->getPost('password')) . $salt;
				$data = [
					'password'  => $password,
					'salt'  => $salt,
					'name'  => $this->request->getPost('name'),
					'level'  => $this->request->getPost('level'),
					'email'  => $this->request->getPost('email'),
					'user_update' =>  $this->request->getPost('usernamelogin')
				];

				session()->setFlashdata('success', 'The Data has been updated.');
				$this->usersModel->update($id, $data);
				return redirect()->to('/users');
			}
		} else {
			$check = $this->validate([
				'name' => [
					'rules' => 'required|alpha_space',
					'error' => [
						'required' => 'Please provide a name',
						'alpha_space' => 'Name can only contain letters and space.'
					]
				],
				'level' => [
					'rules' => 'required',
					'error' => [
						'required' => 'Please provide a level.'
					]
				],
				'email' => [
					'rules' => 'valid_email',
					'errors' => [
						'valid_emails' => 'Email is not valid'
					]
				]

			]);

			if (!$check) {
				$validation = \Config\Services::validation();
				return redirect()->to('/users/edit/' . $this->request->getPost('id'))->withInput()->with('validation', $validation);
			} else {

				$id = $this->request->getPost('id');
				$data = [
					'name'  => $this->request->getPost('name'),
					'level'  => $this->request->getPost('level'),
					'email'  => $this->request->getPost('email'),
					'user_update' =>  $this->request->getPost('usernamelogin')
				];

				session()->setFlashdata('success', 'The Data has been updated.');
				$this->usersModel->update($id, $data);
				return redirect()->to('/users');
			}
		}
	}

	public function delete($id)
	{
		$this->usersModel->delete($id);
		session()->setFlashdata('success', 'The Data has been deleted.');
		return redirect()->to('/users');
	}
}

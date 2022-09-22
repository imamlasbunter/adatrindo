<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LoginModel;
use CodeIgniter\Session\Session;
use Config\Validation;

$session = \Config\Services::session();


class Login extends BaseController
{
	protected $loginModel;

	public function __construct()
	{
		$this->loginModel = new LoginModel();
	}

	public function index()
	{
		$data = [
			'validation' => \Config\Services::validation()
		];

		echo view('v_login', $data);
	}

	public function LoginCheck()
	{

		$username	= $this->request->getPost('username');
		$password	= $this->request->getPost('password');
		$checkFirst = $this->loginModel->checkFirst($username);
		if ($checkFirst) {
			if ($checkFirst['password'] == MD5($password) . $checkFirst['salt']) {
				$password = MD5($password) . $checkFirst['salt'];
				$valid = $this->loginModel->LoginCheck($username, $password);
				session()->set('username', $valid['username']);
				session()->set('level', $valid['level']);
				session()->set('isLoggedIn', $valid['id']);
				session()->set('name', $valid['name']);
				session()->set('descripsion', $valid['descripsion']);
				session()->set('session', uniqid());
				return redirect()->to('/dashboard');
			} else {
				session()->setFlashdata('password', 'Incorrect password.');
				return redirect()->to('/')->withInput();
			}
		} else {
			session()->setFlashdata('username', 'Incorrect username.');
			return redirect()->to('/')->withInput();
		}

		// // $check = $this->validate([
		// // 	'username' => [
		// // 		'rules' => 'required|is_not_unique[tbl_users.username]',
		// // 		'errors' => [
		// // 			'required' => '{field} must be filled.',
		// // 			'is_not_unique' => '{field} not listed.'
		// // 		]
		// // 	],
		// // 	'password' => [
		// // 		'rules' => 'required|is_not_unique[tbl_users.password].',
		// // 		'errors' => [
		// // 			'required' => '{field} must be filled.',
		// // 			'is_not_unique' => '{field} not listed.'
		// // 		]
		// // 	]
		// // ]);

		// if (!$check) {

		// 	$validation = \Config\Services::validation();
		// 	return redirect()->to('/')->withInput()->with('validation', $validation);
		// } else {


		// 	$username	= $this->request->getPost('username');
		// 	$password	= $this->request->getPost('password');
		// 	$valid = $this->loginModel->LoginCheck($username, $password);

		// 	session()->set('username', $valid['username']);
		// 	session()->set('level', $valid['level']);
		// 	session()->set('isLoggedIn', $valid['id']);
		// 	session()->set('nama', $valid['name']);

		// 	return redirect()->to('/dashboard');
		// }
	}

	public function Logout()
	{

		$this->session->destroy();
		return redirect()->to('/');
	}
}

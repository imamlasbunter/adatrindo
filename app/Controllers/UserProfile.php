<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserProfileModel;

class UserProfile extends BaseController
{
    public function __construct()
    {
        $this->userprofilemodel = new UserProfileModel();
    }

    public function index()
    {
        $session_id = session()->get('isLoggedIn');
        $data = [
            'title' => 'User Profile',
            'h1' => 'User Profile',
            'breadcrumb' => 'User Profile',
            'user_profile' => $this->userprofilemodel->find($session_id),
            'menu1' => $this->menusidebarmodel->CategoryList1(),
            'menu2' => $this->menusidebarmodel->CategoryList2(),
            'menu3' => $this->menusidebarmodel->CategoryList3(),
            'logo' => $this->menusidebarmodel->logo()
        ];
        echo view('users/v_user_profile', $data);
    }

    public function save()
    {
        // $pp = $this->request->getFile('pp');
        // dd($pp);


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
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Please provide a name.'
                    ]
                ],
                'email' => [
                    'rules' => 'valid_email',
                    'errors' => [
                        'valid_emails' => 'Email is not valid'
                    ]
                ],
                'pp' => [
                    'rules' => 'max_size[pp,2048]|mime_in[pp,image/jpg,image/jpeg,image/gif,image/png]',
                    'errors' => [
                        'max_size' => 'Maximal size is 2MB.',
                        'mime_in' => 'Only image files are allowed'
                    ]
                ]
            ]);


            if (!$check) {
                session()->setFlashdata('error', \Config\Services::validation()->listErrors());
                return redirect()->to('/user-profile');
                // $validation = \Config\Services::validation();
                // return redirect()->to('/user-profile')->withInput()->with('validation', $validation);
            } else {

                $pp = $this->request->getFile('pp');
                if ($pp <> "") {
                    $ext = $pp->getClientExtension();
                    $name = $pp->getRandomName();
                    // $pp->move(WRITEPATH . 'uploads', $name);
                    $pp->move(ROOTPATH . 'public/uploads', $name);
                    // $img = $pp->getTempName($name);
                    // $imgdata = file_get_contents($img);
                    // $file_encode = base64_encode($imgdata);
                    $id = $this->request->getPost('id');
                    $salt = uniqid('', true);
                    $password = MD5($this->request->getPost('password')) . $salt;
                    $data = [
                        'password'  => $password,
                        'salt'  => $salt,
                        'name'  => $this->request->getPost('name'),
                        'email'  => $this->request->getPost('email'),
                        //'pp' => $file_encode,
                        'pp_name' => $name,
                        'pp_type' => $ext,
                        'user_update' =>  $this->request->getPost('usernamelogin')
                    ];
                    session()->setFlashdata('success', 'The Data has been updated.');
                    $this->userprofilemodel->update($id, $data);
                    return redirect()->to('/user-profile');
                } else {
                    $id = $this->request->getPost('id');
                    $salt = uniqid('', true);
                    $password = MD5($this->request->getPost('password')) . $salt;
                    $data = [
                        'password'  => $password,
                        'salt'  => $salt,
                        'name'  => $this->request->getPost('name'),
                        'email'  => $this->request->getPost('email'),
                        'user_update' =>  $this->request->getPost('usernamelogin')
                    ];
                    session()->setFlashdata('success', 'The Data has been updated.');
                    $this->userprofilemodel->update($id, $data);
                    return redirect()->to('/user-profile');
                }
            }
        } else {
            $check = $this->validate([
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Please provide a name.'
                    ]
                ],
                'email' => [
                    'rules' => 'valid_email',
                    'errors' => [
                        'valid_emails' => 'Email is not valid'
                    ]
                ],
                'pp' => [
                    'rules' => 'max_size[pp,2048]|mime_in[pp,image/jpg,image/jpeg,image/gif,image/png]',
                    'errors' => [
                        'max_size' => 'Maximal size is 2MB.',
                        'is_image' => 'Only image files are allowed',
                        'ext_in' => 'Allowed extension is png and jpg'
                    ]
                ]
            ]);


            if (!$check) {
                // $validation = \Config\Services::validation();
                // return redirect()->to('/user-profile')->withInput()->with('validation', $validation);
                session()->setFlashdata('error', \Config\Services::validation()->listErrors());
                return redirect()->to('/user-profile');
            } else {

                $pp = $this->request->getFile('pp');

                if ($pp <> "") {
                    $ext = $pp->getClientExtension();
                    $name = $pp->getRandomName();
                    // $pp->move(WRITEPATH . 'uploads', $name);
                    $pp->move(ROOTPATH . 'public/uploads', $name);
                    // $img = $pp->getTempName($name);
                    // $imgdata = file_get_contents($img);
                    // $file_encode = base64_encode($imgdata);
                    $id = $this->request->getPost('id');
                    $data = [
                        'name'  => $this->request->getPost('name'),
                        'email'  => $this->request->getPost('email'),
                        //'pp' => $file_encode,
                        'pp_name' => $name,
                        'pp_type' => $ext,
                        'user_update' =>  $this->request->getPost('usernamelogin')
                    ];


                    $this->userprofilemodel->update($id, $data);
                    if ($this->request->getPost('pp_last')) unlink('uploads/' . $this->request->getPost('pp_last'));
                    session()->setFlashdata('success', 'The Data has been updated.');
                    return redirect()->to('/user-profile');
                } else {


                    $id = $this->request->getPost('id');
                    $data = [
                        'name'  => $this->request->getPost('name'),
                        'email'  => $this->request->getPost('email'),
                        'user_update' =>  $this->request->getPost('usernamelogin')
                    ];


                    $this->userprofilemodel->update($id, $data);
                    session()->setFlashdata('success', 'The Data has been updated.');
                    return redirect()->to('/user-profile');
                }
            }
        }
    }
}

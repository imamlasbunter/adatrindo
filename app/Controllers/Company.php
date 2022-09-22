<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CompanyModel;

class Company extends BaseController
{
    public function __construct()
    {
        $this->companymodel = new CompanyModel();
    }
    public function index()
    {
        $check = $this->companymodel->FindAll();
        if ($check) {

            $data = [
                'title' => 'Company',
                'h1' => 'Company',
                'breadcrumb' => 'Company',
                'company' => $this->companymodel->getData(),
                'validation' => \Config\Services::validation(),
                'currency' => $this->companymodel->currency(),
                'menu1' => $this->menusidebarmodel->CategoryList1(),
                'menu2' => $this->menusidebarmodel->CategoryList2(),
                'menu3' => $this->menusidebarmodel->CategoryList3(),
                'logo' => $this->menusidebarmodel->logo()
            ];

            echo view('company/v_company_edit', $data);
        } else {

            $data = [
                'title' => 'Company',
                'h1' => 'Company',
                'breadcrumb' => 'Company',
                'validation' => \Config\Services::validation(),
                'company' => $this->companymodel->getData(),
                'currency' => $this->companymodel->currency(),
                'menu1' => $this->menusidebarmodel->CategoryList1(),
                'menu2' => $this->menusidebarmodel->CategoryList2(),
                'menu3' => $this->menusidebarmodel->CategoryList3(),
                'logo' => $this->menusidebarmodel->logo()
            ];

            echo view('company/v_company_index', $data);
        }
    }

    public function save()
    {
        // $tes = $this->request->getPost('currency');
        // dd($tes);
        $check = $this->validate([
            'company_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Please provide a company name'
                ]
            ],
            'telephone' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Please provide a company name',
                    'numeric' => 'Please provide a numeric'
                ]
            ],
            'logo' => [
                'rules' => 'max_size[logo,2048]|mime_in[logo,image/jpg,image/jpeg,image/gif,image/png]',
                'errors' => [
                    'max_size' => 'Maximal size is 2MB.',
                    'mime_in' => 'Only image files are allowed'
                ]
            ],
            'currency' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Please provide a currency'
                ]
            ]
        ]);

        if (!$check) {
            return redirect()->to('/company')->withInput()->with('validation', $check);
        } else {
            // $company_name = $this->request->getPost('company_name');
            // dd($company_name);

            $file = $this->request->getPost('logo');
            if ($file <> "") {

                $ext = $file->getClientExtension();
                $name = $file->getRandomName();
                $file->move(ROOTPATH . 'public/uploads', $name);
                $data = [
                    'company_name' => $this->request->getPost('company_name'),
                    'logo' => $name,
                    'logo_type' => $ext,
                    'address' => $this->request->getPost('address'),
                    'shipping_address' => $this->request->getPost('shipping_address'),
                    'telp' => $this->request->getPost('telephone'),
                    'fax' => $this->request->getPost('fax'),
                    'npwp' => $this->request->getPost('npwp'),
                    'website' => $this->request->getPost('website'),
                    'email' => $this->request->getPost('email'),
                    'bank_name' => $this->request->getPost('bank_name'),
                    'bank_branch' => $this->request->getPost('bank_branch'),
                    'bank_address' => $this->request->getPost('bank_address'),
                    'account_number' => $this->request->getPost('account_number'),
                    'bautno' => $this->request->getPost('bautno'),
                    'swift_code' => $this->request->getPost('swift_code'),
                    'currency_id' => $this->request->getPost('currency')
                ];
                session()->setFlashdata('success', 'The Data has been saved successfully.');
                $this->companymodel->save($data);
                return redirect()->to('/company');
            } else {
                $data = [
                    'company_name' => $this->request->getPost('company_name'),
                    'address' => $this->request->getPost('address'),
                    'shipping_address' => $this->request->getPost('shipping_address'),
                    'telp' => $this->request->getPost('telephone'),
                    'fax' => $this->request->getPost('fax'),
                    'npwp' => $this->request->getPost('npwp'),
                    'website' => $this->request->getPost('website'),
                    'email' => $this->request->getPost('email'),
                    'bank_name' => $this->request->getPost('bank_name'),
                    'bank_branch' => $this->request->getPost('bank_branch'),
                    'bank_address' => $this->request->getPost('bank_address'),
                    'account_number' => $this->request->getPost('account_number'),
                    'bautno' => $this->request->getPost('bautno'),
                    'swift_code' => $this->request->getPost('swift_code'),
                    'currency_id' => $this->request->getPost('currency')
                ];
                session()->setFlashdata('success', 'The Data has been saved successfully.');
                $this->companymodel->save($data);
                return redirect()->to('/company');
            }
        }
    }

    public function update()
    {
        // $tes = $this->request->getPost('currency');
        // dd($tes);
        $check = $this->validate([
            'company_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Please provide a company name'
                ]
            ],
            'telephone' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Please provide a company name',
                    'numeric' => 'Please provide a numeric'
                ]
            ],
            'logo' => [
                'rules' => 'max_size[logo,2048]|mime_in[logo,image/jpg,image/jpeg,image/gif,image/png]',
                'errors' => [
                    'max_size' => 'Maximal size is 2MB.',
                    'mime_in' => 'Only image files are allowed'
                ]
            ]
        ]);

        if (!$check) {
            return redirect()->to('/company')->withInput()->with('validation', $check);
        } else {
            // $company_name = $this->request->getPost('company_name');
            // dd($company_name);
            $id = $this->request->getPost('id');

            $file = $this->request->getFile('logo');
            if ($file != "") {

                $ext = $file->getClientExtension();
                $name = $file->getRandomName();
                $file->move(ROOTPATH . 'public/uploads', $name);
                $data = [
                    'company_name' => $this->request->getPost('company_name'),
                    'logo' => $name,
                    'logo_type' => $ext,
                    'address' => $this->request->getPost('address'),
                    'shipping_address' => $this->request->getPost('shipping_address'),
                    'telp' => $this->request->getPost('telephone'),
                    'fax' => $this->request->getPost('fax'),
                    'npwp' => $this->request->getPost('npwp'),
                    'website' => $this->request->getPost('website'),
                    'email' => $this->request->getPost('email'),
                    'bank_name' => $this->request->getPost('bank_name'),
                    'bank_branch' => $this->request->getPost('bank_branch'),
                    'bank_address' => $this->request->getPost('bank_address'),
                    'account_number' => $this->request->getPost('account_number'),
                    'bautno' => $this->request->getPost('bautno'),
                    'swift_code' => $this->request->getPost('swift_code'),
                    'currency_id' => $this->request->getPost('currency')
                ];

                if ($this->request->getPost('logo_last')) {
                    // unlink('public/uploads/' . $this->request->getPost('logo_last'));
                    helper('filesystem');
                    delete_files('.public/uploads/' . $this->request->getPost('logo_last'));
                }

                session()->setFlashdata('success', 'The Data has been updated.');
                if ($this->request->getPost('logo_last')) unlink('uploads/' . $this->request->getPost('logo_last'));
                $this->companymodel->update($id, $data);
                return redirect()->to('/company');
            } else {
                $data = [
                    'company_name' => $this->request->getPost('company_name'),
                    'address' => $this->request->getPost('address'),
                    'shipping_address' => $this->request->getPost('shipping_address'),
                    'telp' => $this->request->getPost('telephone'),
                    'fax' => $this->request->getPost('fax'),
                    'npwp' => $this->request->getPost('npwp'),
                    'website' => $this->request->getPost('website'),
                    'email' => $this->request->getPost('email'),
                    'bank_name' => $this->request->getPost('bank_name'),
                    'bank_branch' => $this->request->getPost('bank_branch'),
                    'bank_address' => $this->request->getPost('bank_address'),
                    'account_number' => $this->request->getPost('account_number'),
                    'bautno' => $this->request->getPost('bautno'),
                    'swift_code' => $this->request->getPost('swift_code'),
                    'currency_id' => $this->request->getPost('currency')
                ];
                session()->setFlashdata('success', 'The Data has been updated.');
                $this->companymodel->update($id, $data);
                return redirect()->to('/company');
            }
        }
    }
}

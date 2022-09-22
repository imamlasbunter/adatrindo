<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MenuModel;
use App\Models\RolesModels;

class Menu extends BaseController
{
    protected $menumodel;
    public function __construct()
    {

        $this->menumodel = new MenuModel();
        $this->level = new RolesModels();
    }

    public function index()
    {
        $data = [
            'title' => 'Menu',
            'h1' => 'Menu',
            'breadcrumb' => 'Menu',
            'menu1' => $this->menusidebarmodel->CategoryList1(),
            'menu2' => $this->menusidebarmodel->CategoryList2(),
            'menu3' => $this->menusidebarmodel->CategoryList3(),
            'logo' => $this->menusidebarmodel->logo()
        ];
        //dd($menus);
        echo view('menu/v_menu_index', $data);
    }

    public function add()
    {

        $data = [
            'title' => 'Add|Menu',
            'h1' => 'Add Menu',
            'breadcrumb' => 'Menu / Add Menu',
            'validation' => \Config\Services::validation(),
            'category_menu' => $this->menumodel->category_menu(),
            'menu1' => $this->menusidebarmodel->CategoryList1(),
            'menu2' => $this->menusidebarmodel->CategoryList2(),
            'menu3' => $this->menusidebarmodel->CategoryList3(),
            'logo' => $this->menusidebarmodel->logo()
        ];
        echo view('menu/v_menu_add', $data);
    }

    public function save()
    {
        $check = $this->validate([
            'category_menu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Please provide a category menu.'
                ]
            ],
            'menu_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Please provide a telephone number.'
                ]
            ],
            'sequence' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Please provide a sequence.',
                    'numeric' => 'Sequence must be filled with numbers.'
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Please provide a status.'
                ]
            ],
            'icon_menu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Please provide a icon menu.'
                ]
            ],
            'link_menu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Please provide a link menu.'
                ]
            ]
        ]);

        if (!$check) {
            $validation = \Config\Services::validation();
            return redirect()->to('/menu/add')->withInput()->with('validation', $check);
        } else {
            $db = \Config\Database::connect();
            $db->transStart();
            $data = [
                'category_menu' => $this->request->getPost('category_menu'),
                'menu_name'  => $this->request->getPost('menu_name'),
                'sequence'  => $this->request->getPost('sequence'),
                'status'  => $this->request->getPost('status'),
                'parent_id '  => 0,
                'icon_menu'  => $this->request->getPost('icon_menu'),
                'link_menu'  => $this->request->getPost('link_menu'),
                'user_create' =>  $this->request->getPost('usernamelogin')
            ];


            $this->menumodel->save($data);
            $id = $this->menumodel->insertID();
            $id_level =  $this->level->findAll();

            foreach ($id_level as $r) {
                $data_access[] = array(
                    'id_menu' => $id,
                    'id_level' => $r['id'],
                    'status' => 'N',
                    'user_create' =>  $this->request->getPost('usernamelogin')
                );
            }
            $bulider = $db->table('tbl_role_menus');
            $bulider->insertbatch($data_access);

            $db->transComplete();
            session()->setFlashdata('success', 'The Data has been saved successfully.');
            return redirect()->to('/menu');
        }
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit|Menu',
            'h1' => 'Edit Menu',
            'breadcrumb' => 'Menu / Edit Menu',
            'validation' => \Config\Services::validation(),
            'category_menu' => $this->menumodel->category_menu(),
            'edit' => $this->menumodel->find($id),
            'menu1' => $this->menusidebarmodel->CategoryList1(),
            'menu2' => $this->menusidebarmodel->CategoryList2(),
            'menu3' => $this->menusidebarmodel->CategoryList3(),
            'logo' => $this->menusidebarmodel->logo()

        ];

        echo view('menu/v_menu_edit', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        $check = $this->validate([
            'category_menu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Please provide a category menu.'
                ]
            ],
            'menu_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Please provide a telephone number.'
                ]
            ],
            'sequence' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Please provide a sequence.',
                    'numeric' => 'Sequence must be filled with numbers.'
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Please provide a status.'
                ]
            ],
            'icon_menu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Please provide a icon menu.'
                ]
            ],
            'link_menu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Please provide a link menu.'
                ]
            ]
        ]);

        if (!$check) {
            $validation = \Config\Services::validation();
            return redirect()->to('/menu/edit/' . $this->request->getPost('id'))->withInput()->with('validation', $validation);
        } else {

            $id = $this->request->getPost('id');
            $data = [
                'category_menu' => $this->request->getPost('category_menu'),
                'menu_name'  => $this->request->getPost('menu_name'),
                'sequence'  => $this->request->getPost('sequence'),
                'status'  => $this->request->getPost('status'),
                'parent_id '  => 0,
                'icon_menu'  => $this->request->getPost('icon_menu'),
                'link_menu'  => $this->request->getPost('link_menu'),
                'user_update' =>  $this->request->getPost('usernamelogin')
            ];

            session()->setFlashdata('success', 'The Data has been updated.');
            $this->menumodel->update($id, $data);
            return redirect()->to('/menu');
        }
    }

    public function add_submenu($id)
    {
        $add_submenu = $this->menumodel->submenu($id);
        //dd($add_submenu);
        $data = [
            'title' => 'Add Submenu|Menu',
            'h1' => 'Add Submenu ',
            'breadcrumb' => 'Menu / Add Submenu',
            'validation' => \Config\Services::validation(),
            'category_menu' => $this->menumodel->category_menu(),
            'add_submenu' => $this->menumodel->submenu($id),
            'menu1' => $this->menusidebarmodel->CategoryList1(),
            'menu2' => $this->menusidebarmodel->CategoryList2(),
            'menu3' => $this->menusidebarmodel->CategoryList3(),
            'logo' => $this->menusidebarmodel->logo()

        ];

        echo view('menu/v_menu_add_submenu', $data);
    }

    public function save_submenu()
    {
        $check = $this->validate([

            'sequence' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Please provide a sequence.',
                    'numeric' => 'Sequence must be filled with numbers.'
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Please provide a status.'
                ]
            ],
            'icon_menu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Please provide a icon menu.'
                ]
            ],
            'link_menu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Please provide a link menu.'
                ]
            ]
        ]);

        if (!$check) {
            $validation = \Config\Services::validation();
            return redirect()->to('/menu/add-submenu/' . $this->request->getPost('id'))->withInput()->with('validation', $validation);
        } else {

            $data = [
                'category_menu' => $this->request->getPost('category_menu'),
                'menu_name'  => $this->request->getPost('menu_name'),
                'sequence'  => $this->request->getPost('sequence'),
                'status'  => $this->request->getPost('status'),
                'parent_id'  => $this->request->getPost('id'),
                'icon_menu'  => $this->request->getPost('icon_menu'),
                'link_menu'  => $this->request->getPost('link_menu'),
                'user_create' =>  $this->request->getPost('usernamelogin')
            ];

            session()->setFlashdata('success', 'The Data has been saved successfully.');
            $this->menumodel->save($data);
            return redirect()->to('/menu');
        }
    }

    public function delete($id)
    {
        $this->menumodel->del_role_menu($id);
        session()->setFlashdata('success', 'The Data has been deleted.');
        return redirect()->to('/menu');
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RolesModels;
use App\Models\MenuModel;

class Roles extends BaseController
{
    public function __construct()
    {
        $this->roles = new RolesModels();
        $this->menu = new MenuModel();
    }
    public function index()
    {
        $currentPage = $this->request->getVar('page_level') ? $this->request->getVar('page_level') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $roles = $this->roles->search($keyword);
        } else {
            $roles = $this->roles;
        }

        $data = [
            'title' => 'Roles|Level Users',
            'h1' => 'Roles User',
            'breadcrumb' => 'Roles / Level Users',
            'level' => $this->roles->findAll(),
            'menu1' => $this->menusidebarmodel->CategoryList1(),
            'menu2' => $this->menusidebarmodel->CategoryList2(),
            'menu3' => $this->menusidebarmodel->CategoryList3(),
            'logo' => $this->menusidebarmodel->logo()
        ];

        echo view('level/v_levels_index', $data);
    }
    public function add()
    {
        $data = [
            'title' => 'Add|Level User',
            'h1' => 'Level User',
            'h2' => 'Add',
            'breadcrumb' => 'Role / Add Level User',
            'validation' => \Config\Services::validation(),
            'menu1' => $this->menusidebarmodel->CategoryList1(),
            'menu2' => $this->menusidebarmodel->CategoryList2(),
            'menu3' => $this->menusidebarmodel->CategoryList3(),
            'logo' => $this->menusidebarmodel->logo()
        ];
        echo view('level/v_levels_add', $data);
    }

    public function save()
    {
        $check = $this->validate([
            'descripsion' => [
                'rules' => 'required|is_unique[tbl_levels.descripsion]',
                'errors' => [
                    'required' => 'Please provide a level name',
                    'is_unique' => 'Level name is exist'
                ]
            ]
        ]);

        if (!$check) {
            // $validation = \Config\Services::validation();
            return redirect()->to('roles/add/level')->withInput()->with('validation', $check);
        } else {
            $db = \Config\Database::connect();
            $db->transStart();

            $data = [
                'descripsion' => $this->request->getPost('descripsion'),
                'user_create' =>  $this->request->getPost('usernamelogin')
            ];

            $this->roles->save($data);
            $id = $this->roles->insertID();

            $id_menu = $this->menu->findAll();
            foreach ($id_menu as $r) {
                $data_access[] = array(
                    'id_menu' => $r['id'],
                    'id_level' => $id,
                    'status' => 'N',
                    'user_create' =>  $this->request->getPost('usernamelogin')
                );
            }
            $bulider = $db->table('tbl_role_menus');
            $bulider->insertbatch($data_access);
            $db->transComplete();
            session()->setFlashdata('success', 'The Data has been saved successfully.');
            return redirect()->to('/roles');
        }
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit|Level User',
            'h1' => 'Level User',
            'h2' => 'Edit',
            'breadcrumb' => 'Role / Edit Level User',
            'validation' => \Config\Services::validation(),
            'edit' => $this->roles->find($id),
            'menu1' => $this->menusidebarmodel->CategoryList1(),
            'menu2' => $this->menusidebarmodel->CategoryList2(),
            'menu3' => $this->menusidebarmodel->CategoryList3(),
            'logo' => $this->menusidebarmodel->logo()
        ];

        echo view('level/v_levels_edit', $data);
    }

    public function update()
    {
        $check = $this->validate([
            'descripsion' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Please provide a level name'
                ]
            ]
        ]);

        if (!$check) {
            // $validation = \Config\Services::validation();
            return redirect()->to('roles/edit/level')->withInput()->with('validation', $check);
        } else {
            $id = $this->request->getPost('id');
            $data = [
                'descripsion' => $this->request->getPost('descripsion'),
                'user_update' =>  $this->request->getPost('usernamelogin')
            ];

            session()->setFlashdata('success', 'The Data has been saved successfully.');
            $this->roles->update($id, $data);
            return redirect()->to('/roles');
        }
    }

    public function access($id)
    {
        $data = [
            'title' => 'Access Menu|Level User',
            'h1' => 'Level User',
            'h2' => 'Access Menu',
            'breadcrumb' => 'Role / Access Menu Level User',
            'access' => $this->roles->find($id),
            'data1' => $this->roles->mainmenu1($id),
            'data2' => $this->roles->mainmenu2($id),
            'data3' => $this->roles->mainmenu3($id),
            'menu1' => $this->menusidebarmodel->CategoryList1(),
            'menu2' => $this->menusidebarmodel->CategoryList2(),
            'menu3' => $this->menusidebarmodel->CategoryList3(),
            'logo' => $this->menusidebarmodel->logo()
        ];

        echo view('level/v_levels_access', $data);
    }

    public function access_save()
    {
        $db      = \Config\Database::connect();

        $id_level = $this->request->getPost('id_level');
        $usernamelogin = $this->request->getPost('usernamelogin');
        // $id_menu = $this->request->getPost('id_menu');



        // $query = $db->query("SELECT id_menu FROM tbl_role_menus WHERE id_level=$id_level");
        $query = $this->roles->find_id_menu($id_level);
        // dd($query);
        foreach ($query as $r) {

            $id = $r['id'];
            $id_menu = $r['id_menu'];
            $checkbox = $this->request->getPost('' . $id_menu . '');
            // dd($checkbox);
            if ($checkbox == "") {
                $status = "N";
            } else {
                $status = "Y";
            }
            // $db->query("UPDATE tbl_role_menus SET status='$status' WHERE id_level='$id_level' AND id_menu='$id_menu'");

            $data[] = array(
                'id' => $id,
                'status' =>  $status,
                'user_update' => $usernamelogin,
                'updated_at' => date('Y-m-d H:i:s')
            );
        }
        // dd($id_menu);

        $where = "'id_level' = " . $id_level . " AND 'id_menu' = " . $id_menu . "  ";
        $builder = $db->table('tbl_role_menus');
        // $builder->set('status', $status);
        // $builder->set('user_update', $usernamelogin);
        // $builder->set('updated_at', date('Y-m-d H:i:s'));
        // $builder->where($where);
        // // $builder->where(['id_menu' => $id_menu]);
        // $builder->update();
        // $builder->insertbatch($data);
        $builder->updateBatch($data, 'id');
        session()->setFlashdata('success', 'The Data has been saved successfully.');
        return redirect()->to('/roles');
    }

    public function del_role_menu($id)
    {
        $this->roles->del_role_menu($id);
        session()->setFlashdata('success', 'The Data has been deleted.');
        return redirect()->to('/roles');
    }
}

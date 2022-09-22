<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TaxModel;

class Tax extends BaseController
{
    public function __construct()
    {
        $this->taxModel = new TaxModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Tax',
            'h1' => 'Tax',
            'breadcrumb' => 'Tax',
            'tax' => $this->taxModel->index(),
            'validation' => \Config\Services::validation(),
            'menu1' => $this->menusidebarmodel->CategoryList1(),
            'menu2' => $this->menusidebarmodel->CategoryList2(),
            'menu3' => $this->menusidebarmodel->CategoryList3(),
            'logo' => $this->menusidebarmodel->logo()
        ];
        echo view('tax/v_tax_index', $data);
    }
}

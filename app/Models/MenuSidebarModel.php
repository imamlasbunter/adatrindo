<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\MySQLi\Builder;

class MenuSidebarModel extends Model
{
    protected $table                = 'tbl_menu';
    protected $primaryKey           = 'id';
    protected $returnType           = 'array';
    protected $allowedFields        = [];

    // Dates
    protected $useTimestamps        = True;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    /////// For main menu
    function CategoryList1()
    {
        $id_user = session()->get('isLoggedIn');
        $id_level = session()->get('level');

        $list = "";
        $sql = "SELECT DISTINCT a.* FROM tbl_menus a LEFT JOIN tbl_role_menus b ON a.id=b.id_menu LEFT JOIN tbl_users c ON b.id=c.level WHERE a.parent_id=0 AND a.status='A' AND a.category_menu ='1' AND b.status='Y' AND b.id_level =$id_level ORDER BY a.sequence";
        // dd($sql);
        $qry = $this->db->query($sql);
        $parent =  $qry->getresult();
        //print_r($parent);
        $mainlist = "";
        foreach ($parent as $pr) {
            $mainlist .= $this->CategoryTree1($list, $pr->id, $pr->menu_name, $pr->icon_menu, $pr->link_menu, $append = 0);
        }
        $mainlist .= "</li>";
        return $mainlist;
    }
    function CategoryTree1($list, $id, $name, $icon, $link, $append)
    {
        $uri = current_url(true);
        $path = strtoupper($uri->getSegment(1));
        $nameupper = strtoupper($link);
        // $parent_id = 0;
        // $sqlCheck = "SELECT parent_id FROM tbl_menus WHERE parent_id =$id ";
        // $qry = $this->db->query($sqlCheck);
        // $row =  $qry->getRow();
        // if (isset($row)) $parent_id = $row->parent_id;

        if ($path == $nameupper) {
            $class = "nav-link active";
        } else {
            $class = "nav-link";
        }

        $check = $this->hasChild1($id);
        if ($check == 0) {
            $list = '<li class="nav-item"><a href="' . base_url($link) . '"  class="' . $class . '" id="link" Onclick="klik()">
            <i class="nav-icon ' . $icon . '"></i><p>' . $name . '</p></a>';
        } else {
            $list = '<li class="nav-item has-treeview"><a href="' . $link . '"  class="' . $class . '" id="link" Onclick="klik()"><i class="nav-icon ' . $icon . '"></i><p>' . $name . '<i class="fas fa-angle-left right"></i>
            </p></a>';
        }
        //dd($list);
        $id_user = session()->get('isLoggedIn');
        if ($this->hasChild1($id)) // check if the id has a child
        {
            $append++;
            $list .= "<ul class='nav nav-treeview'> <li class='nav-item'>";
            $sql = "SELECT  DISTINCT a.* FROM tbl_menus a LEFT JOIN tbl_role_menus b ON a.id=b.id_menu LEFT JOIN tbl_users c ON b.id=c.level WHERE  a.category_menu ='1' AND a.status='A' AND b.status='Y' AND parent_id =$id ORDER BY a.sequence";
            $qry = $this->db->query($sql);
            $child = $qry->getresult();
            foreach ($child as $pr) {
                $list .= $this->CategoryTree1($list, $pr->id, $pr->menu_name, $pr->icon_menu, $pr->link_menu, $append);
            };
            $list .= "</li></ul>";
        }
        //dd($list);
        return $list;
    }
    function hasChild1($parent_id)
    {
        $sql = $this->db->query("SELECT COUNT(*) as count FROM tbl_menus WHERE status='A' AND parent_id = '" . $parent_id . "'")->getrow();
        return $sql->count;
    }
    //end main menu //


    //for report ///
    function CategoryList2()
    {
        $id_level = session()->get('level');
        $list = "";
        $sql = "SELECT DISTINCT a.* FROM tbl_menus a LEFT JOIN tbl_role_menus b ON a.id=b.id_menu LEFT JOIN tbl_users c ON b.id=c.level WHERE a.parent_id=0 AND a.status='A' AND a.category_menu ='2' AND b.status='Y' AND b.id_level =$id_level ORDER BY a.sequence";
        $qry = $this->db->query($sql);
        $parent =  $qry->getresult();
        //print_r($parent);
        $mainlist = "";
        foreach ($parent as $pr) {
            $mainlist .= $this->CategoryTree2($list, $pr->id, $pr->menu_name, $pr->icon_menu, $pr->link_menu, $append = 0);
        }
        $mainlist .= "</li>";
        return $mainlist;
    }
    function CategoryTree2($list, $id, $name, $icon, $link, $append)
    {
        $uri = current_url(true);
        $path = strtoupper($uri->getSegment(1));
        $nameupper = strtoupper($link);
        // $parent_id = 0;
        // $sqlCheck = "SELECT parent_id FROM tbl_menus WHERE parent_id =$id ";
        // $qry = $this->db->query($sqlCheck);
        // $row =  $qry->getRow();
        // if (isset($row)) $parent_id = $row->parent_id;

        if ($path == $nameupper) {
            $class = "nav-link active";
        } else {
            $class = "nav-link";
        }

        $check = $this->hasChild2($id);
        if ($check == 0) {
            $list = '<li class="nav-item"><a href="' . base_url($link) . '"  class="' . $class . '" id="link" Onclick="klik()">
            <i class="nav-icon ' . $icon . '"></i><p>' . $name . '</p></a>';
        } else {
            $list = '<li class="nav-item has-treeview"><a href="' . $link . '"  class="' . $class . '" id="link" Onclick="klik()"><i class="nav-icon ' . $icon . '"></i><p>' . $name . '<i class="fas fa-angle-left right"></i>
            </p></a>';
        }
        //dd($list);
        $id_user = session()->get('isLoggedIn');
        if ($this->hasChild2($id)) // check if the id has a child
        {
            $append++;
            $list .= "<ul class='nav nav-treeview'> <li class='nav-item'>";
            $sql = "SELECT  DISTINCT a.* FROM tbl_menus a LEFT JOIN tbl_role_menus b ON a.id=b.id_menu LEFT JOIN tbl_users c ON b.id=c.level WHERE  a.category_menu ='2' AND a.status='A' AND b.status='Y' AND parent_id =$id ORDER BY a.sequence";
            $qry = $this->db->query($sql);
            $child = $qry->getresult();
            foreach ($child as $pr) {
                $list .= $this->CategoryTree2($list, $pr->id, $pr->menu_name, $pr->icon_menu, $pr->link_menu, $append);
            };
            $list .= "</li></ul>";
        }
        //dd($list);
        return $list;
    }
    function hasChild2($parent_id)
    {
        $sql = $this->db->query("SELECT COUNT(*) as count FROM tbl_menus WHERE status='A' AND parent_id = '" . $parent_id . "'")->getrow();
        return $sql->count;
    }
    //end report///






    // For Setting
    function CategoryList3()
    {

        $id_level = session()->get('level');
        $list = "";
        $sql = "SELECT DISTINCT a.* FROM tbl_menus a LEFT JOIN tbl_role_menus b ON a.id=b.id_menu LEFT JOIN tbl_users c ON b.id=c.level WHERE a.parent_id=0 AND  a.status='A' AND a.category_menu ='3' AND b.status='Y' AND b.id_level =$id_level ORDER BY a.sequence";
        $qry = $this->db->query($sql);
        $parent =  $qry->getresult();
        //print_r($parent);
        $mainlist = "";
        foreach ($parent as $pr) {
            $mainlist .= $this->CategoryTree3($list, $pr->id, $pr->menu_name, $pr->icon_menu, $pr->link_menu, $append = 0);
        }
        $mainlist .= "</li>";
        return $mainlist;
    }
    function CategoryTree3($list, $id, $name, $icon, $link, $append)
    {
        $uri = current_url(true);
        // $path = Str_replace("-", " ", strtoupper($uri->getSegment(1)));
        $path = strtoupper($uri->getSegment(1));
        $nameupper = strtoupper($link);
        // $parent_id = 0;
        // $sqlCheck = "SELECT parent_id FROM tbl_menus WHERE parent_id =$id ";
        // $qry = $this->db->query($sqlCheck);
        // $row =  $qry->getRow();
        // if (isset($row)) $parent_id = $row->parent_id;

        if ($path == $nameupper) {
            $class = "nav-link active";
        } else {
            $class = "nav-link";
        }

        $check = $this->hasChild3($id);
        if ($check == 0) {
            $list = '<li class="nav-item"><a href="' . base_url($link) . '"  class="' . $class . '" id="link" Onclick="klik()">
            <i class="nav-icon ' . $icon . '"></i><p>' . $name . '</p></a>';
        } else {
            $list = '<li class="nav-item has-treeview"><a href="' . $link . '"  class="' . $class . '" id="link" Onclick="klik()"><i class="nav-icon ' . $icon . '"></i><p>' . $name . '<i class="fas fa-angle-left right"></i>
            </p></a>';
        }
        //dd($list);
        $id_user = session()->get('isLoggedIn');
        if ($this->hasChild3($id)) // check if the id has a child
        {
            $append++;
            $list .= "<ul class='nav nav-treeview'> <li class='nav-item'>";
            $sql = "SELECT  DISTINCT a.* FROM tbl_menus a LEFT JOIN tbl_role_menus b ON a.id=b.id_menu LEFT JOIN tbl_users c ON b.id=c.level WHERE  a.category_menu ='3' AND a.status='A' AND b.status='Y' AND parent_id =$id ORDER BY a.sequence";
            $qry = $this->db->query($sql);
            $child = $qry->getresult();
            foreach ($child as $pr) {
                $list .= $this->CategoryTree3($list, $pr->id, $pr->menu_name, $pr->icon_menu, $pr->link_menu, $append);
            };
            $list .= "</li></ul>";
        }
        //dd($list);
        return $list;
    }

    function hasChild3($parent_id)
    {
        $sql = $this->db->query("SELECT COUNT(*) as count FROM tbl_menus WHERE status='A' AND parent_id = '" . $parent_id . "'")->getrow();
        return $sql->count;
    }

    function Logo()
    {
        // $sql = $this->table('tbl_profile_comp');
        // $sql->select('tbl_profile_comp.*, tbl_currency.currency_name');
        // $sql->join('tbl_currency', 'tbl_currency.id=tbl_profile_comp.currency_id', 'left');
        // $result = $sql->get();
        $logo = "";
        $sql = "SELECT * FROM tbl_profile_comp";
        $qry = $this->db->query($sql);
        $loop = $qry->getresult();
        foreach ($loop as $row) {
            $logo = $row->logo;
        }
        return $logo;
    }
}

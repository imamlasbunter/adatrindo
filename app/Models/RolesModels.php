<?php

namespace App\Models;

use CodeIgniter\Database\SQLite3\Table;
use CodeIgniter\Model;

class RolesModels extends Model
{
    protected $table                = 'tbl_levels';
    protected $primaryKey           = 'id';
    protected $returnType           = 'array';
    protected $allowedFields        = [
        'descripsion',
        'user_create',
        'user_update',
        'user_delete'
    ];

    // Dates
    protected $useTimestamps        = True;
    public function search($keyword)
    {
        return $this->table('tbl_levels')->like('descripsion ', $keyword);
    }

    // setting
    public function mainmenu1($id)
    {
        $list = "";
        $sql = "SELECT DISTINCT  a.*,b.status, b.id_level FROM tbl_menus a LEFT JOIN tbl_role_menus b ON a.id=b.id_menu AND b.id_level = $id WHERE a.parent_id=0 AND  a.category_menu ='1' Order by a.id ASC";

        $qry = $this->db->query($sql);
        $parent =  $qry->getresult();
        $mainlist = "<ul style='list-style-type:none;'>";
        foreach ($parent as $pr) {
            $mainlist .= $this->submenu1($list, $pr->id, $pr->menu_name, $pr->icon_menu, $pr->link_menu, $pr->status, $pr->id_level, $append = 0);
        }
        $mainlist .= "</ul></li>";
        return $mainlist;
    }
    public function submenu1($list, $id, $name, $icon, $link, $status, $idlvl, $append)
    {
        //$id_level = session()->get('level');
        // if ($status == "Y" and $id_level == $idlvl) $checked = "checked";
        if ($status == "Y") $checked = "checked";
        else $checked = "";
        $list = '<li style="list-style-type:none; margin-left:-38px;""><input type="checkbox" id="checkboxPrimary1" name="' . $id . '" value="Y" ' . $checked . '>&nbsp;' . $name;


        if ($this->hasChild1($id)) // check if the id has a child
        {
            $append++;
            $list .= "<ul> ";
            $sql = "SELECT DISTINCT  a.*,b.status, b.id_level FROM tbl_menus a LEFT JOIN tbl_role_menus b ON a.id=b.id_menu AND b.id_level = $id WHERE a.parent_id=0 AND  a.category_menu ='1' Order by a.id ASC";
            $qry = $this->db->query($sql);
            $child = $qry->getresult();
            foreach ($child as $pr) {
                $list .= $this->submenu1($list, $pr->id, $pr->menu_name, $pr->icon_menu, $pr->link_menu, $pr->status, $pr->id_level, $append);
            };
            $list .= "</ul>";
        }
        return $list;
    }
    function hasChild1($parent_id)
    {
        $sql = $this->db->query("SELECT COUNT(*) as count FROM tbl_menus WHERE parent_id = '" . $parent_id . "'")->getrow();
        return $sql->count;
    }
    //end Setting
    // setting
    public function mainmenu2($id)
    {
        $list = "";
        $sql = "SELECT DISTINCT  a.*,b.status, b.id_level FROM tbl_menus a LEFT JOIN tbl_role_menus b ON a.id=b.id_menu AND b.id_level = $id WHERE a.parent_id=0 AND  a.category_menu ='2' Order by a.id ASC";
        $qry = $this->db->query($sql);
        $parent =  $qry->getresult();
        $mainlist = "<ul style='list-style-type:none;'>";
        foreach ($parent as $pr) {
            $mainlist .= $this->submenu2($list, $pr->id, $pr->menu_name, $pr->icon_menu, $pr->link_menu, $pr->status, $pr->id_level, $append = 0);
        }
        $mainlist .= "</ul></li>";
        return $mainlist;
    }
    public function submenu2($list, $id, $name, $icon, $link, $status, $idlvl, $append)
    {


        // $id_level = session()->get('level');
        // if ($status == "Y" and $id_level == $idlvl) $checked = "checked";
        if ($status == "Y") $checked = "checked";
        else $checked = "";
        $list = '<li style="list-style-type:none; margin-left:-38px;""><input type="checkbox" id="checkboxPrimary1" name="' . $id . '" value="Y" ' . $checked . '>&nbsp;' . $name;


        if ($this->hasChild2($id)) // check if the id has a child
        {
            $append++;
            $list .= "<ul> ";
            $sql = "SELECT DISTINCT  a.*,b.status, b.id_level FROM tbl_menus a LEFT JOIN tbl_role_menus b ON a.id=b.id_menu WHERE parent_id =$id Order by a.id ASC";
            $qry = $this->db->query($sql);
            $child = $qry->getresult();
            foreach ($child as $pr) {
                $list .= $this->submenu2($list, $pr->id, $pr->menu_name, $pr->icon_menu, $pr->link_menu, $pr->status, $pr->id_level, $append);
            };
            $list .= "</ul>";
        }
        return $list;
    }
    function hasChild2($parent_id)
    {
        $sql = $this->db->query("SELECT COUNT(*) as count FROM tbl_menus WHERE parent_id = '" . $parent_id . "'")->getrow();
        return $sql->count;
    }
    //end Setting

    // setting
    public function mainmenu3($id)
    {

        $sql = "SELECT DISTINCT  a.*,b.status, b.id_level FROM tbl_menus a LEFT JOIN tbl_role_menus b ON a.id=b.id_menu AND b.id_level = $id WHERE a.parent_id=0 AND  a.category_menu ='3'  Order by a.id ASC";
        $qry = $this->db->query($sql);
        $parent =  $qry->getresult();
        $mainlist = "<ul style='list-style-type:none;'>";
        $list = '';
        foreach ($parent as $pr) {
            $mainlist .= $this->submenu3($list, $pr->id, $pr->menu_name, $pr->icon_menu, $pr->link_menu, $pr->status, $pr->id_level, $append = 0);
        }
        $mainlist .= "</ul></li>";
        return $mainlist;
    }
    public function submenu3($list, $id, $name, $icon, $link, $status, $idlvl, $append)
    {
        // $id_level = session()->get('level');
        // if ($status == "Y" and $id_level == $idlvl) $checked = "checked";
        if ($status == "Y") $checked = "checked";
        else $checked = "";
        $list = '<li style="list-style-type:none; margin-left:-38px;""><input type="checkbox" id="checkboxPrimary1" name="' . $id . '" value="Y" ' . $checked . '>&nbsp;' . $name;

        if ($this->hasChild3($id)) // check if the id has a child
        {
            $append++;
            $list .= "<ul> ";
            $sql = "SELECT DISTINCT  a.*,b.status, b.id_level FROM tbl_menus a LEFT JOIN tbl_role_menus b ON a.id=b.id_menu WHERE parent_id =$id Order by a.id ASC";
            $qry = $this->db->query($sql);
            $child = $qry->getresult();
            foreach ($child as $pr) {
                $list .= $this->submenu3($list, $pr->id, $pr->menu_name, $pr->icon_menu, $pr->link_menu, $pr->status, $pr->id_level, $append);
            };
            $list .= "</ul>";
        }
        return $list;
    }
    function hasChild3($parent_id)
    {
        $sql = $this->db->query("SELECT COUNT(*) as count FROM tbl_menus WHERE parent_id = '" . $parent_id . "'")->getrow();
        return $sql->count;
    }
    //end Setting

    function del_role_menu($id)
    {

        $db = \Config\Database::connect();
        $db->transStart();
        $sql = $db->table('tbl_role_menus');
        $sql->delete(['id_level' => $id]);
        $sql2 = $this->table('tbl_levels');
        $sql2->delete(['id' => $id]);
        $db->transComplete();
    }

    function find_id_menu($id_level)
    {
        return $this->db->table('tbl_role_menus')->select('id,id_menu')->where('id_level', $id_level)->get()->getResultArray();
        // $sql = $this->db->table('tbl_role_menus')->select('id_menu')->where('id_level', $id_level)->get()->getResultArray();
        // dd($sql)
    }
}

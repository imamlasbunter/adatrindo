<?php

namespace App\Models;

use CodeIgniter\Model;

class UserProfileModel extends Model
{
    protected $table                = 'tbl_users';
    protected $primaryKey           = 'id';
    protected $allowedFields        = ['username', 'password', 'salt', 'name', 'email', 'level', 'pp', 'pp_name', 'pp_type', 'user_create', 'user_update', 'user_delete'];

    // Dates
    protected $useTimestamps        = true;
}

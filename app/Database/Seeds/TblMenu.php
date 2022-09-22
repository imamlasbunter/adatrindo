<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TblMenu extends Seeder
{
	public function run()
	{
		$data_insert = [
			[
				//'id' => 1,
				'category_menu' => '1',
				'menu_name' => 'Dashboard',
				'sequence' => 1,
				'status' => 'A',
				'parent_id' => 0,
				'icon_menu' => 'fas fa-tachometer-alt',
				'link_menu' => 'dashboard',
				'user_create' => 'System'
			],
			[
				// 'id' => 2,
				'category_menu' => '1',
				'menu_name' => 'Sales',
				'sequence' => 2,
				'status' => 'A',
				'parent_id' => 0,
				'icon_menu' => 'fas fa-shopping-cart',
				'link_menu' => 'sales',
				'user_create' => 'System'
			],
			[
				// 'id' => 5,
				'category_menu' => '2',
				'menu_name' => 'Sales',
				'sequence' => 1,
				'status' => 'A',
				'parent_id' => 0,
				'icon_menu' => 'fas fa-chart-line',
				'link_menu' => 'sales-report',
				'user_create' => 'System'
			],
			[
				// 'id' => 5,
				'category_menu' => '2',
				'menu_name' => 'Stock IN\Out',
				'sequence' => 2,
				'status' => 'A',
				'parent_id' => 0,
				'icon_menu' => 'fas fa-list',
				'link_menu' => 'stock-in-out-report',
				'user_create' => 'System'
			],
			[
				// 'id' => 5,
				'category_menu' => '2',
				'menu_name' => 'Account List',
				'sequence' => 3,
				'status' => 'A',
				'parent_id' => 0,
				'icon_menu' => 'fas fa-clipboard-list',
				'link_menu' => 'account-list',
				'user_create' => 'System'
			],
			[
				// 'id' => 4,
				'category_menu' => '3',
				'menu_name' => 'Stock In',
				'sequence' => 1,
				'status' => 'A',
				'parent_id' => 0,
				'icon_menu' => 'fas fa-list',
				'link_menu' => 'stock-in',
				'user_create' => 'System'
			],
			[
				// 'id' => 5,
				'category_menu' => '3',
				'menu_name' => 'Stock Out',
				'sequence' => 2,
				'status' => 'A',
				'parent_id' => 0,
				'icon_menu' => 'fas fa-list',
				'link_menu' => 'stock-out',
				'user_create' => 'System'
			],
			[
				// 'id' => 5,
				'category_menu' => '3',
				'menu_name' => 'Products',
				'sequence' => 3,
				'status' => 'A',
				'parent_id' => 0,
				'icon_menu' => 'fas fas fa-box',
				'link_menu' => 'product',
				'user_create' => 'System'
			],
			[
				// 'id' => 5,
				'category_menu' => '3',
				'menu_name' => 'Contact',
				'sequence' => 4,
				'status' => 'A',
				'parent_id' => 0,
				'icon_menu' => ' fas fa-address-book',
				'link_menu' => 'contact',
				'user_create' => 'System'
			],
			[
				// 'id' => 5,
				'category_menu' => '3',
				'menu_name' => 'Roles',
				'sequence' => 5,
				'status' => 'A',
				'parent_id' => 0,
				'icon_menu' => 'fas fa-user-tag',
				'link_menu' => 'roles',
				'user_create' => 'System'
			],
			[
				// 'id' => 5,
				'category_menu' => '3',
				'menu_name' => 'Users',
				'sequence' => 6,
				'status' => 'A',
				'parent_id' => 0,
				'icon_menu' => 'fas fa-users',
				'link_menu' => 'users',
				'user_create' => 'System'
			],
			[
				// 'id' => 5,
				'category_menu' => '3',
				'menu_name' => 'Journal Setting',
				'sequence' => 7,
				'status' => 'A',
				'parent_id' => 0,
				'icon_menu' => 'fas fa-clipboard-list',
				'link_menu' => 'journal-setting',
				'user_create' => 'System'
			],
			[
				// 'id' => 5,
				'category_menu' => '3',
				'menu_name' => 'Company',
				'sequence' => 8,
				'status' => 'A',
				'parent_id' => 0,
				'icon_menu' => 'fas fa-building',
				'link_menu' => 'Company',
				'user_create' => 'System'
			],
			[
				// 'id' =>,
				'category_menu' => '3',
				'menu_name' => 'Tax',
				'sequence' => 9,
				'status' => 'A',
				'parent_id' => 0,
				'icon_menu' => 'fas fa-percent',
				'link_menu' => 'tax',
				'user_create' => 'System'
			],
			[
				// 'id' =>,
				'category_menu' => '3',
				'menu_name' => 'Menu',
				'sequence' => 10,
				'status' => 'A',
				'parent_id' => 0,
				'icon_menu' => 'fas fa-bars',
				'link_menu' => 'menu',
				'user_create' => 'System'
			],
			[
				// 'id' =>,
				'category_menu' => '3',
				'menu_name' => 'Discount Program',
				'sequence' => 4,
				'status' => 'A',
				'parent_id' => 0,
				'icon_menu' => 'fas fa-bars',
				'link_menu' => 'discount-program',
				'user_create' => 'System'
			]


			// [
			// 	// 'id' => 5,
			// 	'category_menu' => '3',
			// 	'menu_name' => 'Suppliers',
			// 	'sequence' => 11,
			// 	'status' => 'A',
			// 	'parent_id' => 0,
			// 	'icon_menu' => 'fas fas fa-truck',
			// 	'link_menu' => 'suppliers',
			// 	'user_create' => 'System'
			// ],
			// [
			// 	// 'id' => 5,
			// 	'category_menu' => '3',
			// 	'menu_name' => 'Customers',
			// 	'sequence' => 12,
			// 	'status' => 'A',
			// 	'parent_id' => 0,
			// 	'icon_menu' => 'fas fas fa-users',
			// 	'link_menu' => 'customers',
			// 	'user_create' => 'System'
			// ],
		];

		foreach ($data_insert as $data) {
			$this->db->table('tbl_menus')->insert($data);
		}
	}
}

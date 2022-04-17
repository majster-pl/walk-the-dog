<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class AdminTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // base tables
        \Encore\Admin\Auth\Database\Menu::truncate();
        \Encore\Admin\Auth\Database\Menu::insert(
            [
                [
                    "icon" => "fa-tasks",
                    "order" => 5,
                    "parent_id" => 0,
                    "permission" => NULL,
                    "title" => "Admin",
                    "uri" => ""
                ],
                [
                    "icon" => "fa-users",
                    "order" => 6,
                    "parent_id" => 2,
                    "permission" => NULL,
                    "title" => "Users",
                    "uri" => "auth/users"
                ],
                [
                    "icon" => "fa-user",
                    "order" => 7,
                    "parent_id" => 2,
                    "permission" => NULL,
                    "title" => "Roles",
                    "uri" => "auth/roles"
                ],
                [
                    "icon" => "fa-ban",
                    "order" => 8,
                    "parent_id" => 2,
                    "permission" => NULL,
                    "title" => "Permission",
                    "uri" => "auth/permissions"
                ],
                [
                    "icon" => "fa-bars",
                    "order" => 9,
                    "parent_id" => 2,
                    "permission" => NULL,
                    "title" => "Menu",
                    "uri" => "auth/menu"
                ],
                [
                    "icon" => "fa-history",
                    "order" => 10,
                    "parent_id" => 2,
                    "permission" => NULL,
                    "title" => "Operation log",
                    "uri" => "auth/logs"
                ],
                [
                    "icon" => "fa-paw",
                    "order" => 2,
                    "parent_id" => 0,
                    "permission" => NULL,
                    "title" => "Place Types",
                    "uri" => NULL
                ],
                [
                    "icon" => "fa-plus-square",
                    "order" => 4,
                    "parent_id" => 8,
                    "permission" => NULL,
                    "title" => "Add New",
                    "uri" => "/place-types/create"
                ],
                [
                    "icon" => "fa-paw",
                    "order" => 3,
                    "parent_id" => 8,
                    "permission" => NULL,
                    "title" => "All",
                    "uri" => "/place-types"
                ],
                [
                    "icon" => "fa-users",
                    "order" => 1,
                    "parent_id" => 0,
                    "permission" => NULL,
                    "title" => "Users",
                    "uri" => "/users"
                ]
            ]
        );

        \Encore\Admin\Auth\Database\Permission::truncate();
        \Encore\Admin\Auth\Database\Permission::insert(
            [
                [
                    "http_method" => "",
                    "http_path" => "*",
                    "name" => "All permission",
                    "slug" => "*"
                ],
                [
                    "http_method" => "GET",
                    "http_path" => "/",
                    "name" => "Dashboard",
                    "slug" => "dashboard"
                ],
                [
                    "http_method" => "",
                    "http_path" => "/auth/login\r\n/auth/logout",
                    "name" => "Login",
                    "slug" => "auth.login"
                ],
                [
                    "http_method" => "GET,PUT",
                    "http_path" => "/auth/setting",
                    "name" => "User setting",
                    "slug" => "auth.setting"
                ],
                [
                    "http_method" => "",
                    "http_path" => "/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs",
                    "name" => "Auth management",
                    "slug" => "auth.management"
                ]
            ]
        );

        \Encore\Admin\Auth\Database\Role::truncate();
        \Encore\Admin\Auth\Database\Role::insert(
            [
                [
                    "name" => "Administrator",
                    "slug" => "administrator"
                ]
            ]
        );

        // pivot tables
        DB::table('admin_role_menu')->truncate();
        DB::table('admin_role_menu')->insert(
            [
                [
                    "menu_id" => 2,
                    "role_id" => 1
                ],
                [
                    "menu_id" => 8,
                    "role_id" => 1
                ],
                [
                    "menu_id" => 9,
                    "role_id" => 1
                ],
                [
                    "menu_id" => 10,
                    "role_id" => 1
                ]
            ]
        );

        DB::table('admin_role_permissions')->truncate();
        DB::table('admin_role_permissions')->insert(
            [
                [
                    "permission_id" => 1,
                    "role_id" => 1
                ]
            ]
        );

        // finish
    }
}

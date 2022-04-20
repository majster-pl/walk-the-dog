<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        exec('php artisan admin:install');
        $this->call(AdminTablesSeeder::class);
        $this->call(PermissionsDemoSeeder::class);
    }
}
